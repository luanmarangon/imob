<?php

/**
 * DATA BASE
 */

if (strpos($_SERVER['HTTP_HOST'], "localhost")) {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_DB_NAME", "imob");
} else {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_DB_NAME", "imob");
}

/**
 * PROJECTS URLs
 */
define("CONF_URL_BASE", "https://localhost/imob");
define("CONF_URL_TEST", "https://localhost/imob");

/**
 * SITE
 */
define("CONF_SITE_NAME", "IMOB - Imobiliaria");
define("CONF_SITE_TITLE", "Gerencie seus Imóveis");
define("CONF_SITE_DESC", "O IMOB é um gerenciador de imóveis, para manter atualizados as informações dos imóveis a venda e em aluguel");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "www.imob-marangon.com.br");
define("CONF_SITE_DOMAIN_LINK", "https://www.imob-marangon.com.br");
define("CONF_SITE_ADDR_STREET", "Rua Alcides Ramos da Silva");
define("CONF_SITE_ADDR_NUMBER", "315");
define("CONF_SITE_ADDR_COMPLEMENT", "Casa");
define("CONF_SITE_ADDR_DISTRICT", "Jd. Paulista");
define("CONF_SITE_ADDR_CITY", "Martinópolis");
define("CONF_SITE_ADDR_STATE", "SP");
define("CONF_SITE_ADDR_ZIPCODE", "19.500-000");

/**
 * COMPANY
 */
define("CONF_COMPANY_ATTENDANCE_WEEK", "Seg/Sex");
define("CONF_COMPANY_ATTENDANCE_WEEK_TIME", "08:00h - 18:00h");
define("CONF_COMPANY_ATTENDANCE_WEEKEND", "Sábado");
define("CONF_COMPANY_ATTENDANCE_WEEKEND_TIME", "08:00h - 12:00h");
define("CONF_COMPANY_ATTENDANCE_MAIL", "contato@dominio-imob.com.br");
define("CONF_COMPANY_ATTENDANCE_PHONE", "+55 (99) 3322-4455");
define("CONF_COMPANY_ATTENDANCE_WHATS", "+55 (18) 99748-2397");
define("CONF_COMPANY_ATTENDANCE_MENSAGE", "Olá, gostaria de mais informações referente ao imóvel: ");
/**
 * teste de imovel ate buscar do banco
 */
define("CONF_IMOVEL_TEST", "IMOB0091");



/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "marangonLuan");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "#");
define("CONF_SOCIAL_FACEBOOK_APP", "#");
define("CONF_SOCIAL_FACEBOOK_PAGE", "marangonluan");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "#");
define("CONF_SOCIAL_GOOGLE_PAGE", "#");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "#");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "luan_marangon");
define("CONF_SOCIAL_YOUTUBE", "#");


/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y/m/d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "imobweb");
// define("CONF_VIEW_APP", "cafeapp");
// define("CONF_VIEW_ADMIN", "cafeadm");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.mailtrap.io");
define("CONF_MAIL_PORT", "2525");
define("CONF_MAIL_USER", "a0865255cf3335");
define("CONF_MAIL_PASS", "3c0ab03e8c7c54");
define("CONF_MAIL_SENDER", ["name" => "IMOB", "address" => "luan.limarangon@hotmail.com"]);
define("CONF_MAIL_SUPPORT", "luan.limarangon@hotmail.com");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");
