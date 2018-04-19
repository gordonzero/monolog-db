<?php

namespace Logger;

use Monolog\Logger;


class DatabaseLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config) : Logger
    {
        $handler = new MysqlHandler($config,Logger::DEBUG);
        return new Logger('database',[$handler]);
    }
}