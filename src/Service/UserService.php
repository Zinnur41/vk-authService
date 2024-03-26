<?php

namespace app\Service;
require '../Database/Database.php';

use app\Database\Database;
use Exception;
use PDO;

class UserService
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->getPdo();
    }

    /**
     * @throws Exception
     */
    public function register(string $email, string $password)
    {
        if ($this->findUserByEmail($email)) {
            throw new Exception('Пользователь с таким email уже существует!');
        } else
            if (!$this->validateEmail($email)) {
                throw new Exception('Email не валиден!');
            }
            if (!$this->checkPassword($password)) {
                throw new Exception("Ненадежный пароль!");
            }
            $query = "INSERT INTO user_account(email, password) VALUES (:email, :password)";
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            $user_id = $this->pdo->lastInsertId();
            return [
                'user_id' => $user_id,
                'password_check_status' => $this->checkPassword($password)
            ];
        }

        public function authorize(string $email, string $password)
        {
            $user = $this->findUserByEmail($email);
            if (!$user) {
                throw new Exception('Вы не зарегистрированы!');
            } else if (!password_verify($password, $user['password'])) {
                throw new Exception('Пароль не совпадает!');
            } else {

            }
        }

    public function findUserByEmail(string $email): bool|array
    {
        $query = "SELECT * FROM user_account WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return false;
        }
        return $user;
    }

    public function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function checkPassword($password): bool|string
    {
        $check_status = '';
        if (strlen($password) < 8 ||
            !preg_match("#[0-9]+#", $password) ||
            !preg_match("#[a-z]+#", $password)
        ) {
            return false;
        } else if (preg_match("#[A-Z]+#", $password) && preg_match('#[./_\-*]#', $password)) {
            $check_status = 'perfect';
        } else {
            $check_status = 'good';
        }
        return $check_status;
    }
}

$database = new Database();
$user = new UserService($database);

print_r($user->checkPassword('adsca-sAca2scd'));


