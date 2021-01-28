<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TaskList\Command\CommandFactory;
use Anguis\TaskList\Reader\JsonTaskReader;
use Anguis\TaskList\IndexProvider\NumberIndexProvider;
use Anguis\TaskList\Repository\ArrayTaskRepository;
use Anguis\TaskList\Manager\JsonTaskManager;


// define data files
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


$argStdInput =getStandardInput();

// ToDo move this block to function
If ($argStdInput <> '') {
    If (isset($argv[1])) {
        $commandName = 'update';
        $argumentsArray = array($argv[1], $argStdInput);
    } else {
        $commandName = 'add';
        $argumentsArray = array($argStdInput);
    }
} else {
    $commandName = $argv[1];
    $argumentsArray = array_slice($argv, 2);
}

$command = $commandFactory->create($commandName);
$command->run($argumentsArray);

/*
 * try read StandardInput
 * @return: string
 */
function getStandardInput(): string
{
    $stdin = '';
    $fh = fopen('php://stdin', 'r');
    $read = array($fh);
    $write = NULL;
    $except = NULL;
    if (stream_select($read, $write, $except, 0) === 1) {
        while ($line = fgets($fh)) {
            $stdin .= $line;
        }
    }
    fclose($fh);
    return trim($stdin);
}
$stdInput = getStandardInput();
