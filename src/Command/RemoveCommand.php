<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Manager\TaskManagerInterface;

/**
 * Class RemoveCommand
 * @package Anguis\TaskList\Command
 */
class RemoveCommand implements CommandInterface
{
    protected TaskManagerInterface $taskManager;

    function __construct(
        TaskManagerInterface $taskManager
    ) {
        $this->taskManager = $taskManager;
    }

    public function run(array $arguments)
    {
        $this->taskManager->remove($arguments[0]);
    }
}