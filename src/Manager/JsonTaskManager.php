<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;
use Anguis\TaskList\IndexProvider\IndexProviderInterface;

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
        $data = json_decode(
            file_get_contents($this->filename), true
        );
        $newId = $this->indexProvider->getNext();

        $newRow = [
            'id' => $newId,
            'title' => $task->getTitle(),
            'createdAt' => $task->getCreatedAt(),
            'updatedAt' => $task->getUpdatedAt()
        ];
        $data[] = $newRow;
        file_put_contents(
            $this->filename,
            json_encode($data)
        );
        $this->indexProvider->saveNext();
        return $newId;
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