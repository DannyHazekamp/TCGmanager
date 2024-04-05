<?php

namespace app\models;

use app\core\DbModel;

class Set extends DbModel
{
    public string $name;
    public string $release_date;

    public static function tableName(): string
    {
        return 'cards';
    }


    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED],
            'release_date' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name', 'release_date'];
    }
}