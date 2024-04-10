<?php

namespace app\core;

abstract class Model 
{
    public const REQUIRED = 'required';
    public const VALID_EMAIL = 'email';
    public const MIN = 'min';
    public const MAX = 'max';
    public const UNIQUE = 'unique';
    public const MISMATCH = 'mismatch';


    public function loadData($data)
    {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    abstract public static function primaryKey(): string;

    public array $errors = [];

    public function validate() 
    {
        foreach($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach($rules as $rule) {
                $ruleName = $rule; 
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::REQUIRED && !$value) {
                    $this->addErrorRule($attribute, self::REQUIRED);
                }

                if($ruleName === self::VALID_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorRule($attribute, self::VALID_EMAIL);
                }
                if ($ruleName === self::MIN && strlen($value) < $rule['min']) {
                    $this->addErrorRule($attribute, self::MIN);
                }
                if ($ruleName === self::MAX && strlen($value) > $rule['max']) {
                    $this->addErrorRule($attribute, self::MAX);
                }

                if($ruleName === self::UNIQUE) {    
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $excludeUser = $rule['exclude'] ?? null;

                    $excludeCondition = $excludeUser ? "AND user_id != :user_id" : "";
                    $sql = "SELECT * FROM $tableName WHERE $uniqueAttribute = :attribute $excludeCondition";

                    $statement = App::$app->db->prepare($sql);
                    $statement->bindValue(":attribute", $value);

                    if($excludeUser) {
                        $statement->bindValue(":user_id", $excludeUser);
                    }

                    $statement->execute();
                    $rec = $statement->fetchObject();
                    
                    if ($rec) {
                        $this->addErrorRule($attribute, self::UNIQUE);
                    }

                }
                if($ruleName === self::MISMATCH) {
                    $validRoleIDs = [1, 2, 3];
                    if (!in_array($value, $validRoleIDs)) {
                        $this->addErrorRule($attribute, self::MISMATCH);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addErrorRule(string $attribute, string $rule)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages() 
    {
        return [
            self::REQUIRED => 'This field is required',
            self::VALID_EMAIL => 'This field must be a valid email',
            self::MIN => 'Minimum length of this field must be 6',
            self::MAX => 'Max length of this field is 30',
            self::UNIQUE => 'This email already exists',
            self::MISMATCH => 'Not a valid value for this field'
        ];
    }

    public function hasError($attribute) 
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}