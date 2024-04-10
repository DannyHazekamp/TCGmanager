<?php

namespace app\models;

use app\core\Model;
use app\core\DbModel;

class User extends DbModel
{
    public int $user_id;
    public string $username;
    public string $email;
    public string $password;
    public int $role_id;


    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'user_id';
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
            'email' => [self::REQUIRED, self::VALID_EMAIL, [self::UNIQUE, 'class' => self::class, 'exclude' => $this->user_id]],
            'password' => [self::REQUIRED],
            'role_id' => [self::REQUIRED, self::MISMATCH]
        ];
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'role_id'];
    }

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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function decks()
    {
        return $this->hasMany(Deck::class, 'user_id');
    }

}