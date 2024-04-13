<?php

namespace app\models;

use app\core\Model;
use app\core\DbModel;

class User extends DbModel
{
    public int $user_id = 0;
    public string $username;
    public string $email;
    public string $password;
    public int $role_id;


    // table name of the user model
    public static function tableName(): string
    {
        return 'users';
    }

    // primary key of the user model
    public static function primaryKey(): string
    {
        return 'user_id';
    }

    // hashes the password and saves (registers) the user
    public function save()
    {
        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        return parent::save();
    }

    // defines the rules for the user attributes
    public function rules(): array
    {
        return [
            'username' => [self::REQUIRED, [self::MAX, 'max' => 255]],
            'email' => [self::REQUIRED, self::VALID_EMAIL, [self::UNIQUE, 'class' => self::class, 'exclude' => $this->user_id], [self::MAX, 'max' => 254]],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 6]],
            'role_id' => [self::REQUIRED, self::MISMATCH]
        ];
    }

    // defines the attributes for the user model
    public function attributes(): array
    {
        return ['username', 'email', 'password', 'role_id'];
    }

    // checks if the user has a role
    public function hasRole($roleNames): bool
    {
        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }

        foreach ($roleNames as $roleName) {
            $role = $this->role();

            if ($role && $role->name === $roleName) {
                return true;
            }
        }

        return false;
    }

    // a user has a role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // a user has many decks
    public function decks()
    {
        return $this->hasMany(Deck::class, 'user_id');
    }
}
