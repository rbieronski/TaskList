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

    function __construct(
        string $filename,
        IndexProviderInterface $indexProvider
    ) {
        $this->filename = $filename;
        $this->indexProvider = $indexProvider;
    }

    public function save(TaskEntity $task): string
    {
        $dataArray = $this->readDataFile();

        $id = $task->getId() ?? $this->indexProvider->getNext();

        $dataArray[$id] = [
            'id' => $id,
            'title' => $task->getTitle(),
            'createdAt' => $task->getCreatedAt(),
            'updatedAt' => $task->getUpdatedAt()
        ];

        // encode data array and save to file
        $this->writeDataFile($dataArray);

        return $id;
    }

    public function remove(string $id): string
    {
        $arrData = $this->readDataFile(); 
        // delete row from associative array
        unset($arrData[$id]);

        $this->writeDataFile($arrData);

        return $id;
    }

    private function readDataFile(): array {
        // read the json database to array
        return json_decode(
            file_get_contents($this->filename), true
        );
    }

    private function writeDataFile(array $arrData) {
        // encode data array and save to file
        file_put_contents(
            $this->filename,
            json_encode($arrData, JSON_PRETTY_PRINT)
        );
    }
}
