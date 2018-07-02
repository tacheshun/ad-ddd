<?php

namespace MG\Application\Notification;


use Symfony\Component\EventDispatcher\EventDispatcher;

class NotificationService
{
    public function publishNotifications($exchangeName)
    {

        $event =
        (new EventDispatcher())->dispatch($event);
    }
}