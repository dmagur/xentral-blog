<?php

namespace Blog\Repository;

use Blog\Interface\PersistanceInterface;

class AbstractRepository
{
    protected PersistanceInterface $persistance;

    public function __construct(PersistanceInterface $persistance)
    {
        $this->persistance = $persistance;
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

    public function getCount(array $params): ?int
    {
        $sql = "SELECT count(*) as total_records from `".$this->table."` INNER JOIN `user` ON `user`.id=`post`.user_id";

        if (isset($params['limit'])) unset($params['limit']);
        if (isset($params['orderby'])) unset($params['orderby']);

        $sql = $this->__prepare_sql($sql,$params);

        $res = $this->db->query($sql);

        if ($res) {
            $count = $res->fetch_assoc();
            return $count['total_records'];
        }
        else {
            return null;
        }
    }

    public function getOne(string $id): ?array
    {
        $sql = 'SELECT ' . static::TABLE . '.* FROM `' . static::TABLE . '` where id = ?';
        $records = $this->persistance->queryAndFetch($sql, [$id]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }
}
