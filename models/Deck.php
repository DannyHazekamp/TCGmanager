<?php

namespace app\models;

use app\core\DbModel;

class Deck extends DbModel 
{
    public string $name;
    public string $description;
    public int $user_id;


    public static function tableName(): string
    {
        return 'decks';
    }

    public static function primaryKey(): string
    {
        return 'deck_id';
    }


    public function save()
    {
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED],
            'user_id' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name', 'description', 'user_id'];
    }

}