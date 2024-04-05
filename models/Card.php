<?php

namespace app\models;

use app\core\DbModel;

class Card extends DbModel
{
    public string $name;
    public int $attack;
    public int $defense;
    public string $rarity;
    public float $price;
    public int $set_id;

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
            'attack' => [self::REQUIRED],
            'defense' => [self::REQUIRED],
            'rarity' => [self::REQUIRED],
            'price' => [self::REQUIRED],
            'set_id' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name', 'attack', 'defense', 'rarity', 'price','set_id'];
    }




}