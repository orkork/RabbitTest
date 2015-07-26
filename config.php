<?php

return array(

    /*
     * RabbitMQ settings
     */ 

    'rabbitMqHost' => 'myhost',
    'rabbitMqPort' => '5672',
    'rabbitMqUser' => 'user',
    'rabbitMqPassword' => 'pass',

    'queueName' => 'rabbitTest',
    'queueIsPassive' => false,
    'queueIsDurable' => true,
    'queueIsExclusive' => false,
    'queueIsAutodelete' => false,

    'exchange' => '',
    'routingKey' => 'rabbitTest',

    /*
     * Script settings
     */ 

    'message' => 'hallo',
    'messageAmount' => 1000,
    'publishSleepSeconds' => 0.055556 // publish ~18 msg/s
);