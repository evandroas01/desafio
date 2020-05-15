<?php

namespace Source\App;

class Store
{
    public function debug($data)
    {
        echo "Debug!";

        $model = new \Source\Models\Product();

        $insert = $model->bootstrap($_POST['name'], $_POST['sku'], $_POST['price'], $_POST['description'], $_POST['qts'], $_POST['category']);
        $insert->save();

        // $model = new \Source\Models\Category();

        // $insert = $model->info("teste","123456");
        // $insert->save();

        var_dump($model->errorCode());

    }

    public function dashboard($data)
    {
        require __DIR__."/../../views/dashboard.html";
    }
 
    public function products($data)
    {
        require __DIR__."/../../views/products.html";
    }
    
    public function addProducts($data)
    {
        require __DIR__."/../../views/addProduct.html";
    }

    public function categories($data)
    {
        require __DIR__."/../../views/categories.html";
    }

    public function addCategories($data)
    {
        require __DIR__."/../../views/addCategory.html";
    }

    public function error($data)
    {
        echo "<h1>Erro{$data["errcode"]}</h1>";
        var_dump($data);
    }

}