<?php

class UserRepository extends Repository
{
    private static ?UserRepository $instance = null;

    private function __construct()
    {
        parent::__construct();
    }

    public static function getInstance(): UserRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function findAll(): array
    {
        $stmt = $this->connection->query("SELECT id, name, email, password_hash AS passwordHash FROM users");
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

        return $stmt->fetchAll();
    }

    function findById(int $id): ?object
    {
        $stmt = $this->connection->prepare("
            SELECT id, name, email, password_hash AS passwordHash 
            FROM users 
            WHERE id = :id
        ");

        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: null;
    }

    function findByEmail(string $email): ?object
    {
        $stmt = $this->connection->prepare("
            SELECT id, name, email, password_hash AS passwordHash
            FROM users
            WHERE email = :email
        ");

        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch() ?: null;
    }

    function create(array $data): bool
    {
        $stmt = $this->connection->prepare("
            INSERT INTO users (name, email, password_hash)
            VALUES (:name, :email, :password_hash)
        ");

        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],
        ]);

        return $stmt->rowCount() > 0;
    }
}