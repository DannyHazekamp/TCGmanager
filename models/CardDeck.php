<?php

namespace app\models;

use app\core\DbModel;

class CardDeck extends DbModel
{
    public int $card_id;
    public int $deck_id;

    // table name of the card deck model
    public static function tableName(): string
    {
        return 'cards_decks';
    }

    // primary key of the card deck model
    public static function primaryKey(): string
    {
        return 'id';
    }

    // defines the rules for the card deck attributes
    public function rules(): array
    {
        return [
            'card_id' => [self::REQUIRED],
            'deck_id' => [self::REQUIRED]

        ];
    }

    // defines the attributes of the card deck model
    public function attributes(): array
    {
        return ['card_id', 'deck_id'];
    }

    // belongs to a card
    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    // belongs to a deck
    public function deck()
    {
        return $this->belongsTo(Deck::class, 'deck_id');
    }
}
