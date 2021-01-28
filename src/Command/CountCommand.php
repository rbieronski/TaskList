<?php

namespace Anguis\TaskList\Command;

use Anguis\TaskList\Repository\TaskRepositoryInterface;

/**
 * Class CountCommand
 * @package Anguis\TaskList\Command
 */
class CountCommand implements CommandInterface
{
    protected TaskRepositoryInterface $taskRepository;

    function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function run(array $arguments)
    {
        echo count(
            $this->taskRepository->findAll()
        ) . PHP_EOL;
    }
}