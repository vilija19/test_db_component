<?php

namespace Vilija19\DbComponent;

use Aigletter\Contracts\Builder\BuilderInterface;
use Aigletter\Contracts\Builder\QueryInterface;

class QueryBuilder implements \Aigletter\Contracts\Builder\QueryBuilderInterface
{

    protected $select;
    protected $where;
    protected $table;
    protected $limit;
    protected $offset;
    protected $order;

    public function table($table): BuilderInterface
    {
        $this->table = $table;
        return $this;
    }

    public function where($where): BuilderInterface
    {
        $this->where = $where;
        return $this;
    }

    public function select($select): BuilderInterface
    {
        $this->select = $select;
        return $this;
    }

    public function limit($limit): BuilderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset): BuilderInterface
    {
        $this->offset = $offset;
        return $this;
    }    
    
    public function order($order): BuilderInterface
    {
        $this->order = $order;
        return $this;
    }  

    public function build(): QueryInterface
    {
        return new Query(
            $this->select,
            $this->table,
            $this->where,
            $this->limit,
            $this->offset,
            $this->order
        );
    }
}
