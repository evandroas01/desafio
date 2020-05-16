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
$router->group(null);
$router->get("/","Store:debug");
$router->get("/{filter}", "Store:debug");

//insertcategories
$router->group("insertCategories");
$router->get("/","Store:insertCategories");
$router->post("/","Store:insertCategories");
$router->get("/{filter}", "Store:insertCategories");

//readcat
$router->group("readcat");
$router->get("/","Store:readcat");
$router->post("/","Store:readcat");
$router->get("/{filter}", "Store:readcat");

//readcat
$router->group("readprod");
$router->get("/","Store:readprod");
$router->post("/","Store:readprod");
$router->get("/{filter}", "Store:readprod");


//insertProduct
$router->group("insertProduct");
$router->get("/","Store:insertProduct");
$router->post("/","Store:insertProduct");
$router->get("/{filter}", "Store:insertProduct");

//Produtos
$router->group("products");
$router->get("/", "Store:products");
$router->get("/add", "Store:addProducts");

//Categorias
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