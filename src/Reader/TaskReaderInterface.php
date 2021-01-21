<?php

namespace Anguis\TaskList\Reader;

/**
 * Interface TaskReaderInterface
 */
interface TaskReaderInterface
{
    public function findAll(): array;
}
