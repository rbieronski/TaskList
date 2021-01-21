<?php

namespace Anguis\TaskList\IndexProvider;

class NumberIndexProvider implements IndexProviderInterface
{
    protected string $filename;
    protected string $nextKey;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function getNext(): string {
        $lastIndex = (int) file_get_contents($this->filename);
        return ++$lastIndex;
    }

    public function saveNext(): string {
        file_put_contents($this->filename, $this->nextKey);
        return $this->nextKey;
    }
}