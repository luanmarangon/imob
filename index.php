<?php


ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

/**
 * WEB ROUTES
 */

$route->namespace("Source\App");
$route->get("/", "Web:home");
$route->get("/contato", "Web:contact");
$route->get("/filtro/{type}", "Web:filter");
$route->get("/destaques", "Web:emphasis");
$route->get("/propriedades/{id}", "Web:property");
$route->get("/alugar", "Web:rent");
$route->get("/comprar", "Web:purchase");
$route->get("/termos", "Web:terms");
// $route->get("/entrar", "Web:login");
// $route->post("/entrar", "Web:login");


/**
 * ADMIN ROUTES
 */
$route->namespace("Source\App\Admin");
$route->group("/admin");

//login
$route->get("/", "Login:root");
$route->get("/login", "Login:login");
$route->post("/login", "Login:login");

//dash
$route->get("/dash", "Dash:dash");
$route->get("/dash/home", "Dash:home");
$route->post("/dash/home", "Dash:home");
$route->get("/logoff", "Dash:logoff");

//Owners
$route->get("/owners/home", "Owner:home");

$route->get("/owners/owners", "Owner:owners");
$route->post("/owners/owners", "Owner:owners");
$route->get("/owners/owners/{search}/{page}", "Owner:owners");


$route->get("/owners/owners/{owners_id}/contacts", "Owner:contacts");
$route->get("/owners/owners/create", "Owner:create");

//properties
$route->get("/properties/home", "Propertie:home");
$route->get("/properties/properties", "Propertie:properties");
$route->post("/properties/properties", "Propertie:properties");
$route->get("/properties/properties/{search}/{page}", "Propertie:properties");
$route->get("/properties/properties/{reference}/details/home", "Propertie:details");
$route->get("/properties/properties/{reference}/details/comfortable", "Propertie:detailsComfortable");
$route->get("/properties/properties/{reference}/details/features", "Propertie:detailsFeatures");
$route->get("/properties/properties/{reference}/details/structures", "Propertie:detailsStrucutures");
$route->get("/properties/properties/{reference}/transactions/transactions", "Propertie:transactions");

//transactions
$route->get("/transactions/home", "Transaction:home");
$route->get("/transactions/transactions", "Transaction:transactions");
$route->post("/transactions/transactions", "Transaction:transactions");
$route->get("/transactions/transactions/{search}/{page}", "Transaction:transactions");


//customers
$route->get("/clients/home", "Customer:home");
$route->get("/clients/client", "Customer:clients");
$route->get("/clients/client/{clients_id}/contacts", "Customer:clientContacts");

$route->get("/clients/leads", "Customer:leads");
$route->post("/clients/leads", "Customer:leads");
$route->get("/clients/leads/{search}/{page}", "Customer:leads");

//settings
$route->get("/settings/home", "Setting:home");

$route->get("/settings/category", "Setting:category");
$route->post("/settings/category", "Setting:category");
$route->get("/settings/category/{search}/{page}", "Setting:category");

$route->get("/settings/charges", "Setting:charges");
$route->post("/settings/charges", "Setting:charges");
$route->get("/settings/charges/{search}/{page}", "Setting:charges");

$route->get("/settings/comfortable", "Setting:comfortable");
$route->post("/settings/comfortable", "Setting:comfortable");
$route->get("/settings/comfortable/{search}/{page}", "Setting:comfortable");

$route->get("/settings/feature", "Setting:feature");
$route->post("/settings/feature", "Setting:feature");
$route->get("/settings/feature/{search}/{page}", "Setting:feature");

$route->get("/settings/structures", "Setting:structures");
$route->post("/settings/structures", "Setting:structures");
$route->get("/settings/structures/{search}/{page}", "Setting:structures");

$route->get("/settings/types", "Setting:types");
$route->post("/settings/types", "Setting:types");
$route->get("/settings/types/{search}/{page}", "Setting:types");


//reports
$route->get("/relatorios", "Reports:home");


//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");

$route->get("/users/home/{search}/{page}", "Users:home");

$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");

$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");



/**
 * ERROR ROUTES
 */

$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */

$route->dispatch();

/**
 * ERROR REDIRECT
 */

if ($route->error()) {
  $route->redirect("/ops/{$route->error()}");
}




ob_end_flush();