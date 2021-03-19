<?php
namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;
use PDO;

class SqlDatabaseTaskManager implements TaskManagerInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(TaskEntity $task): string
    {
        $id = $task->getId();
        if (!is_null($id)) {
            $this->existingTaskUpdate($task);
        } else {
            $id = $this->addNewTask($task);
        }
        return $id;
    }

    protected function existingTaskUpdate(TaskEntity $task)
    {
        $sql = <<<'SQL'
        UPDATE MyTasklist
        SET 
            title =:title,
            createdAt =:createdAt,
            updatedAt =:updatedAt
        WHERE id = :id
SQL;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'title' => $task->getTitle(),
            'createdAt' => $task->getCreatedAt(),
            'updatedAt' => $this->prepareTimestamp(),
            'id' => $task->getId()
        ]);
    }

    protected function addNewTask(TaskEntity $task): string
    {
        $timestamp = $this->prepareTimestamp();
        $sql = <<<'SQL'
        INSERT INTO MyTasklist (id, title, createdAt, updatedAt)
        VALUES (NULL, :title, :createdAt, :updatedAt)
SQL;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'title' => $task->getTitle(),
            'createdAt' => $timestamp,
            'updatedAt' => $timestamp
        ]);
        return $this->pdo->lastInsertId();
    }

    public function remove(string $id): string
    {
        $stmt = $this->pdo->prepare('DELETE FROM MyTasklist WHERE id =  :id');
        $stmt->execute(['id' => $id]);
        return $id;
    }

    protected function prepareTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }
}
