<?php

namespace app\models;

use app\core\DbModel;

class Deck extends DbModel
{
    public string $name;
    public string $description;
    public int $user_id;


    // table name of the deck model
    public static function tableName(): string
    {
        return 'decks';
    }

    // primary key of the deck model
    public static function primaryKey(): string
    {
        return 'deck_id';
    }

    // saves the deck model
    public function save()
    {
        return parent::save();
    }

    // defines the rules for the deck attributes
    public function rules(): array
    {
        return [
            'name' => [self::REQUIRED, [self::MAX, 'max' => 255]],
            'description' => [[self::MAX, 'max' => 500]],
            'user_id' => [self::REQUIRED]
        ];
    }

    // defines the attributes for the deck model
    public function attributes(): array
    {
        return ['name', 'description', 'user_id'];
    }

    // a deck belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // a deck hasMany cards
    public function cards()
    {
        return $this->hasMany(CardDeck::class, 'deck_id');
    }

    // counts the cards in a deck
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

    // delete the related objects in the many to many table of cards and decks
    public function deleteRelated()
    {
        $tableName = CardDeck::tableName();

        $this->deleteRelations($tableName);

        return parent::delete();
    }
}
