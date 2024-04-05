<?php

namespace app\core;

abstract class DbModel extends Model 
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    public static function userId(): string
    {
        return 'user_id';
    }

    public static function roleId(): string
    {
        return 'role_id';
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES(".implode(',', $params).") ");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;

    }

    public static function findOne($where) 
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }

        $statement->execute(); 
        return $statement->fetchObject(static::class);
    }

    public static function findAll()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute(); 
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public function belongsTo($class, $foreignKey)
    {
        $tableName = $class::tableName();

        $foreignKeyValue = $this->{$foreignKey};

        return $class::findOne([$class::roleId() => $foreignKeyValue]);
    }

    public static function prepare($sql) 
    {
        return App::$app->db->pdo->prepare($sql);
    }
}