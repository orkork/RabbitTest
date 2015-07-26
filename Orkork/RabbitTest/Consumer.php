<?php

namespace Orkork\RabbitTest;

use Orkork\RabbitTest\Node;
use PhpAmqpLib\Connection\AMQPConnection;

class Consumer extends Node
{
    public function listen($callback)
    {
        $this->_channel->basic_consume(
            $this->_config->queueName,
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while(count($this->_channel->callbacks)) {
            $this->_channel->wait();
        }
    }
}