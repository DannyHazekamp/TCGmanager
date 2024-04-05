<?php

namespace app\models;

use app\core\DbModel;

class Deck extends DbModel 
{
    public string $name;
    public string $description;
    public int $user_id;


}