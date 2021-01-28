<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;

/**
 * Interface TaskManagerInterface
 * @package Anguis\TaskList\Manager
 */
interface TaskManagerInterface
{
    public function save(TaskEntity $task): string;

    public function remove(string $id): string;
}