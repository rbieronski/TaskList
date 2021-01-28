<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Manager\TaskManagerInterface;
use Anguis\TaskList\Entity\TaskEntity;

/**
 * Class AddCommand
 * @package Anguis\TaskList\Command
 */
class AddCommand implements CommandInterface
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
            null,
            $arguments[0],
            $timestamp,
            $timestamp
        );
        $this->taskManager->save($newTask);
    }
}