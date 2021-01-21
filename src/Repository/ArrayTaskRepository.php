<?php

namespace Anguis\TaskList\Repository;

use Anguis\TaskList\Entity\TaskEntity;
use Anguis\TaskList\Reader\TaskReaderInterface;

class ArrayTaskRepository implements TaskRepositoryInterface
{
    protected TaskReaderInterface $taskReader;
    protected array $arrayRepository;

    function __construct(TaskReaderInterface $taskReader)
    {
        $this->taskReader = $taskReader;
    }

    //    public function __toString(): string
    //    {
    //        $separator = ' | ';
    //        $str = '';
    //        foreach ($this->findAll() as $item) {
    //            $str .= $item->getId . $separator;
    //            $str .= $item->getTitle . $separator;
    //            $str .= $item->getCreatedAt . $separator;
    //            $str .= $item->getUpdatedAt . $separator;
    //            $str .= PHP_EOL;
    //        }
    //        return $str;
    //    }

    /**
     * @inheritDoc
     * @return array of TaskEntity
     */
    public function findAll(): array
    {
        $records = $this->taskReader->findAll();
        $result = [];
        foreach ($records as $row) {
            $task = new TaskEntity(
                $row['id'],
                $row['title'],
                $row['createdAt'],
                $row['updatedAt']
            );
            $result[] = $task;
        }
        return $result;
    }

    /**
     * @return TaskEntity
     */
    public function findById($id): TaskEntity
    {
        $records = $this->taskReader->findAll();
        foreach ($records as $task) {
            if ($task->getId === $id) {
                $result = $task;
                break;
            };
        }
        // todo check if not found found
        return $result;
    }
}