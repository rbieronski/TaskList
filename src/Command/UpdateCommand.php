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
        echo ' ----------------------';
        var_dump($arguments);
        echo ' -----------------------';
        $now = date('Y-m-d h:m:s');
        $newTask = new TaskEntity(
            $arguments[1],
            $arguments[1],
            $now,
            $now
        );
        $this->taskManager->save($newTask);
    }
}