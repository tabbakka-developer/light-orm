<?php

namespace Tabbakka\LightOrm\Builder;

use Exception;

class Builder
{
    protected string $query;

    protected array $where;

    protected string $table;

    protected string $select;

    protected int $limit;

    public function __construct()
    {
        $this->query = '';
    }

    public function select(array $columns): Builder
    {
        $this->select = implode(', ', $columns);
        return $this;
    }

    public function from(string $table): Builder
    {
        $this->table = $table;
        return $this;
    }

    public function where(array $where): Builder
    {
        if (!empty($where)) {
            $this->where = array_merge($this->where, $where);
            return $this;
        }

        $this->where = $where;
        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function build(): string
    {
        if (empty($this->select)) {
            $this->select = '*';
        }

        if (empty($this->table)) {
            throw new Exception('Table name is required');
        }

        $this->query = "SELECT {$this->select} FROM {$this->table}";

        if (!empty($this->where)) {
            $whereQuery = 'WHERE ';
            $max = count($this->where);
            $i = 1;
            foreach ($this->where as $key => $value) {
                $whereQuery .= "{$key} = {$value} ";
                if ($i < $max) {
                    $i++;
                    $whereQuery .= 'AND ';
                }
            }
            $this->query .= $whereQuery;
        }

        if (!empty($this->limit)) {
            $this->query .= " LIMIT {$this->limit}";
        }

        return $this->query;
    }

    public function limit(int $limit): Builder
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function get(): array
    {
        if (empty($this->query)) {
            $this->query = $this->build();
        }
        //todo: execute query
        return [];
    }
}