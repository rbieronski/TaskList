<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;

/**
 * Class ListCommand
 * @package Anguis\TaskList\Command
 */
class ListCommand implements CommandInterface
{
    protected TaskRepositoryInterface $taskRepository;

    function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function run(array $arguments)
    {
        foreach ($this->taskRepository->findAll() as $task) {
            echo $task->getTitle() . PHP_EOL;
        }
    }
}