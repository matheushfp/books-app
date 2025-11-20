<?php

abstract class Repository
{
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    abstract function findAll(): array;
    abstract function findById(int $id): ?object;
    abstract function create(array $data): bool;
}