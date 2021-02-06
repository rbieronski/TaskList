<?php

namespace Anguis\TaskList\Listener;

use Symfony\Contracts\EventDispatcher\Event;

class TaskAddedListener
{
    public function taskAdded(Event $event)
    {
      printf("Dodano nowego taska: %s\n", $event->getTaskEntity()->getTitle());
    }
}
