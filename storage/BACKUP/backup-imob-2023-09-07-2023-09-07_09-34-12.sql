DROP TABLE IF EXISTS addresses;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `people_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `complement` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`people_id`),
  KEY `fk_addresses_people1_idx` (`people_id`),
  CONSTRAINT `fk_addresses_people1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO addresses VALUES("1","1","Rua Residencia Proprietario - sem Imovel vinculado","315","Casa","Jardim Paulista","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-05-21 21:16:16","","");
INSERT INTO addresses VALUES("2","1","Rua Alcides Ramos da Silva","315","Casa","Jardim Paulista","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-06-25 13:12:46","-22.1475282","-51.1720686");
INSERT INTO addresses VALUES("3","1","Rua Jose Maria Sanches","511","Comercio","Centro","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-07-05 20:32:26","-22.14749","-51.17207");
INSERT INTO addresses VALUES("4","1","Rua Teste","1500","Comercio","TesteA","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-05-21 21:16:16","","");
INSERT INTO addresses VALUES("5","1","Rua TesteB","2300","Predio","TesteB","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-05-21 21:16:16","","");
INSERT INTO addresses VALUES("6","2","Rua Teste3","200","","TesteB","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-05-21 21:16:16","","");
INSERT INTO addresses VALUES("7","2","Rua TesteC","250","","TesteB","Martinopolis","SP","19500-000","2023-05-21 21:16:16","2023-05-21 21:16:16","","");
INSERT INTO addresses VALUES("8","2","Rua TesteD","230","Casa","TesteB","Presidente Prudente","SP","19500-000","2023-05-21 21:16:16","2023-07-16 12:57:44","","");
INSERT INTO addresses VALUES("9","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:47:06","2023-06-27 06:47:06","-22.09757","-51.38855");
INSERT INTO addresses VALUES("10","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:47:21","2023-06-27 06:47:21","-22.09757","-51.38855");
INSERT INTO addresses VALUES("11","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:48:13","2023-06-27 06:48:13","-22.09757","-51.38855");
INSERT INTO addresses VALUES("12","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:49:31","2023-06-27 06:49:31","-22.09757","-51.38855");
INSERT INTO addresses VALUES("13","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:49:59","2023-06-27 06:49:59","-22.09757","-51.38855");
INSERT INTO addresses VALUES("14","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:50:50","2023-06-27 06:50:50","-22.09752","-51.38953");
INSERT INTO addresses VALUES("15","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:52:28","2023-06-27 06:52:28","-22.09752","-51.38953");
INSERT INTO addresses VALUES("16","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:52:52","2023-06-27 06:52:52","-22.09752","-51.38953");
INSERT INTO addresses VALUES("17","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:54:51","2023-06-27 06:54:51","-22.09752","-51.38953");
INSERT INTO addresses VALUES("18","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:56:28","2023-06-27 06:56:28","-22.09752","-51.38953");
INSERT INTO addresses VALUES("19","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:56:46","2023-06-27 06:56:46","-22.09752","-51.38953");
INSERT INTO addresses VALUES("20","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:57:07","2023-06-27 06:57:07","-22.09752","-51.38953");
INSERT INTO addresses VALUES("21","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 06:58:50","2023-06-27 06:58:50","-22.09752","-51.38953");
INSERT INTO addresses VALUES("22","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:00:11","2023-06-27 07:00:11","-22.09752","-51.38953");
INSERT INTO addresses VALUES("23","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:00:32","2023-06-27 07:00:32","-22.09752","-51.38953");
INSERT INTO addresses VALUES("24","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:03:09","2023-06-27 07:03:09","-22.09752","-51.38953");
INSERT INTO addresses VALUES("25","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:03:29","2023-06-27 07:03:29","-22.09752","-51.38953");
INSERT INTO addresses VALUES("26","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:03:53","2023-06-27 07:03:53","-22.09752","-51.38953");
INSERT INTO addresses VALUES("27","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:04:29","2023-06-27 07:04:29","-22.09752","-51.38953");
INSERT INTO addresses VALUES("28","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:04:46","2023-06-27 07:04:46","-22.09752","-51.38953");
INSERT INTO addresses VALUES("29","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:05:10","2023-06-27 07:05:10","-22.09752","-51.38953");
INSERT INTO addresses VALUES("30","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:05:31","2023-06-27 07:05:31","-22.09752","-51.38953");
INSERT INTO addresses VALUES("31","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:06:18","2023-06-27 07:06:18","-22.09752","-51.38953");
INSERT INTO addresses VALUES("32","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:07:12","2023-06-27 07:07:12","-22.09752","-51.38953");
INSERT INTO addresses VALUES("33","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:07:55","2023-06-27 07:07:55","-22.09752","-51.38953");
INSERT INTO addresses VALUES("34","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:08:39","2023-06-27 07:08:39","-22.09752","-51.38953");
INSERT INTO addresses VALUES("35","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:09:01","2023-06-27 07:09:01","-22.09752","-51.38953");
INSERT INTO addresses VALUES("36","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:09:22","2023-06-27 07:09:22","-22.09752","-51.38953");
INSERT INTO addresses VALUES("37","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:09:47","2023-06-27 07:09:47","-22.09752","-51.38953");
INSERT INTO addresses VALUES("38","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:09:59","2023-06-27 07:09:59","-22.09752","-51.38953");
INSERT INTO addresses VALUES("39","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:10:51","2023-06-27 07:10:51","-22.09752","-51.38953");
INSERT INTO addresses VALUES("40","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:11:06","2023-06-27 07:11:06","-22.09752","-51.38953");
INSERT INTO addresses VALUES("41","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 07:11:19","2023-06-27 07:11:19","-22.09752","-51.38953");
INSERT INTO addresses VALUES("42","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 19:08:54","2023-06-27 19:08:54","-22.09752","-51.38953");
INSERT INTO addresses VALUES("43","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 19:10:04","2023-06-27 19:10:04","-22.09752","-51.38953");
INSERT INTO addresses VALUES("44","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 19:15:16","2023-06-27 19:15:16","-22.09752","-51.38953");
INSERT INTO addresses VALUES("45","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 20:49:27","2023-06-27 20:49:27","-22.09752","-51.38953");
INSERT INTO addresses VALUES("46","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 20:51:48","2023-06-27 20:51:48","-22.09752","-51.38953");
INSERT INTO addresses VALUES("47","1","Avenida Presidente Juscelino Kubitschek","7800","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-27 20:52:24","2023-06-27 20:52:24","-22.09752","-51.38953");
INSERT INTO addresses VALUES("48","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:32:37","2023-06-30 06:32:37","-22.09757","-51.38855");
INSERT INTO addresses VALUES("49","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:33:51","2023-06-30 06:33:51","-22.09757","-51.38855");
INSERT INTO addresses VALUES("50","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:34:54","2023-06-30 06:34:54","-22.09757","-51.38855");
INSERT INTO addresses VALUES("51","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:38:28","2023-06-30 06:38:28","-22.09757","-51.38855");
INSERT INTO addresses VALUES("52","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:48:12","2023-06-30 06:48:12","-22.09757","-51.38855");
INSERT INTO addresses VALUES("53","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:54:55","2023-06-30 06:54:55","-22.09757","-51.38855");
INSERT INTO addresses VALUES("54","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:55:30","2023-06-30 06:55:30","-22.09757","-51.38855");
INSERT INTO addresses VALUES("55","1","Avenida Presidente Juscelino Kubitschek","7899","Bloco 3 Apto 41","Jardim Guanabara","Presidente Prudente","SP","19.033-390","2023-06-30 06:55:44","2023-06-30 06:55:44","-22.09757","-51.38855");
INSERT INTO addresses VALUES("56","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:56:24","2023-06-30 06:56:24","-22.14688","-51.13763");
INSERT INTO addresses VALUES("57","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:56:44","2023-06-30 06:56:44","-22.14688","-51.13763");
INSERT INTO addresses VALUES("58","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:56:51","2023-06-30 06:56:51","-22.14688","-51.13763");
INSERT INTO addresses VALUES("59","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:57:34","2023-06-30 06:57:34","-22.14688","-51.13763");
INSERT INTO addresses VALUES("60","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:57:55","2023-06-30 06:57:55","-22.14688","-51.13763");
INSERT INTO addresses VALUES("61","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:58:18","2023-06-30 06:58:18","-22.14688","-51.13763");
INSERT INTO addresses VALUES("62","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:58:38","2023-06-30 06:58:38","-22.14688","-51.13763");
INSERT INTO addresses VALUES("63","2","154s56as","315","315","sdsaas","Martinópolis","SP","19500-000","2023-06-30 06:58:57","2023-06-30 06:58:57","-22.14688","-51.13763");
INSERT INTO addresses VALUES("64","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:18:39","2023-06-30 07:18:39","-22.11191","-51.37716");
INSERT INTO addresses VALUES("65","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:19:26","2023-06-30 07:19:26","-22.11191","-51.37716");
INSERT INTO addresses VALUES("66","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:19:45","2023-06-30 07:19:45","-22.11191","-51.37716");
INSERT INTO addresses VALUES("67","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:20:24","2023-06-30 07:20:24","-22.11191","-51.37716");
INSERT INTO addresses VALUES("68","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:22:25","2023-06-30 07:22:25","-22.11191","-51.37716");
INSERT INTO addresses VALUES("69","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:22:41","2023-06-30 07:22:41","-22.11191","-51.37716");
INSERT INTO addresses VALUES("70","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:23:20","2023-06-30 07:23:20","-22.11191","-51.37716");
INSERT INTO addresses VALUES("71","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:23:39","2023-06-30 07:23:39","-22.11191","-51.37716");
INSERT INTO addresses VALUES("72","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:24:14","2023-06-30 07:24:14","-22.11191","-51.37716");
INSERT INTO addresses VALUES("73","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:24:27","2023-06-30 07:24:27","-22.11191","-51.37716");
INSERT INTO addresses VALUES("74","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:24:49","2023-06-30 07:24:49","-22.11191","-51.37716");
INSERT INTO addresses VALUES("75","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-06-30 07:25:04","2023-06-30 07:25:04","-22.11191","-51.37716");
INSERT INTO addresses VALUES("76","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:14:52","2023-07-01 09:14:52","-22.11191","-51.37716");
INSERT INTO addresses VALUES("77","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:43:07","2023-07-01 09:43:07","-22.11191","-51.37716");
INSERT INTO addresses VALUES("78","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:44:12","2023-07-01 09:44:12","-22.11191","-51.37716");
INSERT INTO addresses VALUES("79","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:48:56","2023-07-01 09:48:56","-22.11191","-51.37716");
INSERT INTO addresses VALUES("80","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:54:18","2023-07-01 09:54:18","-22.11191","-51.37716");
INSERT INTO addresses VALUES("81","4","Rua Alvino Gomes Teixeira","12","asa","Parque Furquim","Presidente Prudente","SP","19.033-000","2023-07-01 09:59:15","2023-07-01 09:59:15","-22.11191","-51.37716");


