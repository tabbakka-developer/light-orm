<?php

namespace Tabbakka\LightOrm\Mappers;

use Tabbakka\LightOrm\Entities\IEntityInterface;

interface IMapperInterface
{
    public function mapFromDatabase(array $data): IEntityInterface;

    public function mapToDatabase(IEntityInterface $entity): array;
}