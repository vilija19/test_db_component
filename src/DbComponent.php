<?php

namespace Vilija19\db_component;

use Aigletter\Contracts\Builder\DbInterface;
use Aigletter\Contracts\Builder\QueryInterface;

class DbComponent implements DbInterface
{
    protected $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
    }

    public function one(QueryInterface $query): object
    {
        $sqlStr = $query->toSql();
        $res = $this->conn->query($sqlStr);
        return $res->fetch_assoc();
    }

    public function all(QueryInterface $query): array
    {
        $outData = array();
        $sqlStr = $query->toSql();
        $res = $this->conn->query($sqlStr);
        while ($row = $res->fetch_assoc()) {
            $outData[] = $row;
        }
        return $outData;                
    }

}
