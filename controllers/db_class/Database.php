<?php

class Database
{
    private $host;
    private $database;
    private $user;
    private $password;
    private $conn;

    public function __construct($host, $name, $pass, $db)
    {
        $this->host = $host;
        $this->user = $name;
        $this->password = $pass;
        $this->database = $db;
        $this->conn();
    }

    public function conn()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function sqlQuery($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return $result;
    }

    public function fetchAsso($sql)
    {
        $result = $this->sqlQuery($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function closeConn()
    {
        mysqli_close($this->conn);
    }
}
