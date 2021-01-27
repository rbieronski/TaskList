<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TaskList\Command\CommandFactory;
use Anguis\TaskList\Reader\{
    JsonTaskReader
};
use Anguis\TaskList\IndexProvider\NumberIndexProvider;
use Anguis\TaskList\Repository\ArrayTaskRepository;
use Anguis\TaskList\Manager\JsonTaskManager;


// files
$dataFile = 'data.json';
$indexFile = 'last-index.idx';

$indexProvider = new NumberIndexProvider($indexFile);
$repository = new ArrayTaskRepository(
    new JsonTaskReader($dataFile)
);



$manager = new JsonTaskManager(
    $dataFile,
    $indexProvider
);

$commandFactory = new CommandFactory(
    $repository,
    $manager
);

$dummyArray = array(1,2);

$command = $commandFactory->create($argv[1]);
$command->run(array_slice($argv, 2));
//var_dump(array_slice($argv, 2));
