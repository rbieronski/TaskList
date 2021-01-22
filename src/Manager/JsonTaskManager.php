<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;
use Anguis\TaskList\IndexProvider\IndexProviderInterface;

class JsonTaskManager implements TaskManagerInterface
{
    protected string $filename;
    protected IndexProviderInterface $indexProvider;
    protected TaskEntity $task;

    function __construct(
        string $filename,
        IndexProviderInterface $indexProvider
    ) {
        $this->filename = $filename;
        $this->indexProvider = $indexProvider;
    }

    public function save(TaskEntity $task): string
    {
        $this->taskEntity = $task;
        $timestamp = $this->prepareTimestamp();

        // read the json database
        $data = json_decode(
            file_get_contents($this->filename), true
        );

        // determine if save new entity or update existing
        $id = $this->task->getId();
        if (!is_null($id)) {
            // existing TaskEntity
            $entity = [
                'id' => $id,
                'title' => $task->getTitle(),
                'createdAt' => $task->getCreatedAt(),
                'updatedAt' => $timestamp
            ];
        } else {
            // new TaskEntity
            $entity = [
                'id' => $id,
                'title' => $task->getTitle(),
                'createdAt' => $timestamp,
                'updatedAt' => $timestamp
            ];
        }

        $data[] = $newRow;
        file_put_contents(
            $this->filename,
            json_encode($data)
        );
        $this->indexProvider->saveNext();
        return $id;
    }

    protected function
    protected function prepareTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }

    protected function updateExistingEntity
    {

    }

    public function remove(string $id): string
    {
        $arrData = json_decode(
            file_get_contents($this->filename), true
        );
        $iRow = 0;
        foreach ($arrData as $row) {
            if ($row['id'] === $id) {
                break;
            }
            $iRow++;
        }
        unset($arrData[$iRow]);
        $json = json_encode($arrData);
        file_put_contents(
            $this->filename,
            $json
        );
        return $id;
    }
}