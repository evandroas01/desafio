<?php

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\App");

//Store-home
$router->group(null);
$router->get("/","Store:dashboard");
$router->get("/{filter}", "Store:dashboard");

//debug
$router->group("debug");
$router->get("/","Store:debug");
$router->get("/{filter}", "Store:debug");

//Insert-Categories
$router->group("insertCategories");
$router->get("/","Store:insertCategories");
$router->post("/","Store:insertCategories");
$router->get("/{filter}", "Store:insertCategories");

//Delete-Categories
$router->group("catdelete");
$router->get("/","Store:catdelete");
$router->post("/","Store:catdelete");
$router->get("/{filter}", "Store:catdelete");

//Read-Category
$router->group("readcat");
$router->get("/","Store:readcat");
$router->post("/","Store:readcat");
$router->get("/{filter}", "Store:readcat");

//Read-Product
$router->group("readprod");
$router->get("/","Store:readprod");
$router->post("/","Store:readprod");
$router->get("/{filter}", "Store:readprod");


//Insert-Product
$router->group("insertProduct");
$router->get("/","Store:insertProduct");
$router->post("/","Store:insertProduct");
$router->get("/{filter}", "Store:insertProduct");

//Delete-Product
$router->group("proddelete");
$router->get("/","Store:prodDelete");
$router->post("/","Store:prodDelete");
$router->get("/{filter}", "Store:prodDelete");

//Delete-Category  updateProduct
$router->group("catdelete");
$router->get("/","Store:catDelete");
$router->post("/","Store:catDelete");
$router->get("/{filter}", "Store:catDelete");

//List-Categorias
$router->group("updateproduct");
$router->get("/","Store:updateProduct");
$router->post("/","Store:updateProduct");


//List-Categorias
$router->group("updatecategory");
$router->get("/","Store:updateCategory");
$router->post("/","Store:updateCategory");


//List-Produtos
$router->group("products");
$router->get("/", "Store:products");
$router->get("/add", "Store:addProducts");

//List-Categorias
$router->group("categories");
$router->get("/","Store:categories");
$router->get("/add","Store:addCategories");

//erros
$router->group("error");
$router->get("/{errcode}", "Store:error");

$router->dispatch();

if ($router->error()){
    $router->redirect("/error/{$router->error()}");
} 