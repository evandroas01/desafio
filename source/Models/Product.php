<?php

namespace Source\Models;

class Product extends Model
{

    protected static $safe = ["id"];    

    protected static $entity = "product";    

    public function bootstrap(string $name, string $sku,  $price, string $description, int $amount, string $categories): ?Product
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
        $this->description = $description;
        $this->amount = $amount;
        $this->categories = $categories;
        return $this;

    }

    public function load($id, $columns = "*"): Product
    {
        $load = $this->read("SELECT {$columns} FROM " .self::$entity. " WHERE id = :id ", "id= {$id}");
        if ($this->fail() || !$load->rowCount()) {
            $this->message = "Erro, não foi encontrado usuario para o id informado!";
            return null;
        }

        return $load->fetchObject(__CLASS__);
    }

    public function find($sku, string $columns = "*"): ?Product
    {
        $find = $this->read("SELECT {$columns} FROM " .self::$entity. " WHERE sku = :sku", "sku={$sku}");
        if ($this->fail() || !$find->rowCount()){
            $this->message = "Sku não encontrado, para o nome informado!";
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    public function all($limit = 10 , $ofsset = 0, string $columns = "*")
    {
        $all = $this->read("SELECT {$columns} FROM " .self::$entity. " LIMIT :l OFFSET :o", "l={$limit}&o={$ofsset}");
        if ($this->fail() || !$all->rowCount()){
            $this->message = "Sua consulta não retornou usuarios!";
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);

    }

    public function save()
    {
        if(!$this->required()){
            return null;
        }

        /**Product Update */
        if (!empty($this->id)){
            $id = $this->id;
            $sku = $this->read("SELECT id FROM product WHERE sku = :sku AND id != :id","sku={$this->sku}&id={$id}");


            $this->update(self::$entity, $this->safe(), "id = :id", "id={$id}");
            if ($this->fail()){
                $this->message = "Erro ao atualizar, verifique os dados";
            }

            $this->message = "Cadastro atualizado com sucesso";
        }

        /**Product Create */
        if (empty($this->id)){
            if($this->find($this->sku)){
                $this->message = "SKU informado já esta cadastrado!";
                return null;
            }

            $id = $this->create(self::$entity, $this->safe());
            if ($this->fail()){
                $this->message = "Erro ao cadastrar, verifique os dados";
            }
            $this->message = "Cadastro realizado com sucesso";
         
        }
        $this->data = $this->read("SELECT * FROM product WHERE id = :id", "id={$id}")->fetch();
        return $id;
    }

    public function destroy()
    {

    }

    private function required():bool
    {

        if(empty($this->name) || empty($this->price) || empty($this->categories)){
            $this->message = "O Nome, documento, email  são campos obrigatorios!";
            return false;
            // "$name, string $sku,  $price, string $description, int $amount, string $categories";
        }

        return true;

    }


}