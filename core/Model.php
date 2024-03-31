<?php

namespace app\core;

abstract class Model 
{
    public const REQUIRED = 'required';
    public const VALID_EMAIL = 'email';
    public const MIN = 'min';
    public const MAX = 'max';


    public function loadData($data)
    {
        foreach($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];

    public function validate() 
    {
        foreach($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach($rules as $rule) {
                if($rule === self::REQUIRED && !$value) {
                    $this->addError($attribute, self::REQUIRED);
                }

                if($rule === self::VALID_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::VALID_EMAIL);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule)
    {
        $message = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages() 
    {
        return [
            self::REQUIRED => 'This field is required',
            self::VALID_EMAIL => 'This field must be a valid email',
            self::MIN => 'Min length of this field must be {min}',
            self::MAX => 'Max length of this field must be {max}'
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