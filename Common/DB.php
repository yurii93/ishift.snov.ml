<?php

namespace Common;

use Exception;

class DB
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection->set_charset("utf8");

        if (mysqli_connect_error()) {
            throw new Exception('Извините, у нас проблемы на сервере.');
        }
    }

    /*
     * Makes sql query & returns data
     */
    public function query($sql)
    {
        if (!$this->connection) {
            return false;
        }

        $result = $this->connection->query($sql);

        if (is_bool($result)) {
            return $result;
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    /*
     * Escapes data
     */
    public function escape($value)
    {
        return mysqli_escape_string($this->connection, $value);
    }

    /*
     * Returns last insert id
     */
    public function lastId() {
        return $this->connection->insert_id;
    }
}