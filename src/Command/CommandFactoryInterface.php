<?php

namespace Anguis\TaskList\Command;

/**
 * Interface CommandFactoryInterface
 * @package Anguis\TaskList\Command
 */
interface CommandFactoryInterface
{
    public function create($name): CommandInterface;
}