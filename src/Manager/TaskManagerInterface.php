<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;

interface TaskManagerInterface
{
    public function save(TaskEntity $task): string;
}