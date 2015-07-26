<?php

namespace Orkork\RabbitTest;

use PhpAmqpLib\Connection\AMQPConnection;
use Orkork\Tools\Config;

abstract class Node
{
    protected $_config;
    protected $_connection;
    protected $_channel;

    /**
     * Sets config and initializes connection to RabbitMQ
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->_config = $config;
        $this->_initConnection();
    }

    public function __destruct() 
    {
        $this->closeConnection();
    }

    public function closeConnection()
    {
        if($this->_channel) {
            $this->_channel->close();
        }
        
        if($this->_connection) {
            $this->_connection->close();
        }
    }

    public function reopenConnection()
    {
        $this->closeConnection();
        $this->_initConnection();
    }

    protected function _initConnection()
    {
        // Create connection
        $this->_connection = new AMQPConnection(
            $this->_config->rabbitMqHost,
            $this->_config->rabbitMqPort,
            $this->_config->rabbitMqUser,
            $this->_config->rabbitMqPassword
        );

        // Create channel
        $this->_channel = $this->_connection->channel();

        $this->_channel->queue_declare(
            $this->_config->queueName,
            $this->_config->queueIsPassive,
            $this->_config->queueIsDurable,
            $this->_config->queueIsExclusive,
            $this->_config->queueIsAutodelete
        );
    }
}