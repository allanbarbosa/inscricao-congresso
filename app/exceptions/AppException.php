<?php

class AppException extends Exception
{

    protected $message;

    public function getMensagem()
    {
        $this->message = "Erro: " . $this->getMessage();

        $this->log();

        return $this->message;
    }

    public function log()
    {
        $monolog = Log::getMonolog();

        $monolog->addInfo($this->message, array('Congresso' => 'Error'));
    }
}