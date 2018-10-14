<?php

class Demidov_CustomApi_Model_Package
{
    protected $version, $command, $params, $token;

    public function __construct($version, $command, $params, $token)
    {
        $this->version = $version;
        $this->command = $command;
        $this->params = $params;
        $this->token = $token;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getToken()
    {
        return $this->token;
    }
}