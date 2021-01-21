<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;

class DetailsCommand implements CommandInterface
{
    protected TaskRepositoryInterface $taskRepository;

    function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function run(array $arguments)
    {
        foreach ($this->taskRepository->findAll() as $task) {
            echo $task->getTitle() . ' ';
            echo $task->getCreatedAt() . PHP_EOL;
        }
    }
}