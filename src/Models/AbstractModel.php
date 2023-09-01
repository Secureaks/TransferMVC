<?php

namespace App\Models;

use PDO;

abstract class AbstractModel
{
    protected PDO $pdo;
    private array $db;

    public function __construct()
    {
        $this->db = require __DIR__ . '/../../config/database.php';
        $this->pdo = new PDO('mysql:host=' . $this->db['host'] . ';dbname=' . $this->db['name'], $this->db['user'], $this->db['pass']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

}