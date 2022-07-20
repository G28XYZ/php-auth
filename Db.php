<?php

class Db
{
    protected static $instance = null;

    public PDO $dbh;

    public static function instance() {
        if(null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=php-auth', 'root', '');
    }

    public function query($sql, $class): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $data=[]): bool
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    public function lastId() {
        return $this->dbh->lastInsertId();
    }

}