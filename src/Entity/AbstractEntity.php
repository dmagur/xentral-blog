<?php

namespace Blog\Entity;

class AbstractEntity
{
    protected array $required = [];

    public function getRequired(): array
    {
        return $this->required;
    }
}
