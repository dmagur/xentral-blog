<?php

namespace Blog\Services;

use Blog\Interface\SlugGeneratorInterface;

class SlugGenerator implements SlugGeneratorInterface
{
    public function generate(string $title): string
    {
        return strtolower(str_replace(" ", "-", $title));
    }
}
