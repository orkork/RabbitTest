<?php

require_once __DIR__.'/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Orkork\RabbitTest\Producer;
use Orkork\Tools\Config;

$config = new Config(require 'config.php');

$producer = new Producer($config);

for($i = 1; $i <= $config->messageAmount; $i++) {
    $producer->publishMessage(uniqid('', true));
    usleep(ceil($config->publishSleepSeconds * 1000000)); 
}