<?php

namespace Anguis\TaskList\Command;

interface CommandInterface
{
    public function run(array $arguments);
}