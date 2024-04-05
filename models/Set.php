<?php

namespace app\models;

use app\core\DbModel;

class Set extends DbModel
{
    public string $name;
    public string $release_date;
}