<?php

namespace Anguis\IndexProvider\IndexProvider;

interface IndexProviderInterface {

    public function getNext(): string;
    public function saveNext(): string;
}
