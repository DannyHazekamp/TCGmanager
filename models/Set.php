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