DROP TABLE IF EXISTS backup_properties_comfortable;
CREATE TABLE `backup_properties_comfortable` (
  `properties_id` int(11) NOT NULL,
  `comfortable_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO backup_properties_comfortable VALUES("1","1","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("1","3","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("1","4","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("1","5","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("2","3","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("3","1","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("3","3","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("3","4","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("3","5","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO backup_properties_comfortable VALUES("14","3","1","2023-06-27 07:03:09","2023-06-27 07:03:09");
INSERT INTO backup_properties_comfortable VALUES("15","3","1","2023-06-27 07:03:29","2023-06-27 07:03:29");
INSERT INTO backup_properties_comfortable VALUES("16","3","1","2023-06-27 07:03:53","2023-06-27 07:03:53");
INSERT INTO backup_properties_comfortable VALUES("17","3","1","2023-06-27 07:04:29","2023-06-27 07:04:29");
INSERT INTO backup_properties_comfortable VALUES("18","3","1","2023-06-27 07:04:46","2023-06-27 07:04:46");
INSERT INTO backup_properties_comfortable VALUES("19","3","1","2023-06-27 07:05:10","2023-06-27 07:05:10");
INSERT INTO backup_properties_comfortable VALUES("20","3","1","2023-06-27 07:05:31","2023-06-27 07:05:31");
INSERT INTO backup_properties_comfortable VALUES("21","3","1","2023-06-27 07:06:18","2023-06-27 07:06:18");
INSERT INTO backup_properties_comfortable VALUES("22","3","1","2023-06-27 07:07:12","2023-06-27 07:07:12");
INSERT INTO backup_properties_comfortable VALUES("23","3","1","2023-06-27 07:07:56","2023-06-27 07:07:56");
INSERT INTO backup_properties_comfortable VALUES("24","3","1","2023-06-27 07:08:39","2023-06-27 07:08:39");
INSERT INTO backup_properties_comfortable VALUES("25","3","1","2023-06-27 07:09:01","2023-06-27 07:09:01");
INSERT INTO backup_properties_comfortable VALUES("26","3","1","2023-06-27 07:09:22","2023-06-27 07:09:22");
INSERT INTO backup_properties_comfortable VALUES("27","3","1","2023-06-27 07:09:47","2023-06-27 07:09:47");
INSERT INTO backup_properties_comfortable VALUES("28","3","1","2023-06-27 07:09:59","2023-06-27 07:09:59");
INSERT INTO backup_properties_comfortable VALUES("30","3","1","2023-06-27 07:11:06","2023-06-27 07:11:06");
INSERT INTO backup_properties_comfortable VALUES("31","3","1","2023-06-27 07:11:20","2023-06-27 07:11:20");
INSERT INTO backup_properties_comfortable VALUES("36","3","1","2023-06-27 20:51:48","2023-06-27 20:51:48");
INSERT INTO backup_properties_comfortable VALUES("40","1","100","2023-06-30 06:37:53","2023-06-30 06:37:53");


DROP TABLE IF EXISTS categories;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO categories VALUES("1","Residencial","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO categories VALUES("2","Comercial","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO categories VALUES("3","Rural","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO categories VALUES("4","Industrial","2023-05-21 21:16:15","2023-05-21 21:16:15");


DROP TABLE IF EXISTS charges;
CREATE TABLE `charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`charge`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO charges VALUES("1","IPTU","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO charges VALUES("2","Condomínio","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO charges VALUES("3","Água","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO charges VALUES("4","Gás","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO charges VALUES("5","Lixo","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS comfortable;
CREATE TABLE `comfortable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `convenient` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`convenient`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO comfortable VALUES("1","Quarto","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("2","Suíte","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("3","Banheiro Social","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("4","Cozinha","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("5","Sala de Estar","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("6","Sala de Jantar","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("7","Area Gourmet","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO comfortable VALUES("8","Lavabo","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS contacts;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO contacts VALUES("1","997482397","celular","","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO contacts VALUES("2","356429882","celular","","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO contacts VALUES("3","324586792","celular","","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO contacts VALUES("4","32654589","Fixo","","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO contacts VALUES("5","(18) 99876-5432","WhatsApp","","2023-07-01 10:13:03","2023-07-01 10:13:03");
INSERT INTO contacts VALUES("6","luanymarangon@gmail.com","E-mail","","2023-07-01 10:16:01","2023-07-01 10:16:01");


DROP TABLE IF EXISTS contract_history;
CREATE TABLE `contract_history` (
  `id` int(11) NOT NULL,
  `properties_id` int(11) NOT NULL,
  `people_id` int(11) NOT NULL,
  `transactions_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`properties_id`,`people_id`,`transactions_id`),
  KEY `fk_historyTransaction_properties1_idx` (`properties_id`),
  KEY `fk_historyTransaction_people1_idx` (`people_id`),
  KEY `fk_historyTransaction_transactions1_idx` (`transactions_id`),
  CONSTRAINT `fk_historyTransaction_people1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historyTransaction_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historyTransaction_transactions1` FOREIGN KEY (`transactions_id`) REFERENCES `transactions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



DROP TABLE IF EXISTS customer_service;
CREATE TABLE `customer_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `messageContact` longtext DEFAULT NULL,
  `status` char(1) DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `fulltext` (`name`,`email`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO customer_service VALUES("13","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Ola, gostaria de saber mais informações relevantes para anunciar um imovel.","S","2023-08-24 20:30:07","2023-08-24 20:31:02");


DROP TABLE IF EXISTS features;
CREATE TABLE `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`feature`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO features VALUES("1","Ar-Condicionado","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO features VALUES("2","Churrasqueira","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO features VALUES("3","Piscina","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO features VALUES("4","Portão Eletrônico","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO features VALUES("5","teste do 1","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("6","teste do 2","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("7","teste do 3","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("8","teste do 4","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("9","teste do 5","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("10","teste do 6","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("11","teste do 7","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("12","teste do 8","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("13","teste do 9","2023-06-25 10:56:20","2023-06-25 10:56:20");
INSERT INTO features VALUES("14","teste do 10","2023-06-25 10:56:20","2023-06-25 10:56:20");


DROP TABLE IF EXISTS images;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`properties_id`),
  KEY `fk_images_properties1_idx` (`properties_id`),
  CONSTRAINT `fk_images_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO images VALUES("1","1","Fachada","images/imob002/imovel2_1.jpg","2023-02-16 06:33:42","2023-06-12 07:21:22");
INSERT INTO images VALUES("2","1","Quarto","images/imob002/imovel2_2.jpg","2023-02-16 06:33:42","2023-06-12 07:21:27");
INSERT INTO images VALUES("3","1","Cozinha","images/imob002/3.jpg","2023-02-16 06:33:42","2023-02-19 22:14:46");
INSERT INTO images VALUES("4","2","Fachada","images/IMOB003/imovel3_1.jpg","2023-02-16 06:33:42","2023-06-13 06:51:56");
INSERT INTO images VALUES("5","2","Quarto","images/IMOB003/imovel3_2.jpg","2023-02-21 19:17:37","2023-06-13 06:52:00");
INSERT INTO images VALUES("6","2","Sala","images/IMOB003/imovel3_3.jpg","2023-02-21 19:17:38","2023-06-13 06:52:07");
INSERT INTO images VALUES("13","3","Fachada","images/IMOB004/imovel4_1.jpg","2023-02-21 19:20:58","2023-06-12 07:22:39");
INSERT INTO images VALUES("14","3","Quarto","images/IMOB004/imovel4_2.jpg","2023-02-21 19:20:58","2023-06-12 07:22:45");
INSERT INTO images VALUES("15","3","Sala","images/IMOB004/3.jpg","2023-02-21 19:20:58","2023-02-21 19:20:58");
INSERT INTO images VALUES("16","4","Fachada","images/IMOB005/imovel5_1.jpg","2023-02-21 19:23:22","2023-06-13 06:53:54");
INSERT INTO images VALUES("17","4","Quarto","images/IMOB005/imovel5_2.jpg","2023-02-21 19:23:22","2023-07-04 06:54:42");
INSERT INTO images VALUES("18","4","Sala","images/IMOB005/3.jpg","2023-02-21 19:23:22","2023-02-21 19:23:22");
INSERT INTO images VALUES("19","5","Fachada","images/imob001/imovel1_1.jpg","2023-02-16 06:33:42","2023-06-13 06:33:56");
INSERT INTO images VALUES("20","5","Quarto","images/imob001/imovel1_2.jpg","2023-02-16 06:33:42","2023-06-13 06:34:00");
INSERT INTO images VALUES("21","5","Cozinha","images/imob001/3.jpg","2023-02-16 06:33:42","2023-02-19 22:14:46");
INSERT INTO images VALUES("22","6","Fachada","images/imob006/Imovel6_1.jpg","2023-02-16 06:33:42","2023-06-13 06:38:07");
INSERT INTO images VALUES("23","6","Quarto","images/imob006/Imovel6_2.jpg","2023-02-16 06:33:42","2023-06-13 06:38:19");
INSERT INTO images VALUES("24","6","Cozinha","images/imob006/Imovel6_3.jpg","2023-02-16 06:33:42","2023-06-13 06:38:26");
INSERT INTO images VALUES("25","7","Fachada","","2023-02-16 06:33:42","2023-06-13 06:54:20");
INSERT INTO images VALUES("26","7","Quarto","images/imob007/imovel7_2.jpg","2023-02-16 06:33:42","2023-06-13 06:47:39");
INSERT INTO images VALUES("27","7","Cozinha","images/imob007/imovel7_3.jpg","2023-02-16 06:33:42","2023-06-13 06:47:49");


DROP TABLE IF EXISTS interest;
CREATE TABLE `interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transactions_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL COMMENT 'reserved, rented, sold',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`transactions_id`),
  KEY `fk_interest_transactions1_idx` (`transactions_id`),
  CONSTRAINT `fk_interest_transactions1` FOREIGN KEY (`transactions_id`) REFERENCES `transactions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO interest VALUES("1","6","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Quero ter mais informações sobre este imóvel. Imóvel Residencial - Apartamento - Martinopolis/SP (#IMOB005)","","2023-05-22 20:04:19","2023-05-22 20:04:19");
INSERT INTO interest VALUES("2","3","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Quero ter mais informações sobre este imóvel. Imóvel Residencial - Apartamento - Martinopolis/SP (#IMOB003)","","2023-05-25 12:03:26","2023-05-25 12:03:26");
INSERT INTO interest VALUES("3","3","Luany de Lima Marangon","luanymarangon@gmail.com","(18) 99715-9096","Quero ter mais informações sobre este imóvel. Imóvel Residencial - Apartamento - Martinopolis/SP (#IMOB003)","","2023-05-25 12:04:41","2023-05-25 12:04:41");
INSERT INTO interest VALUES("4","4","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Quero ter mais informações sobre este imóvel. Imóvel Residencial - Edícula - Martinopolis/SP (#IMOB002)","","2023-07-05 20:37:16","2023-07-05 20:37:16");
INSERT INTO interest VALUES("5","6","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Quero ter mais informações sobre este imóvel. Imóvel Residencial - Apartamento - Martinopolis/SP (#IMOB005)","","2023-07-14 18:53:23","2023-07-14 18:53:23");


DROP TABLE IF EXISTS leads;
CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`full_name`,`email`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO leads VALUES("1","Luan de Lima Marangon","luan.limarangon@gmail.com","(18) 99748-2397","Inativo","2023-05-21 21:20:45","2023-09-06 21:32:37");
INSERT INTO leads VALUES("2","JESSICA FERNANDA VIEIRA MARANGON","jessicafer470@gmail.com","(18) 99605-3857","Lead","2023-05-25 12:07:00","2023-05-25 12:07:00");


DROP TABLE IF EXISTS mail_queue;
CREATE TABLE `mail_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `from_email` varchar(255) NOT NULL DEFAULT '',
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `recipient_email` varchar(255) NOT NULL DEFAULT '',
  `recipient_name` varchar(255) NOT NULL DEFAULT '',
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO mail_queue VALUES("16","[RETORNO - CONTATO IMOB - Imobiliaria]","\r\n                    <html>\r\n                    <head>\r\n                        <style>\r\n                            /* Estilos de formatação do e-mail */\r\n                            body {\r\n                                font-family: Arial, sans-serif;\r\n                            }\r\n                            .container {\r\n                                max-width: 600px;\r\n                                margin: 0 auto;\r\n                                padding: 20px;\r\n                                border: 1px solid #ccc;\r\n                                border-radius: 5px;\r\n                                background-color: #f9f9f9;\r\n                            }\r\n                            h2 {\r\n                                color: #333;\r\n                            }\r\n                            p {\r\n                                margin-bottom: 15px;\r\n                            }\r\n                            span {\r\n                                font-weight: bold;\r\n                                font-style: italic;\r\n                            }            \r\n                            a:link, a:visited {\r\n                                text-decoration: none\r\n                                }\r\n                            a:hover {\r\n                                text-decoration: underline;\r\n                                }\r\n                            a:active {\r\n                                text-decoration: none\r\n                                }\r\n                        </style>\r\n                    </head>\r\n                    <body>\r\n                        <div class=\'container\'>\r\n                            <h2>Resposta ao Contato</h2>\r\n                            <p>Olá, tudo bem?</p>\r\n                            <p>Estamos retornando sobre o envio do contato através de <a href=\'https://www.imob-marangon.com.br\'>www.imob-marangon.com.br</a>.</p>\r\n\r\n                            <h3>Aqui está a sua mensagem original:</h3>\r\n                            <blockquote>Ola, gostaria de saber mais informações relevantes para anunciar um imovel.</blockquote>\r\n                            <h3>Nossa Resposta:</h3>\r\n                            <blockquote>Olá, agradecemos o contato, estarei entrando em contato através do WhatsApp!!\n\n:)</blockquote>\r\n                            <br>\r\n                            <br>\r\n                            <p>Atenciosamente Equipe IMOB - Imobiliaria</p>\r\n                        </div>\r\n                    </body>\r\n                    </html>\r\n                ","luan.limarangon@hotmail.com","IMOB","luan.limarangon@gmail.com","Luan de Lima Marangon","2023-08-24 20:31:08","2023-08-24 20:31:02","2023-08-24 20:31:08");
INSERT INTO mail_queue VALUES("17","[RETORNO - CONTATO IMOB - Imobiliaria]","\r\n                    <html>\r\n                    <head>\r\n                        <style>\r\n                            /* Estilos de formatação do e-mail */\r\n                            body {\r\n                                font-family: Arial, sans-serif;\r\n                            }\r\n                            .container {\r\n                                max-width: 600px;\r\n                                margin: 0 auto;\r\n                                padding: 20px;\r\n                                border: 1px solid #ccc;\r\n                                border-radius: 5px;\r\n                                background-color: #f9f9f9;\r\n                            }\r\n                            h2 {\r\n                                color: #333;\r\n                            }\r\n                            p {\r\n                                margin-bottom: 15px;\r\n                            }\r\n                            span {\r\n                                font-weight: bold;\r\n                                font-style: italic;\r\n                            }            \r\n                            a:link, a:visited {\r\n                                text-decoration: none\r\n                                }\r\n                            a:hover {\r\n                                text-decoration: underline;\r\n                                }\r\n                            a:active {\r\n                                text-decoration: none\r\n                                }\r\n                        </style>\r\n                    </head>\r\n                    <body>\r\n                        <div class=\'container\'>\r\n                            <h2>Resposta ao Contato</h2>\r\n                            <p>Olá, tudo bem?</p>\r\n                            <p>Estamos retornando sobre o envio do contato através de <a href=\'https://www.imob-marangon.com.br\'>www.imob-marangon.com.br</a>.</p>\r\n\r\n                            <h3>Aqui está a sua mensagem original:</h3>\r\n                            <blockquote>Ola, gostaria de saber mais informações relevantes para anunciar um imovel.</blockquote>\r\n                            <h3>Nossa Resposta:</h3>\r\n                            <blockquote>Olá, agradecemos o contato, estarei entrando em contato através do WhatsApp!!\n\n:)</blockquote>\r\n                            <br>\r\n                            <br>\r\n                            <p>Atenciosamente Equipe IMOB - Imobiliaria</p>\r\n                        </div>\r\n                    </body>\r\n                    </html>\r\n                ","luan.limarangon@hotmail.com","IMOB","luan.limarangon@gmail.com","Luan de Lima Marangon","2023-09-06 21:22:57","2023-09-06 21:14:53","2023-09-06 21:22:57");


DROP TABLE IF EXISTS people;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `rg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`first_name`,`last_name`,`cpf`,`rg`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO people VALUES("1","Luan","Marangon","37969546854","47141754","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people VALUES("2","Jessica Fernanda","Marangon","44422255568","45213568","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people VALUES("3","Joao","Silva","45689735625","25463125","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people VALUES("4","Marcos","Menezes","12543689578","12546896","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS people_contacts;
CREATE TABLE `people_contacts` (
  `people_id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`people_id`,`contacts_id`),
  KEY `fk_owners_has_contacts_contacts1_idx` (`contacts_id`),
  KEY `fk_owners_contacts_people1_idx` (`people_id`),
  CONSTRAINT `fk_owners_contacts_people1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_owners_has_contacts_contacts1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO people_contacts VALUES("1","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people_contacts VALUES("1","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people_contacts VALUES("2","3","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people_contacts VALUES("2","4","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO people_contacts VALUES("3","5","2023-07-01 10:13:03","2023-07-01 10:13:03");
INSERT INTO people_contacts VALUES("3","6","2023-07-01 10:16:01","2023-07-01 10:16:01");


DROP TABLE IF EXISTS properties;
CREATE TABLE `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addresses_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `reference_UNIQUE` (`reference`),
  KEY `fk_properties_categories1_idx` (`categories_id`),
  KEY `fk_properties_types1_idx` (`types_id`),
  KEY `fk_properties_addresses1_idx` (`addresses_id`),
  FULLTEXT KEY `full_text` (`reference`),
  CONSTRAINT `fk_properties_addresses1` FOREIGN KEY (`addresses_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_types1` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO properties VALUES("1","2","2","6","IMOB001","","1","2023-05-21 21:16:16","2023-05-21 21:23:37");
INSERT INTO properties VALUES("2","3","1","3","IMOB002","Teste Marangon","1","2023-05-21 21:16:16","2023-07-05 20:12:44");
INSERT INTO properties VALUES("3","4","1","5","IMOB003","","1","2023-05-21 21:16:16","2023-05-21 21:29:29");
INSERT INTO properties VALUES("4","5","1","5","IMOB004","","1","2023-05-21 21:16:16","2023-07-04 07:06:12");
INSERT INTO properties VALUES("5","6","1","5","IMOB005","","1","2023-05-21 21:16:16","2023-05-21 21:29:35");
INSERT INTO properties VALUES("6","7","1","5","IMOB006","","1","2023-05-21 21:16:16","2023-05-21 21:29:38");
INSERT INTO properties VALUES("7","8","1","5","IMOB007","","1","2023-05-21 21:16:16","2023-05-21 21:29:40");
INSERT INTO properties VALUES("8","18","1","5","IMOB008","TESTE CREATE","1","2023-06-27 06:56:28","2023-06-27 06:56:28");
INSERT INTO properties VALUES("9","19","1","5","IMOB009","TESTE CREATE","1","2023-06-27 06:56:46","2023-06-27 06:56:46");
INSERT INTO properties VALUES("10","20","1","5","IMOB010","TESTE CREATE","1","2023-06-27 06:57:07","2023-06-27 06:57:07");
INSERT INTO properties VALUES("11","21","1","5","IMOB011","TESTE CREATE","1","2023-06-27 06:58:50","2023-06-27 06:58:50");
INSERT INTO properties VALUES("12","22","1","5","IMOB012","TESTE CREATE","1","2023-06-27 07:00:11","2023-06-27 07:00:11");
INSERT INTO properties VALUES("13","23","1","5","IMOB013","TESTE CREATE","1","2023-06-27 07:00:32","2023-06-27 07:00:32");
INSERT INTO properties VALUES("14","24","1","5","IMOB014","TESTE CREATE","1","2023-06-27 07:03:09","2023-06-27 07:03:09");
INSERT INTO properties VALUES("15","25","1","5","IMOB015","TESTE CREATE","1","2023-06-27 07:03:29","2023-06-27 07:03:29");
INSERT INTO properties VALUES("16","26","1","5","IMOB016","TESTE CREATE","1","2023-06-27 07:03:53","2023-06-27 07:03:53");
INSERT INTO properties VALUES("17","27","1","5","IMOB017","TESTE CREATE","1","2023-06-27 07:04:29","2023-06-27 07:04:29");
INSERT INTO properties VALUES("18","28","1","5","IMOB018","TESTE CREATE20","1","2023-06-27 07:04:46","2023-06-27 07:04:46");
INSERT INTO properties VALUES("19","29","1","5","IMOB019","TESTE CREATE21","1","2023-06-27 07:05:10","2023-06-27 07:05:10");
INSERT INTO properties VALUES("20","30","1","5","IMOB020","TESTE CREATE21","1","2023-06-27 07:05:31","2023-06-27 07:05:31");
INSERT INTO properties VALUES("21","31","1","5","IMOB021","TESTE CREATE21","1","2023-06-27 07:06:18","2023-06-27 07:06:18");
INSERT INTO properties VALUES("22","32","1","5","IMOB022","TESTE CREATE21","1","2023-06-27 07:07:12","2023-06-27 07:07:12");
INSERT INTO properties VALUES("23","33","1","5","IMOB023","TESTE CREATE21","1","2023-06-27 07:07:56","2023-06-27 07:07:56");
INSERT INTO properties VALUES("24","34","1","5","IMOB024","TESTE CREATE21","1","2023-06-27 07:08:39","2023-06-27 07:08:39");
INSERT INTO properties VALUES("25","35","1","5","IMOB025","TESTE CREATE21","1","2023-06-27 07:09:01","2023-06-27 07:09:01");
INSERT INTO properties VALUES("26","36","1","5","IMOB026","TESTE CREATE21","1","2023-06-27 07:09:22","2023-06-27 07:09:22");
INSERT INTO properties VALUES("27","37","1","5","IMOB027","TESTE CREATE21","1","2023-06-27 07:09:47","2023-06-27 07:09:47");
INSERT INTO properties VALUES("28","38","1","5","IMOB028","TESTE CREATE21","1","2023-06-27 07:09:59","2023-06-27 07:09:59");
INSERT INTO properties VALUES("29","39","1","5","IMOB029","TESTE CREATE21","1","2023-06-27 07:10:51","2023-06-27 07:10:51");
INSERT INTO properties VALUES("30","40","1","5","IMOB030","TESTE CREATE21","1","2023-06-27 07:11:06","2023-06-27 07:11:06");
INSERT INTO properties VALUES("31","41","1","5","IMOB031","TESTE CREATE21","1","2023-06-27 07:11:19","2023-06-27 07:11:19");
INSERT INTO properties VALUES("32","42","1","5","IMOB032","TESTE CREATE21","1","2023-06-27 19:08:54","2023-06-27 19:08:54");
INSERT INTO properties VALUES("33","43","1","5","IMOB033","TESTE CREATE21","1","2023-06-27 19:10:04","2023-06-27 19:10:04");
INSERT INTO properties VALUES("34","44","1","5","IMOB034","TESTE CREATE21","1","2023-06-27 19:15:16","2023-06-27 19:15:16");
INSERT INTO properties VALUES("35","45","1","5","IMOB035","TESTE CREATE21","1","2023-06-27 20:49:27","2023-06-27 20:49:27");
INSERT INTO properties VALUES("36","46","1","5","IMOB036","TESTE CREATE21","1","2023-06-27 20:51:48","2023-06-27 20:51:48");
INSERT INTO properties VALUES("37","47","1","5","IMOB037","TESTE CREATE21","1","2023-06-27 20:52:24","2023-06-27 20:52:24");
INSERT INTO properties VALUES("38","48","1","5","IMOB038","asa","1","2023-06-30 06:32:37","2023-06-30 06:32:37");
INSERT INTO properties VALUES("39","49","1","5","IMOB039","asa","1","2023-06-30 06:33:51","2023-06-30 06:33:51");
INSERT INTO properties VALUES("40","50","1","5","IMOB040","asa","1","2023-06-30 06:34:54","2023-06-30 06:34:54");
INSERT INTO properties VALUES("41","51","1","5","IMOB041","asa","1","2023-06-30 06:38:28","2023-06-30 06:38:28");
INSERT INTO properties VALUES("42","52","1","5","IMOB042","asa","1","2023-06-30 06:48:12","2023-06-30 06:48:12");
INSERT INTO properties VALUES("43","53","1","5","IMOB043","asa","1","2023-06-30 06:54:55","2023-06-30 06:54:55");
INSERT INTO properties VALUES("44","54","1","5","IMOB044","asa","1","2023-06-30 06:55:30","2023-06-30 06:55:30");
INSERT INTO properties VALUES("45","55","1","5","IMOB045","asa","1","2023-06-30 06:55:44","2023-06-30 06:55:44");
INSERT INTO properties VALUES("46","56","1","1","IMOB046","asa","1","2023-06-30 06:56:24","2023-06-30 06:56:24");
INSERT INTO properties VALUES("47","57","1","1","IMOB047","asa","1","2023-06-30 06:56:44","2023-06-30 06:56:44");
INSERT INTO properties VALUES("48","58","1","1","IMOB048","asa","1","2023-06-30 06:56:51","2023-06-30 06:56:51");
INSERT INTO properties VALUES("49","59","1","1","IMOB049","asa","1","2023-06-30 06:57:34","2023-06-30 06:57:34");
INSERT INTO properties VALUES("50","60","1","1","IMOB050","asa","1","2023-06-30 06:57:55","2023-06-30 06:57:55");
INSERT INTO properties VALUES("51","61","1","1","IMOB051","asa","1","2023-06-30 06:58:18","2023-06-30 06:58:18");
INSERT INTO properties VALUES("52","62","1","1","IMOB052","asa","1","2023-06-30 06:58:38","2023-06-30 06:58:38");
INSERT INTO properties VALUES("53","63","1","1","IMOB053","asa","1","2023-06-30 06:58:57","2023-06-30 06:58:57");
INSERT INTO properties VALUES("54","64","2","2","IMOB054","asas","1","2023-06-30 07:18:39","2023-06-30 07:18:39");
INSERT INTO properties VALUES("55","65","2","2","IMOB055","asas","1","2023-06-30 07:19:26","2023-06-30 07:19:26");
INSERT INTO properties VALUES("56","66","2","2","IMOB056","asas","1","2023-06-30 07:19:45","2023-06-30 07:19:45");
INSERT INTO properties VALUES("57","67","2","2","IMOB057","asas","1","2023-06-30 07:20:24","2023-06-30 07:20:24");
INSERT INTO properties VALUES("58","68","2","2","IMOB058","asas","1","2023-06-30 07:22:25","2023-06-30 07:22:25");
INSERT INTO properties VALUES("59","69","2","2","IMOB059","asas","1","2023-06-30 07:22:41","2023-06-30 07:22:41");
INSERT INTO properties VALUES("60","70","2","2","IMOB060","asas","1","2023-06-30 07:23:20","2023-06-30 07:23:20");
INSERT INTO properties VALUES("61","71","2","2","IMOB061","asas","1","2023-06-30 07:23:39","2023-06-30 07:23:39");
INSERT INTO properties VALUES("62","72","2","2","IMOB062","asas","1","2023-06-30 07:24:14","2023-06-30 07:24:14");
INSERT INTO properties VALUES("63","73","2","2","IMOB063","asas","1","2023-06-30 07:24:27","2023-06-30 07:24:27");
INSERT INTO properties VALUES("64","74","2","2","IMOB064","asas","1","2023-06-30 07:24:49","2023-06-30 07:24:49");
INSERT INTO properties VALUES("65","75","2","2","IMOB065","asas","1","2023-06-30 07:25:04","2023-06-30 07:25:04");
INSERT INTO properties VALUES("66","76","2","2","IMOB066","asas","1","2023-07-01 09:14:52","2023-07-01 09:14:52");
INSERT INTO properties VALUES("67","77","2","2","IMOB067","asas","1","2023-07-01 09:43:07","2023-07-01 09:43:07");
INSERT INTO properties VALUES("68","78","2","2","IMOB068","asas","1","2023-07-01 09:44:12","2023-07-01 09:44:12");
INSERT INTO properties VALUES("69","79","2","2","IMOB069","asas","1","2023-07-01 09:48:56","2023-07-01 09:48:56");
INSERT INTO properties VALUES("70","80","2","2","IMOB070","asas","1","2023-07-01 09:54:18","2023-07-01 09:54:18");
INSERT INTO properties VALUES("71","81","2","2","IMOB071","asas","1","2023-07-01 09:59:15","2023-07-01 09:59:15");


DROP TABLE IF EXISTS properties_bkp;
CREATE TABLE `properties_bkp` (
  `id` int(11) NOT NULL DEFAULT 0,
  `addresses_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO properties_bkp VALUES("1","2","2","6","IMOB001","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("2","3","1","3","IMOB002","Teste Marangon","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("3","4","1","5","IMOB003","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("4","5","1","5","IMOB004","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("5","6","1","5","IMOB005","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("6","7","1","5","IMOB006","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("7","8","1","5","IMOB007","","1","2023-05-21 21:16:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("8","18","1","5","IMOB008","TESTE CREATE","1","2023-06-27 06:56:28","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("9","19","1","5","IMOB009","TESTE CREATE","1","2023-06-27 06:56:46","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("10","20","1","5","IMOB010","TESTE CREATE","1","2023-06-27 06:57:07","2023-07-15 20:19:31");
INSERT INTO properties_bkp VALUES("11","21","1","5","IMOB011","TESTE CREATE","1","2023-06-27 06:58:50","2023-07-15 20:22:25");
INSERT INTO properties_bkp VALUES("12","22","1","5","IMOB012","TESTE CREATE","1","2023-06-27 07:00:11","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("13","23","1","5","IMOB013","TESTE CREATE","1","2023-06-27 07:00:32","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("14","24","1","5","IMOB014","TESTE CREATE","1","2023-06-27 07:03:09","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("15","25","1","5","IMOB015","TESTE CREATE","1","2023-06-27 07:03:29","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("16","26","1","5","IMOB016","TESTE CREATE","1","2023-06-27 07:03:53","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("17","27","1","5","IMOB017","TESTE CREATE","1","2023-06-27 07:04:29","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("18","28","1","5","IMOB018","TESTE CREATE20","1","2023-06-27 07:04:46","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("19","29","1","5","IMOB019","TESTE CREATE21","1","2023-06-27 07:05:10","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("20","30","1","5","IMOB020","TESTE CREATE21","1","2023-06-27 07:05:31","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("21","31","1","5","IMOB021","TESTE CREATE21","1","2023-06-27 07:06:18","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("22","32","1","5","IMOB022","TESTE CREATE21","1","2023-06-27 07:07:12","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("23","33","1","5","IMOB023","TESTE CREATE21","1","2023-06-27 07:07:56","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("24","34","1","5","IMOB024","TESTE CREATE21","1","2023-06-27 07:08:39","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("25","35","1","5","IMOB025","TESTE CREATE21","1","2023-06-27 07:09:01","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("26","36","1","5","IMOB026","TESTE CREATE21","1","2023-06-27 07:09:22","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("27","37","1","5","IMOB027","TESTE CREATE21","1","2023-06-27 07:09:47","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("28","38","1","5","IMOB028","TESTE CREATE21","1","2023-06-27 07:09:59","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("29","39","1","5","IMOB029","TESTE CREATE21","1","2023-06-27 07:10:51","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("30","40","1","5","IMOB030","TESTE CREATE21","1","2023-06-27 07:11:06","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("31","41","1","5","IMOB031","TESTE CREATE21","1","2023-06-27 07:11:19","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("32","42","1","5","IMOB032","TESTE CREATE21","1","2023-06-27 19:08:54","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("33","43","1","5","IMOB033","TESTE CREATE21","1","2023-06-27 19:10:04","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("34","44","1","5","IMOB034","TESTE CREATE21","1","2023-06-27 19:15:16","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("35","45","1","5","IMOB035","TESTE CREATE21","1","2023-06-27 20:49:27","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("36","46","1","5","IMOB036","TESTE CREATE21","1","2023-06-27 20:51:48","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("37","47","1","5","IMOB037","TESTE CREATE21","1","2023-06-27 20:52:24","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("38","48","1","5","IMOB038","asa","1","2023-06-30 06:32:37","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("39","49","1","5","IMOB039","asa","1","2023-06-30 06:33:51","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("40","50","1","5","IMOB040","asa","1","2023-06-30 06:34:54","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("41","51","1","5","IMOB041","asa","1","2023-06-30 06:38:28","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("42","52","1","5","IMOB042","asa","1","2023-06-30 06:48:12","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("43","53","1","5","IMOB043","asa","1","2023-06-30 06:54:55","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("44","54","1","5","IMOB044","asa","1","2023-06-30 06:55:30","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("45","55","1","5","IMOB045","asa","1","2023-06-30 06:55:44","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("46","56","1","1","IMOB046","asa","1","2023-06-30 06:56:24","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("47","57","1","1","IMOB047","asa","1","2023-06-30 06:56:44","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("48","58","1","1","IMOB048","asa","1","2023-06-30 06:56:51","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("49","59","1","1","IMOB049","asa","1","2023-06-30 06:57:34","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("50","60","1","1","IMOB050","asa","1","2023-06-30 06:57:55","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("51","61","1","1","IMOB051","asa","1","2023-06-30 06:58:18","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("52","62","1","1","IMOB052","asa","1","2023-06-30 06:58:38","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("53","63","1","1","IMOB053","asa","1","2023-06-30 06:58:57","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("54","64","2","2","IMOB054","asas","1","2023-06-30 07:18:39","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("55","65","2","2","IMOB055","asas","1","2023-06-30 07:19:26","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("56","66","2","2","IMOB056","asas","1","2023-06-30 07:19:45","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("57","67","2","2","IMOB057","asas","1","2023-06-30 07:20:24","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("58","68","2","2","IMOB058","asas","1","2023-06-30 07:22:25","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("59","69","2","2","IMOB059","asas","1","2023-06-30 07:22:41","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("60","70","2","2","IMOB060","asas","1","2023-06-30 07:23:20","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("61","71","2","2","IMOB061","asas","1","2023-06-30 07:23:39","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("62","72","2","2","IMOB062","asas","1","2023-06-30 07:24:14","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("63","73","2","2","IMOB063","asas","1","2023-06-30 07:24:27","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("64","74","2","2","IMOB064","asas","1","2023-06-30 07:24:49","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("65","75","2","2","IMOB065","asas","1","2023-06-30 07:25:04","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("66","76","2","2","IMOB066","asas","1","2023-07-01 09:14:52","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("67","77","2","2","IMOB067","asas","1","2023-07-01 09:43:07","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("68","78","2","2","IMOB068","asas","1","2023-07-01 09:44:12","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("69","79","2","2","IMOB069","asas","1","2023-07-01 09:48:56","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("70","80","2","2","IMOB070","asas","1","2023-07-01 09:54:18","2023-07-15 20:23:17");
INSERT INTO properties_bkp VALUES("71","81","2","2","IMOB071","asas","1","2023-07-01 09:59:15","2023-07-15 20:23:17");


DROP TABLE IF EXISTS properties_comfortable;
CREATE TABLE `properties_comfortable` (
  `properties_id` int(11) NOT NULL,
  `comfortable_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`properties_id`,`comfortable_id`),
  KEY `fk_properties_has_comfortable_comfortable1_idx` (`comfortable_id`),
  KEY `fk_properties_has_comfortable_properties1_idx` (`properties_id`),
  CONSTRAINT `fk_properties_has_comfortable_comfortable1` FOREIGN KEY (`comfortable_id`) REFERENCES `comfortable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_properties_has_comfortable_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO properties_comfortable VALUES("1","1","2","2023-07-03 19:46:08","2023-07-03 19:46:08");
INSERT INTO properties_comfortable VALUES("1","3","2","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("1","4","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("1","5","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("2","3","2","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("3","1","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("3","3","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("3","4","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("3","5","1","2023-07-03 19:46:20","2023-07-03 19:46:20");
INSERT INTO properties_comfortable VALUES("4","1","2","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("4","3","2","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("4","4","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("4","5","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("5","1","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("5","3","2","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("6","1","1","2023-07-03 19:54:56","2023-07-03 19:54:56");
INSERT INTO properties_comfortable VALUES("6","2","1","2023-07-03 19:54:56","2023-07-03 19:54:56");
INSERT INTO properties_comfortable VALUES("6","4","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("6","5","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("7","1","1","2023-07-03 19:55:13","2023-07-03 19:55:13");
INSERT INTO properties_comfortable VALUES("7","2","1","2023-07-03 19:54:21","2023-07-03 19:54:21");
INSERT INTO properties_comfortable VALUES("7","3","1","2023-07-03 19:54:21","2023-07-03 19:54:21");


DROP TABLE IF EXISTS properties_features;
CREATE TABLE `properties_features` (
  `properties_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`properties_id`,`features_id`),
  KEY `fk_properties_has_features_features1_idx` (`features_id`),
  KEY `fk_properties_has_features_properties1_idx` (`properties_id`),
  CONSTRAINT `fk_properties_has_features_features1` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_has_features_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO properties_features VALUES("1","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("1","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("2","3","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("2","4","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("3","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("3","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("3","3","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("3","4","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("4","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("4","3","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("5","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("5","2","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("6","3","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("6","4","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("7","1","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_features VALUES("7","4","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS properties_structures;
CREATE TABLE `properties_structures` (
  `properties_id` int(11) NOT NULL,
  `structures_id` int(11) NOT NULL,
  `footage` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`properties_id`,`structures_id`),
  KEY `fk_properties_has_structures_structures1_idx` (`structures_id`),
  KEY `fk_properties_has_structures_properties1_idx` (`properties_id`),
  CONSTRAINT `fk_properties_has_structures_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_has_structures_structures1` FOREIGN KEY (`structures_id`) REFERENCES `structures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO properties_structures VALUES("1","1","45 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("1","2","300 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("1","3","25 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("1","4","12 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("2","1","120 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("2","2","120 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("2","3","12 m²","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO properties_structures VALUES("2","4","10 m²","2023-05-21 21:16:17","2023-05-21 21:16:17");
INSERT INTO properties_structures VALUES("3","1","20 m²","2023-05-21 21:16:17","2023-05-21 21:16:17");
INSERT INTO properties_structures VALUES("3","2","100 m²","2023-05-21 21:16:17","2023-05-21 21:16:17");
INSERT INTO properties_structures VALUES("3","3","10 m²","2023-05-21 21:16:17","2023-05-21 21:16:17");
INSERT INTO properties_structures VALUES("3","4","10 m²","2023-05-21 21:16:17","2023-05-21 21:16:17");


DROP TABLE IF EXISTS report_access;
CREATE TABLE `report_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users` int(11) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 1,
  `pages` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO report_access VALUES("26","1","1","240","2023-09-07 08:36:35","2023-09-07 09:33:41");


DROP TABLE IF EXISTS report_online;
CREATE TABLE `report_online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned DEFAULT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `agent` varchar(255) NOT NULL DEFAULT '',
  `pages` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO report_online VALUES("63","","::1","/ops/404","\"Not/A)Brand\";v=\"99\", \"Opera\";v=\"101\", \"Chromium\";v=\"115\"","30","2023-09-07 09:04:41","2023-09-07 09:33:40");
INSERT INTO report_online VALUES("64","","::1","/contato","\"Chromium\";v=\"116\", \"Not)A;Brand\";v=\"24\", \"Microsoft Edge\";v=\"116\"","34","2023-09-07 09:04:45","2023-09-07 09:33:40");
INSERT INTO report_online VALUES("65","2","::1","/ops/404","\"Chromium\";v=\"116\", \"Not)A;Brand\";v=\"24\", \"Google Chrome\";v=\"116\"","62","2023-09-07 09:05:10","2023-09-07 09:33:41");


DROP TABLE IF EXISTS response_service;
CREATE TABLE `response_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `customer_service_id` int(11) NOT NULL,
  `response` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`users_id`,`customer_service_id`),
  KEY `fk_response_service_users1_idx` (`users_id`),
  KEY `fk_response_service_customer_service1_idx` (`customer_service_id`),
  CONSTRAINT `fk_response_service_customer_service1` FOREIGN KEY (`customer_service_id`) REFERENCES `customer_service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_response_service_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='		';

INSERT INTO response_service VALUES("43","2","13","Olá, agradecemos o contato, estarei entrando em contato através do WhatsApp!!\n\n:)","2023-08-24 20:31:02","2023-08-24 20:31:02");
INSERT INTO response_service VALUES("44","2","13","Olá, agradecemos o contato, estarei entrando em contato através do WhatsApp!!\n\n:)","2023-09-06 21:14:53","2023-09-06 21:14:53");


DROP TABLE IF EXISTS structures;
CREATE TABLE `structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`structure`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO structures VALUES("1","Area Construída","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO structures VALUES("2","Area Total","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO structures VALUES("3","Comprimento","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO structures VALUES("4","Largura","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS transactions;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `properties_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `value` float DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`,`properties_id`),
  KEY `fk_transactions_properties1_idx` (`properties_id`),
  FULLTEXT KEY `full_text` (`type`),
  CONSTRAINT `fk_transactions_properties1` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO transactions VALUES("1","1","Aluguel","2022-12-01 00:00:00","2023-12-01 00:00:00","500","ativo","2023-05-21 21:16:17","2023-07-05 20:11:26");
INSERT INTO transactions VALUES("3","3","Venda","2022-12-01 00:00:00","2023-06-08 00:00:00","120000","inativo","2023-05-21 21:16:17","2023-07-03 20:24:18");
INSERT INTO transactions VALUES("4","2","Venda","2022-12-01 00:00:00","2023-09-01 00:00:00","250000","ativo","2023-05-21 21:16:17","2023-07-05 20:11:26");
INSERT INTO transactions VALUES("5","4","Venda","2022-12-01 00:00:00","2023-10-01 00:00:00","120000","ativo","2023-05-21 21:16:17","2023-07-05 20:11:26");
INSERT INTO transactions VALUES("6","5","Venda","2022-12-01 00:00:00","2023-10-01 00:00:00","200000","ativo","2023-05-21 21:16:17","2023-07-05 20:11:26");
INSERT INTO transactions VALUES("7","6","Venda","2022-12-01 00:00:00","2023-12-01 00:00:00","350000","ativo","2023-05-21 21:16:17","2023-07-05 20:11:26");
INSERT INTO transactions VALUES("8","7","Aluguel","2022-12-01 00:00:00","2023-12-01 00:00:00","1200","ativo","2023-05-21 21:16:17","2023-07-09 13:12:32");


DROP TABLE IF EXISTS tributes;
CREATE TABLE `tributes` (
  `properties_id` int(11) NOT NULL,
  `charges_id` int(11) NOT NULL,
  `exercise` varchar(255) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`properties_id`,`charges_id`),
  KEY `fk_properties_has_charges_charges1_idx` (`charges_id`),
  KEY `fk_properties_has_charges_properties_idx` (`properties_id`),
  CONSTRAINT `fk_properties_has_charges_charges1` FOREIGN KEY (`charges_id`) REFERENCES `charges` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_properties_has_charges_properties` FOREIGN KEY (`properties_id`) REFERENCES `properties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tributes VALUES("1","1","2022","180","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO tributes VALUES("2","1","2022","250","2023-05-21 21:16:16","2023-05-21 21:16:16");
INSERT INTO tributes VALUES("3","1","2022","100","2023-05-21 21:16:16","2023-05-21 21:16:16");


DROP TABLE IF EXISTS types;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO types VALUES("1","Casa","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO types VALUES("2","Sobrado","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO types VALUES("3","Edícula","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO types VALUES("4","Kitnet","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO types VALUES("5","Apartamento","2023-05-21 21:16:15","2023-05-21 21:16:15");
INSERT INTO types VALUES("6","Salão Comercial","2023-05-21 21:16:15","2023-05-21 21:16:15");


DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `datebirth` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT 'registered, confirmed	',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`first_name`,`last_name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO users VALUES("1","Administrador","Sistema","","male","2023-01-01","","administracao@marangon.com.br","$2y$10$pp.D.gxiLOtM3jJwnL0Y5.ohNy5SLP.uGwzyVuCBAevh1qMbzEqdq","100","Administrador","registered","2023-04-21 20:28:29","2023-05-21 21:51:50");
INSERT INTO users VALUES("2","Jessica Fernanda","Marangon","45454545454","female","1998-10-01","images/2023/05/jessica-fernanda-marangon-1684716952.jpg","jessicafer470@gmail.com","$2y$10$JyWHMV/rIP.CWwmMLyrY6OV7gHDEYCOg3RucV0HMbhkOX5YPjqh1a","10","Diretora","registered","2023-04-21 21:39:12","2023-05-21 21:55:52");
INSERT INTO users VALUES("3","Luan","Marangon","","male","2023-06-12","images/2023/06/luan-marangon.png","luan.limarangon@gmail.com","$2y$10$sndTtVCRQupOlQ9.LjSQ9.8z6m1TMMcxarKOTn7c2e/4WSQvt/Swm","5","Manager","registered","2023-04-22 15:29:58","2023-06-12 07:19:00");
INSERT INTO users VALUES("4","Luany de","Marangon","","female","2023-04-27","","luanymarangon@gmail.com","$2y$10$8bzbCrLcK.MbbpqWoJXmb.r02oHy5DDC491j.iHK3ilaYiJeoby/O","Inativo","Manager","registered","2023-04-22 15:31:59","2023-05-01 14:10:24");
INSERT INTO users VALUES("5","vanda","maria","","female","2023-04-23","","vanda@gmail.com","$2y$10$qQKABnyEy/UFAm71QKj/2.9U63kE.gowr6YNirQTQVkoHvXNI0N22","Inativo","Diretor","registered","2023-04-22 15:33:01","2023-04-23 13:19:09");
INSERT INTO users VALUES("6","Lyvia","Marangon","","female","2011-01-13","","lyvia@gmail.com","$2y$10$xekMfDc1ZFlqUu/ehD44FuODFKaF6.hel5SPGb448y4zfWPX7WJOa","Inativo","vender","registered","2023-04-23 12:35:17","2023-04-30 11:40:19");
INSERT INTO users VALUES("7","joao","silva","","male","2023-06-12","images/2023/08/joao-silva.jpg","joao@gmai.com","$2y$10$A8Utn.MkgD9voYIyayW9lukLjvTDqIidI2IS6yrCB7uTIvrGu0R36","5","dono","registered","2023-04-23 12:35:58","2023-08-16 07:22:21");
INSERT INTO users VALUES("8","helio","marangon","12456325876","male","1952-08-24","","helio@marangon.com.br","$2y$10$32HEPOFDE7.VR26QLXzsmuCVTsjwz72qFaUVixkT.rTWJErcyYReu","5","Diretor","registered","2023-06-25 13:02:45","2023-06-25 13:02:45");
INSERT INTO users VALUES("9","Marco","Damato","12546325468","male","1970-01-01","","marco@damato.com.br","$2y$10$lD.oUvb.UilaGi1T6BzxVe2GYqJQ4b0HTCnJB2jLg/I8/BxkgfRs2","10","Diretor","registered","2023-09-06 21:01:13","2023-09-06 21:01:13");


