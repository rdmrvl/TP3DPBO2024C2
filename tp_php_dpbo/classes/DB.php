<?php

class DB
{
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result;

    function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    function open()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }

    function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    function execute($query, $params = array())
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        if (!empty($params)) {
            $types = array_shift($params);
            $stmt->bind_param($types, ...$params);
        }

        $result = $stmt->execute();
        if ($result === false) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $this->result = $stmt->get_result();
    }

    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    function get_result()
    {
        return $this->result->fetch_assoc();
    }

    function executeAffected($query = "")
    {
        // mengeksekusi query
        mysqli_query($this->conn, $query);
        return mysqli_affected_rows($this->conn);
    }

    function close()
    {
        mysqli_close($this->conn);
    }

    public function escapeString($string) {
        return mysqli_real_escape_string($this->conn, $string);
    }
}
