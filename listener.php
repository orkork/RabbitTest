<?php

require_once __DIR__.'/vendor/autoload.php';

use Orkork\RabbitTest\Consumer;
use Orkork\Tools\Config;
use PhpAmqpLib\Message\AMQPMessage;

$config = new Config(require 'config.php');

$consumer = new Consumer($config);
$consumer->listen(
    function (AMQPMessage $message) {
        echo "-> Received message '", $message->body, "'\n";
        usleep(0.15 * 1000000); // simulate 150ms processwing time
});