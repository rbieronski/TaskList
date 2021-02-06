<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Manager\TaskManagerInterface;
use Anguis\TaskList\Entity\TaskEntity;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Anguis\TaskList\Event\TaskAddedEvent;

/**
 * Class AddCommand
 * @package Anguis\TaskList\Command
 */
class AddCommand implements CommandInterface
{
    protected TaskManagerInterface $taskManager;
    protected EventDispatcher $dispatcher;

    function __construct(
        TaskManagerInterface $taskManager,
        EventDispatcher $dispatcher
    ) {
        $this->taskManager = $taskManager;
        $this->dispatcher = $dispatcher;
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

        $this->dispatcher->dispatch(new TaskAddedEvent($newTask), TaskAddedEvent::NAME);
    }
}
