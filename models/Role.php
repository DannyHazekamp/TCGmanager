<?php 

namespace app\models;

use app\core\DbModel;

class Role extends DbModel
{
    public string $name;


    public static function tableName(): string
    {
        return 'roles';
    }

    public static function userId(): string 
    {
        return '';
    }

    public static function roleId(): string
    {
        return 'role_id';
    }
    
    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return ['name'];
    }
}