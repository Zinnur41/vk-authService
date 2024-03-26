<?php

namespace app\Database;

use Exception;
use PDO;
use PDOException;

class Database
{
    private PDO $pdo;

    private string $format = 'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s';
    public function __construct()
    {
        try {
            $params = parse_ini_file(__DIR__ . '/../../config.ini');
        } catch (Exception $exception) {
            throw new Exception("Файла не существует или его невозможно открыть! $exception");
        }
        $dsn = sprintf(
            $this->format,
            $params['host'],
            $params['port'],
            $params['dbname'],
            $params['user'],
            $params['password']
        );
        try {
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            throw new PDOException("Ошибка к подключению к базу данных: $exception->errorInfo");
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}

$db = new Database();
