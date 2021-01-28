<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;
use Anguis\TaskList\Manager\TaskManagerInterface;
use Anguis\TaskList\Entity\TaskEntity;

class UpdateCommand implements CommandInterface
{
    protected TaskManagerInterface $taskManager;

    function __construct(
        TaskManagerInterface $taskManager
    ) {
        $this->taskManager = $taskManager;
    }

    public function run(array $arguments)
    {
        $timestamp = date('Y-m-d h:m:s');
        $newTask = new TaskEntity(
            $arguments[0],  // id to update
            $arguments[1],  // task title
            $timestamp,
            $timestamp
        );
        $this->taskManager->save($newTask);
    }
}