<?php

namespace Anguis\TaskList\Entity;

class TaskEntity
{
    protected ?string $id;
    protected string $title;
    protected string $createdAt;
    protected string $updatedAt;

    function __construct(
        ?string $id,
        string $title,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
}
