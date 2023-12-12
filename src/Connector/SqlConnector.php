<?php

namespace Tabbakka\LightOrm\Connector;

use Tabbakka\LightOrm\Connector\ConnectorInterface;
use mysqli;

class SqlConnector implements ConnectorInterface
{
    protected mysqli $sql;

    #[\Override] public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    #[\Override] public function connect()
    {
        // TODO: Implement connect() method.
    }

    #[\Override] public function connectWithParams(ConnectionParams $params)
    {
        $this->sql = mysqli_connect(
            $params->getHost(),
            $params->getUser(),
            $params->getPassword(),
            $params->getDatabase(),
            $params->getPort()
        );
    }
}