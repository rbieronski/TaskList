<?php

namespace Anguis\TaskList\Command;

/**
 * Interface CommandInterface
 * @package Anguis\TaskList\Command
 */
interface CommandInterface
{
    public function run(array $arguments);
}