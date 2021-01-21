<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TaskList\Reader\{
    JsonTaskReader
};
use Anguis\TaskList\Repository\ArrayTaskRepository;

//
//$jsonFile = 'tlp.php';
//
$reader = new JsonTaskReader(
    'tasks.json'
);

$repository = new ArrayTaskRepository(
    $reader
);

$command = new \Anguis\TaskList\Command\ListCommand(
    $repository
);

    $command->run(array(1,2));
