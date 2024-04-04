<?php

namespace app\models;

use app\core\Model;
use app\core\DbModel;

class User extends DbModel
{
    public string $username;
    public string $email;
    public string $password;
    public int $role_id;

    public function tableName(): string
    {
        return 'users';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'username' => [self::REQUIRED],
            'email' => [self::REQUIRED, self::VALID_EMAIL, [self::UNIQUE, 'class' => self::class]],
            'password' => [self::REQUIRED],
            'role_id' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'role_id'];
    }

}