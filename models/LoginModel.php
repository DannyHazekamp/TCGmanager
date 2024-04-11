<?php

namespace app\models;

use app\core\App;
use app\core\Model;

class LoginModel extends Model
{
    public string $email;
    public string $password;


    public static function primaryKey(): string
    {
        return 'user_id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::REQUIRED, self::VALID_EMAIL, [self::MAX, 'max' => 254]],
            'password' => [self::REQUIRED]
        ];
    }

    public function login()
    {
        $user = (new User())->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'A user with this email and password combination does not exist');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'A user with this email and password combination does not exist');
            return false;
        }

        return App::$app->login($user);
    }
}
