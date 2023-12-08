<?php

namespace Tabbakka\LightOrm\Repositories;

use Tabbakka\LightOrm\Builder\Builder;
use Tabbakka\LightOrm\Entities\IEntityInterface;
use Tabbakka\LightOrm\Mappers\IMapperInterface;
use Exception;

abstract class Repository implements IRepositoryInterface
{

    #[\Override] public function findOneBy(array $criteria): IEntityInterface
    {
        $builder = new Builder();

        $result = $builder->select(['*'])
            ->from($this->getTableName());

        //apply criteria
        foreach ($criteria as $key => $value) {
            $result = $result->where([$key => $value]);
        }

        $result = $result
            ->limit(1)
            ->get();

        return $this->getMapper()->mapFromDatabase($result);
    }

    #[\Override] public function findBy(array $criteria): array
    {
        $builder = new Builder();

        $result = $builder->select(['*'])
            ->from($this->getTableName());

        //apply criteria
        foreach ($criteria as $key => $value) {
            $result = $result->where([$key => $value]);
        }

        $result = $result
            ->get();

        $response = [];
        foreach ($result as $item) {
            $response[] = $this->getMapper()->mapFromDatabase($item);
        }

        return $response;
    }

    #[\Override] public function findAll(): array
    {
        $builder = new Builder();

        $result = $builder->select(['*'])
            ->from($this->getTableName())
            ->get();

        $response = [];
        foreach ($result as $item) {
            $response[] = $this->getMapper()->mapFromDatabase($item);
        }

        return $response;
    }

    /**
     * @param int $id
     * @return IEntityInterface
     * @throws Exception
     */
    #[\Override] public function findOneById(int $id): IEntityInterface
    {
        $builder = new Builder();

        $result = $builder->select(['*'])
            ->from($this->getTableName())
            ->where(['id' => $id])
            ->limit(1)
            ->get();

        return $this->getMapper()->mapFromDatabase($result);
    }

    #[\Override] public function create(array $data): void
    {
        $builder = new Builder();

        $builder->insert($data)
            ->into($this->getTableName())
            ->get();
    }

    #[\Override] public function update(int $id, array $data): void
    {
        $builder = new Builder();

        $builder->update($data)
            ->from($this->getTableName())
            ->where(['id' => $id])
            ->get();
    }

    #[\Override] public function delete(int $id): void
    {
        $builder = new Builder();

        $builder->delete()
            ->from($this->getTableName())
            ->where(['id' => $id])
            ->get();
    }

    #[\Override] public function count(string $field = "*", array $criteria = []): int
    {
        $builder = new Builder();

        $result = $builder
            ->from($this->getTableName())
            ->where($criteria)
            ->count($field)
            ->get();

        return $result[0]->cnt ?? 0;
    }

    #[\Override] public function exists(int $id): bool
    {
        // TODO: Implement exists() method.
    }

    #[\Override] public function existsBy(array $criteria): bool
    {
        // TODO: Implement existsBy() method.
    }

    #[\Override] public function upsert(array $data): void
    {
        // TODO: Implement upsert() method.
    }

    abstract public function getTableName(): string;

    abstract public function getMapper(): IMapperInterface;
}