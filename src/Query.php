<?php

namespace Vilija19\db_component;

class Query implements \Aigletter\Contracts\Builder\QueryInterface
{

    protected $select;
    protected $table;
    protected $where;
    protected $limit;
    protected $offset;
    protected $order;
    
    public function __construct($select,$table,$where,$limit,$offset,$order)
    {
        $this->select = $select;
        $this->table = $table;
        $this->where = $where;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->order = $order;
    }

    public function toSql(): string
    {
        $sql =  'SELECT ' . implode(',' , $this->select);
        $sql .= ' FROM ' . $this->table . ' WHERE ';
        foreach ($this->where as $key => $value) {
            $sql .= $key . '=' . $value;
        }


        return $sql;
    }    
    
}
