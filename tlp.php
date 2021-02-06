<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TaskList\Command\CommandFactory;
use Anguis\TaskList\Reader\JsonTaskReader;
use Anguis\TaskList\IndexProvider\NumberIndexProvider;
use Anguis\TaskList\Repository\ArrayTaskRepository;
use Anguis\TaskList\Manager\JsonTaskManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Anguis\TaskList\Event\TaskAddedEvent;
use Anguis\TaskList\Listener\TaskAddedListener;

// define data files
$dataFile = 'data.json';
$indexFile = 'last-index.idx';

$dispatcher = new EventDispatcher();

$dispatcher->addListener(TaskAddedEvent::NAME, [new TaskAddedListener(), 'taskAdded']);

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
    $manager,
    $dispatcher
);


$argStdInput = getStandardInput();

$commandName = $argv[1];
$argumentsArray = array_slice($argv, 2);

// add standard input to list of arguments if given
if ($argStdInput <> '') {
    $argumentsArray[] = $argStdInput;
}

$command = $commandFactory->create($commandName);
$command->run($argumentsArray);


// ---------- FUNCTIONS ---------------------------------

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
