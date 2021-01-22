<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;
use Anguis\TaskList\Manager\TaskManagerInterface;
use Anguis\TaskList\Entity\TaskEntity;

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
        $now = date('Y-m-d h:m:s');
        $newTask = new TaskEntity(
            1,
            $arguments[0],
            $now,
            $now
        );
        $this->taskManager->save($newTask);
    }
}