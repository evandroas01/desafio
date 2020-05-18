<?php

namespace Source\App;

class Store
{

    public function debug($data)
    {
        echo "to aqui!";
     
        // $model = new \Source\Models\Category();

        // $update = $model->load('4');

        // if($update){
        //     $update->destroy(); 
        // }
        // $update->code = "1987";
        // $update->name = "ultimo update"; 
        // $update->destroy(); 
        // $update->save();

        // var_dump($update);

    }

    public function readcat()
    {

        $model = new \Source\Models\Category();

        $insert = $model->all();

        $encode = json_encode($insert);
        
        echo $encode;
    }

    public function readprod()
    {

        $model = new \Source\Models\Product();

        $insert = $model->all();

        $encode = json_encode($insert);
        
        echo $encode;
    }

    public function insertProduct($data)
    {
       
        $model = new \Source\Models\Product();

        $insertProd = $model->bootstrap($_POST['name'], $_POST['sku'], $_POST['price'], $_POST['description'], $_POST['qts'], $_POST['category']);
        $insertProd->save();

        $confirm = ($insertProd->message() == "Cadastro realizado com sucesso") ? true : false;

        $message = array("success" => $confirm,"message" => $insertProd->message());

        echo json_encode($message);

    }

    public function insertCategories($data)
    {
     
        $model = new \Source\Models\Category();

        $insertCat = $model->info($_POST['catname'],$_POST['catcode']);
        $insertCat->save();

        $confirm = ($insertCat->message() == "Cadastro realizado com sucesso") ? true : false;

        $message = array("success" => $confirm,"message" => $insertCat->message());

        echo json_encode($message);

    }

    public function updateProduct($data)
    {
       
        $model = new \Source\Models\Product();

        $upProduct = $model->load($_POST['id']);
        $upProduct->name = $_POST['id'];
        $upProduct->sku =  $_POST['sku'];
        $upProduct->price = $_POST['price'];
        $upProduct->description = $_POST['description'];
        $upProduct->amount = $_POST['amount'];
        $upProduct->categories = $_POST['categories'];
        $upProduct->save();
      
        var_dump($upProduct->message());

    }

    public function updateCategory($data)
    {
       
        $model = new \Source\Models\Category();

        $upCategory = $model->load($_POST['id']);
        $upCategory->name = $_POST['name'];
        $upCategory->code =  $_POST['code'];
        $upCategory->save();
      
        var_dump($upCategory->message());

    }

 

    public function catDelete($data)
    {
     
        $model = new \Source\Models\Category();

        $deleteCat = $model->load($_POST['id']);
        $deleteCat->destroy(); 
      
        var_dump($deleteCat->message());

    }

    public function prodDelete($data)
    {
     
        $model = new \Source\Models\Product();

        $deleteProd = $model->load($_POST['id']);
        $deleteProd->destroy(); 
      
        var_dump($deleteProd->message());

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