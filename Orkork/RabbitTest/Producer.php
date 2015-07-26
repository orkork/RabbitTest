<?php 

namespace Orkork\RabbitTest;

use Orkork\RabbitTest\Node;
use PhpAmqpLib\Message\AMQPMessage;

class Producer extends Node
{
    /**
     * Sends given message via configured exchange and routingKey
     *
     * @param string $message
     */
    public function publishMessage($message)
    {
        $this->_channel->basic_publish(
            new AMQPMessage($message),
            $this->_config->exchange,
            $this->_config->routingKey
        );
    }
}