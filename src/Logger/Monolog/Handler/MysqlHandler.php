<?php

namespace Logger\Monolog\Handler;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use DB;
use Illuminate\Support\Facades\Auth;


class MysqlHandler extends AbstractProcessingHandler
{
    protected $table;
    protected $connection;

    public function __construct(array $config,int $level = Logger::DEBUG,bool $bubble = true) {

        $this->table        = $config['table'];
        $this->connection   = $config['connection'];
        parent::__construct($level, $bubble);
    }

    protected function write(array $record) {
        $data = [
            'instance' => gethostname(),
            'message' => $record['message'],
            'channel' => $record['channel'],
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'context' => json_encode($record['context']),
            'remote_addr' => isset($_SERVER['REMOTE_ADDR']) ? ip2long($_SERVER['REMOTE_ADDR']) : null,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
            'created_by' => Auth::id() > 0 ? Auth::id() : null,
            'created_at' => $record['datetime']->format('Y-m-d H:i:s')
        ];
        DB::connection($this->connection)->table($this->table)->insert($data);
    }
}