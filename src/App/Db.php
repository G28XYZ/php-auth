<?php

namespace App;

use PDO;
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
        // $this->dbh = new \PDO('mysql:host=localhost;dbname=php-auth', 'root', '');
        // $ENV = getenv();
        // $DB_PATH = (string)$ENV['DB_PATH'];
        // $DB_USER = (string)$ENV['DB_USER'];
        // $DB_PASS = (string)$ENV['DB_PASS'];
        // $this->dbh = new PDO($DB_PATH, $DB_USER, $DB_PASS);
        $this->dbh = new PDO('pgsql:host=ec2-44-206-197-71.compute-1.amazonaws.com;dbname=d5l915gas45dd0','cnittcwiselxjv', '879b4004958212b31f7e80fc97ed44a72436a54682cf1926d8b006cb58212fc4');
    }

    public function query($sql, $class, $param=[]): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($param);
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