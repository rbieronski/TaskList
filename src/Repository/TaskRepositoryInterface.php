<?php

namespace Anguis\TaskList\Repository;

use Anguis\TaskList\Entity\TaskEntity;

interface TaskRepositoryInterface
{
    /**
     * @return array of TaskEntity
     */
    public function findAll(): array;

    /**
     * @return TaskEntity
     */
    public function findById($id): TaskEntity;
}