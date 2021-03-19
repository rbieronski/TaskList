<?php

namespace Anguis\TaskList\IndexProvider;

/**
 * Interface IndexProviderInterface
 * @package Anguis\TaskList\IndexProvider
 */
interface IndexProviderInterface {

    public function getNext(): string;
}
