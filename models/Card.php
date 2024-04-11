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
    public string $image;
    public ?int $set_id;

    public static function tableName(): string
    {
        return 'cards';
    }

    public static function primaryKey(): string
    {
        return 'card_id';
    }


    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED, [self::MAX, 'max' => 255]],
            'attack' => [self::REQUIRED],
            'defense' => [self::REQUIRED],
            'rarity' => [self::REQUIRED, [self::MAX, 'max' => 255]],
            'price' => [self::REQUIRED],
            'set_id' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name', 'attack', 'defense', 'rarity', 'price', 'image', 'set_id'];
    }

    public function set()
    {
        return $this->belongsTo(Set::class,'set_id');
    }

    public function decks()
    {
        return $this->hasMany(CardDeck::class, 'card_id');
    }

}