<?php
namespace Blog\Core;

use Blog\Interface\ConfigProviderInterface;
use Blog\Interface\PersistanceInterface;

class MySqlDatabase implements PersistanceInterface
{
    private ConfigProviderInterface $config;

    private \PDO $connection;

    function __construct(ConfigProviderInterface $config)
    {
        $this->config = $config;
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new \PDO('mysql:host=' . $this->config->get('dbhost') . ';dbname=' . $this->config->get('dbname'), $this->config->get('dbuser'), $this->config->get('dbpass'));
    }

    public function getConnection(): \PDO
    {
        if (!$this->connection) {
            $this->connect();
        }
        return $this->connection;
    }

    public function queryAndFetch(string $sql, array $bindings = [], int $fetchMode = \PDO::FETCH_ASSOC): array
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($bindings);
        $results = $statement->fetchAll($fetchMode);

        $statement->closeCursor();
        $statement = null;

        return $results;
    }

    public function execute(string $sql, array $bindings = []): void
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($bindings);
    }

    public function lastInsertId(): int
    {
        return $this->connection->lastInsertId();
    }
}
