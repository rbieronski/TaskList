<?php

namespace Anguis\TaskList\Reader;

class JsonTaskReader implements TaskReaderInterface
{
    protected string $jsonPath;

    function __construct(string $jsonPath)
    {
        $this->jsonPath = $jsonPath;
    }

    public function findAll(): array
    {
        return json_decode(
            file_get_contents($this->jsonPath), true
        );
    }

    // for debugging
    public function __toString(): string
    {
        $separator = ' | ';
        $str = '';
        $arr = $this->findAll();
        foreach ($arr as $key=>$item) {
            $str .= $item['id'] . $separator;
            $str .= $item['title'] . $separator;
            $str .= $item['createdAt'] . $separator;
            $str .= $item['updatedAt'] . $separator;
            $str .= PHP_EOL;
        }
        return $str;
    }
}