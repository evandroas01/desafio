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
$router->post("/","Store:debug");
$router->get("/{filter}", "Store:debug");

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