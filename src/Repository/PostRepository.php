<?php

namespace Blog\Repository;

class PostRepository extends AbstractRepository
{
    public const TABLE = 'post';

    public function getList(array $params)
    {
        $sql = 'SELECT `post`.*,CONCAT(`user`.first_name," ",`user`.last_name) as author FROM `'.self::TABLE.'` INNER JOIN `user` ON `user`.id=`post`.user_id';
        $sql = $this->prepareSql($sql, $params);

        $records = $this->persistance->queryAndFetch($sql);

        $countSql = 'SELECT COUNT(*) as total_records FROM `'.self::TABLE.'` INNER JOIN `user` ON `user`.id=`post`.user_id';
        $count = $this->persistance->queryAndFetch($countSql);

        if ($records) {
            return ['records' => $records,'total_records' => $count[0]['total_records']];
        } else {
            return null;
        }
    }

    public function getOne(string $slug): ?array
    {
        $sql = 'SELECT `post`.*,CONCAT(`user`.first_name," ",`user`.last_name) as author FROM `' . self::TABLE . '` INNER JOIN `user` ON `user`.id=`post`.user_id
        where post.slug=?';

        $records = $this->persistance->queryAndFetch($sql, [$slug]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }

    public function getOneById(string $id): ?array
    {
        $sql = 'SELECT `post`.*,CONCAT(`user`.first_name," ",`user`.last_name) as author FROM `' . self::TABLE . '` INNER JOIN `user` ON `user`.id=`post`.user_id
        where post.id=?';

        $records = $this->persistance->queryAndFetch($sql, [$id]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }

    public function deleteById(string $id): void
    {
        $sql = 'DELETE FROM ' . self::TABLE . ' WHERE id = ?';
        $this->persistance->execute($sql, [$id]);
    }
}
