<?php

class Database
{
    private $serverName;
    private $userName;
    private $password;
    private $dbName;

    protected function connect()
    {
        $this->serverName = "localhost";
        $this->userName = "prince_sadariya";
        $this->password = "deep70";
        $this->dbName = "prince_sadariya3";
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
        return $conn;
    }
}
