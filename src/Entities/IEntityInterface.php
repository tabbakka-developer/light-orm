<?php

namespace Tabbakka\LightOrm\Entities;

interface IEntityInterface
{
    /**
     * @return array
     */
    public function toDatabase(): array;

    /**
     * @param array $data
     * @return object
     */
    public static function toEntity(array $data): object;
}