<?php

require_once __DIR__ . '/vendor/autoload.php';

use Anguis\TaskList\Command\CommandFactory;
use Anguis\TaskList\Repository\ArrayTaskRepository;
use Anguis\TaskList\Manager\SqlDatabaseTaskManager;
use Anguis\TaskList\Reader\SqlDatabaseTaskReader;


/**
 *  Prepare db connection and PDO object
 */
$host = '127.0.0.1:3306';
$db = 'rafal-cashflow';
$user = 'rafal-flow';
$pass = 'rafal';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


/**
 * Read & prepare data and data manager
 */
$repository = new ArrayTaskRepository(
    new SqlDatabaseTaskReader($pdo)
);
$manager = new SqlDatabaseTaskManager($pdo);


/**
 * Read all user parameters given to input
 */
$commandName = $argv[1];
$commandArguments = array_slice($argv, 2);
$standardInput = getStandardInput();
if ($standardInput <> '') {
    $argumentsArray[] = $standardInput;
}


/**
 * Execute command
 */
$commandFactory = new CommandFactory(
    taskRepository: $repository,
    taskManager: $manager
);
$command = $commandFactory->create($commandName);
$command->run($commandArguments);


/**
 * Helper functions
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