<?php

namespace Source\App;

class Store
{
    public function insertProduct($data)
    {
       
        $model = new \Source\Models\Product();

        $insert = $model->bootstrap($_POST['name'], $_POST['sku'], $_POST['price'], $_POST['description'], $_POST['qts'], $_POST['category']);
        $insert->save();

        $confirm = ($insert->message() == "Cadastro realizado com sucesso") ? true : false;

        $message = array("success" => $confirm,"message" => $insert->message());

        echo json_encode($message);

    }

    public function insertCategories($data)
    {
     
        $model = new \Source\Models\Category();

        $insert = $model->info($_POST['catname'],$_POST['catcode']);
        $insert->save();

        $confirm = ($insert->message() == "Cadastro realizado com sucesso") ? true : false;

        $message = array("success" => $confirm,"message" => $insert->message());

        echo json_encode($message);

    }

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

        var_dump($update);

    }

    public function catdelete($data)
    {
        echo "to aqui delete!";
     
        $model = new \Source\Models\Category();

        $delete = $model->load($_POST['id']);
        $delete->destroy(); 
      
        var_dump($update);

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