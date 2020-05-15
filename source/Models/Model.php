<?php

namespace Source\Models;
use Source\Database\Connect;

abstract class Model
{
    
    /** @var object|null */
    protected $data;

    /** @var \PDOException|null */
    protected $fail;

    /** @var  string|null */
    protected $message;

    /**
     * @return null|object
     */

    public function __set($name, $value)
    {
        if (empty($this->data)){
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }



    public function data(): ?\PDOException
    {
        return $this->data;
    }

    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    public function message(): ?\PDOException
    {
        return $this->message;
    }

    protected function create(string $entity, array $data): ?int
    {
        try {
            $columns = implode(", ", array_keys($data));
            $value = ":" . implode(",:", array_keys($data));

            $stmt = Connect::getInstance()->prepare("INSERT INTO {$entity} ({$columns}) VALUES ({$value})");
            $stmt->execute($this->filter($data));
           
            return Connect::getInstance()->lastInsertId();

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }

        var_dump($entity, $data);
    }

    public function read(string $select, string $params = null): ?\PDOStatement
    {
        try {
            $stmt = Connect::getInstance()->prepare($select);
            
            if ($params){
                parse_str($params, $params);
                foreach ($params as $key => $value) { 
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }
            
            $stmt->execute();
            return $stmt;

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
        
    }

    protected function update(string $entity, array $data, string $terms, string $params): ?int
    {

        try {
            foreach ($data as $bind => $value){
                $dataSet[] = "{$bind} = :{$bind}";
            }

            $dataSet = implode(", ", $dataSet);
            parse_str($params, $params);
            //var_dump(array_merge($data, $params));

            $stmt = Connect::getInstance()->prepare("UPDATE {$entity} SET {$dataSet}  WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));
            return($stmt->rowCount() ?? 1);

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }

        
    }

    protected function delete()
    {
        
    }

    public function safe(): ?array
    {
        $safe = (array)$this->data;
        foreach (static::$safe as $unset) {
            unset($safe[$unset]);
        }
        return $safe;

    }

    protected function filter(array $data)
    {
        $filter = [];
        foreach ($data as $key => $value) {
            // var_dump($data);
          $filter[$key] = (is_null($value) ? null : $value);
        }
        return $filter;
    }

}