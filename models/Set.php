<?php

namespace app\models;

use app\core\DbModel;

class Set extends DbModel
{
    public string $name;

    public static function tableName(): string
    {
        return 'sets';
    }

    public static function primaryKey(): string
    {
        return 'set_id';
    }


    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name'];
    }
}