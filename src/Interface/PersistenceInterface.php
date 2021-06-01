<?php
namespace Blog\Interface;

interface PersistenceInterface
{
    public function connect();

    public function queryAndFetch(string $sql, array $bindings = [], int $fetchMode = \PDO::FETCH_ASSOC);

    public function execute(string $sql, array $bindings = []);

    public function lastInsertId(): int;
}
