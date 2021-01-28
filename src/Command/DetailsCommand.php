<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;

/**
 * Class DetailsCommand
 * @package Anguis\TaskList\Command
 */
class DetailsCommand implements CommandInterface
{
    protected TaskRepositoryInterface $taskRepository;

    function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function run(array $arguments)
    {
        foreach ($this->taskRepository->findAll() as $task) {
            echo $task->getId() . ' ';
            echo $task->getTitle() . ' ';
            echo $task->getCreatedAt() . PHP_EOL;
        }
    }
}