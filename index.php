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
$route->post("/", "Web:home");
$route->get("/contato", "Web:contact");
$route->post("/contato", "Web:contact");
$route->get("/optin", "Web:optin");
$route->post("/optin", "Web:optin");
$route->get("/interest", "Web:interest");
$route->post("/interest", "Web:interest");
$route->get("/filtro/{type}", "Web:filter");
// $route->post("/filtro/{type}", "Web:filter");
/*Consulta dos Filtros  */
$route->get("/propertySearch", "Web:propertySearch");
$route->post("/propertySearch", "Web:propertySearch");

$route->get("/destaques", "Web:emphasis");
$route->post("/destaques", "Web:emphasis");
$route->get("/propriedades/{id}", "Web:property");
$route->post("/propriedades/{id}", "Web:property");
// $route->get("/alugar", "Web:rent");
// $route->get("/comprar", "Web:purchase");
$route->get("/termos", "Web:terms");
$route->get("/politicaPrivacidade", "Web:privacyPolicy");
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

//people/
$route->get("/people/home", "Person:home");

$route->get("/people/people", "Person:people");
$route->post("/people/people", "Person:people");
$route->get("/people/people/{search}/{page}", "Person:people");

$route->get("/people/people-create", "Person:peopleCreate");
$route->post("/people/people-create", "Person:peopleCreate");

$route->get("/people/people-create/{people_id}", "Person:peopleCreate");
$route->post("/people/people-create/{people_id}", "Person:peopleCreate");

$route->get("/people/people/{people_id}/contacts", "Person:contacts");
$route->post("/people/people/{people_id}/contacts", "Person:contacts");
$route->get("/people/people/{people_id}/contacts/{search}/{page}", "Person:contacts");
$route->post("/people/people/{people_id}/contacts/{contacts_id}", "Person:contacts");

//properties
$route->get("/properties/home", "Propertie:home");
$route->get("/properties/properties", "Propertie:properties");
$route->post("/properties/properties", "Propertie:properties");

$route->get("/properties/properties-create", "Propertie:propertiesCreate");
$route->post("/properties/properties-create", "Propertie:propertiesCreate");

$route->get("/properties/properties-create/{propertie_id}", "Propertie:propertiesCreate");
$route->post("/properties/properties-create/{propertie_id}", "Propertie:propertiesCreate");

$route->get("/properties/propertiesImages/{reference}", "Propertie:propertiesImages");
$route->post("/properties/propertiesImages/{reference}", "Propertie:propertiesImages");
$route->get("/properties/propertiesImages/{reference}/{image}", "Propertie:propertiesImagesUpdate");
$route->post("/properties/propertiesImages/{reference}/{image}", "Propertie:propertiesImagesUpdate");


$route->get("/properties/properties/{search}/{page}", "Propertie:properties");
$route->get("/properties/properties/{reference}/details/home", "Propertie:details");

$route->get("/properties/properties/{reference}/details/comfortable", "Propertie:detailsComfortable");
$route->post("/properties/properties/{reference}/details/comfortable", "Propertie:detailsComfortable");
$route->get("/properties/properties/{reference}/details/comfortableUpdate/{comfortable_id}", "Propertie:comfortableUpdate");
$route->post("/properties/properties/{reference}/details/comfortableUpdate/{comfortable_id}", "Propertie:comfortableUpdate");

$route->get("/properties/properties/{reference}/details/features", "Propertie:detailsFeatures");
$route->post("/properties/properties/{reference}/details/features", "Propertie:detailsFeatures");

$route->get("/properties/properties/{reference}/details/structures", "Propertie:detailsStrucutures");
$route->post("/properties/properties/{reference}/details/structures", "Propertie:detailsStrucutures");
$route->get("/properties/properties/{reference}/details/structuresUpdate/{structures_id}", "Propertie:structuresUpdate");
$route->post("/properties/properties/{reference}/details/structuresUpdate/{structures_id}", "Propertie:structuresUpdate");

$route->get("/properties/properties/{reference}/transactions/transactions", "Propertie:transactions");
$route->get("/properties/properties/{reference}/transactions/transactions/{search}/{page}", "Propertie:transactions");
$route->get("/properties/properties/{reference}/transactions/transactions-create", "Propertie:transactionsCreate");
$route->post("/properties/properties/{reference}/transactions/transactions-create", "Propertie:transactionsCreate");

$route->get("/properties/properties/{reference}/transactions/transactions-create/{transaction_id}", "Propertie:transactionsCreate");
$route->post("/properties/properties/{reference}/transactions/transactions-create/{transaction_id}", "Propertie:transactionsCreate");

$route->get("/properties/properties/{reference}/tributes/home", "Propertie:tributes");
$route->get("/properties/properties/{reference}/tributes/tributes-create", "Propertie:tributesCreate");
$route->post("/properties/properties/{reference}/tributes/tributes-create", "Propertie:tributesCreate");
$route->get("/properties/properties/{reference}/tributes/tributes-create/{tribute_id}", "Propertie:tributesCreate");
$route->post("/properties/properties/{reference}/tributes/tributes-create/{tribute_id}", "Propertie:tributesCreate");


