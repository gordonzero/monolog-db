<?php
/**
 * Created by PhpStorm.
 * User: michael.tombrello
 * Date: 4/17/2018
 * Time: 5:02 PM
 */

namespace Logger;
use Monolog\Logger;
use Logger\Monolog\Handler\MysqlHandler;


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