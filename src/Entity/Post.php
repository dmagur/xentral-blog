<?php
namespace Blog\Entity;

class Post extends AbstractEntity
{
    private ?string $id;

    private string $userId;

    private string $title;

    private string $content;

    private string $postDate;

    private string $slug;

    protected array $required = [
        'title',
        'post_date',
        'content'
    ];

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPostDate(): string
    {
        return $this->postDate;
    }

    public function setPostDate(string $postDate): void
    {
        $this->postDate = $postDate;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
