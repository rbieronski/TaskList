<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;
use Anguis\TaskList\Manager\TaskManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class CommandFactory
 * @package Anguis\TaskList\Command
 */
class CommandFactory implements CommandFactoryInterface
{
    protected TaskRepositoryInterface $taskRepository;
    protected TaskManagerInterface $taskManager;
    protected EventDispatcher $dispatcher;

    function __construct(
        TaskRepositoryInterface $taskRepository,
        TaskManagerInterface $taskManager,
        EventDispatcher $dispatcher
    ) {
        $this->taskRepository = $taskRepository;
        $this->taskManager = $taskManager;
        $this->dispatcher = $dispatcher;
    }

    public function create($name): CommandInterface
    {
        switch ($name) {
            case 'list':
                return new ListCommand($this->taskRepository);
            case 'details':
                return new DetailsCommand($this->taskRepository);
            case 'count':
                return new CountCommand($this->taskRepository);
            case 'add':
                return new AddCommand($this->taskManager, $this->dispatcher);
            case 'rm':
                return new RemoveCommand($this->taskManager);
            case 'update':
                return new UpdateCommand($this->taskManager);
        }
    }
}
