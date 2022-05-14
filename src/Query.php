<?php

namespace Vilija19\DbComponent;

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

    /**
     * Формирует строки для SQL запроса из ассоциативных массивов параметров
     * @param array $assocArray - ассоциативный массив
     * @param string $separator - склеивающая подстрока, включая пробелы если надо
     * @return string 
     */
    protected function assocToStr(array $assocArray,string $separator):string
    {
        $sqlSubStr = '';
        $i = 0;
        foreach ($assocArray as $key => $value) {
            $sqlSubStr .= $i ? $separator : '';            
            $sqlSubStr .= $key . '="' . $value . '"';
            $i++;
        }
        return $sqlSubStr;
    }

    public function toSql(): string
    {
        $sql = '';
        $start = $this->offset ? (int)$this->offset : 0;            
        $limit = $this->limit ? (int)$this->limit : 20; 

        if ($this->select) {
            $sql .=  'SELECT ' . implode(',' , $this->select);
        }else{
            $sql .=  'SELECT * ';
        }
        $sql .= ' FROM ' . $this->table .' WHERE ';     
        if ($this->where) {
            $i = 0;
            foreach ($this->where as $key => $value) {
                $sql .= $i ? ' AND ' : '';            
                $sql .= $key . '="' . $value . '"';
                $i++;
            }            
        }else{
            $sql .= ' 1 ';
        }
        if ($this->order) {
            $sql .= ' ORDER BY ';
            $i = 0;
            foreach ($this->order as $key => $value) {
                $sql .= $i ? ',' : '';            
                $sql .= $key . ' ' . $value ;
                $i++;
            }            
        }
        if ($this->limit) {
            $sql .= ' LIMIT ' . $start . "," . $limit;
        }
        echo '$sqlString is: ' . $sql . PHP_EOL;
        return $sql;
    }    
    
}
