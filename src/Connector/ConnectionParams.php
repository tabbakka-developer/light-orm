<?php

namespace Tabbakka\LightOrm\Connector;

class ConnectionParams
{
    private string $host;

    private int $port;

    private string $user;

    private string $password;

    private string $database;

    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $database
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }
}