//transactions
$route->get("/transactions/home", "Transaction:home");
$route->get("/transactions/transactions", "Transaction:transactions");
$route->post("/transactions/transactions", "Transaction:transactions");
$route->get("/transactions/transactions/{search}/{page}", "Transaction:transactions");


//customers
$route->get("/leads/home", "Customer:home");
$route->get("/clients/client", "Customer:clients");
$route->get("/clients/client/{clients_id}/contacts", "Customer:clientContacts");

$route->get("/leads/leads", "Customer:leads");
$route->post("/leads/leads", "Customer:leads");
$route->get("/leads/leads/{search}/{page}", "Customer:leads");

$route->get("/leads/convert/{leads_id}", "Customer:convert");
$route->post("/leads/convert/{leads_id}", "Customer:convert");

$route->get("/leads/inactive/{leads_id}", "Customer:inactive");
$route->post("/leads/inactive/{leads_id}", "Customer:inactive");


//settings
$route->get("/settings/home", "Setting:home");

$route->get("/settings/category", "Setting:category");
$route->post("/settings/category", "Setting:category");
$route->get("/settings/category/{search}/{page}", "Setting:category");
$route->get("/settings/categoryUpdate/{category_id}", "Setting:categoryUpdate");
$route->post("/settings/categoryUpdate/{category_id}", "Setting:categoryUpdate");

$route->get("/settings/charges", "Setting:charges");
$route->post("/settings/charges", "Setting:charges");
$route->get("/settings/charges/{search}/{page}", "Setting:charges");
$route->get("/settings/chargesUpdate/{charge_id}", "Setting:chargesUpdate");
$route->post("/settings/chargesUpdate/{charge_id}", "Setting:chargesUpdate");

$route->get("/settings/comfortable", "Setting:comfortable");
$route->post("/settings/comfortable", "Setting:comfortable");
$route->get("/settings/comfortable/{search}/{page}", "Setting:comfortable");
$route->get("/settings/comfortableUpdate/{comfortable_id}", "Setting:comfortableUpdate");
$route->post("/settings/comfortableUpdate/{comfortable_id}", "Setting:comfortableUpdate");

$route->get("/settings/feature", "Setting:feature");
$route->post("/settings/feature", "Setting:feature");
$route->get("/settings/feature/{search}/{page}", "Setting:feature");
$route->get("/settings/featureUpdate/{feature_id}", "Setting:featureUpdate");
$route->post("/settings/featureUpdate/{feature_id}", "Setting:featureUpdate");

$route->get("/settings/structures", "Setting:structures");
$route->post("/settings/structures", "Setting:structures");
$route->get("/settings/structures/{search}/{page}", "Setting:structures");
$route->get("/settings/structuresUpdate/{structure_id}", "Setting:structuresUpdate");
$route->post("/settings/structuresUpdate/{structure_id}", "Setting:structuresUpdate");

$route->get("/settings/types", "Setting:types");
$route->post("/settings/types", "Setting:types");
$route->get("/settings/types/{search}/{page}", "Setting:types");
$route->get("/settings/typesUpdate/{type_id}", "Setting:typesUpdate");
$route->post("/settings/typesUpdate/{type_id}", "Setting:typesUpdate");

//reports
$route->get("/reports/home", "Reports:home");

$route->get("/reports/relImoveis", "Reports:relImoveis");
$route->post("/reports/relImoveis", "Reports:relImoveis");

$route->get("/reports/relatorioImoveis", "Reports:relatorioImoveis");
$route->post("/reports/relatorioImoveis", "Reports:relatorioImoveis");
$route->get("/reports/relatorioImoveis/{search}/{page}", "Reports:relatorioImoveis");

$route->get("/reports/relClients", "Reports:relClients");
$route->post("/reports/relClients", "Reports:relClients");


$route->get("/reports/relatorioClientes", "Reports:relatorioClientes");
$route->post("/reports/relatorioClientes", "Reports:relatorioClientes");
$route->get("/reports/relatorioClientes/{search}/{page}", "Reports:relatorioClientes");

//customer success
$route->get("/cs", "ContactCenter:cs");
$route->get("/cs/home", "ContactCenter:home");
$route->get("/cs/contato", "ContactCenter:contact");
$route->post("/cs/contato", "ContactCenter:contact");
$route->get("/cs/contato/{search}/{page}", "ContactCenter:contact");
$route->get("/cs/resposta/{id}", "ContactCenter:response");
$route->post("/cs/resposta/{id}", "ContactCenter:response");


//users
$route->get("/users/home", "Users:home");
$route->post("/users/home", "Users:home");
$route->get("/users/home/{search}/{page}", "Users:home");
$route->get("/users/user", "Users:user");
$route->post("/users/user", "Users:user");
$route->get("/users/user/{user_id}", "Users:user");
$route->post("/users/user/{user_id}", "Users:user");


//Backup
$route->get("/backup", "Backup:backup");


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
