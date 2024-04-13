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


    // loads data into the model
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    abstract public static function primaryKey(): string;

    public array $errors = [];

    // used for validating model attributes
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::REQUIRED && !$value) {         // makes sure input fields are not empty
                    $this->addErrorRule($attribute, self::REQUIRED);
                }

                if ($ruleName === self::VALID_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {    // checks if email is valid
                    $this->addErrorRule($attribute, self::VALID_EMAIL);
                }
                if ($ruleName === self::MIN && strlen($value) < $rule['min']) {     // gives a minimum length to input fields
                    $this->addErrorRule($attribute, self::MIN);
                }
                if ($ruleName === self::MAX && strlen($value) > $rule['max']) {     // gives a maximum length to input fields
                    $this->addErrorRule($attribute, self::MAX);
                }

                if ($ruleName === self::UNIQUE) {       // checks if the value is unique
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $excludeUser = $rule['exclude'] ?? null;

                    $excludeCondition = $excludeUser ? "AND user_id != :user_id" : "";
                    $sql = "SELECT * FROM $tableName WHERE $uniqueAttribute = :attribute $excludeCondition";

                    $statement = App::$app->db->prepare($sql);
                    $statement->bindValue(":attribute", $value);

                    if ($excludeUser) {
                        $statement->bindValue(":user_id", $excludeUser);
                    }

                    $statement->execute();
                    $rec = $statement->fetchObject();

                    if ($rec) {
                        $this->addErrorRule($attribute, self::UNIQUE);
                    }
                }
                if ($ruleName === self::MISMATCH) {        // checks if role_id is 1, 2 or 3 otherwise wont accept the value
                    $validRoleIDs = [1, 2, 3];
                    if (!in_array($value, $validRoleIDs)) {
                        $this->addErrorRule($attribute, self::MISMATCH);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    // adds error message for specific attribute and rule
    private function addErrorRule(string $attribute, string $rule)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
    }

    // adds a custom error message for a specific attribute
    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    // returns the error messages for the validation rules
    public function errorMessages()
    {
        return [
            self::REQUIRED => 'This field is required',
            self::VALID_EMAIL => 'This field must be a valid email',
            self::MIN => 'Minimum length of this field must be 6',
            self::MAX => 'Maximum length of this field surpassed',
            self::UNIQUE => 'This email already exists',
            self::MISMATCH => 'Not a valid value for this field'
        ];
    }

    // check if errors exist for the attribute
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    // returns the first error message for the attribute
    public function getError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
