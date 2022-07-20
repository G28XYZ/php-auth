<?php

class Db
{

    public PDO $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=php-auth', 'root', '');
    }

    public function query($sql): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function execute($sql, $data=[])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }
    

}