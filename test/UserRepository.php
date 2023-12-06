<?php

use Tabbakka\LightOrm\Repositories\Repository;
use Tabbakka\LightOrm\Mappers\IMapperInterface;

class UserRepository extends Repository
{

    #[\Override] public function getTableName(): string
    {
        return 'users';
    }

    #[\Override] public function getMapper(): IMapperInterface
    {
        return new UserMapper();
    }
}