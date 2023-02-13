<?php
class Database{
    private $host;
    private $dbname;
    private $user;
    private $pass;

    function __construct(string $host, string $dbname, string $user, string $pass)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function connect() {
        $conn_str = "mysql:host=" . $this->host;

        try {
            $conn = new PDO($conn_str, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("CREATE DATABASE IF NOT EXISTS urlshortener");
            $conn->exec("use $this->dbname");
            $sql1 = "create table if not exists users (id int(11) primary key, email varchar(100), password varchar(100));";
            $conn->exec($sql1);
            $sql2 = "create table if not exists urls (id int(11) primary key, short_url varchar(300), orig_url varchar(2000), clicks integer(6), user_id integer, foreign key (user_id) references users(id));";
            $conn->exec($sql2);

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();

        }
    }
}
?>