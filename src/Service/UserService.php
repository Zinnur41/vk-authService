<?php

namespace app\Service;

require __DIR__ . '/../../vendor/autoload.php';

use app\Database\Database;
use PDO;

class UserService
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->getPdo();
    }

    public function register(string $email, string $password): array
    {
        if ($this->findUserByEmail($email)) {
            return [
              'message' => 'Пользвователь с таким email уже сущесвтует!'
            ];
        } else
            if (!$this->validateEmail($email)) {
                return [
                    'message' => 'Email не валиден!'
                ];
            }
            if (!$this->checkPassword($password)) {
                return [
                    'message' => 'Ненадежный пароль!'
                ];
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
                return [
                    'message' => 'Вы не зарегистрированы!'
                ];
            } else if ($email !== $user['email'] || !password_verify($password, $user['password'])) {
                return [
                    'message' => 'Пароль или email не совпадают!'
                ];
            } else {
                return [
                    'message' => http_response_code(200)
                ];
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

