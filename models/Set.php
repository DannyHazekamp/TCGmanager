<?php

namespace app\models;

use app\core\DbModel;

class Set extends DbModel
{
    public string $name;

    // table name of the set model
    public static function tableName(): string
    {
        return 'sets';
    }

    // primary key of the set model
    public static function primaryKey(): string
    {
        return 'set_id';
    }

    // saves the set model
    public function save()
    {
        return parent::save();
    }

    // defines the rules for the set attributes
    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED, [self::MAX, 'max' => 255]]
        ];
    }

    // defines the attributes for the set model
    public function attributes(): array
    {
        return ['name'];
    }

    // a set has many cards
    public function cards()
    {
        return $this->hasMany(Card::class, 'set_id');
    }
}
