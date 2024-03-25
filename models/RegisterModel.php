<?php

namespace app\models;
use app\core\Model;

class RegisterModel extends Model
{
    public string $username;
    public string $email;
    public string $password;

    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [
            'username' => [self::REQUIRED],
            'email' => [self::REQUIRED, self::VALID_EMAIL],
            'password' => [self::REQUIRED, [self::MIN => '6'], [SELF::MAX => '32']]
        ];
    }

}