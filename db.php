<?php

use PDO;
class DB
{
    protected $host = 'localhost';
    protected $db_name = 'test';
    protected $username = 'root';
    protected $password = '';
    protected $pdo = null;
    protected $table;

    public function __construct()
    {
        $pd = $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", "{$this->username}", "{$this->password}");
        $pd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function create(array $data)
    {

        $values = join(",", array_keys($data));
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));
        $stmt = $this->pdo->prepare("INSERT INTO {$this -> table} ({$values}) values ({$params})");
        return $stmt->execute($data);
    }

    
