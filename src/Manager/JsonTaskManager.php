<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;
use Anguis\TaskList\IndexProvider\IndexProviderInterface;

/**
 * Class JsonTaskManager
 * @package Anguis\TaskList\Manager
 */
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
        $this->task = $task;

        // read the json database to array
        $dataArray = json_decode(
            file_get_contents($this->filename), true
        );

        // determine if make new TaskEntity or update existing one
        $id = $this->task->getId();
        if (is_null($id)) {
            $newArr = $this->addNewTaskToDataArray($dataArray);
        } else {
            $newArr = $this->updateExistingTaskInDataArray(
                $id,
                $dataArray
            );
        }

        // encode data array and save to file
        file_put_contents(
            $this->filename,
            json_encode($newArr, JSON_PRETTY_PRINT)
        );
        $this->indexProvider->saveNext();

        return $task->getId();
    }

    protected function addNewTaskToDataArray(array $arr): array
    {
        $timestamp = $this->prepareTimestamp();
        $arr[] = [
            'id' => $this->indexProvider->getNext(),
            'title' => $this->task->getTitle(),
            'createdAt' => $timestamp,
            'updatedAt' => $timestamp
        ];
        return $arr;
    }

    protected function updateExistingTaskInDataArray(
        string $id,
        array $arr
    ): array {                  //  format looks awful, but...
        $arr[$id] = [           //  ...it follows PSR-12 rules :D
            'id' => $id,
            'title' => $this->task->getTitle(),
            'createdAt' => $this->task->getCreatedAt(),
            'updatedAt' => $this->prepareTimestamp()
        ];
        return $arr;
    }

    protected function prepareTimestamp(): string
    {
        return date('Y-m-d H:i:s');
    }

    public function remove(string $id): string
    {
        // read the json database to array
        $arrData = json_decode(
            file_get_contents($this->filename), true
        );

        // delete row from associative array
        unset($arrData[$id]);

        // encode data array and save to file
        file_put_contents(
            $this->filename,
            json_encode($arrData, JSON_PRETTY_PRINT)
        );

        return $id;
    }
}