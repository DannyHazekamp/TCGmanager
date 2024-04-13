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

    // table name of the card model
    public static function tableName(): string
    {
        return 'cards';
    }

    // primary key of the card model
    public static function primaryKey(): string
    {
        return 'card_id';
    }

    // saves the card model
    public function save()
    {
        return parent::save();
    }

    // defines the rules for the card attributes
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

    // defines the attributes for the card model
    public function attributes(): array
    {
        return ['name', 'attack', 'defense', 'rarity', 'price', 'image', 'set_id'];
    }

    // a card belongs to a set
    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    // a card has many decks (belongs to many decks) (many to many)
    public function decks()
    {
        return $this->hasMany(CardDeck::class, 'card_id');
    }
}
