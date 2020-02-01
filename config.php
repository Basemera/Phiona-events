<?php
class PDOConfig extends PDO {
   
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $port;
    private $db;
   
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = '127.0.0.1';
        $this->database = 'events';
        $this->user = 'root';
        $this->pass = 'root';
        $this->port = '8889';
        $dsn = $this->engine.':dbname='.$this->database.';host='.$this->host.';port='.$this->port;
        parent::__construct( $dsn, $this->user, $this->pass );
    }
}
?>