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
            'name' => [self::REQUIRED, [self::MAX, 'max' => 255]],
            'description' => [[self::MAX, 'max' => 500]],
            'user_id' => [self::REQUIRED]
        ];
    }

    public function attributes(): array
    {
        return ['name', 'description', 'user_id'];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cards()
    {
        return $this->hasMany(CardDeck::class, 'deck_id');
    }

    public function countCards(int $card_id): int
    {
        $cardCount = 0;
        foreach ($this->cards() as $cardDeck) {
            if ($cardDeck->card_id === $card_id) {
                $cardCount++;
            }
        }
        return $cardCount;
    }

    public function deleteRelated()
    {
        $tableName = CardDeck::tableName();

        $this->deleteRelations($tableName);

        return parent::delete();

    }

}