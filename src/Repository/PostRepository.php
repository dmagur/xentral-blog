<?php

namespace Blog\Repository;

use Blog\Entity\Post;

class PostRepository extends AbstractRepository
{
    public const TABLE = 'post';

    public function getList(array $params): ?array
    {
        $sql = 'SELECT `post`.*,CONCAT(`user`.first_name," ",`user`.last_name) as author FROM `'.self::TABLE.'` INNER JOIN `user` ON `user`.id=`post`.user_id';
        $sql = $this->prepareSql($sql, $params);

        $records = $this->persistence->queryAndFetch($sql);

        $countSql = 'SELECT COUNT(*) as total_records FROM `'.self::TABLE.'` INNER JOIN `user` ON `user`.id=`post`.user_id';
        $count = $this->persistence->queryAndFetch($countSql);

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

        $records = $this->persistence->queryAndFetch($sql, [$slug]);

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

        $records = $this->persistence->queryAndFetch($sql, [$id]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }

    public function insert(Post $post): int
    {
        $sql = 'INSERT INTO ' . self::TABLE . '(id, title, content, user_id, post_date, slug) VALUES (?, ?, ?, ?, ?, ?)';
        $this->persistence->execute($sql, [null, $post->getTitle(), $post->getContent(), $post->getUserId(), $post->getPostDate(), $post->getSlug()]);
        return $this->persistence->lastInsertId();
    }

    public function update(Post $post): void
    {
        $sql = 'UPDATE ' . self::TABLE . ' SET title=?, content=?, user_id=?, post_date=?, slug=?, changed_at=? WHERE id=?';
        $this->persistence->execute($sql, [$post->getTitle(), $post->getContent(), $post->getUserId(), $post->getPostDate(), $post->getSlug(), date("Y-m-d H:i:s"), $post->getId()]);
    }

    public function deleteById(string $id): void
    {
        $sql = 'DELETE FROM ' . self::TABLE . ' WHERE id = ?';
        $this->persistence->execute($sql, [$id]);
    }
}
