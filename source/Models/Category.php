<?php

namespace Source\Models;

class Category extends Model
{

    protected static $safe = ["id"];    

    protected static $entity = "categories";    

    public function info(string $name, string $code): ?Category
    {
        $this->name = $name;
        $this->code = $code;
        return $this;

    }

    public function load($id, $columns = "*"): Category
    {
        $load = $this->read("SELECT {$columns} FROM " .self::$entity. " WHERE id = :id ", "id= {$id}");
        if ($this->fail() || !$load->rowCount()) {
            $this->message = "Erro, não foi encontrado usuario para o id informado!";
            return null;
        }

        return $load->fetchObject(__CLASS__);
    }

    public function find($code, string $columns = "*"): ?Category
    {
        $find = $this->read("SELECT {$columns} FROM " .self::$entity. " WHERE code = :code", "code={$code}");
        if ($this->fail() || !$find->rowCount()){
            $this->message = "Usuario não encontrado, para o nome informado!";
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

        /**Category Update */
        if (!empty($this->id)){
            $id = $this->id;
            $code = $this->read("SELECT id FROM categories WHERE code = :code AND id != :id","code={$this->code}&id={$id}");


            $this->update(self::$entity, $this->safe(), "id = :id", "id={$id}");
            if ($this->fail()){
                $this->message = "Erro ao atualizar, verifique os dados";
            }

            $this->message = "Cadastro atualizado com sucesso";
        }

        /**Category Create */
        if (empty($this->id)){
            if($this->find($this->code)){
                $this->message = "Codigo informado já esta cadastrado!";
                return null;
            }

            $id = $this->create(self::$entity, $this->safe());
            if ($this->fail()){
                $this->message = "Erro ao cadastrar, verifique os dados";
            }
            $this->message = "Cadastro realizado com sucesso";
         
        }
        $this->data = $this->read("SELECT * FROM categories WHERE id = :id", "id={$id}")->fetch();
        return $id;
    }

    public function destroy()
    {

    }

    private function required():bool
    {

        if(empty($this->name) || empty($this->code)){
            $this->message = "O Nome, Codigo são campos obrigatorios!";
            return false;
        }

        return true;

    }


}