<?php

namespace Vilija19\DbComponent;

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
        $res = $this->conn->querySingle($sqlStr, true);
        return (object)$res;
    }

    public function all(QueryInterface $query): array
    {
        $outData = array();
        $sqlStr = $query->toSql();
        $res = $this->conn->query($sqlStr);
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            $outData[] = $row;
        }
        return $outData;                
    }

}
