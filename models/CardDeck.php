<?php

namespace app\models;

use app\core\DbModel;

class CardDeck extends DbModel
{
    public int $card_id;
    public int $deck_id;

    public static function tableName(): string
    {
        return 'cards_decks';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'card_id' => [self::REQUIRED],
            'deck_id' => [self::REQUIRED]
            
        ];
    }

    public function attributes(): array
    {
        return ['card_id', 'deck_id'];
    }

    public function card() 
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function deck() 
    {
        return $this->belongsTo(Deck::class, 'deck_id');
    }
}