<?php

namespace Tabbakka\LightOrm\Criteria;

class Criteria
{
    /**
     * @var array $criteria
     */
    protected array $criteria;

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function add(string $key, string $value): void
    {
        $this->criteria[$key] = $value;
    }

    /**
     * @return array
     */
    public function getCriteria(): array
    {
        return $this->criteria;
    }
}