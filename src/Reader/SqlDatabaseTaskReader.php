<?php


namespace Anguis\TaskList\Reader;

use PDO;


class SqlDatabaseTaskReader implements TaskReaderInterface
{

    protected PDO $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM MyTasklist');
        $queryResult = $stmt->fetchAll();

        // reindex associative keys
        // Marcin, can I make it better here?
        $result = [];
        foreach ($queryResult as $row) {
            $result[$row['id']] = $row;
        }
        return $result;
    }
}