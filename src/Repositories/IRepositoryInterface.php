<?php

namespace Tabbakka\LightOrm\Repositories;

use Tabbakka\LightOrm\Entities\IEntityInterface;
use Tabbakka\LightOrm\Mappers\IMapperInterface;

interface IRepositoryInterface
{
    public function findOneBy(array $criteria): object;

    public function findBy(array $criteria): array;

    public function findAll(): array;

    public function findOneById(int $id): IEntityInterface;

    public function create(array $data): void;

    public function update(int $id, array $data): void;

    public function delete(int $id): void;

    public function count(): int;

    public function exists(int $id): bool;

    public function existsBy(array $criteria): bool;

    public function getTableName(): string;

    public function upsert(array $data): void;

    public function getMapper(): IMapperInterface;
}