<?php

namespace Anguis\TaskList\Reader;

/**
 * Interface TaskReaderInterface
 * @package Anguis\TaskList\Reader
 */
interface TaskReaderInterface
{
    public function findAll(): array;
}
