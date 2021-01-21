<?php

namespace Anguis\TaskList\Manager;

use Anguis\TaskList\Entity\TaskEntity;
use Anguis\IndexProvider\IndexProvider\IndexProviderInterface;

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

        $data = [
            'id' => $newId,
            'title' => $task->getTitle(),
            'createdAt' => $task->getCreatedAt(),
            'updatedAt' => $task->getUpdatedAt()
        ];

        file_put_contents(
            $this->filename,
            json_encode($data)
        );
        $this->indexProvider->saveNext();

        return $newId;
    }
}