<?php

namespace Blog\Repository;

use Blog\Entity\User;

class UserRepository extends AbstractRepository
{
    public const TABLE = 'user';

    public function getOneByEmail(string $email): ?array
    {
        $sql = 'SELECT ' . static::TABLE . '.* FROM `' . static::TABLE . '` where email = ?';
        $records = $this->persistance->queryAndFetch($sql, [$email]);

        if ($records) {
            return array_shift($records);
        } else {
            return null;
        }
    }

    public function insert(User $user): int
    {
        $sql = 'INSERT INTO ' . self::TABLE . '(id, email, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)';
        $this->persistance->execute($sql, [null, $user->getEmail(), $user->getPassword(), $user->getFirstName(), $user->getLastName()]);
        return $this->persistance->lastInsertId();
    }
}
