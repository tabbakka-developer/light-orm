<?php

namespace Tabbakka\LightOrm\Connector;

interface ConnectorInterface
{
    public function getConnection();

    public function connect();

    public function connectWithParams(ConnectionParams $params);
}