<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;

class CommandFactory implements CommandFactoryInterface
{
    protected TaskRepositoryInterface $taskRepository;
//    protected TaskManagerInterface $taskManager;

    function __construct(
        TaskRepositoryInterface $taskRepository
//   ,    TaskManagerInterface $taskManager
    ) {
        $this->taskRepository = $taskRepository;
//        $this->taskManager = $taskManager;
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
        }
    }
}