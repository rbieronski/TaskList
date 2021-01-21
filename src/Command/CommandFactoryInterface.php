<?php

namespace Anguis\TaskList\Command;

interface CommandFactoryInterface
{
    public function create($name): CommandInterface;
}