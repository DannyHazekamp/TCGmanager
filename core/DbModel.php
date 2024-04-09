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
        $primaryKey = $this->primaryKey();

        $changedAttributes = array_filter($attributes, function ($attribute) {
            return isset($this->{$attribute});
        });

        $params = array_map(fn($attr) => "$attr = :$attr", $changedAttributes);
        $sql = implode(', ', $params);

        $statement = self::prepare("UPDATE $tableName SET $sql WHERE $primaryKey = :id");

        foreach ($changedAttributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->bindValue(":id", $this->{$primaryKey});
        $statement->execute();

        return true;
    }

    public function delete()
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $primaryKeyValue = $this->{$primaryKey};

        $statement = self::prepare("DELETE FROM $tableName WHERE $primaryKey = :id");
        $statement->bindValue(":id", $primaryKeyValue);
        $statement->execute();

        return true;
    }

    public function deleteRelations($tableName)
    {
        $primaryKey = $this->primaryKey();
        $primaryKeyValue = $this->{$primaryKey};
        $sql = "DELETE FROM $tableName WHERE $primaryKey = :id";

        $statement = self::prepare($sql);
        $statement->bindValue(":id", $primaryKeyValue);
        $statement->execute();
        return true;
    }

    public function addManyToMany()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $columns = implode(', ', $attributes);
        $params = ':' . implode(', :', $attributes);

        $sql = "INSERT INTO $tableName ($columns) VALUES ($params)";
        $statement = self::prepare($sql);

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
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }

        $statement->execute(); 
        return $statement->fetchObject(static::class);
    }

    public static function findAll($where = [])
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName";

        if(!empty($where)) {
            $attributes = array_keys($where);
            $conditions = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $sql .= " WHERE $conditions";
        }
        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute(); 
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function searchAll($where = [])
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName";

        if(!empty($where)) {
            $attributes = array_keys($where);
            $conditions = implode(" AND ", array_map(fn($attr) => "$attr LIKE :$attr", $attributes));
            $sql .= " WHERE $conditions";
        }
        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", "%$value%");
        }
        
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

    public function hasMany($class, $foreignKey)
    {
        $tableName = $class::tableName();

        $primaryKeyValue = $this->{$this->primaryKey()};

        $relatedModel = new $class();
        $relatedPrimaryKey = $relatedModel::primaryKey();

        $sql = "SELECT * FROM $tableName WHERE $foreignKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(":primaryKeyValue", $primaryKeyValue);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public static function prepare($sql) 
    {
        return App::$app->db->pdo->prepare($sql);
    }
}