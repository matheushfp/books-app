<?php

class Migration
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function migrate(): void
    {
        $this->createMigrationsTableIfNeeded();

        $migrations = glob(__DIR__ . '/migrations/*.php');

        foreach ($migrations as $migrationFile) {
            $migrationName = basename($migrationFile, '.php');

            if ($this->isMigrationApplied($migrationName)) {
                continue;
            }

            require_once $migrationFile;
            $className = '_' . str_replace('.php', '', basename($migrationFile));
            $migrationClass = new $className($this->pdo);

            if ($migrationClass->up()) {
                $this->recordMigration($migrationName);
                echo "Migration '$migrationName' executed successfully.\n";
            } else {
                echo "Error executing migration '$migrationName'.\n";
            }
        }
    }

    public function rollback(): void
    {
        $lastMigration = $this->getLastMigration();

        if ($lastMigration === null) {
            echo "No migration to rollback.\n";
            return;
        }

        $migrationFile = __DIR__ . '/migrations/' . $lastMigration . '.php';

        if (file_exists($migrationFile)) {
            require_once $migrationFile;
            $className = '_' . str_replace('.php', '', basename($migrationFile));
            $migrationClass = new $className($this->pdo);

            if ($migrationClass->down()) {
                $this->removeMigration($lastMigration);
                echo "Migration: '$lastMigration' rolled back successfully.\n";
            } else {
                echo "Error rolling back migration '$lastMigration'.\n";
            }
        }
    }

    private function createMigrationsTableIfNeeded(): void
    {
        $createTableSQL = "
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration_name VARCHAR(255) UNIQUE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        try {
            $this->pdo->exec($createTableSQL);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            exit;
        }
    }

    private function isMigrationApplied(string $migrationName): bool
    {
        $stmt = $this->pdo->prepare("SELECT 1 FROM migrations WHERE migration_name = ?");
        $stmt->execute([$migrationName]);

        return (bool) $stmt->fetchColumn();
    }

    private function recordMigration(string $migrationName): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration_name) VALUES (?)");
        $stmt->execute([$migrationName]);
    }

    private function getLastMigration(): ?string
    {
        $stmt = $this->pdo->query("SELECT migration_name FROM migrations ORDER BY created_at DESC LIMIT 1");
        return $stmt->fetchColumn() ?: null;
    }

    private function removeMigration(string $migrationName): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM migrations WHERE migration_name = ?");
        $stmt->execute([$migrationName]);
    }
}