<?php

use Tabbakka\LightORM\Mappers\IMapperInterface;
use Tabbakka\LightOrm\Entities\IEntityInterface;

class UserMapper implements IMapperInterface
{

    #[\Override] public function mapFromDatabase(array $data): User
    {
        return User::toEntity($data);
    }

    #[\Override] public function mapToDatabase(IEntityInterface $entity): array
    {
        return $entity->toDatabase();
    }
}