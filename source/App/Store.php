<?php

namespace Source\App;

class Store
{

    public function dashboard($data)
    {
        require __DIR__."/../../views/dashboard.html";
    }
 
    public function products($data)
    {
        echo "<h1>Produtos!</h1>";
        var_dump($data);
    }
    
    public function addProducts($data)
    {
        echo "<h1>Add Produtos!</h1>";
        var_dump($data);
    }

    public function categories($data)
    {
        echo "<h1>Categoria!</h1>";
        var_dump($data);
    }

    public function addCategories($data)
    {
        echo "<h1>Add Categories!</h1>";
    }

    public function error($data)
    {
        echo "<h1>Erro{$data["errcode"]}</h1>";
        var_dump($data);
    }

}