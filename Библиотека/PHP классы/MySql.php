<?php
/**
 * Class getMySql -> readTable
 * Class getMySql -> readRow
 * Class setMySql -> changeTable
 */

 abstract class MySql{

    private const HOSTNAME = 'localhost';
    private const LOGIN = 'root';
    private const PASSWORD = '';
    private const DBNAME = 'test';

    protected function sqlQuery(string $request){

        $link = mysqli_connect(self::HOSTNAME, self::LOGIN, self::PASSWORD, self::DBNAME);
        return mysqli_query($link, $request);
    }
}

class getMySql extends MySql{

    public function readTable(string $request){
        $data = parent::sqlQuery($request);
        $sql = mysqli_fetch_all($data, 1);
        return $sql;
    }

    public function readRow(string $request){
        $data = parent::sqlQuery($request);
        $sql = mysqli_fetch_row($data);
        return $sql;
    }
}

class setMySql extends MySql{

    public function changeTable(string $request){

        return parent::sqlQuery($request);
    }
}

