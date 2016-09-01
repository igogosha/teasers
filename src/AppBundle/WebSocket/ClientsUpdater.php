<?php
/**
 * Created by PhpStorm.
 * User: igogosha
 * Date: 30.08.16
 * Time: 10:46
 */

namespace AppBundle\WebSocket;

use P2\Bundle\RatchetBundle\Socket\Event\ConnectionEvent;
use P2\Bundle\RatchetBundle\Socket\Payload;
use P2\Bundle\RatchetBundle\Socket\ApplicationInterface;
use P2\Bundle\RatchetBundle\Socket\Payload\EventPayload;
use P2\Bundle\RatchetBundle\Socket\Event\MessageEvent;

class ClientsUpdater
{
    public static function getSubscribedEvents()
    {
        return array(
            'chat.send' => 'onSendMessage'
        );
    }

    public function onSendMessage(MessageEvent $event)
    {
        $client = $event->getConnection()->getClient()->jsonSerialize();
        $message = $event->getPayload()->getData();

        $event->getConnection()->broadcast(
            new EventPayload(
                'chat.message',
                array(
                    'client' => $client,
                    'message' => $message
                )
            )
        );

        $event->getConnection()->emit(
            new EventPayload(
                'chat.message.sent',
                array(
                    'client' => $client,
                    'message' => $message
                )
            )
        );
    }
}