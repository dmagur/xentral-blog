<?php

namespace Blog\Interface;

interface SlugGeneratorInterface
{
    public function generate(string $title): string;
}
