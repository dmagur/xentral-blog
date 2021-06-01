<?php
namespace Blog\Services;

use Blog\Entity\AbstractEntity;

class Validator
{
    public function validate(AbstractEntity $entity, array $data)
    {
        $errors = [];
        foreach ($entity->getRequired() as $r) {
            if (empty($data[$r])) {
                $errors[$r] = 1;
            }
        }

        return $errors;
    }
}
