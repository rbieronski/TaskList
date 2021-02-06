<?php

namespace Anguis\TaskList\Event;

use Anguis\TaskList\Entity\TaskEntity;
use Symfony\Contracts\EventDispatcher\Event;

class TaskAddedEvent extends Event
{
    public const NAME = 'anguis.tasklist.task_added';

    protected $taskEntity;

    public function __construct(TaskEntity $taskEntity)
    {
        $this->taskEntity = $taskEntity;
    }

    public function getTaskEntity(): TaskEntity
    {
        return $this->taskEntity;
    }
}
