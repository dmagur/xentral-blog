<?php

namespace Blog\Repository;

use Blog\Interface\PersistenceInterface;

class AbstractRepository
{
    protected PersistenceInterface $persistence;

    public function __construct(PersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    protected function prepareSql(string $sql,array $params): string
    {
        if (isset($params['where'])){
            $sql .= " ".$params['where'];
        }

        if (isset($params['orderby'])){
            $sql .= " ".$params['orderby'];
        }

        if (isset($params['limit'])){
            $sql .= " ".$params['limit'];
        }
        return $sql;
    }

    public function getOneById(string $id): ?array
    {
        $sql = 'SELECT ' . static::TABLE . '.* FROM `' . static::TABLE . '` where id = ?';
        $records = $this->persistence->queryAndFetch($sql, [$id]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }
}
