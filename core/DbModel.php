<?php

namespace app\core;

abstract class DbModel extends Model 
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

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

    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
    
        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $sql = implode(', ', $params);
        $statement = self::prepare("UPDATE $tableName SET $sql WHERE {$this->primaryKey()} = :id");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        
        $statement->bindValue(":id", $this->{$this->primaryKey()});
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

        $relatedModel = new $class();
        $relatedPrimaryKey = $relatedModel::primaryKey();

        return $class::findOne([$relatedPrimaryKey => $foreignKeyValue]);
    }

    public static function prepare($sql) 
    {
        return App::$app->db->pdo->prepare($sql);
    }
}