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

    protected bool $isUpdate;

    protected bool $isDelete;

    protected bool $isInsert;

    protected array $update;

    protected array $insert;

    public function __construct()
    {
        $this->query = '';
        $this->table = '';
        $this->select = '';
        $this->where = [];
        $this->isUpdate = false;
        $this->isDelete = false;
        $this->update = [];
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

    public function into(string $table): Builder
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

        if (!$this->isUpdate && !$this->isDelete && !$this->isInsert) {
            $this->query = "SELECT {$this->select} FROM {$this->table} ";
        } else {
            if ($this->isUpdate && count($this->update)) {
                $this->query = "UPDATE {$this->table} SET ";
                //apply update fields
                $max = count($this->update);
                $i = 1;
                foreach ($this->update as $column => $value) {
                    $this->query .= "{$column} = {$value}, ";
                    if ($i === $max) {
                        $this->query = substr($this->query, 0, -2);
                    }
                }
            } elseif ($this->isDelete) {
                $this->query = "DELETE FROM {$this->table} ";
            } elseif ($this->isInsert && count($this->insert)) {
                $this->query = "INSERT INTO {$this->table} ";
                //apply insert fields
                $max = count($this->insert);
                $i = 1;
                $columns = '';
                $values = '';
                foreach ($this->insert as $column => $value) {
                    $columns .= "{$column}, ";
                    $values .= "{$value}, ";
                    if ($i === $max) {
                        $columns = substr($columns, 0, -2);
                        $values = substr($values, 0, -2);
                    }
                    $i++;
                }
                $this->query .= "({$columns}) VALUES ({$values})";
            } else {
                throw new Exception('Invalid query');
            }
        }

        if (!empty($this->where) && !$this->isInsert) {
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

        if (!empty($this->limit) && !$this->isInsert) {
            $this->query .= "LIMIT {$this->limit}";
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

        var_dump($this->query);
        die(1);

        //todo: execute query
        return [];
    }

    public function delete(): Builder
    {
        $this->isDelete = true;
        return $this;
    }

    public function update(array $update): Builder
    {
        $this->isUpdate = true;
        $this->update = $update;
        return $this;
    }

    public function insert(array $data): Builder
    {
        $this->isInsert = true;
        $this->insert = $data;
        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function count(string $field = "*"): Builder
    {
        $this->select = "count($field) as cnt";
        return $this;
    }
}