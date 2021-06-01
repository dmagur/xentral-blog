<?php

namespace Blog\Services;

use Blog\Entity\Post;
use Blog\Interface\SlugGeneratorInterface;

class PostHydrator
{
    private SlugGeneratorInterface $slugGenerator;

    public function __construct(SlugGeneratorInterface $slugGenerator)
    {
        $this->slugGenerator = $slugGenerator;
    }

    function hydrate(Post $post, array $data): Post
    {
        $post->setId($data['id'] ?? null);
        $post->setUserId($data['user_id']);
        $post->setTitle($data['title']);
        $post->setPostDate($data['post_date']);
        $post->setContent($data['content']);

        $post->setSlug($this->slugGenerator->generate($data['title']));

        return $post;
    }
}
