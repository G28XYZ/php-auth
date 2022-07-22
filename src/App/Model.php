<?php

namespace App;
use App\Db;

// модель для инкапсуляции работы с бд в других классах
abstract class Model
{
    protected const TABLE = '';

    public int $id;

    public static function findAll(): array
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    public function findByParameter($name, $value) {
        $db = Db::instance();
        $sql = "SELECT * FROM users WHERE $name=:value";
        $data = $db->query($sql, static::class, [':value'=>$value]);
        return $data[0] ?? false;
    }

    public function insert() {
        $props = get_object_vars($this);
        $columns = [];
        $binds = [];
        $data = [];
        foreach($props as $name => $value) {
            $columns[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' ('. implode(',',$columns) .') VALUES (' . implode(',', $binds) . ')';

        $db = Db::instance();
        $db->execute($sql, $data);
        $this->id = $db->lastId();
    }

    public function update() {
        $props = get_object_vars($this);
        $columns = [];
        $binds = [];
        $data = [];
        foreach($props as $name => $value) {
            $columns[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'UPDATE ' . static::TABLE .
                ' SET (' . implode(',',$columns) . ')' . ' = ' . '(' . implode(',', $binds) . ')' .
                ' WHERE id=:id'
                ;

        $db = Db::instance();
        $db->execute($sql, $data);
    }

    public function save() {
        if(isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete($id) {
        $sql = 'DELETE FROM ' . static::TABLE .
        ' WHERE id=:id';
        $db = Db::instance();
        $db->execute($sql, [':id'=>$id]);
    }

}