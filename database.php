<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
    private $table;
    private $select;
    private $where;
    private $join;
    private $groupBy;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$this->connection) {
            die('Database connection error: ' . mysqli_connect_error());
        }
    }

    public function disconnect()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    public function table($table)
    {
        $this->where = [];
        $this->join = [];
        $this->select = [];
        $this->groupBy = [];
        $this->table = $table;
        return $this;
    }

    public function select($columns = '*')
    {
        $this->select = $columns;
        return $this;
    }

    public function where($column, $value)
    {
        $this->where[] = "$column = $value";
        return $this;
    }

    public function whereNotIn($column, $value)
    {
        $this->where[] = "$column NOT IN ($value)";
        return $this;
    }

    public function whereIn($column, $value)
    {
        $this->where[] = "$column IN ($value)";
        return $this;
    }

    public function join($table, $condition)
    {
        $this->join[] = "JOIN $table ON $condition";
        return $this;
    }

    public function groupBy($column)
    {
        $this->groupBy[] = $column;
        return $this;
    }

    public function find()
    {
        $result = $this->exec();
        return mysqli_fetch_assoc($result);
    }

    public function insert($data)
    {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

        return mysqli_query($this->connection, $query);
    }

    public function update($data)
    {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = '$value'";
        }

        $query = "UPDATE {$this->table} SET " . implode(", ", $set);

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(" AND ", $this->where);
        }

        return mysqli_query($this->connection, $query);
    }

    public function delete()
    {
        $query = "DELETE FROM {$this->table}";

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(" AND ", $this->where);
        }

        return mysqli_query($this->connection, $query);
    }

    public function findAll()
    {
        $result = $this->exec();
        $results = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }

        return $results;
    }

    public function exec()
    {
        $query = "SELECT ";

        if (empty($this->select)) {
            $query .= "*";
        } else {
            $query .= $this->select;
        }

        $query .= " FROM {$this->table}";

        if (!empty($this->join)) {
            $query .= " " . implode(" ", $this->join);
        }

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(" AND ", $this->where);
        }

        if (!empty($this->groupBy)) {
            $query .= " GROUP BY " . implode(", ", $this->groupBy);
        }

        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            return null;
        }

        return $result;
    }

    public function column($column)
    {
        $this->select = $column;
        $result = $this->exec();

        $values = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $values[] = $row[$column];
        }

        return $values;
    }
}
