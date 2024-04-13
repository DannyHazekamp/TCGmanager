<?php

namespace app\models;

use app\core\DbModel;

class Role extends DbModel
{
    public string $name;


    // table name of the role model
    public static function tableName(): string
    {
        return 'roles';
    }

    // primary key of the role model
    public static function primaryKey(): string
    {
        return 'role_id';
    }

    // defines the rules for the role attributes
    public function rules(): array
    {
        return [];
    }

    // defines the attributes for the role model
    public function attributes(): array
    {
        return ['name'];
    }
}
