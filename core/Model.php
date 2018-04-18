<?php

namespace core;

use core\DB;

abstract class Model
{
    protected $conn;

    public function __construct() {}

    public function all($sql = null)
    {
        if ($sql === null) {
            $sql = "
                SELECT *
                  FROM {$this->getEntity()}
              ORDER BY {$this->getKey()}
            ";
        }
        
        try {
            $this->beginTransaction();
            
            $query = $this->getConn()->prepare($sql);
            $query->execute();

            $users = $query->fetchAll();

            $this->close();

            if ($users !== false) {
                return $users;
            }
        } catch (\Exception $e) {
            $this->rollback();
            throw new \Exception($e->getMessage());
        }
        return null; 
    }

    public function find($id)
    {
        $sql = "
            SELECT *
              FROM {$this->getEntity()}
             WHERE {$this->getKey()} = {$id}
        ";
        try {
            $this->beginTransaction();

            $query = $this->getConn()->prepare($sql);
            $query->execute();
            $user = $query->fetch();

            $this->close();

            if ($user !== false) {
                return $user;
            }
        } catch (\Exception $e) {
            $this->rollback();
            throw new \Exception($e->getMessage());
        }
		return null;    
    }

    public function store()
    {
        if ($this->toArray() != null) {
            $sql = "
                INSERT INTO {$this->getEntity()} ({$this->getKeyColumns()})"
                . "VALUES ({$this->getDataColumns()})";
                     
            try {
                $this->beginTransaction();
    
                $query = $this->getConn()->prepare($sql);
                $query->execute();
                
                $this->close();
            } catch (\Exception $e) {
                $this->rollback();
                var_dump($e->getMessage());
            }
        } 
    }
    
    public function update()
    {
        if ($this->toArray() != null) {
            $sql = "
                UPDATE {$this->getEntity()} "
                . "SET {$this->getUpdateValues()} "
                . "WHERE {$this->getKey()} = {$this->toArray()[$this->getKey()]}";
                
            try {
                $this->beginTransaction();
    
                $query = $this->getConn()->prepare($sql);
                $query->execute();
                
                $this->close();
            } catch (\Exception $e) {
                $this->rollback();
                var_dump($e->getMessage());
            }
        } 
    }
    
    protected function getUpdateValues()
    {
        $arr = [];
        
        foreach ($this->toArray() as $col => $val) {
            if ($val != null && $col != $this->getKey()) {
                array_push($arr, $col.' = '.$val);
            }
        }
        
        return implode(', ', $arr);
    }
    
    protected function getKeyColumns()
    {
        return implode(',', array_keys($this->columns));
    }
    
    protected function getDataColumns()
    {
        return ($this->max()+1).implode(',', $this->toArray());
    }

    public function max()
    {
        $sql = "
            SELECT max({$this->getKey()}) AS max
              FROM {$this->getEntity()}
        ";

        try {
            $this->beginTransaction();

            $query = $this->getConn()->prepare($sql);
            $query->execute();
            $id = $query->fetch();

            $this->close();
            
            if ($id !== false) {
                return $id->max;
            }
        } catch (\Exception $e) {
            $this->rollback();
            throw new \Exception($e->getMessage());
        }
        return null; 
    }

    public function delete()
    {
        if ($this->toArray() != null) {
            $sql = "
                DELETE FROM {$this->getEntity()} "
                . "WHERE {$this->getKey()} = {$this->toArray()[$this->getKey()]}";
                
            try {
                $this->beginTransaction();
    
                $query = $this->getConn()->prepare($sql);
                $query->execute();
                
                $this->close();
            } catch (\Exception $e) {
                $this->rollback();
                var_dump($e->getMessage());
            }
        } 
    }

    protected function beginTransaction()
    {
        $this->conn = DB::begin();
    }

    protected function close()
    {
        $this->conn->commit();
        $this->conn = null;
    }

    protected function rollback()
    {
        $this->conn->rollBack();
        $this->conn = null;
    }

    protected function getConn()
    {
        return $this->conn;
    }

    public function getEntity()
    {
        return $this->tableName;
    }
    
    public function getKey()
    {
        return $this->pkey;
    }
    
    public function toArray()
    {
        return $this->columns;
    }

    public function __get($property)
    {
        return (isset($this->columns[$property])) 
            ? $this->columns[$property]
            : null;
    }
    
    public function __set($column, $value)
    {
        $value = (is_string($value)) ? "'".$value."'" : $value;
        $this->columns[$column] = $value;
    }
}