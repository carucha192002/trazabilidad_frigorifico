

CREATE TABLE `camara` (
  `id_camara` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id_camara`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO camara VALUES("1","CAMARA Nº1","camara-default.jpg","1");
INSERT INTO camara VALUES("2","CAMARA Nº2","camara-default.jpg","2");



CREATE TABLE `chofer` (
  `id_chofer` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `dni` int(11) NOT NULL,
  PRIMARY KEY (`id_chofer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO chofer VALUES("2","JUAN MANUEL OJEDA","chofer-default.jpg","31167331");
INSERT INTO chofer VALUES("3","rodrigo gonzalo cara","chofer-default.jpg","42204241");
INSERT INTO chofer VALUES("4","flores claudio","chofer-default.jpg","345577");



CREATE TABLE `clasificacion` (
  `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO clasificacion VALUES("1","cabra/chiva","clas-default.jpg");



CREATE TABLE `conservacion` (
  `id_conservacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `grados` varchar(45) NOT NULL,
  `vida` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_conservacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO conservacion VALUES("1","refrigerado","0 a 5ºC","7","600ae13d7e705-leg-default.png");
INSERT INTO conservacion VALUES("3","congelados entero","-18ºc","365","prod-default.jpg");
INSERT INTO conservacion VALUES("4","cuarteado","-18ºc","534","prod-default.jpg");



CREATE TABLE `corral` (
  `id_corral` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id_corral`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO corral VALUES("1","CORRAL Nº1","5ff84d78a80a6-5f538ddd44d49-Koala.jpg","1");
INSERT INTO corral VALUES("2","CORRAL Nº2","corral-default.jpg","2");
INSERT INTO corral VALUES("4","CORRAL Nº3","corral-default.jpg","3");
INSERT INTO corral VALUES("5","CORRAL Nº4","corral-default.jpg","4");
INSERT INTO corral VALUES("6","CORRAL Nº5","corral-default.jpg","5");



CREATE TABLE `corraleros` (
  `id_corraleros` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `legajo` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_corraleros`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO corraleros VALUES("2","franco  cara","2163","corraleros-default.jpg");
INSERT INTO corraleros VALUES("3","claudio flores","2162","corraleros-default.jpg");
INSERT INTO corraleros VALUES("4","javier basualto","1111","corraleros-default.jpg");
INSERT INTO corraleros VALUES("5","gutierrez joel","1234","corraleros-default.jpg");



CREATE TABLE `despieces` (
  `id_despieces` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `espeice` varchar(255) NOT NULL,
  `despiece` varchar(255) NOT NULL,
  PRIMARY KEY (`id_despieces`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

INSERT INTO despieces VALUES("1","2","Bovinos","1/2 Res");
INSERT INTO despieces VALUES("2","3","Bovinos","1/4 Delanteros");
INSERT INTO despieces VALUES("3","4","Bovinos","1/4 Traseros");
INSERT INTO despieces VALUES("4","9","caprinos","Entero/Carcasa");
INSERT INTO despieces VALUES("5","6","bubalinos","1/2 Res");
INSERT INTO despieces VALUES("6","7","bubalinos","1/4 Delanteros");
INSERT INTO despieces VALUES("7","8","bubalinos","1/4 Traseros");
INSERT INTO despieces VALUES("8","20","Camelidos","Entero/Carcasa");
INSERT INTO despieces VALUES("9","17","Camelidos","1/2 Res");
INSERT INTO despieces VALUES("10","18","Camelidos","1/4 Delanteros");
INSERT INTO despieces VALUES("11","19","Camelidos","1/4 Traseros");
INSERT INTO despieces VALUES("13","12","caprinos","1/2 Res");
INSERT INTO despieces VALUES("14","11","caprinos","1/4 Delanteros");
INSERT INTO despieces VALUES("15","10","caprinos","1/4 Traseros");
INSERT INTO despieces VALUES("16","21","Ciervos","Entero/Carcasa");
INSERT INTO despieces VALUES("17","22","Ciervos","1/2 Res");
INSERT INTO despieces VALUES("18","24","Ciervos","1/4 Delanteros");
INSERT INTO despieces VALUES("19","23","Ciervos","1/4 Traseros");
INSERT INTO despieces VALUES("20","7","Conejos y Piliferos","Entero/Carcasa");
INSERT INTO despieces VALUES("21","16","Equidos","Entero/Carcasa");
INSERT INTO despieces VALUES("22","15","Equidos","1/2 Res");
INSERT INTO despieces VALUES("23","13","Equidos","1/4 Delanteros");
INSERT INTO despieces VALUES("24","14","Equidos","1/4 Traseros");
INSERT INTO despieces VALUES("25","32","ovinos","Entero/Carcasa");
INSERT INTO despieces VALUES("26","30","ovinos","1/2 Res");
INSERT INTO despieces VALUES("27","31","ovinos","1/4 Delanteros");
INSERT INTO despieces VALUES("28","29","ovinos","1/4 Traseros");
INSERT INTO despieces VALUES("29","26","Porcinos","Entero/Carcasa");
INSERT INTO despieces VALUES("30","28","Porcinos","1/2 Reses");
INSERT INTO despieces VALUES("31","27","Porcinos","1/4 Delanteros");
INSERT INTO despieces VALUES("32","25","Porcinos","1/4 Traseros");



CREATE TABLE `destino` (
  `id_destino` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_destino`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

INSERT INTO destino VALUES("2","106","consumo interno","destino-default.jpg");
INSERT INTO destino VALUES("3","121","exportacion a china","destino-default.jpg");
INSERT INTO destino VALUES("4","103","exportacion chile","destino-default.jpg");
INSERT INTO destino VALUES("11","122","exportacion hilton","destino-default.jpg");
INSERT INTO destino VALUES("12","102","exportacion israel","destino-default.jpg");
INSERT INTO destino VALUES("13","105","exportacion otros paises","destino-default.jpg");
INSERT INTO destino VALUES("14","100","exportacion u.e","destino-default.jpg");
INSERT INTO destino VALUES("15","120","exportacion ue cuota 481","destino-default.jpg");
INSERT INTO destino VALUES("16","125","exportacion ue no hilton","destino-default.jpg");
INSERT INTO destino VALUES("17","101","exportacion u.s.a","destino-default.jpg");
INSERT INTO destino VALUES("18","107","general","destino-default.jpg");
INSERT INTO destino VALUES("19","104","patagonia","destino-default.jpg");
INSERT INTO destino VALUES("20","116","proveduria maritima","destino-default.jpg");



CREATE TABLE `especies` (
  `id_especies` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `id_especies_sub` int(11) NOT NULL,
  PRIMARY KEY (`id_especies`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO especies VALUES("2","ovinos","esp-default.jpg","2");
INSERT INTO especies VALUES("3","porcinos","esp-default.jpg","3");
INSERT INTO especies VALUES("4","caprinos","esp-default.jpg","4");
INSERT INTO especies VALUES("5","equidos","esp-default.jpg","5");
INSERT INTO especies VALUES("8","Bovinos","esp-default.jpg","1");
INSERT INTO especies VALUES("9","Conejos y Piliferos","esp-default.jpg","8");
INSERT INTO especies VALUES("10","Bubalinos","esp-default.jpg","9");
INSERT INTO especies VALUES("11","Camelidos","esp-default.jpg","14");
INSERT INTO especies VALUES("12","Ciervos","esp-default.jpg","19");



CREATE TABLE `faenados` (
  `id_faenados` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `tropa` int(11) NOT NULL,
  `garron` int(11) NOT NULL,
  `peso` float NOT NULL,
  `especie` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `productor` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `etiqueta` varchar(1000) NOT NULL,
  `fechafaena` varchar(255) NOT NULL,
  `fechaetiqueta` varchar(255) NOT NULL,
  `numespecie` int(11) NOT NULL,
  `fechacsv` varchar(11) NOT NULL,
  `codigocsv` varchar(11) NOT NULL,
  `destinocsv` int(11) NOT NULL,
  `camara` int(11) NOT NULL,
  `despiece` int(11) NOT NULL,
  PRIMARY KEY (`id_faenados`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8mb4;

INSERT INTO faenados VALUES("469","2021","1","1","1","Cabrillas/chivitos","2021-02-28","CUNCO SA","PARCIAL","etiqueta1202111.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("470","2021","1","2","2","Cabrillas/chivitos","2021-02-28","CUNCO SA","PARCIAL","etiqueta1202122.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("471","2021","1","3","3","Cabrillas/chivitos","2021-02-28","CUNCO SA","PARCIAL","etiqueta1202133.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("472","2021","1","4","4","Cabrillas/chivitos","2021-02-28","CUNCO SA","PARCIAL","etiqueta1202144.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("473","2021","1","5","5","Cabrillas/chivitos","2021-02-28","CUNCO SA","PARCIAL","etiqueta1202155.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("474","2021","1","6","6","Cabrillas/chivitos","2021-02-28","CUNCO SA","FINALIZADO","etiqueta1202166.png","28-02-2021","26-02-2022","4","28/02/2021","04.05","0","0","9");
INSERT INTO faenados VALUES("475","2021","185","7","7","ciervos","2021-02-28","ROJAS RAMON ALBERTO","PARCIAL","etiqueta185202177.png","28-02-2021","26-02-2022","12","28/02/2021","19.01","0","0","21");
INSERT INTO faenados VALUES("482","2021","226","14","1","novillito","2021-02-28","ROJAS RAMON ALBERTO","PARCIAL","etiqueta2262021141.png","28-02-2021","26-02-2022","9","28/02/2021","2d-nt","0","0","0");
INSERT INTO faenados VALUES("483","2021","226","15","2","novillito","2021-02-28","ROJAS RAMON ALBERTO","FINALIZADO","etiqueta2262021152.png","28-02-2021","26-02-2022","9","28/02/2021","2d-nt","0","0","0");
INSERT INTO faenados VALUES("484","2021","226","16","3","novillito","2021-02-28","ROJAS RAMON ALBERTO","FINALIZADO","etiqueta2262021163.png","28-02-2021","26-02-2022","9","28/02/2021","2d-nt","0","0","0");
INSERT INTO faenados VALUES("485","2021","227","16","1","novillito","2021-02-28","CUNCO SA","FINALIZADO","etiqueta2272021161.png","28-02-2021","26-02-2022","9","28/02/2021","4d-nt","0","0","0");
INSERT INTO faenados VALUES("486","2021","227","17","2","novillito","2021-02-28","CUNCO SA","PARCIAL","etiqueta2272021172.png","28-02-2021","26-02-2022","9","28/02/2021","4d-nt","0","0","0");
INSERT INTO faenados VALUES("487","2021","227","18","3","novillito","2021-02-28","CUNCO SA","FINALIZADO","etiqueta2272021183.png","28-02-2021","26-02-2022","9","28/02/2021","4d-nt","0","0","0");
INSERT INTO faenados VALUES("493","2021","2","17","17","Cabrillas/chivitos","2021-03-01","CUNCO SA","PARCIAL","etiqueta220211717.png","01-03-2021","27-02-2022","4","01/03/2021","04.05","106","2","9");
INSERT INTO faenados VALUES("504","2021","2","18","18","Cabrillas/chivitos","2021-03-01","CUNCO SA","PARCIAL","etiqueta220211818.png","01-03-2021","27-02-2022","4","01/03/2021","04.05","106","2","9");
INSERT INTO faenados VALUES("505","2021","2","19","19","Cabrillas/chivitos","2021-03-01","CUNCO SA","PARCIAL","etiqueta220211919.png","01-03-2021","27-02-2022","4","01/03/2021","04.05","106","2","9");
INSERT INTO faenados VALUES("506","2021","2","20","20","Cabrillas/chivitos","2021-03-01","CUNCO SA","PARCIAL","etiqueta220212020.png","01-03-2021","27-02-2022","4","01/03/2021","04.05","106","2","9");
INSERT INTO faenados VALUES("509","2021","2","21","21","Cabrillas/chivitos","2021-03-02","CUNCO SA","PARCIAL","etiqueta220212121.png","02-03-2021","28-02-2022","4","02/03/2021","04.05","106","2","9");
INSERT INTO faenados VALUES("514","2021","2","22","22","Cabrillas/chivitos","2021-03-02","CUNCO SA","FINALIZADO","etiqueta220212222.png","02-03-2021","28-02-2022","4","02/03/2021","04.05","106","2","9");



CREATE TABLE `faenas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tropa` int(11) NOT NULL,
  `desde` int(11) NOT NULL,
  `hasta` int(11) NOT NULL,
  `clasificacion` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `seleccionado` int(11) NOT NULL,
  `matarife` int(11) NOT NULL,
  `etapa` varchar(11) NOT NULL DEFAULT 'A',
  `quedan` int(11) NOT NULL DEFAULT 0,
  `parcialterminado` varchar(11) NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8mb4;

INSERT INTO faenas VALUES("245","2021-02-28","6","1","1","6","Cabrillas/chivitos","TOTALIDAD","6","17","A","0","NO");
INSERT INTO faenas VALUES("246","2021-02-28","2","185","7","8","ciervos","TOTALIDAD","2","17","A","0","NO");
INSERT INTO faenas VALUES("248","2021-02-28","3","226","11","12","novillito","PARCIAL","2","18","I","1","SI");
INSERT INTO faenas VALUES("250","2021-02-28","3","226","14","15","novillito","PARCIAL","2","18","I","1","SI");
INSERT INTO faenas VALUES("251","2021-02-28","3","226","16","16","novillito","TOTALIDAD","1","18","I","0","SI");
INSERT INTO faenas VALUES("252","2021-02-28","3","227","16","16","novillito","PARCIAL","1","18","I","2","SI");
INSERT INTO faenas VALUES("253","2021-02-28","3","227","17","18","novillito","TOTALIDAD","2","18","I","0","SI");
INSERT INTO faenas VALUES("254","2021-03-01","6","2","17","22","Cabrillas/chivitos","TOTALIDAD","6","17","A","0","NO");



CREATE TABLE `ingresos` (
  `id_ingresos` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `libro` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `especie` int(11) NOT NULL,
  `subespecie` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `kilos` int(11) NOT NULL,
  `muertos` int(11) NOT NULL,
  `caidos` int(11) NOT NULL,
  `enpie` int(11) NOT NULL,
  `kilosenpie` int(11) NOT NULL,
  `conservacion` int(11) NOT NULL,
  `vencimiento` int(11) NOT NULL,
  `corral` int(11) NOT NULL,
  `corralero` int(11) NOT NULL,
  `matarife` int(11) NOT NULL,
  `productor` int(11) NOT NULL,
  `guia` int(11) NOT NULL,
  `fechaguia` date NOT NULL,
  `dtamodal` varchar(45) NOT NULL,
  `fechadtamodal` date NOT NULL,
  `llenarprocedencia` int(11) NOT NULL,
  `provinciamodal` int(255) NOT NULL,
  `localidadmodal` int(255) NOT NULL,
  `CPmodal` varchar(45) NOT NULL,
  `llenartransporte` int(11) NOT NULL,
  `llenarchofer` int(11) NOT NULL,
  `dnimodal` varchar(11) NOT NULL,
  `habilitacionmodal` varchar(255) NOT NULL,
  `horasdeviajemodal` int(11) NOT NULL,
  `lavadomodal` varchar(255) NOT NULL,
  `prescintomodal` varchar(255) NOT NULL,
  `prescintomodalacoplado` varchar(255) NOT NULL,
  `observacionmodal` text NOT NULL,
  `kiloscuerosmodal` int(11) NOT NULL,
  `numtropas` int(11) NOT NULL,
  `estado` varchar(11) NOT NULL DEFAULT 'A',
  `cargodatos` int(11) NOT NULL,
  `fechaeditar` varchar(255) NOT NULL,
  `edito` int(11) NOT NULL,
  `digestormuertos` varchar(255) NOT NULL,
  `digestorcaidos` varchar(255) NOT NULL,
  `etapa` varchar(255) NOT NULL DEFAULT 'INGRESO',
  `quedanreduccion` int(255) NOT NULL,
  `etiqueta` varchar(100) NOT NULL DEFAULT 'NO',
  `fechafinalizado` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ingresos`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

INSERT INTO ingresos VALUES("54","2021","28/02/2021 11:37:15","2","2","4","19","37","2","20","0","0","2","20","1","7","5","2","17","1","2456788","2021-02-28","2456788-0","2021-02-28","4","2","146","5677","2","3","42204241","1234","76","89493789090","02890099000","088899i8990099","SIN NOVEDAD","677","185","A","1","","0","DIGESTOR","DIGESTOR","FINALIZADO","0","etiqueta2021185.png","28/02/2021");
INSERT INTO ingresos VALUES("55","2021","28/02/2021 12:07:48","1","1","11","9","42","3","300","0","0","3","300","3","365","5","2","18","1","2456788","2021-02-22","2456788-0","2021-02-23","1","3","284","5613","2","3","42204241","1","7","4444","028900990009878899","088899i8990099","y","788","226","A","1","","0","DIGESTOR","DIGESTOR","FINALIZADO","0","etiqueta2021226.png","");
INSERT INTO ingresos VALUES("56","2021","28/02/2021 12:47:53","3","3","3","9","41","3","100","0","0","3","100","3","365","2","5","18","7","2456788","2021-03-01","2456788-0","2021-02-19","4","2","147","5613","2","2","31167331","1234","6","4444","02890099000","088899i8990099","SIN NOVEDAD","0","227","A","1","","0","DIGESTOR","DIGESTOR","FINALIZADO","0","etiqueta2021227.png","");
INSERT INTO ingresos VALUES("57","2021","01/03/2021 11:23:43","1","1","2","4","7","6","600","0","0","6","600","3","365","1","3","17","7","2456788","2021-03-17","2456788-0","2021-03-02","4","1","3","5613","2","3","42204241","1234","67","89493789090","02890099000","088899i8990099","SIN NOVEDAD","0","2","A","1","","0","DIGESTOR","DIGESTOR","FINALIZADO","0","etiqueta20212.png","02/03/2021");



CREATE TABLE `localidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provincia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2383 DEFAULT CHARSET=latin1;

INSERT INTO localidades VALUES("1","1","25 de Mayo");
INSERT INTO localidades VALUES("2","1","3 de febrero");
INSERT INTO localidades VALUES("3","1","A. Alsina");
INSERT INTO localidades VALUES("4","1","A. Gonzáles Cháves");
INSERT INTO localidades VALUES("5","1","Aguas Verdes");
INSERT INTO localidades VALUES("6","1","Alberti");
INSERT INTO localidades VALUES("7","1","Arrecifes");
INSERT INTO localidades VALUES("8","1","Ayacucho");
INSERT INTO localidades VALUES("9","1","Azul");
INSERT INTO localidades VALUES("10","1","Bahía Blanca");
INSERT INTO localidades VALUES("11","1","Balcarce");
INSERT INTO localidades VALUES("12","1","Baradero");
INSERT INTO localidades VALUES("13","1","Benito Juárez");
INSERT INTO localidades VALUES("14","1","Berisso");
INSERT INTO localidades VALUES("15","1","Bolívar");
INSERT INTO localidades VALUES("16","1","Bragado");
INSERT INTO localidades VALUES("17","1","Brandsen");
INSERT INTO localidades VALUES("18","1","Campana");
INSERT INTO localidades VALUES("19","1","Cañuelas");
INSERT INTO localidades VALUES("20","1","Capilla del Señor");
INSERT INTO localidades VALUES("21","1","Capitán Sarmiento");
INSERT INTO localidades VALUES("22","1","Carapachay");
INSERT INTO localidades VALUES("23","1","Carhue");
INSERT INTO localidades VALUES("24","1","Cariló");
INSERT INTO localidades VALUES("25","1","Carlos Casares");
INSERT INTO localidades VALUES("26","1","Carlos Tejedor");
INSERT INTO localidades VALUES("27","1","Carmen de Areco");
INSERT INTO localidades VALUES("28","1","Carmen de Patagones");
INSERT INTO localidades VALUES("29","1","Castelli");
INSERT INTO localidades VALUES("30","1","Chacabuco");
INSERT INTO localidades VALUES("31","1","Chascomús");
INSERT INTO localidades VALUES("32","1","Chivilcoy");
INSERT INTO localidades VALUES("33","1","Colón");
INSERT INTO localidades VALUES("34","1","Coronel Dorrego");
INSERT INTO localidades VALUES("35","1","Coronel Pringles");
INSERT INTO localidades VALUES("36","1","Coronel Rosales");
INSERT INTO localidades VALUES("37","1","Coronel Suarez");
INSERT INTO localidades VALUES("38","1","Costa Azul");
INSERT INTO localidades VALUES("39","1","Costa Chica");
INSERT INTO localidades VALUES("40","1","Costa del Este");
INSERT INTO localidades VALUES("41","1","Costa Esmeralda");
INSERT INTO localidades VALUES("42","1","Daireaux");
INSERT INTO localidades VALUES("43","1","Darregueira");
INSERT INTO localidades VALUES("44","1","Del Viso");
INSERT INTO localidades VALUES("45","1","Dolores");
INSERT INTO localidades VALUES("46","1","Don Torcuato");
INSERT INTO localidades VALUES("47","1","Ensenada");
INSERT INTO localidades VALUES("48","1","Escobar");
INSERT INTO localidades VALUES("49","1","Exaltación de la Cruz");
INSERT INTO localidades VALUES("50","1","Florentino Ameghino");
INSERT INTO localidades VALUES("51","1","Garín");
INSERT INTO localidades VALUES("52","1","Gral. Alvarado");
INSERT INTO localidades VALUES("53","1","Gral. Alvear");
INSERT INTO localidades VALUES("54","1","Gral. Arenales");
INSERT INTO localidades VALUES("55","1","Gral. Belgrano");
INSERT INTO localidades VALUES("56","1","Gral. Guido");
INSERT INTO localidades VALUES("57","1","Gral. Lamadrid");
INSERT INTO localidades VALUES("58","1","Gral. Las Heras");
INSERT INTO localidades VALUES("59","1","Gral. Lavalle");
INSERT INTO localidades VALUES("60","1","Gral. Madariaga");
INSERT INTO localidades VALUES("61","1","Gral. Pacheco");
INSERT INTO localidades VALUES("62","1","Gral. Paz");
INSERT INTO localidades VALUES("63","1","Gral. Pinto");
INSERT INTO localidades VALUES("64","1","Gral. Pueyrredón");
INSERT INTO localidades VALUES("65","1","Gral. Rodríguez");
INSERT INTO localidades VALUES("66","1","Gral. Viamonte");
INSERT INTO localidades VALUES("67","1","Gral. Villegas");
INSERT INTO localidades VALUES("68","1","Guaminí");
INSERT INTO localidades VALUES("69","1","Guernica");
INSERT INTO localidades VALUES("70","1","Hipólito Yrigoyen");
INSERT INTO localidades VALUES("71","1","Ing. Maschwitz");
INSERT INTO localidades VALUES("72","1","Junín");
INSERT INTO localidades VALUES("73","1","La Plata");
INSERT INTO localidades VALUES("74","1","Laprida");
INSERT INTO localidades VALUES("75","1","Las Flores");
INSERT INTO localidades VALUES("76","1","Las Toninas");
INSERT INTO localidades VALUES("77","1","Leandro N. Alem");
INSERT INTO localidades VALUES("78","1","Lincoln");
INSERT INTO localidades VALUES("79","1","Loberia");
INSERT INTO localidades VALUES("80","1","Lobos");
INSERT INTO localidades VALUES("81","1","Los Cardales");
INSERT INTO localidades VALUES("82","1","Los Toldos");
INSERT INTO localidades VALUES("83","1","Lucila del Mar");
INSERT INTO localidades VALUES("84","1","Luján");
INSERT INTO localidades VALUES("85","1","Magdalena");
INSERT INTO localidades VALUES("86","1","Maipú");
INSERT INTO localidades VALUES("87","1","Mar Chiquita");
INSERT INTO localidades VALUES("88","1","Mar de Ajó");
INSERT INTO localidades VALUES("89","1","Mar de las Pampas");
INSERT INTO localidades VALUES("90","1","Mar del Plata");
INSERT INTO localidades VALUES("91","1","Mar del Tuyú");
INSERT INTO localidades VALUES("92","1","Marcos Paz");
INSERT INTO localidades VALUES("93","1","Mercedes");
INSERT INTO localidades VALUES("94","1","Miramar");
INSERT INTO localidades VALUES("95","1","Monte");
INSERT INTO localidades VALUES("96","1","Monte Hermoso");
INSERT INTO localidades VALUES("97","1","Munro");
INSERT INTO localidades VALUES("98","1","Navarro");
INSERT INTO localidades VALUES("99","1","Necochea");
INSERT INTO localidades VALUES("100","1","Olavarría");
INSERT INTO localidades VALUES("101","1","Partido de la Costa");
INSERT INTO localidades VALUES("102","1","Pehuajó");
INSERT INTO localidades VALUES("103","1","Pellegrini");
INSERT INTO localidades VALUES("104","1","Pergamino");
INSERT INTO localidades VALUES("105","1","Pigüé");
INSERT INTO localidades VALUES("106","1","Pila");
INSERT INTO localidades VALUES("107","1","Pilar");
INSERT INTO localidades VALUES("108","1","Pinamar");
INSERT INTO localidades VALUES("109","1","Pinar del Sol");
INSERT INTO localidades VALUES("110","1","Polvorines");
INSERT INTO localidades VALUES("111","1","Pte. Perón");
INSERT INTO localidades VALUES("112","1","Puán");
INSERT INTO localidades VALUES("113","1","Punta Indio");
INSERT INTO localidades VALUES("114","1","Ramallo");
INSERT INTO localidades VALUES("115","1","Rauch");
INSERT INTO localidades VALUES("116","1","Rivadavia");
INSERT INTO localidades VALUES("117","1","Rojas");
INSERT INTO localidades VALUES("118","1","Roque Pérez");
INSERT INTO localidades VALUES("119","1","Saavedra");
INSERT INTO localidades VALUES("120","1","Saladillo");
INSERT INTO localidades VALUES("121","1","Salliqueló");
INSERT INTO localidades VALUES("122","1","Salto");
INSERT INTO localidades VALUES("123","1","San Andrés de Giles");
INSERT INTO localidades VALUES("124","1","San Antonio de Areco");
INSERT INTO localidades VALUES("125","1","San Antonio de Padua");
INSERT INTO localidades VALUES("126","1","San Bernardo");
INSERT INTO localidades VALUES("127","1","San Cayetano");
INSERT INTO localidades VALUES("128","1","San Clemente del Tuyú");
INSERT INTO localidades VALUES("129","1","San Nicolás");
INSERT INTO localidades VALUES("130","1","San Pedro");
INSERT INTO localidades VALUES("131","1","San Vicente");
INSERT INTO localidades VALUES("132","1","Santa Teresita");
INSERT INTO localidades VALUES("133","1","Suipacha");
INSERT INTO localidades VALUES("134","1","Tandil");
INSERT INTO localidades VALUES("135","1","Tapalqué");
INSERT INTO localidades VALUES("136","1","Tordillo");
INSERT INTO localidades VALUES("137","1","Tornquist");
INSERT INTO localidades VALUES("138","1","Trenque Lauquen");
INSERT INTO localidades VALUES("139","1","Tres Lomas");
INSERT INTO localidades VALUES("140","1","Villa Gesell");
INSERT INTO localidades VALUES("141","1","Villarino");
INSERT INTO localidades VALUES("142","1","Zárate");
INSERT INTO localidades VALUES("143","2","11 de Septiembre");
INSERT INTO localidades VALUES("144","2","20 de Junio");
INSERT INTO localidades VALUES("145","2","25 de Mayo");
INSERT INTO localidades VALUES("146","2","Acassuso");
INSERT INTO localidades VALUES("147","2","Adrogué");
INSERT INTO localidades VALUES("148","2","Aldo Bonzi");
INSERT INTO localidades VALUES("149","2","Área Reserva Cinturón Ecológico");
INSERT INTO localidades VALUES("150","2","Avellaneda");
INSERT INTO localidades VALUES("151","2","Banfield");
INSERT INTO localidades VALUES("152","2","Barrio Parque");
INSERT INTO localidades VALUES("153","2","Barrio Santa Teresita");
INSERT INTO localidades VALUES("154","2","Beccar");
INSERT INTO localidades VALUES("155","2","Bella Vista");
INSERT INTO localidades VALUES("156","2","Berazategui");
INSERT INTO localidades VALUES("157","2","Bernal Este");
INSERT INTO localidades VALUES("158","2","Bernal Oeste");
INSERT INTO localidades VALUES("159","2","Billinghurst");
INSERT INTO localidades VALUES("160","2","Boulogne");
INSERT INTO localidades VALUES("161","2","Burzaco");
INSERT INTO localidades VALUES("162","2","Carapachay");
INSERT INTO localidades VALUES("163","2","Caseros");
INSERT INTO localidades VALUES("164","2","Castelar");
INSERT INTO localidades VALUES("165","2","Churruca");
INSERT INTO localidades VALUES("166","2","Ciudad Evita");
INSERT INTO localidades VALUES("167","2","Ciudad Madero");
INSERT INTO localidades VALUES("168","2","Ciudadela");
INSERT INTO localidades VALUES("169","2","Claypole");
INSERT INTO localidades VALUES("170","2","Crucecita");
INSERT INTO localidades VALUES("171","2","Dock Sud");
INSERT INTO localidades VALUES("172","2","Don Bosco");
INSERT INTO localidades VALUES("173","2","Don Orione");
INSERT INTO localidades VALUES("174","2","El Jagüel");
INSERT INTO localidades VALUES("175","2","El Libertador");
INSERT INTO localidades VALUES("176","2","El Palomar");
INSERT INTO localidades VALUES("177","2","El Tala");
INSERT INTO localidades VALUES("178","2","El Trébol");
INSERT INTO localidades VALUES("179","2","Ezeiza");
INSERT INTO localidades VALUES("180","2","Ezpeleta");
INSERT INTO localidades VALUES("181","2","Florencio Varela");
INSERT INTO localidades VALUES("182","2","Florida");
INSERT INTO localidades VALUES("183","2","Francisco Álvarez");
INSERT INTO localidades VALUES("184","2","Gerli");
INSERT INTO localidades VALUES("185","2","Glew");
INSERT INTO localidades VALUES("186","2","González Catán");
INSERT INTO localidades VALUES("187","2","Gral. Lamadrid");
INSERT INTO localidades VALUES("188","2","Grand Bourg");
INSERT INTO localidades VALUES("189","2","Gregorio de Laferrere");
INSERT INTO localidades VALUES("190","2","Guillermo Enrique Hudson");
INSERT INTO localidades VALUES("191","2","Haedo");
INSERT INTO localidades VALUES("192","2","Hurlingham");
INSERT INTO localidades VALUES("193","2","Ing. Sourdeaux");
INSERT INTO localidades VALUES("194","2","Isidro Casanova");
INSERT INTO localidades VALUES("195","2","Ituzaingó");
INSERT INTO localidades VALUES("196","2","José C. Paz");
INSERT INTO localidades VALUES("197","2","José Ingenieros");
INSERT INTO localidades VALUES("198","2","José Marmol");
INSERT INTO localidades VALUES("199","2","La Lucila");
INSERT INTO localidades VALUES("200","2","La Reja");
INSERT INTO localidades VALUES("201","2","La Tablada");
INSERT INTO localidades VALUES("202","2","Lanús");
INSERT INTO localidades VALUES("203","2","Llavallol");
INSERT INTO localidades VALUES("204","2","Loma Hermosa");
INSERT INTO localidades VALUES("205","2","Lomas de Zamora");
INSERT INTO localidades VALUES("206","2","Lomas del Millón");
INSERT INTO localidades VALUES("207","2","Lomas del Mirador");
INSERT INTO localidades VALUES("208","2","Longchamps");
INSERT INTO localidades VALUES("209","2","Los Polvorines");
INSERT INTO localidades VALUES("210","2","Luis Guillón");
INSERT INTO localidades VALUES("211","2","Malvinas Argentinas");
INSERT INTO localidades VALUES("212","2","Martín Coronado");
INSERT INTO localidades VALUES("213","2","Martínez");
INSERT INTO localidades VALUES("214","2","Merlo");
INSERT INTO localidades VALUES("215","2","Ministro Rivadavia");
INSERT INTO localidades VALUES("216","2","Monte Chingolo");
INSERT INTO localidades VALUES("217","2","Monte Grande");
INSERT INTO localidades VALUES("218","2","Moreno");
INSERT INTO localidades VALUES("219","2","Morón");
INSERT INTO localidades VALUES("220","2","Muñiz");
INSERT INTO localidades VALUES("221","2","Olivos");
INSERT INTO localidades VALUES("222","2","Pablo Nogués");
INSERT INTO localidades VALUES("223","2","Pablo Podestá");
INSERT INTO localidades VALUES("224","2","Paso del Rey");
INSERT INTO localidades VALUES("225","2","Pereyra");
INSERT INTO localidades VALUES("226","2","Piñeiro");
INSERT INTO localidades VALUES("227","2","Plátanos");
INSERT INTO localidades VALUES("228","2","Pontevedra");
INSERT INTO localidades VALUES("229","2","Quilmes");
INSERT INTO localidades VALUES("230","2","Rafael Calzada");
INSERT INTO localidades VALUES("231","2","Rafael Castillo");
INSERT INTO localidades VALUES("232","2","Ramos Mejía");
INSERT INTO localidades VALUES("233","2","Ranelagh");
INSERT INTO localidades VALUES("234","2","Remedios de Escalada");
INSERT INTO localidades VALUES("235","2","Sáenz Peña");
INSERT INTO localidades VALUES("236","2","San Antonio de Padua");
INSERT INTO localidades VALUES("237","2","San Fernando");
INSERT INTO localidades VALUES("238","2","San Francisco Solano");
INSERT INTO localidades VALUES("239","2","San Isidro");
INSERT INTO localidades VALUES("240","2","San José");
INSERT INTO localidades VALUES("241","2","San Justo");
INSERT INTO localidades VALUES("242","2","San Martín");
INSERT INTO localidades VALUES("243","2","San Miguel");
INSERT INTO localidades VALUES("244","2","Santos Lugares");
INSERT INTO localidades VALUES("245","2","Sarandí");
INSERT INTO localidades VALUES("246","2","Sourigues");
INSERT INTO localidades VALUES("247","2","Tapiales");
INSERT INTO localidades VALUES("248","2","Temperley");
INSERT INTO localidades VALUES("249","2","Tigre");
INSERT INTO localidades VALUES("250","2","Tortuguitas");
INSERT INTO localidades VALUES("251","2","Tristán Suárez");
INSERT INTO localidades VALUES("252","2","Trujui");
INSERT INTO localidades VALUES("253","2","Turdera");
INSERT INTO localidades VALUES("254","2","Valentín Alsina");
INSERT INTO localidades VALUES("255","2","Vicente López");
INSERT INTO localidades VALUES("256","2","Villa Adelina");
INSERT INTO localidades VALUES("257","2","Villa Ballester");
INSERT INTO localidades VALUES("258","2","Villa Bosch");
INSERT INTO localidades VALUES("259","2","Villa Caraza");
INSERT INTO localidades VALUES("260","2","Villa Celina");
INSERT INTO localidades VALUES("261","2","Villa Centenario");
INSERT INTO localidades VALUES("262","2","Villa de Mayo");
INSERT INTO localidades VALUES("263","2","Villa Diamante");
INSERT INTO localidades VALUES("264","2","Villa Domínico");
INSERT INTO localidades VALUES("265","2","Villa España");
INSERT INTO localidades VALUES("266","2","Villa Fiorito");
INSERT INTO localidades VALUES("267","2","Villa Guillermina");
INSERT INTO localidades VALUES("268","2","Villa Insuperable");
INSERT INTO localidades VALUES("269","2","Villa José León Suárez");
INSERT INTO localidades VALUES("270","2","Villa La Florida");
INSERT INTO localidades VALUES("271","2","Villa Luzuriaga");
INSERT INTO localidades VALUES("272","2","Villa Martelli");
INSERT INTO localidades VALUES("273","2","Villa Obrera");
INSERT INTO localidades VALUES("274","2","Villa Progreso");
INSERT INTO localidades VALUES("275","2","Villa Raffo");
INSERT INTO localidades VALUES("276","2","Villa Sarmiento");
INSERT INTO localidades VALUES("277","2","Villa Tesei");
INSERT INTO localidades VALUES("278","2","Villa Udaondo");
INSERT INTO localidades VALUES("279","2","Virrey del Pino");
INSERT INTO localidades VALUES("280","2","Wilde");
INSERT INTO localidades VALUES("281","2","William Morris");
INSERT INTO localidades VALUES("282","3","Agronomía");
INSERT INTO localidades VALUES("283","3","Almagro");
INSERT INTO localidades VALUES("284","3","Balvanera");
INSERT INTO localidades VALUES("285","3","Barracas");
INSERT INTO localidades VALUES("286","3","Belgrano");
INSERT INTO localidades VALUES("287","3","Boca");
INSERT INTO localidades VALUES("288","3","Boedo");
INSERT INTO localidades VALUES("289","3","Caballito");
INSERT INTO localidades VALUES("290","3","Chacarita");
INSERT INTO localidades VALUES("291","3","Coghlan");
INSERT INTO localidades VALUES("292","3","Colegiales");
INSERT INTO localidades VALUES("293","3","Constitución");
INSERT INTO localidades VALUES("294","3","Flores");
INSERT INTO localidades VALUES("295","3","Floresta");
INSERT INTO localidades VALUES("296","3","La Paternal");
INSERT INTO localidades VALUES("297","3","Liniers");
INSERT INTO localidades VALUES("298","3","Mataderos");
INSERT INTO localidades VALUES("299","3","Monserrat");
INSERT INTO localidades VALUES("300","3","Monte Castro");
INSERT INTO localidades VALUES("301","3","Nueva Pompeya");
INSERT INTO localidades VALUES("302","3","Núñez");
INSERT INTO localidades VALUES("303","3","Palermo");
INSERT INTO localidades VALUES("304","3","Parque Avellaneda");
INSERT INTO localidades VALUES("305","3","Parque Chacabuco");
INSERT INTO localidades VALUES("306","3","Parque Chas");
INSERT INTO localidades VALUES("307","3","Parque Patricios");
INSERT INTO localidades VALUES("308","3","Puerto Madero");
INSERT INTO localidades VALUES("309","3","Recoleta");
INSERT INTO localidades VALUES("310","3","Retiro");
INSERT INTO localidades VALUES("311","3","Saavedra");
INSERT INTO localidades VALUES("312","3","San Cristóbal");
INSERT INTO localidades VALUES("313","3","San Nicolás");
INSERT INTO localidades VALUES("314","3","San Telmo");
INSERT INTO localidades VALUES("315","3","Vélez Sársfield");
INSERT INTO localidades VALUES("316","3","Versalles");
INSERT INTO localidades VALUES("317","3","Villa Crespo");
INSERT INTO localidades VALUES("318","3","Villa del Parque");
INSERT INTO localidades VALUES("319","3","Villa Devoto");
INSERT INTO localidades VALUES("320","3","Villa Gral. Mitre");
INSERT INTO localidades VALUES("321","3","Villa Lugano");
INSERT INTO localidades VALUES("322","3","Villa Luro");
INSERT INTO localidades VALUES("323","3","Villa Ortúzar");
INSERT INTO localidades VALUES("324","3","Villa Pueyrredón");
INSERT INTO localidades VALUES("325","3","Villa Real");
INSERT INTO localidades VALUES("326","3","Villa Riachuelo");
INSERT INTO localidades VALUES("327","3","Villa Santa Rita");
INSERT INTO localidades VALUES("328","3","Villa Soldati");
INSERT INTO localidades VALUES("329","3","Villa Urquiza");
INSERT INTO localidades VALUES("330","4","Aconquija");
INSERT INTO localidades VALUES("331","4","Ancasti");
INSERT INTO localidades VALUES("332","4","Andalgalá");
INSERT INTO localidades VALUES("333","4","Antofagasta");
INSERT INTO localidades VALUES("334","4","Belén");
INSERT INTO localidades VALUES("335","4","Capayán");
INSERT INTO localidades VALUES("336","4","Capital");
INSERT INTO localidades VALUES("337","4","4");
INSERT INTO localidades VALUES("338","4","Corral Quemado");
INSERT INTO localidades VALUES("339","4","El Alto");
INSERT INTO localidades VALUES("340","4","El Rodeo");
INSERT INTO localidades VALUES("341","4","F.Mamerto Esquiú");
INSERT INTO localidades VALUES("342","4","Fiambalá");
INSERT INTO localidades VALUES("343","4","Hualfín");
INSERT INTO localidades VALUES("344","4","Huillapima");
INSERT INTO localidades VALUES("345","4","Icaño");
INSERT INTO localidades VALUES("346","4","La Puerta");
INSERT INTO localidades VALUES("347","4","Las Juntas");
INSERT INTO localidades VALUES("348","4","Londres");
INSERT INTO localidades VALUES("349","4","Los Altos");
INSERT INTO localidades VALUES("350","4","Los Varela");
INSERT INTO localidades VALUES("351","4","Mutquín");
INSERT INTO localidades VALUES("352","4","Paclín");
INSERT INTO localidades VALUES("353","4","Poman");
INSERT INTO localidades VALUES("354","4","Pozo de La Piedra");
INSERT INTO localidades VALUES("355","4","Puerta de Corral");
INSERT INTO localidades VALUES("356","4","Puerta San José");
INSERT INTO localidades VALUES("357","4","Recreo");
INSERT INTO localidades VALUES("358","4","S.F.V de 4");
INSERT INTO localidades VALUES("359","4","San Fernando");
INSERT INTO localidades VALUES("360","4","San Fernando del Valle");
INSERT INTO localidades VALUES("361","4","San José");
INSERT INTO localidades VALUES("362","4","Santa María");
INSERT INTO localidades VALUES("363","4","Santa Rosa");
INSERT INTO localidades VALUES("364","4","Saujil");
INSERT INTO localidades VALUES("365","4","Tapso");
INSERT INTO localidades VALUES("366","4","Tinogasta");
INSERT INTO localidades VALUES("367","4","Valle Viejo");
INSERT INTO localidades VALUES("368","4","Villa Vil");
INSERT INTO localidades VALUES("369","5","Aviá Teraí");
INSERT INTO localidades VALUES("370","5","Barranqueras");
INSERT INTO localidades VALUES("371","5","Basail");
INSERT INTO localidades VALUES("372","5","Campo Largo");
INSERT INTO localidades VALUES("373","5","Capital");
INSERT INTO localidades VALUES("374","5","Capitán Solari");
INSERT INTO localidades VALUES("375","5","Charadai");
INSERT INTO localidades VALUES("376","5","Charata");
INSERT INTO localidades VALUES("377","5","Chorotis");
INSERT INTO localidades VALUES("378","5","Ciervo Petiso");
INSERT INTO localidades VALUES("379","5","Cnel. Du Graty");
INSERT INTO localidades VALUES("380","5","Col. Benítez");
INSERT INTO localidades VALUES("381","5","Col. Elisa");
INSERT INTO localidades VALUES("382","5","Col. Popular");
INSERT INTO localidades VALUES("383","5","Colonias Unidas");
INSERT INTO localidades VALUES("384","5","Concepción");
INSERT INTO localidades VALUES("385","5","Corzuela");
INSERT INTO localidades VALUES("386","5","Cote Lai");
INSERT INTO localidades VALUES("387","5","El Sauzalito");
INSERT INTO localidades VALUES("388","5","Enrique Urien");
INSERT INTO localidades VALUES("389","5","Fontana");
INSERT INTO localidades VALUES("390","5","Fte. Esperanza");
INSERT INTO localidades VALUES("391","5","Gancedo");
INSERT INTO localidades VALUES("392","5","Gral. Capdevila");
INSERT INTO localidades VALUES("393","5","Gral. Pinero");
INSERT INTO localidades VALUES("394","5","Gral. San Martín");
INSERT INTO localidades VALUES("395","5","Gral. Vedia");
INSERT INTO localidades VALUES("396","5","Hermoso Campo");
INSERT INTO localidades VALUES("397","5","I. del Cerrito");
INSERT INTO localidades VALUES("398","5","J.J. Castelli");
INSERT INTO localidades VALUES("399","5","La Clotilde");
INSERT INTO localidades VALUES("400","5","La Eduvigis");
INSERT INTO localidades VALUES("401","5","La Escondida");
INSERT INTO localidades VALUES("402","5","La Leonesa");
INSERT INTO localidades VALUES("403","5","La Tigra");
INSERT INTO localidades VALUES("404","5","La Verde");
INSERT INTO localidades VALUES("405","5","Laguna Blanca");
INSERT INTO localidades VALUES("406","5","Laguna Limpia");
INSERT INTO localidades VALUES("407","5","Lapachito");
INSERT INTO localidades VALUES("408","5","Las Breñas");
INSERT INTO localidades VALUES("409","5","Las Garcitas");
INSERT INTO localidades VALUES("410","5","Las Palmas");
INSERT INTO localidades VALUES("411","5","Los Frentones");
INSERT INTO localidades VALUES("412","5","Machagai");
INSERT INTO localidades VALUES("413","5","Makallé");
INSERT INTO localidades VALUES("414","5","Margarita Belén");
INSERT INTO localidades VALUES("415","5","Miraflores");
INSERT INTO localidades VALUES("416","5","Misión N. Pompeya");
INSERT INTO localidades VALUES("417","5","Napenay");
INSERT INTO localidades VALUES("418","5","Pampa Almirón");
INSERT INTO localidades VALUES("419","5","Pampa del Indio");
INSERT INTO localidades VALUES("420","5","Pampa del Infierno");
INSERT INTO localidades VALUES("421","5","Pdcia. de La Plaza");
INSERT INTO localidades VALUES("422","5","Pdcia. Roca");
INSERT INTO localidades VALUES("423","5","Pdcia. Roque Sáenz Peña");
INSERT INTO localidades VALUES("424","5","Pto. Bermejo");
INSERT INTO localidades VALUES("425","5","Pto. Eva Perón");
INSERT INTO localidades VALUES("426","5","Puero Tirol");
INSERT INTO localidades VALUES("427","5","Puerto Vilelas");
INSERT INTO localidades VALUES("428","5","Quitilipi");
INSERT INTO localidades VALUES("429","5","Resistencia");
INSERT INTO localidades VALUES("430","5","Sáenz Peña");
INSERT INTO localidades VALUES("431","5","Samuhú");
INSERT INTO localidades VALUES("432","5","San Bernardo");
INSERT INTO localidades VALUES("433","5","Santa Sylvina");
INSERT INTO localidades VALUES("434","5","Taco Pozo");
INSERT INTO localidades VALUES("435","5","Tres Isletas");
INSERT INTO localidades VALUES("436","5","Villa Ángela");
INSERT INTO localidades VALUES("437","5","Villa Berthet");
INSERT INTO localidades VALUES("438","5","Villa R. Bermejito");
INSERT INTO localidades VALUES("439","6","Aldea Apeleg");
INSERT INTO localidades VALUES("440","6","Aldea Beleiro");
INSERT INTO localidades VALUES("441","6","Aldea Epulef");
INSERT INTO localidades VALUES("442","6","Alto Río Sengerr");
INSERT INTO localidades VALUES("443","6","Buen Pasto");
INSERT INTO localidades VALUES("444","6","Camarones");
INSERT INTO localidades VALUES("445","6","Carrenleufú");
INSERT INTO localidades VALUES("446","6","Cholila");
INSERT INTO localidades VALUES("447","6","Co. Centinela");
INSERT INTO localidades VALUES("448","6","Colan Conhué");
INSERT INTO localidades VALUES("449","6","Comodoro Rivadavia");
INSERT INTO localidades VALUES("450","6","Corcovado");
INSERT INTO localidades VALUES("451","6","Cushamen");
INSERT INTO localidades VALUES("452","6","Dique F. Ameghino");
INSERT INTO localidades VALUES("453","6","Dolavón");
INSERT INTO localidades VALUES("454","6","Dr. R. Rojas");
INSERT INTO localidades VALUES("455","6","El Hoyo");
INSERT INTO localidades VALUES("456","6","El Maitén");
INSERT INTO localidades VALUES("457","6","Epuyén");
INSERT INTO localidades VALUES("458","6","Esquel");
INSERT INTO localidades VALUES("459","6","Facundo");
INSERT INTO localidades VALUES("460","6","Gaimán");
INSERT INTO localidades VALUES("461","6","Gan Gan");
INSERT INTO localidades VALUES("462","6","Gastre");
INSERT INTO localidades VALUES("463","6","Gdor. Costa");
INSERT INTO localidades VALUES("464","6","Gualjaina");
INSERT INTO localidades VALUES("465","6","J. de San Martín");
INSERT INTO localidades VALUES("466","6","Lago Blanco");
INSERT INTO localidades VALUES("467","6","Lago Puelo");
INSERT INTO localidades VALUES("468","6","Lagunita Salada");
INSERT INTO localidades VALUES("469","6","Las Plumas");
INSERT INTO localidades VALUES("470","6","Los Altares");
INSERT INTO localidades VALUES("471","6","Paso de los Indios");
INSERT INTO localidades VALUES("472","6","Paso del Sapo");
INSERT INTO localidades VALUES("473","6","Pto. Madryn");
INSERT INTO localidades VALUES("474","6","Pto. Pirámides");
INSERT INTO localidades VALUES("475","6","Rada Tilly");
INSERT INTO localidades VALUES("476","6","Rawson");
INSERT INTO localidades VALUES("477","6","Río Mayo");
INSERT INTO localidades VALUES("478","6","Río Pico");
INSERT INTO localidades VALUES("479","6","Sarmiento");
INSERT INTO localidades VALUES("480","6","Tecka");
INSERT INTO localidades VALUES("481","6","Telsen");
INSERT INTO localidades VALUES("482","6","Trelew");
INSERT INTO localidades VALUES("483","6","Trevelin");
INSERT INTO localidades VALUES("484","6","Veintiocho de Julio");
INSERT INTO localidades VALUES("485","7","Achiras");
INSERT INTO localidades VALUES("486","7","Adelia Maria");
INSERT INTO localidades VALUES("487","7","Agua de Oro");
INSERT INTO localidades VALUES("488","7","Alcira Gigena");
INSERT INTO localidades VALUES("489","7","Aldea Santa Maria");
INSERT INTO localidades VALUES("490","7","Alejandro Roca");
INSERT INTO localidades VALUES("491","7","Alejo Ledesma");
INSERT INTO localidades VALUES("492","7","Alicia");
INSERT INTO localidades VALUES("493","7","Almafuerte");
INSERT INTO localidades VALUES("494","7","Alpa Corral");
INSERT INTO localidades VALUES("495","7","Alta Gracia");
INSERT INTO localidades VALUES("496","7","Alto Alegre");
INSERT INTO localidades VALUES("497","7","Alto de Los Quebrachos");
INSERT INTO localidades VALUES("498","7","Altos de Chipion");
INSERT INTO localidades VALUES("499","7","Amboy");
INSERT INTO localidades VALUES("500","7","Ambul");
INSERT INTO localidades VALUES("501","7","Ana Zumaran");
INSERT INTO localidades VALUES("502","7","Anisacate");
INSERT INTO localidades VALUES("503","7","Arguello");
INSERT INTO localidades VALUES("504","7","Arias");
INSERT INTO localidades VALUES("505","7","Arroyito");
INSERT INTO localidades VALUES("506","7","Arroyo Algodon");
INSERT INTO localidades VALUES("507","7","Arroyo Cabral");
INSERT INTO localidades VALUES("508","7","Arroyo Los Patos");
INSERT INTO localidades VALUES("509","7","Assunta");
INSERT INTO localidades VALUES("510","7","Atahona");
INSERT INTO localidades VALUES("511","7","Ausonia");
INSERT INTO localidades VALUES("512","7","Avellaneda");
INSERT INTO localidades VALUES("513","7","Ballesteros");
INSERT INTO localidades VALUES("514","7","Ballesteros Sud");
INSERT INTO localidades VALUES("515","7","Balnearia");
INSERT INTO localidades VALUES("516","7","Bañado de Soto");
INSERT INTO localidades VALUES("517","7","Bell Ville");
INSERT INTO localidades VALUES("518","7","Bengolea");
INSERT INTO localidades VALUES("519","7","Benjamin Gould");
INSERT INTO localidades VALUES("520","7","Berrotaran");
INSERT INTO localidades VALUES("521","7","Bialet Masse");
INSERT INTO localidades VALUES("522","7","Bouwer");
INSERT INTO localidades VALUES("523","7","Brinkmann");
INSERT INTO localidades VALUES("524","7","Buchardo");
INSERT INTO localidades VALUES("525","7","Bulnes");
INSERT INTO localidades VALUES("526","7","Cabalango");
INSERT INTO localidades VALUES("527","7","Calamuchita");
INSERT INTO localidades VALUES("528","7","Calchin");
INSERT INTO localidades VALUES("529","7","Calchin Oeste");
INSERT INTO localidades VALUES("530","7","Calmayo");
INSERT INTO localidades VALUES("531","7","Camilo Aldao");
INSERT INTO localidades VALUES("532","7","Caminiaga");
INSERT INTO localidades VALUES("533","7","Cañada de Luque");
INSERT INTO localidades VALUES("534","7","Cañada de Machado");
INSERT INTO localidades VALUES("535","7","Cañada de Rio Pinto");
INSERT INTO localidades VALUES("536","7","Cañada del Sauce");
INSERT INTO localidades VALUES("537","7","Canals");
INSERT INTO localidades VALUES("538","7","Candelaria Sud");
INSERT INTO localidades VALUES("539","7","Capilla de Remedios");
INSERT INTO localidades VALUES("540","7","Capilla de Siton");
INSERT INTO localidades VALUES("541","7","Capilla del Carmen");
INSERT INTO localidades VALUES("542","7","Capilla del Monte");
INSERT INTO localidades VALUES("543","7","Capital");
INSERT INTO localidades VALUES("544","7","Capitan Gral B. O´Higgins");
INSERT INTO localidades VALUES("545","7","Carnerillo");
INSERT INTO localidades VALUES("546","7","Carrilobo");
INSERT INTO localidades VALUES("547","7","Casa Grande");
INSERT INTO localidades VALUES("548","7","Cavanagh");
INSERT INTO localidades VALUES("549","7","Cerro Colorado");
INSERT INTO localidades VALUES("550","7","Chaján");
INSERT INTO localidades VALUES("551","7","Chalacea");
INSERT INTO localidades VALUES("552","7","Chañar Viejo");
INSERT INTO localidades VALUES("553","7","Chancaní");
INSERT INTO localidades VALUES("554","7","Charbonier");
INSERT INTO localidades VALUES("555","7","Charras");
INSERT INTO localidades VALUES("556","7","Chazón");
INSERT INTO localidades VALUES("557","7","Chilibroste");
INSERT INTO localidades VALUES("558","7","Chucul");
INSERT INTO localidades VALUES("559","7","Chuña");
INSERT INTO localidades VALUES("560","7","Chuña Huasi");
INSERT INTO localidades VALUES("561","7","Churqui Cañada");
INSERT INTO localidades VALUES("562","7","Cienaga Del Coro");
INSERT INTO localidades VALUES("563","7","Cintra");
INSERT INTO localidades VALUES("564","7","Col. Almada");
INSERT INTO localidades VALUES("565","7","Col. Anita");
INSERT INTO localidades VALUES("566","7","Col. Barge");
INSERT INTO localidades VALUES("567","7","Col. Bismark");
INSERT INTO localidades VALUES("568","7","Col. Bremen");
INSERT INTO localidades VALUES("569","7","Col. Caroya");
INSERT INTO localidades VALUES("570","7","Col. Italiana");
INSERT INTO localidades VALUES("571","7","Col. Iturraspe");
INSERT INTO localidades VALUES("572","7","Col. Las Cuatro Esquinas");
INSERT INTO localidades VALUES("573","7","Col. Las Pichanas");
INSERT INTO localidades VALUES("574","7","Col. Marina");
INSERT INTO localidades VALUES("575","7","Col. Prosperidad");
INSERT INTO localidades VALUES("576","7","Col. San Bartolome");
INSERT INTO localidades VALUES("577","7","Col. San Pedro");
INSERT INTO localidades VALUES("578","7","Col. Tirolesa");
INSERT INTO localidades VALUES("579","7","Col. Vicente Aguero");
INSERT INTO localidades VALUES("580","7","Col. Videla");
INSERT INTO localidades VALUES("581","7","Col. Vignaud");
INSERT INTO localidades VALUES("582","7","Col. Waltelina");
INSERT INTO localidades VALUES("583","7","Colazo");
INSERT INTO localidades VALUES("584","7","Comechingones");
INSERT INTO localidades VALUES("585","7","Conlara");
INSERT INTO localidades VALUES("586","7","Copacabana");
INSERT INTO localidades VALUES("587","7","7");
INSERT INTO localidades VALUES("588","7","Coronel Baigorria");
INSERT INTO localidades VALUES("589","7","Coronel Moldes");
INSERT INTO localidades VALUES("590","7","Corral de Bustos");
INSERT INTO localidades VALUES("591","7","Corralito");
INSERT INTO localidades VALUES("592","7","Cosquín");
INSERT INTO localidades VALUES("593","7","Costa Sacate");
INSERT INTO localidades VALUES("594","7","Cruz Alta");
INSERT INTO localidades VALUES("595","7","Cruz de Caña");
INSERT INTO localidades VALUES("596","7","Cruz del Eje");
INSERT INTO localidades VALUES("597","7","Cuesta Blanca");
INSERT INTO localidades VALUES("598","7","Dean Funes");
INSERT INTO localidades VALUES("599","7","Del Campillo");
INSERT INTO localidades VALUES("600","7","Despeñaderos");
INSERT INTO localidades VALUES("601","7","Devoto");
INSERT INTO localidades VALUES("602","7","Diego de Rojas");
INSERT INTO localidades VALUES("603","7","Dique Chico");
INSERT INTO localidades VALUES("604","7","El Arañado");
INSERT INTO localidades VALUES("605","7","El Brete");
INSERT INTO localidades VALUES("606","7","El Chacho");
INSERT INTO localidades VALUES("607","7","El Crispín");
INSERT INTO localidades VALUES("608","7","El Fortín");
INSERT INTO localidades VALUES("609","7","El Manzano");
INSERT INTO localidades VALUES("610","7","El Rastreador");
INSERT INTO localidades VALUES("611","7","El Rodeo");
INSERT INTO localidades VALUES("612","7","El Tío");
INSERT INTO localidades VALUES("613","7","Elena");
INSERT INTO localidades VALUES("614","7","Embalse");
INSERT INTO localidades VALUES("615","7","Esquina");
INSERT INTO localidades VALUES("616","7","Estación Gral. Paz");
INSERT INTO localidades VALUES("617","7","Estación Juárez Celman");
INSERT INTO localidades VALUES("618","7","Estancia de Guadalupe");
INSERT INTO localidades VALUES("619","7","Estancia Vieja");
INSERT INTO localidades VALUES("620","7","Etruria");
INSERT INTO localidades VALUES("621","7","Eufrasio Loza");
INSERT INTO localidades VALUES("622","7","Falda del Carmen");
INSERT INTO localidades VALUES("623","7","Freyre");
INSERT INTO localidades VALUES("624","7","Gral. Baldissera");
INSERT INTO localidades VALUES("625","7","Gral. Cabrera");
INSERT INTO localidades VALUES("626","7","Gral. Deheza");
INSERT INTO localidades VALUES("627","7","Gral. Fotheringham");
INSERT INTO localidades VALUES("628","7","Gral. Levalle");
INSERT INTO localidades VALUES("629","7","Gral. Roca");
INSERT INTO localidades VALUES("630","7","Guanaco Muerto");
INSERT INTO localidades VALUES("631","7","Guasapampa");
INSERT INTO localidades VALUES("632","7","Guatimozin");
INSERT INTO localidades VALUES("633","7","Gutenberg");
INSERT INTO localidades VALUES("634","7","Hernando");
INSERT INTO localidades VALUES("635","7","Huanchillas");
INSERT INTO localidades VALUES("636","7","Huerta Grande");
INSERT INTO localidades VALUES("637","7","Huinca Renanco");
INSERT INTO localidades VALUES("638","7","Idiazabal");
INSERT INTO localidades VALUES("639","7","Impira");
INSERT INTO localidades VALUES("640","7","Inriville");
INSERT INTO localidades VALUES("641","7","Isla Verde");
INSERT INTO localidades VALUES("642","7","Italó");
INSERT INTO localidades VALUES("643","7","James Craik");
INSERT INTO localidades VALUES("644","7","Jesús María");
INSERT INTO localidades VALUES("645","7","Jovita");
INSERT INTO localidades VALUES("646","7","Justiniano Posse");
INSERT INTO localidades VALUES("647","7","Km 658");
INSERT INTO localidades VALUES("648","7","L. V. Mansilla");
INSERT INTO localidades VALUES("649","7","La Batea");
INSERT INTO localidades VALUES("650","7","La Calera");
INSERT INTO localidades VALUES("651","7","La Carlota");
INSERT INTO localidades VALUES("652","7","La Carolina");
INSERT INTO localidades VALUES("653","7","La Cautiva");
INSERT INTO localidades VALUES("654","7","La Cesira");
INSERT INTO localidades VALUES("655","7","La Cruz");
INSERT INTO localidades VALUES("656","7","La Cumbre");
INSERT INTO localidades VALUES("657","7","La Cumbrecita");
INSERT INTO localidades VALUES("658","7","La Falda");
INSERT INTO localidades VALUES("659","7","La Francia");
INSERT INTO localidades VALUES("660","7","La Granja");
INSERT INTO localidades VALUES("661","7","La Higuera");
INSERT INTO localidades VALUES("662","7","La Laguna");
INSERT INTO localidades VALUES("663","7","La Paisanita");
INSERT INTO localidades VALUES("664","7","La Palestina");
INSERT INTO localidades VALUES("665","7","12");
INSERT INTO localidades VALUES("666","7","La Paquita");
INSERT INTO localidades VALUES("667","7","La Para");
INSERT INTO localidades VALUES("668","7","La Paz");
INSERT INTO localidades VALUES("669","7","La Playa");
INSERT INTO localidades VALUES("670","7","La Playosa");
INSERT INTO localidades VALUES("671","7","La Población");
INSERT INTO localidades VALUES("672","7","La Posta");
INSERT INTO localidades VALUES("673","7","La Puerta");
INSERT INTO localidades VALUES("674","7","La Quinta");
INSERT INTO localidades VALUES("675","7","La Rancherita");
INSERT INTO localidades VALUES("676","7","La Rinconada");
INSERT INTO localidades VALUES("677","7","La Serranita");
INSERT INTO localidades VALUES("678","7","La Tordilla");
INSERT INTO localidades VALUES("679","7","Laborde");
INSERT INTO localidades VALUES("680","7","Laboulaye");
INSERT INTO localidades VALUES("681","7","Laguna Larga");
INSERT INTO localidades VALUES("682","7","Las Acequias");
INSERT INTO localidades VALUES("683","7","Las Albahacas");
INSERT INTO localidades VALUES("684","7","Las Arrias");
INSERT INTO localidades VALUES("685","7","Las Bajadas");
INSERT INTO localidades VALUES("686","7","Las Caleras");
INSERT INTO localidades VALUES("687","7","Las Calles");
INSERT INTO localidades VALUES("688","7","Las Cañadas");
INSERT INTO localidades VALUES("689","7","Las Gramillas");
INSERT INTO localidades VALUES("690","7","Las Higueras");
INSERT INTO localidades VALUES("691","7","Las Isletillas");
INSERT INTO localidades VALUES("692","7","Las Junturas");
INSERT INTO localidades VALUES("693","7","Las Palmas");
INSERT INTO localidades VALUES("694","7","Las Peñas");
INSERT INTO localidades VALUES("695","7","Las Peñas Sud");
INSERT INTO localidades VALUES("696","7","Las Perdices");
INSERT INTO localidades VALUES("697","7","Las Playas");
INSERT INTO localidades VALUES("698","7","Las Rabonas");
INSERT INTO localidades VALUES("699","7","Las Saladas");
INSERT INTO localidades VALUES("700","7","Las Tapias");
INSERT INTO localidades VALUES("701","7","Las Varas");
INSERT INTO localidades VALUES("702","7","Las Varillas");
INSERT INTO localidades VALUES("703","7","Las Vertientes");
INSERT INTO localidades VALUES("704","7","Leguizamón");
INSERT INTO localidades VALUES("705","7","Leones");
INSERT INTO localidades VALUES("706","7","Los Cedros");
INSERT INTO localidades VALUES("707","7","Los Cerrillos");
INSERT INTO localidades VALUES("708","7","Los Chañaritos (C.E)");
INSERT INTO localidades VALUES("709","7","Los Chanaritos (R.S)");
INSERT INTO localidades VALUES("710","7","Los Cisnes");
INSERT INTO localidades VALUES("711","7","Los Cocos");
INSERT INTO localidades VALUES("712","7","Los Cóndores");
INSERT INTO localidades VALUES("713","7","Los Hornillos");
INSERT INTO localidades VALUES("714","7","Los Hoyos");
INSERT INTO localidades VALUES("715","7","Los Mistoles");
INSERT INTO localidades VALUES("716","7","Los Molinos");
INSERT INTO localidades VALUES("717","7","Los Pozos");
INSERT INTO localidades VALUES("718","7","Los Reartes");
INSERT INTO localidades VALUES("719","7","Los Surgentes");
INSERT INTO localidades VALUES("720","7","Los Talares");
INSERT INTO localidades VALUES("721","7","Los Zorros");
INSERT INTO localidades VALUES("722","7","Lozada");
INSERT INTO localidades VALUES("723","7","Luca");
INSERT INTO localidades VALUES("724","7","Luque");
INSERT INTO localidades VALUES("725","7","Luyaba");
INSERT INTO localidades VALUES("726","7","Malagueño");
INSERT INTO localidades VALUES("727","7","Malena");
INSERT INTO localidades VALUES("728","7","Malvinas Argentinas");
INSERT INTO localidades VALUES("729","7","Manfredi");
INSERT INTO localidades VALUES("730","7","Maquinista Gallini");
INSERT INTO localidades VALUES("731","7","Marcos Juárez");
INSERT INTO localidades VALUES("732","7","Marull");
INSERT INTO localidades VALUES("733","7","Matorrales");
INSERT INTO localidades VALUES("734","7","Mattaldi");
INSERT INTO localidades VALUES("735","7","Mayu Sumaj");
INSERT INTO localidades VALUES("736","7","Media Naranja");
INSERT INTO localidades VALUES("737","7","Melo");
INSERT INTO localidades VALUES("738","7","Mendiolaza");
INSERT INTO localidades VALUES("739","7","Mi Granja");
INSERT INTO localidades VALUES("740","7","Mina Clavero");
INSERT INTO localidades VALUES("741","7","Miramar");
INSERT INTO localidades VALUES("742","7","Morrison");
INSERT INTO localidades VALUES("743","7","Morteros");
INSERT INTO localidades VALUES("744","7","Mte. Buey");
INSERT INTO localidades VALUES("745","7","Mte. Cristo");
INSERT INTO localidades VALUES("746","7","Mte. De Los Gauchos");
INSERT INTO localidades VALUES("747","7","Mte. Leña");
INSERT INTO localidades VALUES("748","7","Mte. Maíz");
INSERT INTO localidades VALUES("749","7","Mte. Ralo");
INSERT INTO localidades VALUES("750","7","Nicolás Bruzone");
INSERT INTO localidades VALUES("751","7","Noetinger");
INSERT INTO localidades VALUES("752","7","Nono");
INSERT INTO localidades VALUES("753","7","Nueva 7");
INSERT INTO localidades VALUES("754","7","Obispo Trejo");
INSERT INTO localidades VALUES("755","7","Olaeta");
INSERT INTO localidades VALUES("756","7","Oliva");
INSERT INTO localidades VALUES("757","7","Olivares San Nicolás");
INSERT INTO localidades VALUES("758","7","Onagolty");
INSERT INTO localidades VALUES("759","7","Oncativo");
INSERT INTO localidades VALUES("760","7","Ordoñez");
INSERT INTO localidades VALUES("761","7","Pacheco De Melo");
INSERT INTO localidades VALUES("762","7","Pampayasta N.");
INSERT INTO localidades VALUES("763","7","Pampayasta S.");
INSERT INTO localidades VALUES("764","7","Panaholma");
INSERT INTO localidades VALUES("765","7","Pascanas");
INSERT INTO localidades VALUES("766","7","Pasco");
INSERT INTO localidades VALUES("767","7","Paso del Durazno");
INSERT INTO localidades VALUES("768","7","Paso Viejo");
INSERT INTO localidades VALUES("769","7","Pilar");
INSERT INTO localidades VALUES("770","7","Pincén");
INSERT INTO localidades VALUES("771","7","Piquillín");
INSERT INTO localidades VALUES("772","7","Plaza de Mercedes");
INSERT INTO localidades VALUES("773","7","Plaza Luxardo");
INSERT INTO localidades VALUES("774","7","Porteña");
INSERT INTO localidades VALUES("775","7","Potrero de Garay");
INSERT INTO localidades VALUES("776","7","Pozo del Molle");
INSERT INTO localidades VALUES("777","7","Pozo Nuevo");
INSERT INTO localidades VALUES("778","7","Pueblo Italiano");
INSERT INTO localidades VALUES("779","7","Puesto de Castro");
INSERT INTO localidades VALUES("780","7","Punta del Agua");
INSERT INTO localidades VALUES("781","7","Quebracho Herrado");
INSERT INTO localidades VALUES("782","7","Quilino");
INSERT INTO localidades VALUES("783","7","Rafael García");
INSERT INTO localidades VALUES("784","7","Ranqueles");
INSERT INTO localidades VALUES("785","7","Rayo Cortado");
INSERT INTO localidades VALUES("786","7","Reducción");
INSERT INTO localidades VALUES("787","7","Rincón");
INSERT INTO localidades VALUES("788","7","Río Bamba");
INSERT INTO localidades VALUES("789","7","Río Ceballos");
INSERT INTO localidades VALUES("790","7","Río Cuarto");
INSERT INTO localidades VALUES("791","7","Río de Los Sauces");
INSERT INTO localidades VALUES("792","7","Río Primero");
INSERT INTO localidades VALUES("793","7","Río Segundo");
INSERT INTO localidades VALUES("794","7","Río Tercero");
INSERT INTO localidades VALUES("795","7","Rosales");
INSERT INTO localidades VALUES("796","7","Rosario del Saladillo");
INSERT INTO localidades VALUES("797","7","Sacanta");
INSERT INTO localidades VALUES("798","7","Sagrada Familia");
INSERT INTO localidades VALUES("799","7","Saira");
INSERT INTO localidades VALUES("800","7","Saladillo");
INSERT INTO localidades VALUES("801","7","Saldán");
INSERT INTO localidades VALUES("802","7","Salsacate");
INSERT INTO localidades VALUES("803","7","Salsipuedes");
INSERT INTO localidades VALUES("804","7","Sampacho");
INSERT INTO localidades VALUES("805","7","San Agustín");
INSERT INTO localidades VALUES("806","7","San Antonio de Arredondo");
INSERT INTO localidades VALUES("807","7","San Antonio de Litín");
INSERT INTO localidades VALUES("808","7","San Basilio");
INSERT INTO localidades VALUES("809","7","San Carlos Minas");
INSERT INTO localidades VALUES("810","7","San Clemente");
INSERT INTO localidades VALUES("811","7","San Esteban");
INSERT INTO localidades VALUES("812","7","San Francisco");
INSERT INTO localidades VALUES("813","7","San Ignacio");
INSERT INTO localidades VALUES("814","7","San Javier");
INSERT INTO localidades VALUES("815","7","San Jerónimo");
INSERT INTO localidades VALUES("816","7","San Joaquín");
INSERT INTO localidades VALUES("817","7","San José de La Dormida");
INSERT INTO localidades VALUES("818","7","San José de Las Salinas");
INSERT INTO localidades VALUES("819","7","San Lorenzo");
INSERT INTO localidades VALUES("820","7","San Marcos Sierras");
INSERT INTO localidades VALUES("821","7","San Marcos Sud");
INSERT INTO localidades VALUES("822","7","San Pedro");
INSERT INTO localidades VALUES("823","7","San Pedro N.");
INSERT INTO localidades VALUES("824","7","San Roque");
INSERT INTO localidades VALUES("825","7","San Vicente");
INSERT INTO localidades VALUES("826","7","Santa Catalina");
INSERT INTO localidades VALUES("827","7","Santa Elena");
INSERT INTO localidades VALUES("828","7","Santa Eufemia");
INSERT INTO localidades VALUES("829","7","Santa Maria");
INSERT INTO localidades VALUES("830","7","Sarmiento");
INSERT INTO localidades VALUES("831","7","Saturnino M.Laspiur");
INSERT INTO localidades VALUES("832","7","Sauce Arriba");
INSERT INTO localidades VALUES("833","7","Sebastián Elcano");
INSERT INTO localidades VALUES("834","7","Seeber");
INSERT INTO localidades VALUES("835","7","Segunda Usina");
INSERT INTO localidades VALUES("836","7","Serrano");
INSERT INTO localidades VALUES("837","7","Serrezuela");
INSERT INTO localidades VALUES("838","7","Sgo. Temple");
INSERT INTO localidades VALUES("839","7","Silvio Pellico");
INSERT INTO localidades VALUES("840","7","Simbolar");
INSERT INTO localidades VALUES("841","7","Sinsacate");
INSERT INTO localidades VALUES("842","7","Sta. Rosa de Calamuchita");
INSERT INTO localidades VALUES("843","7","Sta. Rosa de Río Primero");
INSERT INTO localidades VALUES("844","7","Suco");
INSERT INTO localidades VALUES("845","7","Tala Cañada");
INSERT INTO localidades VALUES("846","7","Tala Huasi");
INSERT INTO localidades VALUES("847","7","Talaini");
INSERT INTO localidades VALUES("848","7","Tancacha");
INSERT INTO localidades VALUES("849","7","Tanti");
INSERT INTO localidades VALUES("850","7","Ticino");
INSERT INTO localidades VALUES("851","7","Tinoco");
INSERT INTO localidades VALUES("852","7","Tío Pujio");
INSERT INTO localidades VALUES("853","7","Toledo");
INSERT INTO localidades VALUES("854","7","Toro Pujio");
INSERT INTO localidades VALUES("855","7","Tosno");
INSERT INTO localidades VALUES("856","7","Tosquita");
INSERT INTO localidades VALUES("857","7","Tránsito");
INSERT INTO localidades VALUES("858","7","Tuclame");
INSERT INTO localidades VALUES("859","7","Tutti");
INSERT INTO localidades VALUES("860","7","Ucacha");
INSERT INTO localidades VALUES("861","7","Unquillo");
INSERT INTO localidades VALUES("862","7","Valle de Anisacate");
INSERT INTO localidades VALUES("863","7","Valle Hermoso");
INSERT INTO localidades VALUES("864","7","Vélez Sarfield");
INSERT INTO localidades VALUES("865","7","Viamonte");
INSERT INTO localidades VALUES("866","7","Vicuña Mackenna");
INSERT INTO localidades VALUES("867","7","Villa Allende");
INSERT INTO localidades VALUES("868","7","Villa Amancay");
INSERT INTO localidades VALUES("869","7","Villa Ascasubi");
INSERT INTO localidades VALUES("870","7","Villa Candelaria N.");
INSERT INTO localidades VALUES("871","7","Villa Carlos Paz");
INSERT INTO localidades VALUES("872","7","Villa Cerro Azul");
INSERT INTO localidades VALUES("873","7","Villa Ciudad de América");
INSERT INTO localidades VALUES("874","7","Villa Ciudad Pque Los Reartes");
INSERT INTO localidades VALUES("875","7","Villa Concepción del Tío");
INSERT INTO localidades VALUES("876","7","Villa Cura Brochero");
INSERT INTO localidades VALUES("877","7","Villa de Las Rosas");
INSERT INTO localidades VALUES("878","7","Villa de María");
INSERT INTO localidades VALUES("879","7","Villa de Pocho");
INSERT INTO localidades VALUES("880","7","Villa de Soto");
INSERT INTO localidades VALUES("881","7","Villa del Dique");
INSERT INTO localidades VALUES("882","7","Villa del Prado");
INSERT INTO localidades VALUES("883","7","Villa del Rosario");
INSERT INTO localidades VALUES("884","7","Villa del Totoral");
INSERT INTO localidades VALUES("885","7","Villa Dolores");
INSERT INTO localidades VALUES("886","7","Villa El Chancay");
INSERT INTO localidades VALUES("887","7","Villa Elisa");
INSERT INTO localidades VALUES("888","7","Villa Flor Serrana");
INSERT INTO localidades VALUES("889","7","Villa Fontana");
INSERT INTO localidades VALUES("890","7","Villa Giardino");
INSERT INTO localidades VALUES("891","7","Villa Gral. Belgrano");
INSERT INTO localidades VALUES("892","7","Villa Gutierrez");
INSERT INTO localidades VALUES("893","7","Villa Huidobro");
INSERT INTO localidades VALUES("894","7","Villa La Bolsa");
INSERT INTO localidades VALUES("895","7","Villa Los Aromos");
INSERT INTO localidades VALUES("896","7","Villa Los Patos");
INSERT INTO localidades VALUES("897","7","Villa María");
INSERT INTO localidades VALUES("898","7","Villa Nueva");
INSERT INTO localidades VALUES("899","7","Villa Pque. Santa Ana");
INSERT INTO localidades VALUES("900","7","Villa Pque. Siquiman");
INSERT INTO localidades VALUES("901","7","Villa Quillinzo");
INSERT INTO localidades VALUES("902","7","Villa Rossi");
INSERT INTO localidades VALUES("903","7","Villa Rumipal");
INSERT INTO localidades VALUES("904","7","Villa San Esteban");
INSERT INTO localidades VALUES("905","7","Villa San Isidro");
INSERT INTO localidades VALUES("906","7","Villa 21");
INSERT INTO localidades VALUES("907","7","Villa Sarmiento (G.R)");
INSERT INTO localidades VALUES("908","7","Villa Sarmiento (S.A)");
INSERT INTO localidades VALUES("909","7","Villa Tulumba");
INSERT INTO localidades VALUES("910","7","Villa Valeria");
INSERT INTO localidades VALUES("911","7","Villa Yacanto");
INSERT INTO localidades VALUES("912","7","Washington");
INSERT INTO localidades VALUES("913","7","Wenceslao Escalante");
INSERT INTO localidades VALUES("914","7","Ycho Cruz Sierras");
INSERT INTO localidades VALUES("915","8","Alvear");
INSERT INTO localidades VALUES("916","8","Bella Vista");
INSERT INTO localidades VALUES("917","8","Berón de Astrada");
INSERT INTO localidades VALUES("918","8","Bonpland");
INSERT INTO localidades VALUES("919","8","Caá Cati");
INSERT INTO localidades VALUES("920","8","Capital");
INSERT INTO localidades VALUES("921","8","Chavarría");
INSERT INTO localidades VALUES("922","8","Col. C. Pellegrini");
INSERT INTO localidades VALUES("923","8","Col. Libertad");
INSERT INTO localidades VALUES("924","8","Col. Liebig");
INSERT INTO localidades VALUES("925","8","Col. Sta Rosa");
INSERT INTO localidades VALUES("926","8","Concepción");
INSERT INTO localidades VALUES("927","8","Cruz de Los Milagros");
INSERT INTO localidades VALUES("928","8","Curuzú-Cuatiá");
INSERT INTO localidades VALUES("929","8","Empedrado");
INSERT INTO localidades VALUES("930","8","Esquina");
INSERT INTO localidades VALUES("931","8","Estación Torrent");
INSERT INTO localidades VALUES("932","8","Felipe Yofré");
INSERT INTO localidades VALUES("933","8","Garruchos");
INSERT INTO localidades VALUES("934","8","Gdor. Agrónomo");
INSERT INTO localidades VALUES("935","8","Gdor. Martínez");
INSERT INTO localidades VALUES("936","8","Goya");
INSERT INTO localidades VALUES("937","8","Guaviravi");
INSERT INTO localidades VALUES("938","8","Herlitzka");
INSERT INTO localidades VALUES("939","8","Ita-Ibate");
INSERT INTO localidades VALUES("940","8","Itatí");
INSERT INTO localidades VALUES("941","8","Ituzaingó");
INSERT INTO localidades VALUES("942","8","José Rafael Gómez");
INSERT INTO localidades VALUES("943","8","Juan Pujol");
INSERT INTO localidades VALUES("944","8","La Cruz");
INSERT INTO localidades VALUES("945","8","Lavalle");
INSERT INTO localidades VALUES("946","8","Lomas de Vallejos");
INSERT INTO localidades VALUES("947","8","Loreto");
INSERT INTO localidades VALUES("948","8","Mariano I. Loza");
INSERT INTO localidades VALUES("949","8","Mburucuyá");
INSERT INTO localidades VALUES("950","8","Mercedes");
INSERT INTO localidades VALUES("951","8","Mocoretá");
INSERT INTO localidades VALUES("952","8","Mte. Caseros");
INSERT INTO localidades VALUES("953","8","Nueve de Julio");
INSERT INTO localidades VALUES("954","8","Palmar Grande");
INSERT INTO localidades VALUES("955","8","Parada Pucheta");
INSERT INTO localidades VALUES("956","8","Paso de La Patria");
INSERT INTO localidades VALUES("957","8","Paso de Los Libres");
INSERT INTO localidades VALUES("958","8","Pedro R. Fernandez");
INSERT INTO localidades VALUES("959","8","Perugorría");
INSERT INTO localidades VALUES("960","8","Pueblo Libertador");
INSERT INTO localidades VALUES("961","8","Ramada Paso");
INSERT INTO localidades VALUES("962","8","Riachuelo");
INSERT INTO localidades VALUES("963","8","Saladas");
INSERT INTO localidades VALUES("964","8","San Antonio");
INSERT INTO localidades VALUES("965","8","San Carlos");
INSERT INTO localidades VALUES("966","8","San Cosme");
INSERT INTO localidades VALUES("967","8","San Lorenzo");
INSERT INTO localidades VALUES("968","8","20 del Palmar");
INSERT INTO localidades VALUES("969","8","San Miguel");
INSERT INTO localidades VALUES("970","8","San Roque");
INSERT INTO localidades VALUES("971","8","Santa Ana");
INSERT INTO localidades VALUES("972","8","Santa Lucía");
INSERT INTO localidades VALUES("973","8","Santo Tomé");
INSERT INTO localidades VALUES("974","8","Sauce");
INSERT INTO localidades VALUES("975","8","Tabay");
INSERT INTO localidades VALUES("976","8","Tapebicuá");
INSERT INTO localidades VALUES("977","8","Tatacua");
INSERT INTO localidades VALUES("978","8","Virasoro");
INSERT INTO localidades VALUES("979","8","Yapeyú");
INSERT INTO localidades VALUES("980","8","Yataití Calle");
INSERT INTO localidades VALUES("981","9","Alarcón");
INSERT INTO localidades VALUES("982","9","Alcaraz");
INSERT INTO localidades VALUES("983","9","Alcaraz N.");
INSERT INTO localidades VALUES("984","9","Alcaraz S.");
INSERT INTO localidades VALUES("985","9","Aldea Asunción");
INSERT INTO localidades VALUES("986","9","Aldea Brasilera");
INSERT INTO localidades VALUES("987","9","Aldea Elgenfeld");
INSERT INTO localidades VALUES("988","9","Aldea Grapschental");
INSERT INTO localidades VALUES("989","9","Aldea Ma. Luisa");
INSERT INTO localidades VALUES("990","9","Aldea Protestante");
INSERT INTO localidades VALUES("991","9","Aldea Salto");
INSERT INTO localidades VALUES("992","9","Aldea San Antonio (G)");
INSERT INTO localidades VALUES("993","9","Aldea San Antonio (P)");
INSERT INTO localidades VALUES("994","9","Aldea 19");
INSERT INTO localidades VALUES("995","9","Aldea San Miguel");
INSERT INTO localidades VALUES("996","9","Aldea San Rafael");
INSERT INTO localidades VALUES("997","9","Aldea Spatzenkutter");
INSERT INTO localidades VALUES("998","9","Aldea Sta. María");
INSERT INTO localidades VALUES("999","9","Aldea Sta. Rosa");
INSERT INTO localidades VALUES("1000","9","Aldea Valle María");
INSERT INTO localidades VALUES("1001","9","Altamirano Sur");
INSERT INTO localidades VALUES("1002","9","Antelo");
INSERT INTO localidades VALUES("1003","9","Antonio Tomás");
INSERT INTO localidades VALUES("1004","9","Aranguren");
INSERT INTO localidades VALUES("1005","9","Arroyo Barú");
INSERT INTO localidades VALUES("1006","9","Arroyo Burgos");
INSERT INTO localidades VALUES("1007","9","Arroyo Clé");
INSERT INTO localidades VALUES("1008","9","Arroyo Corralito");
INSERT INTO localidades VALUES("1009","9","Arroyo del Medio");
INSERT INTO localidades VALUES("1010","9","Arroyo Maturrango");
INSERT INTO localidades VALUES("1011","9","Arroyo Palo Seco");
INSERT INTO localidades VALUES("1012","9","Banderas");
INSERT INTO localidades VALUES("1013","9","Basavilbaso");
INSERT INTO localidades VALUES("1014","9","Betbeder");
INSERT INTO localidades VALUES("1015","9","Bovril");
INSERT INTO localidades VALUES("1016","9","Caseros");
INSERT INTO localidades VALUES("1017","9","Ceibas");
INSERT INTO localidades VALUES("1018","9","Cerrito");
INSERT INTO localidades VALUES("1019","9","Chajarí");
INSERT INTO localidades VALUES("1020","9","Chilcas");
INSERT INTO localidades VALUES("1021","9","Clodomiro Ledesma");
INSERT INTO localidades VALUES("1022","9","Col. Alemana");
INSERT INTO localidades VALUES("1023","9","Col. Avellaneda");
INSERT INTO localidades VALUES("1024","9","Col. Avigdor");
INSERT INTO localidades VALUES("1025","9","Col. Ayuí");
INSERT INTO localidades VALUES("1026","9","Col. Baylina");
INSERT INTO localidades VALUES("1027","9","Col. Carrasco");
INSERT INTO localidades VALUES("1028","9","Col. Celina");
INSERT INTO localidades VALUES("1029","9","Col. Cerrito");
INSERT INTO localidades VALUES("1030","9","Col. Crespo");
INSERT INTO localidades VALUES("1031","9","Col. Elia");
INSERT INTO localidades VALUES("1032","9","Col. Ensayo");
INSERT INTO localidades VALUES("1033","9","Col. Gral. Roca");
INSERT INTO localidades VALUES("1034","9","Col. La Argentina");
INSERT INTO localidades VALUES("1035","9","Col. Merou");
INSERT INTO localidades VALUES("1036","9","Col. Oficial Nª3");
INSERT INTO localidades VALUES("1037","9","Col. Oficial Nº13");
INSERT INTO localidades VALUES("1038","9","Col. Oficial Nº14");
INSERT INTO localidades VALUES("1039","9","Col. Oficial Nº5");
INSERT INTO localidades VALUES("1040","9","Col. Reffino");
INSERT INTO localidades VALUES("1041","9","Col. Tunas");
INSERT INTO localidades VALUES("1042","9","Col. Viraró");
INSERT INTO localidades VALUES("1043","9","Colón");
INSERT INTO localidades VALUES("1044","9","Concepción del Uruguay");
INSERT INTO localidades VALUES("1045","9","Concordia");
INSERT INTO localidades VALUES("1046","9","Conscripto Bernardi");
INSERT INTO localidades VALUES("1047","9","Costa Grande");
INSERT INTO localidades VALUES("1048","9","Costa San Antonio");
INSERT INTO localidades VALUES("1049","9","Costa Uruguay N.");
INSERT INTO localidades VALUES("1050","9","Costa Uruguay S.");
INSERT INTO localidades VALUES("1051","9","Crespo");
INSERT INTO localidades VALUES("1052","9","Crucecitas 3ª");
INSERT INTO localidades VALUES("1053","9","Crucecitas 7ª");
INSERT INTO localidades VALUES("1054","9","Crucecitas 8ª");
INSERT INTO localidades VALUES("1055","9","Cuchilla Redonda");
INSERT INTO localidades VALUES("1056","9","Curtiembre");
INSERT INTO localidades VALUES("1057","9","Diamante");
INSERT INTO localidades VALUES("1058","9","Distrito 6º");
INSERT INTO localidades VALUES("1059","9","Distrito Chañar");
INSERT INTO localidades VALUES("1060","9","Distrito Chiqueros");
INSERT INTO localidades VALUES("1061","9","Distrito Cuarto");
INSERT INTO localidades VALUES("1062","9","Distrito Diego López");
INSERT INTO localidades VALUES("1063","9","Distrito Pajonal");
INSERT INTO localidades VALUES("1064","9","Distrito Sauce");
INSERT INTO localidades VALUES("1065","9","Distrito Tala");
INSERT INTO localidades VALUES("1066","9","Distrito Talitas");
INSERT INTO localidades VALUES("1067","9","Don Cristóbal 1ª Sección");
INSERT INTO localidades VALUES("1068","9","Don Cristóbal 2ª Sección");
INSERT INTO localidades VALUES("1069","9","Durazno");
INSERT INTO localidades VALUES("1070","9","El Cimarrón");
INSERT INTO localidades VALUES("1071","9","El Gramillal");
INSERT INTO localidades VALUES("1072","9","El Palenque");
INSERT INTO localidades VALUES("1073","9","El Pingo");
INSERT INTO localidades VALUES("1074","9","El Quebracho");
INSERT INTO localidades VALUES("1075","9","El Redomón");
INSERT INTO localidades VALUES("1076","9","El Solar");
INSERT INTO localidades VALUES("1077","9","Enrique Carbo");
INSERT INTO localidades VALUES("1078","9","9");
INSERT INTO localidades VALUES("1079","9","Espinillo N.");
INSERT INTO localidades VALUES("1080","9","Estación Campos");
INSERT INTO localidades VALUES("1081","9","Estación Escriña");
INSERT INTO localidades VALUES("1082","9","Estación Lazo");
INSERT INTO localidades VALUES("1083","9","Estación Raíces");
INSERT INTO localidades VALUES("1084","9","Estación Yerúa");
INSERT INTO localidades VALUES("1085","9","Estancia Grande");
INSERT INTO localidades VALUES("1086","9","Estancia Líbaros");
INSERT INTO localidades VALUES("1087","9","Estancia Racedo");
INSERT INTO localidades VALUES("1088","9","Estancia Solá");
INSERT INTO localidades VALUES("1089","9","Estancia Yuquerí");
INSERT INTO localidades VALUES("1090","9","Estaquitas");
INSERT INTO localidades VALUES("1091","9","Faustino M. Parera");
INSERT INTO localidades VALUES("1092","9","Febre");
INSERT INTO localidades VALUES("1093","9","Federación");
INSERT INTO localidades VALUES("1094","9","Federal");
INSERT INTO localidades VALUES("1095","9","Gdor. Echagüe");
INSERT INTO localidades VALUES("1096","9","Gdor. Mansilla");
INSERT INTO localidades VALUES("1097","9","Gilbert");
INSERT INTO localidades VALUES("1098","9","González Calderón");
INSERT INTO localidades VALUES("1099","9","Gral. Almada");
INSERT INTO localidades VALUES("1100","9","Gral. Alvear");
INSERT INTO localidades VALUES("1101","9","Gral. Campos");
INSERT INTO localidades VALUES("1102","9","Gral. Galarza");
INSERT INTO localidades VALUES("1103","9","Gral. Ramírez");
INSERT INTO localidades VALUES("1104","9","Gualeguay");
INSERT INTO localidades VALUES("1105","9","Gualeguaychú");
INSERT INTO localidades VALUES("1106","9","Gualeguaycito");
INSERT INTO localidades VALUES("1107","9","Guardamonte");
INSERT INTO localidades VALUES("1108","9","Hambis");
INSERT INTO localidades VALUES("1109","9","Hasenkamp");
INSERT INTO localidades VALUES("1110","9","Hernandarias");
INSERT INTO localidades VALUES("1111","9","Hernández");
INSERT INTO localidades VALUES("1112","9","Herrera");
INSERT INTO localidades VALUES("1113","9","Hinojal");
INSERT INTO localidades VALUES("1114","9","Hocker");
INSERT INTO localidades VALUES("1115","9","Ing. Sajaroff");
INSERT INTO localidades VALUES("1116","9","Irazusta");
INSERT INTO localidades VALUES("1117","9","Isletas");
INSERT INTO localidades VALUES("1118","9","J.J De Urquiza");
INSERT INTO localidades VALUES("1119","9","Jubileo");
INSERT INTO localidades VALUES("1120","9","La Clarita");
INSERT INTO localidades VALUES("1121","9","La Criolla");
INSERT INTO localidades VALUES("1122","9","La Esmeralda");
INSERT INTO localidades VALUES("1123","9","La Florida");
INSERT INTO localidades VALUES("1124","9","La Fraternidad");
INSERT INTO localidades VALUES("1125","9","La Hierra");
INSERT INTO localidades VALUES("1126","9","La Ollita");
INSERT INTO localidades VALUES("1127","9","La Paz");
INSERT INTO localidades VALUES("1128","9","La Picada");
INSERT INTO localidades VALUES("1129","9","La Providencia");
INSERT INTO localidades VALUES("1130","9","La Verbena");
INSERT INTO localidades VALUES("1131","9","Laguna Benítez");
INSERT INTO localidades VALUES("1132","9","Larroque");
INSERT INTO localidades VALUES("1133","9","Las Cuevas");
INSERT INTO localidades VALUES("1134","9","Las Garzas");
INSERT INTO localidades VALUES("1135","9","Las Guachas");
INSERT INTO localidades VALUES("1136","9","Las Mercedes");
INSERT INTO localidades VALUES("1137","9","Las Moscas");
INSERT INTO localidades VALUES("1138","9","Las Mulitas");
INSERT INTO localidades VALUES("1139","9","Las Toscas");
INSERT INTO localidades VALUES("1140","9","Laurencena");
INSERT INTO localidades VALUES("1141","9","Libertador San Martín");
INSERT INTO localidades VALUES("1142","9","Loma Limpia");
INSERT INTO localidades VALUES("1143","9","Los Ceibos");
INSERT INTO localidades VALUES("1144","9","Los Charruas");
INSERT INTO localidades VALUES("1145","9","Los Conquistadores");
INSERT INTO localidades VALUES("1146","9","Lucas González");
INSERT INTO localidades VALUES("1147","9","Lucas N.");
INSERT INTO localidades VALUES("1148","9","Lucas S. 1ª");
INSERT INTO localidades VALUES("1149","9","Lucas S. 2ª");
INSERT INTO localidades VALUES("1150","9","Maciá");
INSERT INTO localidades VALUES("1151","9","María Grande");
INSERT INTO localidades VALUES("1152","9","María Grande 2ª");
INSERT INTO localidades VALUES("1153","9","Médanos");
INSERT INTO localidades VALUES("1154","9","Mojones N.");
INSERT INTO localidades VALUES("1155","9","Mojones S.");
INSERT INTO localidades VALUES("1156","9","Molino Doll");
INSERT INTO localidades VALUES("1157","9","Monte Redondo");
INSERT INTO localidades VALUES("1158","9","Montoya");
INSERT INTO localidades VALUES("1159","9","Mulas Grandes");
INSERT INTO localidades VALUES("1160","9","Ñancay");
INSERT INTO localidades VALUES("1161","9","Nogoyá");
INSERT INTO localidades VALUES("1162","9","Nueva Escocia");
INSERT INTO localidades VALUES("1163","9","Nueva Vizcaya");
INSERT INTO localidades VALUES("1164","9","Ombú");
INSERT INTO localidades VALUES("1165","9","Oro Verde");
INSERT INTO localidades VALUES("1166","9","Paraná");
INSERT INTO localidades VALUES("1167","9","Pasaje Guayaquil");
INSERT INTO localidades VALUES("1168","9","Pasaje Las Tunas");
INSERT INTO localidades VALUES("1169","9","Paso de La Arena");
INSERT INTO localidades VALUES("1170","9","Paso de La Laguna");
INSERT INTO localidades VALUES("1171","9","Paso de Las Piedras");
INSERT INTO localidades VALUES("1172","9","Paso Duarte");
INSERT INTO localidades VALUES("1173","9","Pastor Britos");
INSERT INTO localidades VALUES("1174","9","Pedernal");
INSERT INTO localidades VALUES("1175","9","Perdices");
INSERT INTO localidades VALUES("1176","9","Picada Berón");
INSERT INTO localidades VALUES("1177","9","Piedras Blancas");
INSERT INTO localidades VALUES("1178","9","Primer Distrito Cuchilla");
INSERT INTO localidades VALUES("1179","9","Primero de Mayo");
INSERT INTO localidades VALUES("1180","9","Pronunciamiento");
INSERT INTO localidades VALUES("1181","9","Pto. Algarrobo");
INSERT INTO localidades VALUES("1182","9","Pto. Ibicuy");
INSERT INTO localidades VALUES("1183","9","Pueblo Brugo");
INSERT INTO localidades VALUES("1184","9","Pueblo Cazes");
INSERT INTO localidades VALUES("1185","9","Pueblo Gral. Belgrano");
INSERT INTO localidades VALUES("1186","9","Pueblo Liebig");
INSERT INTO localidades VALUES("1187","9","Puerto Yeruá");
INSERT INTO localidades VALUES("1188","9","Punta del Monte");
INSERT INTO localidades VALUES("1189","9","Quebracho");
INSERT INTO localidades VALUES("1190","9","Quinto Distrito");
INSERT INTO localidades VALUES("1191","9","Raices Oeste");
INSERT INTO localidades VALUES("1192","9","Rincón de Nogoyá");
INSERT INTO localidades VALUES("1193","9","Rincón del Cinto");
INSERT INTO localidades VALUES("1194","9","Rincón del Doll");
INSERT INTO localidades VALUES("1195","9","Rincón del Gato");
INSERT INTO localidades VALUES("1196","9","Rocamora");
INSERT INTO localidades VALUES("1197","9","Rosario del Tala");
INSERT INTO localidades VALUES("1198","9","San Benito");
INSERT INTO localidades VALUES("1199","9","San Cipriano");
INSERT INTO localidades VALUES("1200","9","San Ernesto");
INSERT INTO localidades VALUES("1201","9","San Gustavo");
INSERT INTO localidades VALUES("1202","9","San Jaime");
INSERT INTO localidades VALUES("1203","9","San José");
INSERT INTO localidades VALUES("1204","9","San José de Feliciano");
INSERT INTO localidades VALUES("1205","9","San Justo");
INSERT INTO localidades VALUES("1206","9","San Marcial");
INSERT INTO localidades VALUES("1207","9","San Pedro");
INSERT INTO localidades VALUES("1208","9","San Ramírez");
INSERT INTO localidades VALUES("1209","9","San Ramón");
INSERT INTO localidades VALUES("1210","9","San Roque");
INSERT INTO localidades VALUES("1211","9","San Salvador");
INSERT INTO localidades VALUES("1212","9","San Víctor");
INSERT INTO localidades VALUES("1213","9","Santa Ana");
INSERT INTO localidades VALUES("1214","9","Santa Anita");
INSERT INTO localidades VALUES("1215","9","Santa Elena");
INSERT INTO localidades VALUES("1216","9","Santa Lucía");
INSERT INTO localidades VALUES("1217","9","Santa Luisa");
INSERT INTO localidades VALUES("1218","9","Sauce de Luna");
INSERT INTO localidades VALUES("1219","9","Sauce Montrull");
INSERT INTO localidades VALUES("1220","9","Sauce Pinto");
INSERT INTO localidades VALUES("1221","9","Sauce Sur");
INSERT INTO localidades VALUES("1222","9","Seguí");
INSERT INTO localidades VALUES("1223","9","Sir Leonard");
INSERT INTO localidades VALUES("1224","9","Sosa");
INSERT INTO localidades VALUES("1225","9","Tabossi");
INSERT INTO localidades VALUES("1226","9","Tezanos Pinto");
INSERT INTO localidades VALUES("1227","9","Ubajay");
INSERT INTO localidades VALUES("1228","9","Urdinarrain");
INSERT INTO localidades VALUES("1229","9","Veinte de Septiembre");
INSERT INTO localidades VALUES("1230","9","Viale");
INSERT INTO localidades VALUES("1231","9","Victoria");
INSERT INTO localidades VALUES("1232","9","Villa Clara");
INSERT INTO localidades VALUES("1233","9","Villa del Rosario");
INSERT INTO localidades VALUES("1234","9","Villa Domínguez");
INSERT INTO localidades VALUES("1235","9","Villa Elisa");
INSERT INTO localidades VALUES("1236","9","Villa Fontana");
INSERT INTO localidades VALUES("1237","9","Villa Gdor. Etchevehere");
INSERT INTO localidades VALUES("1238","9","Villa Mantero");
INSERT INTO localidades VALUES("1239","9","Villa Paranacito");
INSERT INTO localidades VALUES("1240","9","Villa Urquiza");
INSERT INTO localidades VALUES("1241","9","Villaguay");
INSERT INTO localidades VALUES("1242","9","Walter Moss");
INSERT INTO localidades VALUES("1243","9","Yacaré");
INSERT INTO localidades VALUES("1244","9","Yeso Oeste");
INSERT INTO localidades VALUES("1245","10","Buena Vista");
INSERT INTO localidades VALUES("1246","10","Clorinda");
INSERT INTO localidades VALUES("1247","10","Col. Pastoril");
INSERT INTO localidades VALUES("1248","10","Cte. Fontana");
INSERT INTO localidades VALUES("1249","10","El Colorado");
INSERT INTO localidades VALUES("1250","10","El Espinillo");
INSERT INTO localidades VALUES("1251","10","Estanislao Del Campo");
INSERT INTO localidades VALUES("1252","10","10");
INSERT INTO localidades VALUES("1253","10","Fortín Lugones");
INSERT INTO localidades VALUES("1254","10","Gral. Lucio V. Mansilla");
INSERT INTO localidades VALUES("1255","10","Gral. Manuel Belgrano");
INSERT INTO localidades VALUES("1256","10","Gral. Mosconi");
INSERT INTO localidades VALUES("1257","10","Gran Guardia");
INSERT INTO localidades VALUES("1258","10","Herradura");
INSERT INTO localidades VALUES("1259","10","Ibarreta");
INSERT INTO localidades VALUES("1260","10","Ing. Juárez");
INSERT INTO localidades VALUES("1261","10","Laguna Blanca");
INSERT INTO localidades VALUES("1262","10","Laguna Naick Neck");
INSERT INTO localidades VALUES("1263","10","Laguna Yema");
INSERT INTO localidades VALUES("1264","10","Las Lomitas");
INSERT INTO localidades VALUES("1265","10","Los Chiriguanos");
INSERT INTO localidades VALUES("1266","10","Mayor V. Villafañe");
INSERT INTO localidades VALUES("1267","10","Misión San Fco.");
INSERT INTO localidades VALUES("1268","10","Palo Santo");
INSERT INTO localidades VALUES("1269","10","Pirané");
INSERT INTO localidades VALUES("1270","10","Pozo del Maza");
INSERT INTO localidades VALUES("1271","10","Riacho He-He");
INSERT INTO localidades VALUES("1272","10","San Hilario");
INSERT INTO localidades VALUES("1273","10","San Martín II");
INSERT INTO localidades VALUES("1274","10","Siete Palmas");
INSERT INTO localidades VALUES("1275","10","Subteniente Perín");
INSERT INTO localidades VALUES("1276","10","Tres Lagunas");
INSERT INTO localidades VALUES("1277","10","Villa Dos Trece");
INSERT INTO localidades VALUES("1278","10","Villa Escolar");
INSERT INTO localidades VALUES("1279","10","Villa Gral. Güemes");
INSERT INTO localidades VALUES("1280","11","Abdon Castro Tolay");
INSERT INTO localidades VALUES("1281","11","Abra Pampa");
INSERT INTO localidades VALUES("1282","11","Abralaite");
INSERT INTO localidades VALUES("1283","11","Aguas Calientes");
INSERT INTO localidades VALUES("1284","11","Arrayanal");
INSERT INTO localidades VALUES("1285","11","Barrios");
INSERT INTO localidades VALUES("1286","11","Caimancito");
INSERT INTO localidades VALUES("1287","11","Calilegua");
INSERT INTO localidades VALUES("1288","11","Cangrejillos");
INSERT INTO localidades VALUES("1289","11","Caspala");
INSERT INTO localidades VALUES("1290","11","Catuá");
INSERT INTO localidades VALUES("1291","11","Cieneguillas");
INSERT INTO localidades VALUES("1292","11","Coranzulli");
INSERT INTO localidades VALUES("1293","11","Cusi-Cusi");
INSERT INTO localidades VALUES("1294","11","El Aguilar");
INSERT INTO localidades VALUES("1295","11","El Carmen");
INSERT INTO localidades VALUES("1296","11","El Cóndor");
INSERT INTO localidades VALUES("1297","11","El Fuerte");
INSERT INTO localidades VALUES("1298","11","El Piquete");
INSERT INTO localidades VALUES("1299","11","El Talar");
INSERT INTO localidades VALUES("1300","11","Fraile Pintado");
INSERT INTO localidades VALUES("1301","11","Hipólito Yrigoyen");
INSERT INTO localidades VALUES("1302","11","Huacalera");
INSERT INTO localidades VALUES("1303","11","Humahuaca");
INSERT INTO localidades VALUES("1304","11","La Esperanza");
INSERT INTO localidades VALUES("1305","11","La Mendieta");
INSERT INTO localidades VALUES("1306","11","La Quiaca");
INSERT INTO localidades VALUES("1307","11","Ledesma");
INSERT INTO localidades VALUES("1308","11","Libertador Gral. San Martin");
INSERT INTO localidades VALUES("1309","11","Maimara");
INSERT INTO localidades VALUES("1310","11","Mina Pirquitas");
INSERT INTO localidades VALUES("1311","11","Monterrico");
INSERT INTO localidades VALUES("1312","11","Palma Sola");
INSERT INTO localidades VALUES("1313","11","Palpalá");
INSERT INTO localidades VALUES("1314","11","Pampa Blanca");
INSERT INTO localidades VALUES("1315","11","Pampichuela");
INSERT INTO localidades VALUES("1316","11","Perico");
INSERT INTO localidades VALUES("1317","11","Puesto del Marqués");
INSERT INTO localidades VALUES("1318","11","Puesto Viejo");
INSERT INTO localidades VALUES("1319","11","Pumahuasi");
INSERT INTO localidades VALUES("1320","11","Purmamarca");
INSERT INTO localidades VALUES("1321","11","Rinconada");
INSERT INTO localidades VALUES("1322","11","Rodeitos");
INSERT INTO localidades VALUES("1323","11","Rosario de Río Grande");
INSERT INTO localidades VALUES("1324","11","San Antonio");
INSERT INTO localidades VALUES("1325","11","San Francisco");
INSERT INTO localidades VALUES("1326","11","San Pedro");
INSERT INTO localidades VALUES("1327","11","San Rafael");
INSERT INTO localidades VALUES("1328","11","San Salvador");
INSERT INTO localidades VALUES("1329","11","Santa Ana");
INSERT INTO localidades VALUES("1330","11","Santa Catalina");
INSERT INTO localidades VALUES("1331","11","Santa Clara");
INSERT INTO localidades VALUES("1332","11","Susques");
INSERT INTO localidades VALUES("1333","11","Tilcara");
INSERT INTO localidades VALUES("1334","11","Tres Cruces");
INSERT INTO localidades VALUES("1335","11","Tumbaya");
INSERT INTO localidades VALUES("1336","11","Valle Grande");
INSERT INTO localidades VALUES("1337","11","Vinalito");
INSERT INTO localidades VALUES("1338","11","Volcán");
INSERT INTO localidades VALUES("1339","11","Yala");
INSERT INTO localidades VALUES("1340","11","Yaví");
INSERT INTO localidades VALUES("1341","11","Yuto");
INSERT INTO localidades VALUES("1342","12","Abramo");
INSERT INTO localidades VALUES("1343","12","Adolfo Van Praet");
INSERT INTO localidades VALUES("1344","12","Agustoni");
INSERT INTO localidades VALUES("1345","12","Algarrobo del Aguila");
INSERT INTO localidades VALUES("1346","12","Alpachiri");
INSERT INTO localidades VALUES("1347","12","Alta Italia");
INSERT INTO localidades VALUES("1348","12","Anguil");
INSERT INTO localidades VALUES("1349","12","Arata");
INSERT INTO localidades VALUES("1350","12","Ataliva Roca");
INSERT INTO localidades VALUES("1351","12","Bernardo Larroude");
INSERT INTO localidades VALUES("1352","12","Bernasconi");
INSERT INTO localidades VALUES("1353","12","Caleufú");
INSERT INTO localidades VALUES("1354","12","Carro Quemado");
INSERT INTO localidades VALUES("1355","12","Catriló");
INSERT INTO localidades VALUES("1356","12","Ceballos");
INSERT INTO localidades VALUES("1357","12","Chacharramendi");
INSERT INTO localidades VALUES("1358","12","Col. Barón");
INSERT INTO localidades VALUES("1359","12","Col. Santa María");
INSERT INTO localidades VALUES("1360","12","Conhelo");
INSERT INTO localidades VALUES("1361","12","Coronel Hilario Lagos");
INSERT INTO localidades VALUES("1362","12","Cuchillo-Có");
INSERT INTO localidades VALUES("1363","12","Doblas");
INSERT INTO localidades VALUES("1364","12","Dorila");
INSERT INTO localidades VALUES("1365","12","Eduardo Castex");
INSERT INTO localidades VALUES("1366","12","Embajador Martini");
INSERT INTO localidades VALUES("1367","12","Falucho");
INSERT INTO localidades VALUES("1368","12","Gral. Acha");
INSERT INTO localidades VALUES("1369","12","Gral. Manuel Campos");
INSERT INTO localidades VALUES("1370","12","Gral. Pico");
INSERT INTO localidades VALUES("1371","12","Guatraché");
INSERT INTO localidades VALUES("1372","12","Ing. Luiggi");
INSERT INTO localidades VALUES("1373","12","Intendente Alvear");
INSERT INTO localidades VALUES("1374","12","Jacinto Arauz");
INSERT INTO localidades VALUES("1375","12","La Adela");
INSERT INTO localidades VALUES("1376","12","La Humada");
INSERT INTO localidades VALUES("1377","12","La Maruja");
INSERT INTO localidades VALUES("1378","12","12");
INSERT INTO localidades VALUES("1379","12","La Reforma");
INSERT INTO localidades VALUES("1380","12","Limay Mahuida");
INSERT INTO localidades VALUES("1381","12","Lonquimay");
INSERT INTO localidades VALUES("1382","12","Loventuel");
INSERT INTO localidades VALUES("1383","12","Luan Toro");
INSERT INTO localidades VALUES("1384","12","Macachín");
INSERT INTO localidades VALUES("1385","12","Maisonnave");
INSERT INTO localidades VALUES("1386","12","Mauricio Mayer");
INSERT INTO localidades VALUES("1387","12","Metileo");
INSERT INTO localidades VALUES("1388","12","Miguel Cané");
INSERT INTO localidades VALUES("1389","12","Miguel Riglos");
INSERT INTO localidades VALUES("1390","12","Monte Nievas");
INSERT INTO localidades VALUES("1391","12","Parera");
INSERT INTO localidades VALUES("1392","12","Perú");
INSERT INTO localidades VALUES("1393","12","Pichi-Huinca");
INSERT INTO localidades VALUES("1394","12","Puelches");
INSERT INTO localidades VALUES("1395","12","Puelén");
INSERT INTO localidades VALUES("1396","12","Quehue");
INSERT INTO localidades VALUES("1397","12","Quemú Quemú");
INSERT INTO localidades VALUES("1398","12","Quetrequén");
INSERT INTO localidades VALUES("1399","12","Rancul");
INSERT INTO localidades VALUES("1400","12","Realicó");
INSERT INTO localidades VALUES("1401","12","Relmo");
INSERT INTO localidades VALUES("1402","12","Rolón");
INSERT INTO localidades VALUES("1403","12","Rucanelo");
INSERT INTO localidades VALUES("1404","12","Sarah");
INSERT INTO localidades VALUES("1405","12","Speluzzi");
INSERT INTO localidades VALUES("1406","12","Sta. Isabel");
INSERT INTO localidades VALUES("1407","12","Sta. Rosa");
INSERT INTO localidades VALUES("1408","12","Sta. Teresa");
INSERT INTO localidades VALUES("1409","12","Telén");
INSERT INTO localidades VALUES("1410","12","Toay");
INSERT INTO localidades VALUES("1411","12","Tomas M. de Anchorena");
INSERT INTO localidades VALUES("1412","12","Trenel");
INSERT INTO localidades VALUES("1413","12","Unanue");
INSERT INTO localidades VALUES("1414","12","Uriburu");
INSERT INTO localidades VALUES("1415","12","Veinticinco de Mayo");
INSERT INTO localidades VALUES("1416","12","Vertiz");
INSERT INTO localidades VALUES("1417","12","Victorica");
INSERT INTO localidades VALUES("1418","12","Villa Mirasol");
INSERT INTO localidades VALUES("1419","12","Winifreda");
INSERT INTO localidades VALUES("1420","13","Arauco");
INSERT INTO localidades VALUES("1421","13","Capital");
INSERT INTO localidades VALUES("1422","13","Castro Barros");
INSERT INTO localidades VALUES("1423","13","Chamical");
INSERT INTO localidades VALUES("1424","13","Chilecito");
INSERT INTO localidades VALUES("1425","13","Coronel F. Varela");
INSERT INTO localidades VALUES("1426","13","Famatina");
INSERT INTO localidades VALUES("1427","13","Gral. A.V.Peñaloza");
INSERT INTO localidades VALUES("1428","13","Gral. Belgrano");
INSERT INTO localidades VALUES("1429","13","Gral. J.F. Quiroga");
INSERT INTO localidades VALUES("1430","13","Gral. Lamadrid");
INSERT INTO localidades VALUES("1431","13","Gral. Ocampo");
INSERT INTO localidades VALUES("1432","13","Gral. San Martín");
INSERT INTO localidades VALUES("1433","13","Independencia");
INSERT INTO localidades VALUES("1434","13","Rosario Penaloza");
INSERT INTO localidades VALUES("1435","13","San Blas de Los Sauces");
INSERT INTO localidades VALUES("1436","13","Sanagasta");
INSERT INTO localidades VALUES("1437","13","Vinchina");
INSERT INTO localidades VALUES("1438","14","Capital");
INSERT INTO localidades VALUES("1439","14","Chacras de Coria");
INSERT INTO localidades VALUES("1440","14","Dorrego");
INSERT INTO localidades VALUES("1441","14","Gllen");
INSERT INTO localidades VALUES("1442","14","Godoy Cruz");
INSERT INTO localidades VALUES("1443","14","Gral. Alvear");
INSERT INTO localidades VALUES("1444","14","Guaymallén");
INSERT INTO localidades VALUES("1445","14","Junín");
INSERT INTO localidades VALUES("1446","14","La Paz");
INSERT INTO localidades VALUES("1447","14","Las Heras");
INSERT INTO localidades VALUES("1448","14","Lavalle");
INSERT INTO localidades VALUES("1449","14","Luján");
INSERT INTO localidades VALUES("1450","14","Luján De Cuyo");
INSERT INTO localidades VALUES("1451","14","Maipú");
INSERT INTO localidades VALUES("1452","14","Malargüe");
INSERT INTO localidades VALUES("1453","14","Rivadavia");
INSERT INTO localidades VALUES("1454","14","San Carlos");
INSERT INTO localidades VALUES("1455","14","San Martín");
INSERT INTO localidades VALUES("1456","14","San Rafael");
INSERT INTO localidades VALUES("1457","14","Sta. Rosa");
INSERT INTO localidades VALUES("1458","14","Tunuyán");
INSERT INTO localidades VALUES("1459","14","Tupungato");
INSERT INTO localidades VALUES("1460","14","Villa Nueva");
INSERT INTO localidades VALUES("1461","15","Alba Posse");
INSERT INTO localidades VALUES("1462","15","Almafuerte");
INSERT INTO localidades VALUES("1463","15","Apóstoles");
INSERT INTO localidades VALUES("1464","15","Aristóbulo Del Valle");
INSERT INTO localidades VALUES("1465","15","Arroyo Del Medio");
INSERT INTO localidades VALUES("1466","15","Azara");
INSERT INTO localidades VALUES("1467","15","Bdo. De Irigoyen");
INSERT INTO localidades VALUES("1468","15","Bonpland");
INSERT INTO localidades VALUES("1469","15","Caá Yari");
INSERT INTO localidades VALUES("1470","15","Campo Grande");
INSERT INTO localidades VALUES("1471","15","Campo Ramón");
INSERT INTO localidades VALUES("1472","15","Campo Viera");
INSERT INTO localidades VALUES("1473","15","Candelaria");
INSERT INTO localidades VALUES("1474","15","Capioví");
INSERT INTO localidades VALUES("1475","15","Caraguatay");
INSERT INTO localidades VALUES("1476","15","Cdte. Guacurarí");
INSERT INTO localidades VALUES("1477","15","Cerro Azul");
INSERT INTO localidades VALUES("1478","15","Cerro Corá");
INSERT INTO localidades VALUES("1479","15","Col. Alberdi");
INSERT INTO localidades VALUES("1480","15","Col. Aurora");
INSERT INTO localidades VALUES("1481","15","Col. Delicia");
INSERT INTO localidades VALUES("1482","15","Col. Polana");
INSERT INTO localidades VALUES("1483","15","Col. Victoria");
INSERT INTO localidades VALUES("1484","15","Col. Wanda");
INSERT INTO localidades VALUES("1485","15","Concepción De La Sierra");
INSERT INTO localidades VALUES("1486","15","Corpus");
INSERT INTO localidades VALUES("1487","15","Dos Arroyos");
INSERT INTO localidades VALUES("1488","15","Dos de Mayo");
INSERT INTO localidades VALUES("1489","15","El Alcázar");
INSERT INTO localidades VALUES("1490","15","El Dorado");
INSERT INTO localidades VALUES("1491","15","El Soberbio");
INSERT INTO localidades VALUES("1492","15","Esperanza");
INSERT INTO localidades VALUES("1493","15","F. Ameghino");
INSERT INTO localidades VALUES("1494","15","Fachinal");
INSERT INTO localidades VALUES("1495","15","Garuhapé");
INSERT INTO localidades VALUES("1496","15","Garupá");
INSERT INTO localidades VALUES("1497","15","Gdor. López");
INSERT INTO localidades VALUES("1498","15","Gdor. Roca");
INSERT INTO localidades VALUES("1499","15","Gral. Alvear");
INSERT INTO localidades VALUES("1500","15","Gral. Urquiza");
INSERT INTO localidades VALUES("1501","15","Guaraní");
INSERT INTO localidades VALUES("1502","15","H. Yrigoyen");
INSERT INTO localidades VALUES("1503","15","Iguazú");
INSERT INTO localidades VALUES("1504","15","Itacaruaré");
INSERT INTO localidades VALUES("1505","15","Jardín América");
INSERT INTO localidades VALUES("1506","15","Leandro N. Alem");
INSERT INTO localidades VALUES("1507","15","Libertad");
INSERT INTO localidades VALUES("1508","15","Loreto");
INSERT INTO localidades VALUES("1509","15","Los Helechos");
INSERT INTO localidades VALUES("1510","15","Mártires");
INSERT INTO localidades VALUES("1511","15","15");
INSERT INTO localidades VALUES("1512","15","Mojón Grande");
INSERT INTO localidades VALUES("1513","15","Montecarlo");
INSERT INTO localidades VALUES("1514","15","Nueve de Julio");
INSERT INTO localidades VALUES("1515","15","Oberá");
INSERT INTO localidades VALUES("1516","15","Olegario V. Andrade");
INSERT INTO localidades VALUES("1517","15","Panambí");
INSERT INTO localidades VALUES("1518","15","Posadas");
INSERT INTO localidades VALUES("1519","15","Profundidad");
INSERT INTO localidades VALUES("1520","15","Pto. Iguazú");
INSERT INTO localidades VALUES("1521","15","Pto. Leoni");
INSERT INTO localidades VALUES("1522","15","Pto. Piray");
INSERT INTO localidades VALUES("1523","15","Pto. Rico");
INSERT INTO localidades VALUES("1524","15","Ruiz de Montoya");
INSERT INTO localidades VALUES("1525","15","San Antonio");
INSERT INTO localidades VALUES("1526","15","San Ignacio");
INSERT INTO localidades VALUES("1527","15","San Javier");
INSERT INTO localidades VALUES("1528","15","San José");
INSERT INTO localidades VALUES("1529","15","San Martín");
INSERT INTO localidades VALUES("1530","15","San Pedro");
INSERT INTO localidades VALUES("1531","15","San Vicente");
INSERT INTO localidades VALUES("1532","15","Santiago De Liniers");
INSERT INTO localidades VALUES("1533","15","Santo Pipo");
INSERT INTO localidades VALUES("1534","15","Sta. Ana");
INSERT INTO localidades VALUES("1535","15","Sta. María");
INSERT INTO localidades VALUES("1536","15","Tres Capones");
INSERT INTO localidades VALUES("1537","15","Veinticinco de Mayo");
INSERT INTO localidades VALUES("1538","15","Wanda");
INSERT INTO localidades VALUES("1539","16","Aguada San Roque");
INSERT INTO localidades VALUES("1540","16","Aluminé");
INSERT INTO localidades VALUES("1541","16","Andacollo");
INSERT INTO localidades VALUES("1542","16","Añelo");
INSERT INTO localidades VALUES("1543","16","Bajada del Agrio");
INSERT INTO localidades VALUES("1544","16","Barrancas");
INSERT INTO localidades VALUES("1545","16","Buta Ranquil");
INSERT INTO localidades VALUES("1546","16","Capital");
INSERT INTO localidades VALUES("1547","16","Caviahué");
INSERT INTO localidades VALUES("1548","16","Centenario");
INSERT INTO localidades VALUES("1549","16","Chorriaca");
INSERT INTO localidades VALUES("1550","16","Chos Malal");
INSERT INTO localidades VALUES("1551","16","Cipolletti");
INSERT INTO localidades VALUES("1552","16","Covunco Abajo");
INSERT INTO localidades VALUES("1553","16","Coyuco Cochico");
INSERT INTO localidades VALUES("1554","16","Cutral Có");
INSERT INTO localidades VALUES("1555","16","El Cholar");
INSERT INTO localidades VALUES("1556","16","El Huecú");
INSERT INTO localidades VALUES("1557","16","El Sauce");
INSERT INTO localidades VALUES("1558","16","Guañacos");
INSERT INTO localidades VALUES("1559","16","Huinganco");
INSERT INTO localidades VALUES("1560","16","Las Coloradas");
INSERT INTO localidades VALUES("1561","16","Las Lajas");
INSERT INTO localidades VALUES("1562","16","Las Ovejas");
INSERT INTO localidades VALUES("1563","16","Loncopué");
INSERT INTO localidades VALUES("1564","16","Los Catutos");
INSERT INTO localidades VALUES("1565","16","Los Chihuidos");
INSERT INTO localidades VALUES("1566","16","Los Miches");
INSERT INTO localidades VALUES("1567","16","Manzano Amargo");
INSERT INTO localidades VALUES("1568","16","16");
INSERT INTO localidades VALUES("1569","16","Octavio Pico");
INSERT INTO localidades VALUES("1570","16","Paso Aguerre");
INSERT INTO localidades VALUES("1571","16","Picún Leufú");
INSERT INTO localidades VALUES("1572","16","Piedra del Aguila");
INSERT INTO localidades VALUES("1573","16","Pilo Lil");
INSERT INTO localidades VALUES("1574","16","Plaza Huincul");
INSERT INTO localidades VALUES("1575","16","Plottier");
INSERT INTO localidades VALUES("1576","16","Quili Malal");
INSERT INTO localidades VALUES("1577","16","Ramón Castro");
INSERT INTO localidades VALUES("1578","16","Rincón de Los Sauces");
INSERT INTO localidades VALUES("1579","16","San Martín de Los Andes");
INSERT INTO localidades VALUES("1580","16","San Patricio del Chañar");
INSERT INTO localidades VALUES("1581","16","Santo Tomás");
INSERT INTO localidades VALUES("1582","16","Sauzal Bonito");
INSERT INTO localidades VALUES("1583","16","Senillosa");
INSERT INTO localidades VALUES("1584","16","Taquimilán");
INSERT INTO localidades VALUES("1585","16","Tricao Malal");
INSERT INTO localidades VALUES("1586","16","Varvarco");
INSERT INTO localidades VALUES("1587","16","Villa Curí Leuvu");
INSERT INTO localidades VALUES("1588","16","Villa del Nahueve");
INSERT INTO localidades VALUES("1589","16","Villa del Puente Picún Leuvú");
INSERT INTO localidades VALUES("1590","16","Villa El Chocón");
INSERT INTO localidades VALUES("1591","16","Villa La Angostura");
INSERT INTO localidades VALUES("1592","16","Villa Pehuenia");
INSERT INTO localidades VALUES("1593","16","Villa Traful");
INSERT INTO localidades VALUES("1594","16","Vista Alegre");
INSERT INTO localidades VALUES("1595","16","Zapala");
INSERT INTO localidades VALUES("1596","17","Aguada Cecilio");
INSERT INTO localidades VALUES("1597","17","Aguada de Guerra");
INSERT INTO localidades VALUES("1598","17","Allén");
INSERT INTO localidades VALUES("1599","17","Arroyo de La Ventana");
INSERT INTO localidades VALUES("1600","17","Arroyo Los Berros");
INSERT INTO localidades VALUES("1601","17","Bariloche");
INSERT INTO localidades VALUES("1602","17","Calte. Cordero");
INSERT INTO localidades VALUES("1603","17","Campo Grande");
INSERT INTO localidades VALUES("1604","17","Catriel");
INSERT INTO localidades VALUES("1605","17","Cerro Policía");
INSERT INTO localidades VALUES("1606","17","Cervantes");
INSERT INTO localidades VALUES("1607","17","Chelforo");
INSERT INTO localidades VALUES("1608","17","Chimpay");
INSERT INTO localidades VALUES("1609","17","Chinchinales");
INSERT INTO localidades VALUES("1610","17","Chipauquil");
INSERT INTO localidades VALUES("1611","17","Choele Choel");
INSERT INTO localidades VALUES("1612","17","Cinco Saltos");
INSERT INTO localidades VALUES("1613","17","Cipolletti");
INSERT INTO localidades VALUES("1614","17","Clemente Onelli");
INSERT INTO localidades VALUES("1615","17","Colán Conhue");
INSERT INTO localidades VALUES("1616","17","Comallo");
INSERT INTO localidades VALUES("1617","17","Comicó");
INSERT INTO localidades VALUES("1618","17","Cona Niyeu");
INSERT INTO localidades VALUES("1619","17","Coronel Belisle");
INSERT INTO localidades VALUES("1620","17","Cubanea");
INSERT INTO localidades VALUES("1621","17","Darwin");
INSERT INTO localidades VALUES("1622","17","Dina Huapi");
INSERT INTO localidades VALUES("1623","17","El Bolsón");
INSERT INTO localidades VALUES("1624","17","El Caín");
INSERT INTO localidades VALUES("1625","17","El Manso");
INSERT INTO localidades VALUES("1626","17","Gral. Conesa");
INSERT INTO localidades VALUES("1627","17","Gral. Enrique Godoy");
INSERT INTO localidades VALUES("1628","17","Gral. Fernandez Oro");
INSERT INTO localidades VALUES("1629","17","Gral. Roca");
INSERT INTO localidades VALUES("1630","17","Guardia Mitre");
INSERT INTO localidades VALUES("1631","17","Ing. Huergo");
INSERT INTO localidades VALUES("1632","17","Ing. Jacobacci");
INSERT INTO localidades VALUES("1633","17","Laguna Blanca");
INSERT INTO localidades VALUES("1634","17","Lamarque");
INSERT INTO localidades VALUES("1635","17","Las Grutas");
INSERT INTO localidades VALUES("1636","17","Los Menucos");
INSERT INTO localidades VALUES("1637","17","Luis Beltrán");
INSERT INTO localidades VALUES("1638","17","Mainqué");
INSERT INTO localidades VALUES("1639","17","Mamuel Choique");
INSERT INTO localidades VALUES("1640","17","Maquinchao");
INSERT INTO localidades VALUES("1641","17","Mencué");
INSERT INTO localidades VALUES("1642","17","Mtro. Ramos Mexia");
INSERT INTO localidades VALUES("1643","17","Nahuel Niyeu");
INSERT INTO localidades VALUES("1644","17","Naupa Huen");
INSERT INTO localidades VALUES("1645","17","Ñorquinco");
INSERT INTO localidades VALUES("1646","17","Ojos de Agua");
INSERT INTO localidades VALUES("1647","17","Paso de Agua");
INSERT INTO localidades VALUES("1648","17","Paso Flores");
INSERT INTO localidades VALUES("1649","17","Peñas Blancas");
INSERT INTO localidades VALUES("1650","17","Pichi Mahuida");
INSERT INTO localidades VALUES("1651","17","Pilcaniyeu");
INSERT INTO localidades VALUES("1652","17","Pomona");
INSERT INTO localidades VALUES("1653","17","Prahuaniyeu");
INSERT INTO localidades VALUES("1654","17","Rincón Treneta");
INSERT INTO localidades VALUES("1655","17","Río Chico");
INSERT INTO localidades VALUES("1656","17","Río Colorado");
INSERT INTO localidades VALUES("1657","17","Roca");
INSERT INTO localidades VALUES("1658","17","San Antonio Oeste");
INSERT INTO localidades VALUES("1659","17","San Javier");
INSERT INTO localidades VALUES("1660","17","Sierra Colorada");
INSERT INTO localidades VALUES("1661","17","Sierra Grande");
INSERT INTO localidades VALUES("1662","17","Sierra Pailemán");
INSERT INTO localidades VALUES("1663","17","Valcheta");
INSERT INTO localidades VALUES("1664","17","Valle Azul");
INSERT INTO localidades VALUES("1665","17","Viedma");
INSERT INTO localidades VALUES("1666","17","Villa Llanquín");
INSERT INTO localidades VALUES("1667","17","Villa Mascardi");
INSERT INTO localidades VALUES("1668","17","Villa Regina");
INSERT INTO localidades VALUES("1669","17","Yaminué");
INSERT INTO localidades VALUES("1670","18","A. Saravia");
INSERT INTO localidades VALUES("1671","18","Aguaray");
INSERT INTO localidades VALUES("1672","18","Angastaco");
INSERT INTO localidades VALUES("1673","18","Animaná");
INSERT INTO localidades VALUES("1674","18","Cachi");
INSERT INTO localidades VALUES("1675","18","Cafayate");
INSERT INTO localidades VALUES("1676","18","Campo Quijano");
INSERT INTO localidades VALUES("1677","18","Campo Santo");
INSERT INTO localidades VALUES("1678","18","Capital");
INSERT INTO localidades VALUES("1679","18","Cerrillos");
INSERT INTO localidades VALUES("1680","18","Chicoana");
INSERT INTO localidades VALUES("1681","18","Col. Sta. Rosa");
INSERT INTO localidades VALUES("1682","18","Coronel Moldes");
INSERT INTO localidades VALUES("1683","18","El Bordo");
INSERT INTO localidades VALUES("1684","18","El Carril");
INSERT INTO localidades VALUES("1685","18","El Galpón");
INSERT INTO localidades VALUES("1686","18","El Jardín");
INSERT INTO localidades VALUES("1687","18","El Potrero");
INSERT INTO localidades VALUES("1688","18","El Quebrachal");
INSERT INTO localidades VALUES("1689","18","El Tala");
INSERT INTO localidades VALUES("1690","18","Embarcación");
INSERT INTO localidades VALUES("1691","18","Gral. Ballivian");
INSERT INTO localidades VALUES("1692","18","Gral. Güemes");
INSERT INTO localidades VALUES("1693","18","Gral. Mosconi");
INSERT INTO localidades VALUES("1694","18","Gral. Pizarro");
INSERT INTO localidades VALUES("1695","18","Guachipas");
INSERT INTO localidades VALUES("1696","18","Hipólito Yrigoyen");
INSERT INTO localidades VALUES("1697","18","Iruyá");
INSERT INTO localidades VALUES("1698","18","Isla De Cañas");
INSERT INTO localidades VALUES("1699","18","J. V. Gonzalez");
INSERT INTO localidades VALUES("1700","18","La Caldera");
INSERT INTO localidades VALUES("1701","18","La Candelaria");
INSERT INTO localidades VALUES("1702","18","La Merced");
INSERT INTO localidades VALUES("1703","18","La Poma");
INSERT INTO localidades VALUES("1704","18","La Viña");
INSERT INTO localidades VALUES("1705","18","Las Lajitas");
INSERT INTO localidades VALUES("1706","18","Los Toldos");
INSERT INTO localidades VALUES("1707","18","Metán");
INSERT INTO localidades VALUES("1708","18","Molinos");
INSERT INTO localidades VALUES("1709","18","Nazareno");
INSERT INTO localidades VALUES("1710","18","Orán");
INSERT INTO localidades VALUES("1711","18","Payogasta");
INSERT INTO localidades VALUES("1712","18","Pichanal");
INSERT INTO localidades VALUES("1713","18","Prof. S. Mazza");
INSERT INTO localidades VALUES("1714","18","Río Piedras");
INSERT INTO localidades VALUES("1715","18","Rivadavia Banda Norte");
INSERT INTO localidades VALUES("1716","18","Rivadavia Banda Sur");
INSERT INTO localidades VALUES("1717","18","Rosario de La Frontera");
INSERT INTO localidades VALUES("1718","18","Rosario de Lerma");
INSERT INTO localidades VALUES("1719","18","Saclantás");
INSERT INTO localidades VALUES("1720","18","18");
INSERT INTO localidades VALUES("1721","18","San Antonio");
INSERT INTO localidades VALUES("1722","18","San Carlos");
INSERT INTO localidades VALUES("1723","18","San José De Metán");
INSERT INTO localidades VALUES("1724","18","San Ramón");
INSERT INTO localidades VALUES("1725","18","Santa Victoria E.");
INSERT INTO localidades VALUES("1726","18","Santa Victoria O.");
INSERT INTO localidades VALUES("1727","18","Tartagal");
INSERT INTO localidades VALUES("1728","18","Tolar Grande");
INSERT INTO localidades VALUES("1729","18","Urundel");
INSERT INTO localidades VALUES("1730","18","Vaqueros");
INSERT INTO localidades VALUES("1731","18","Villa San Lorenzo");
INSERT INTO localidades VALUES("1732","19","Albardón");
INSERT INTO localidades VALUES("1733","19","Angaco");
INSERT INTO localidades VALUES("1734","19","Calingasta");
INSERT INTO localidades VALUES("1735","19","Capital");
INSERT INTO localidades VALUES("1736","19","Caucete");
INSERT INTO localidades VALUES("1737","19","Chimbas");
INSERT INTO localidades VALUES("1738","19","Iglesia");
INSERT INTO localidades VALUES("1739","19","Jachal");
INSERT INTO localidades VALUES("1740","19","Nueve de Julio");
INSERT INTO localidades VALUES("1741","19","Pocito");
INSERT INTO localidades VALUES("1742","19","Rawson");
INSERT INTO localidades VALUES("1743","19","Rivadavia");
INSERT INTO localidades VALUES("1744","19","19");
INSERT INTO localidades VALUES("1745","19","San Martín");
INSERT INTO localidades VALUES("1746","19","Santa Lucía");
INSERT INTO localidades VALUES("1747","19","Sarmiento");
INSERT INTO localidades VALUES("1748","19","Ullum");
INSERT INTO localidades VALUES("1749","19","Valle Fértil");
INSERT INTO localidades VALUES("1750","19","Veinticinco de Mayo");
INSERT INTO localidades VALUES("1751","19","Zonda");
INSERT INTO localidades VALUES("1752","20","Alto Pelado");
INSERT INTO localidades VALUES("1753","20","Alto Pencoso");
INSERT INTO localidades VALUES("1754","20","Anchorena");
INSERT INTO localidades VALUES("1755","20","Arizona");
INSERT INTO localidades VALUES("1756","20","Bagual");
INSERT INTO localidades VALUES("1757","20","Balde");
INSERT INTO localidades VALUES("1758","20","Batavia");
INSERT INTO localidades VALUES("1759","20","Beazley");
INSERT INTO localidades VALUES("1760","20","Buena Esperanza");
INSERT INTO localidades VALUES("1761","20","Candelaria");
INSERT INTO localidades VALUES("1762","20","Capital");
INSERT INTO localidades VALUES("1763","20","Carolina");
INSERT INTO localidades VALUES("1764","20","Carpintería");
INSERT INTO localidades VALUES("1765","20","Concarán");
INSERT INTO localidades VALUES("1766","20","Cortaderas");
INSERT INTO localidades VALUES("1767","20","El Morro");
INSERT INTO localidades VALUES("1768","20","El Trapiche");
INSERT INTO localidades VALUES("1769","20","El Volcán");
INSERT INTO localidades VALUES("1770","20","Fortín El Patria");
INSERT INTO localidades VALUES("1771","20","Fortuna");
INSERT INTO localidades VALUES("1772","20","Fraga");
INSERT INTO localidades VALUES("1773","20","Juan Jorba");
INSERT INTO localidades VALUES("1774","20","Juan Llerena");
INSERT INTO localidades VALUES("1775","20","Juana Koslay");
INSERT INTO localidades VALUES("1776","20","Justo Daract");
INSERT INTO localidades VALUES("1777","20","La Calera");
INSERT INTO localidades VALUES("1778","20","La Florida");
INSERT INTO localidades VALUES("1779","20","La Punilla");
INSERT INTO localidades VALUES("1780","20","La Toma");
INSERT INTO localidades VALUES("1781","20","Lafinur");
INSERT INTO localidades VALUES("1782","20","Las Aguadas");
INSERT INTO localidades VALUES("1783","20","Las Chacras");
INSERT INTO localidades VALUES("1784","20","Las Lagunas");
INSERT INTO localidades VALUES("1785","20","Las Vertientes");
INSERT INTO localidades VALUES("1786","20","Lavaisse");
INSERT INTO localidades VALUES("1787","20","Leandro N. Alem");
INSERT INTO localidades VALUES("1788","20","Los Molles");
INSERT INTO localidades VALUES("1789","20","Luján");
INSERT INTO localidades VALUES("1790","20","Mercedes");
INSERT INTO localidades VALUES("1791","20","Merlo");
INSERT INTO localidades VALUES("1792","20","Naschel");
INSERT INTO localidades VALUES("1793","20","Navia");
INSERT INTO localidades VALUES("1794","20","Nogolí");
INSERT INTO localidades VALUES("1795","20","Nueva Galia");
INSERT INTO localidades VALUES("1796","20","Papagayos");
INSERT INTO localidades VALUES("1797","20","Paso Grande");
INSERT INTO localidades VALUES("1798","20","Potrero de Los Funes");
INSERT INTO localidades VALUES("1799","20","Quines");
INSERT INTO localidades VALUES("1800","20","Renca");
INSERT INTO localidades VALUES("1801","20","Saladillo");
INSERT INTO localidades VALUES("1802","20","San Francisco");
INSERT INTO localidades VALUES("1803","20","San Gerónimo");
INSERT INTO localidades VALUES("1804","20","San Martín");
INSERT INTO localidades VALUES("1805","20","San Pablo");
INSERT INTO localidades VALUES("1806","20","Santa Rosa de Conlara");
INSERT INTO localidades VALUES("1807","20","Talita");
INSERT INTO localidades VALUES("1808","20","Tilisarao");
INSERT INTO localidades VALUES("1809","20","Unión");
INSERT INTO localidades VALUES("1810","20","Villa de La Quebrada");
INSERT INTO localidades VALUES("1811","20","Villa de Praga");
INSERT INTO localidades VALUES("1812","20","Villa del Carmen");
INSERT INTO localidades VALUES("1813","20","Villa Gral. Roca");
INSERT INTO localidades VALUES("1814","20","Villa Larca");
INSERT INTO localidades VALUES("1815","20","Villa Mercedes");
INSERT INTO localidades VALUES("1816","20","Zanjitas");
INSERT INTO localidades VALUES("1817","21","Calafate");
INSERT INTO localidades VALUES("1818","21","Caleta Olivia");
INSERT INTO localidades VALUES("1819","21","Cañadón Seco");
INSERT INTO localidades VALUES("1820","21","Comandante Piedrabuena");
INSERT INTO localidades VALUES("1821","21","El Calafate");
INSERT INTO localidades VALUES("1822","21","El Chaltén");
INSERT INTO localidades VALUES("1823","21","Gdor. Gregores");
INSERT INTO localidades VALUES("1824","21","Hipólito Yrigoyen");
INSERT INTO localidades VALUES("1825","21","Jaramillo");
INSERT INTO localidades VALUES("1826","21","Koluel Kaike");
INSERT INTO localidades VALUES("1827","21","Las Heras");
INSERT INTO localidades VALUES("1828","21","Los Antiguos");
INSERT INTO localidades VALUES("1829","21","Perito Moreno");
INSERT INTO localidades VALUES("1830","21","Pico Truncado");
INSERT INTO localidades VALUES("1831","21","Pto. Deseado");
INSERT INTO localidades VALUES("1832","21","Pto. San Julián");
INSERT INTO localidades VALUES("1833","21","Pto. 21");
INSERT INTO localidades VALUES("1834","21","Río Cuarto");
INSERT INTO localidades VALUES("1835","21","Río Gallegos");
INSERT INTO localidades VALUES("1836","21","Río Turbio");
INSERT INTO localidades VALUES("1837","21","Tres Lagos");
INSERT INTO localidades VALUES("1838","21","Veintiocho De Noviembre");
INSERT INTO localidades VALUES("1839","22","Aarón Castellanos");
INSERT INTO localidades VALUES("1840","22","Acebal");
INSERT INTO localidades VALUES("1841","22","Aguará Grande");
INSERT INTO localidades VALUES("1842","22","Albarellos");
INSERT INTO localidades VALUES("1843","22","Alcorta");
INSERT INTO localidades VALUES("1844","22","Aldao");
INSERT INTO localidades VALUES("1845","22","Alejandra");
INSERT INTO localidades VALUES("1846","22","Álvarez");
INSERT INTO localidades VALUES("1847","22","Ambrosetti");
INSERT INTO localidades VALUES("1848","22","Amenábar");
INSERT INTO localidades VALUES("1849","22","Angélica");
INSERT INTO localidades VALUES("1850","22","Angeloni");
INSERT INTO localidades VALUES("1851","22","Arequito");
INSERT INTO localidades VALUES("1852","22","Arminda");
INSERT INTO localidades VALUES("1853","22","Armstrong");
INSERT INTO localidades VALUES("1854","22","Arocena");
INSERT INTO localidades VALUES("1855","22","Arroyo Aguiar");
INSERT INTO localidades VALUES("1856","22","Arroyo Ceibal");
INSERT INTO localidades VALUES("1857","22","Arroyo Leyes");
INSERT INTO localidades VALUES("1858","22","Arroyo Seco");
INSERT INTO localidades VALUES("1859","22","Arrufó");
INSERT INTO localidades VALUES("1860","22","Arteaga");
INSERT INTO localidades VALUES("1861","22","Ataliva");
INSERT INTO localidades VALUES("1862","22","Aurelia");
INSERT INTO localidades VALUES("1863","22","Avellaneda");
INSERT INTO localidades VALUES("1864","22","Barrancas");
INSERT INTO localidades VALUES("1865","22","Bauer Y Sigel");
INSERT INTO localidades VALUES("1866","22","Bella Italia");
INSERT INTO localidades VALUES("1867","22","Berabevú");
INSERT INTO localidades VALUES("1868","22","Berna");
INSERT INTO localidades VALUES("1869","22","Bernardo de Irigoyen");
INSERT INTO localidades VALUES("1870","22","Bigand");
INSERT INTO localidades VALUES("1871","22","Bombal");
INSERT INTO localidades VALUES("1872","22","Bouquet");
INSERT INTO localidades VALUES("1873","22","Bustinza");
INSERT INTO localidades VALUES("1874","22","Cabal");
INSERT INTO localidades VALUES("1875","22","Cacique Ariacaiquin");
INSERT INTO localidades VALUES("1876","22","Cafferata");
INSERT INTO localidades VALUES("1877","22","Calchaquí");
INSERT INTO localidades VALUES("1878","22","Campo Andino");
INSERT INTO localidades VALUES("1879","22","Campo Piaggio");
INSERT INTO localidades VALUES("1880","22","Cañada de Gómez");
INSERT INTO localidades VALUES("1881","22","Cañada del Ucle");
INSERT INTO localidades VALUES("1882","22","Cañada Rica");
INSERT INTO localidades VALUES("1883","22","Cañada Rosquín");
INSERT INTO localidades VALUES("1884","22","Candioti");
INSERT INTO localidades VALUES("1885","22","Capital");
INSERT INTO localidades VALUES("1886","22","Capitán Bermúdez");
INSERT INTO localidades VALUES("1887","22","Capivara");
INSERT INTO localidades VALUES("1888","22","Carcarañá");
INSERT INTO localidades VALUES("1889","22","Carlos Pellegrini");
INSERT INTO localidades VALUES("1890","22","Carmen");
INSERT INTO localidades VALUES("1891","22","Carmen Del Sauce");
INSERT INTO localidades VALUES("1892","22","Carreras");
INSERT INTO localidades VALUES("1893","22","Carrizales");
INSERT INTO localidades VALUES("1894","22","Casalegno");
INSERT INTO localidades VALUES("1895","22","Casas");
INSERT INTO localidades VALUES("1896","22","Casilda");
INSERT INTO localidades VALUES("1897","22","Castelar");
INSERT INTO localidades VALUES("1898","22","Castellanos");
INSERT INTO localidades VALUES("1899","22","Cayastá");
INSERT INTO localidades VALUES("1900","22","Cayastacito");
INSERT INTO localidades VALUES("1901","22","Centeno");
INSERT INTO localidades VALUES("1902","22","Cepeda");
INSERT INTO localidades VALUES("1903","22","Ceres");
INSERT INTO localidades VALUES("1904","22","Chabás");
INSERT INTO localidades VALUES("1905","22","Chañar Ladeado");
INSERT INTO localidades VALUES("1906","22","Chapuy");
INSERT INTO localidades VALUES("1907","22","Chovet");
INSERT INTO localidades VALUES("1908","22","Christophersen");
INSERT INTO localidades VALUES("1909","22","Classon");
INSERT INTO localidades VALUES("1910","22","Cnel. Arnold");
INSERT INTO localidades VALUES("1911","22","Cnel. Bogado");
INSERT INTO localidades VALUES("1912","22","Cnel. Dominguez");
INSERT INTO localidades VALUES("1913","22","Cnel. Fraga");
INSERT INTO localidades VALUES("1914","22","Col. Aldao");
INSERT INTO localidades VALUES("1915","22","Col. Ana");
INSERT INTO localidades VALUES("1916","22","Col. Belgrano");
INSERT INTO localidades VALUES("1917","22","Col. Bicha");
INSERT INTO localidades VALUES("1918","22","Col. Bigand");
INSERT INTO localidades VALUES("1919","22","Col. Bossi");
INSERT INTO localidades VALUES("1920","22","Col. Cavour");
INSERT INTO localidades VALUES("1921","22","Col. Cello");
INSERT INTO localidades VALUES("1922","22","Col. Dolores");
INSERT INTO localidades VALUES("1923","22","Col. Dos Rosas");
INSERT INTO localidades VALUES("1924","22","Col. Durán");
INSERT INTO localidades VALUES("1925","22","Col. Iturraspe");
INSERT INTO localidades VALUES("1926","22","Col. Margarita");
INSERT INTO localidades VALUES("1927","22","Col. Mascias");
INSERT INTO localidades VALUES("1928","22","Col. Raquel");
INSERT INTO localidades VALUES("1929","22","Col. Rosa");
INSERT INTO localidades VALUES("1930","22","Col. San José");
INSERT INTO localidades VALUES("1931","22","Constanza");
INSERT INTO localidades VALUES("1932","22","Coronda");
INSERT INTO localidades VALUES("1933","22","Correa");
INSERT INTO localidades VALUES("1934","22","Crispi");
INSERT INTO localidades VALUES("1935","22","Cululú");
INSERT INTO localidades VALUES("1936","22","Curupayti");
INSERT INTO localidades VALUES("1937","22","Desvio Arijón");
INSERT INTO localidades VALUES("1938","22","Diaz");
INSERT INTO localidades VALUES("1939","22","Diego de Alvear");
INSERT INTO localidades VALUES("1940","22","Egusquiza");
INSERT INTO localidades VALUES("1941","22","El Arazá");
INSERT INTO localidades VALUES("1942","22","El Rabón");
INSERT INTO localidades VALUES("1943","22","El Sombrerito");
INSERT INTO localidades VALUES("1944","22","El Trébol");
INSERT INTO localidades VALUES("1945","22","Elisa");
INSERT INTO localidades VALUES("1946","22","Elortondo");
INSERT INTO localidades VALUES("1947","22","Emilia");
INSERT INTO localidades VALUES("1948","22","Empalme San Carlos");
INSERT INTO localidades VALUES("1949","22","Empalme Villa Constitucion");
INSERT INTO localidades VALUES("1950","22","Esmeralda");
INSERT INTO localidades VALUES("1951","22","Esperanza");
INSERT INTO localidades VALUES("1952","22","Estación Alvear");
INSERT INTO localidades VALUES("1953","22","Estacion Clucellas");
INSERT INTO localidades VALUES("1954","22","Esteban Rams");
INSERT INTO localidades VALUES("1955","22","Esther");
INSERT INTO localidades VALUES("1956","22","Esustolia");
INSERT INTO localidades VALUES("1957","22","Eusebia");
INSERT INTO localidades VALUES("1958","22","Felicia");
INSERT INTO localidades VALUES("1959","22","Fidela");
INSERT INTO localidades VALUES("1960","22","Fighiera");
INSERT INTO localidades VALUES("1961","22","Firmat");
INSERT INTO localidades VALUES("1962","22","Florencia");
INSERT INTO localidades VALUES("1963","22","Fortín Olmos");
INSERT INTO localidades VALUES("1964","22","Franck");
INSERT INTO localidades VALUES("1965","22","Fray Luis Beltrán");
INSERT INTO localidades VALUES("1966","22","Frontera");
INSERT INTO localidades VALUES("1967","22","Fuentes");
INSERT INTO localidades VALUES("1968","22","Funes");
INSERT INTO localidades VALUES("1969","22","Gaboto");
INSERT INTO localidades VALUES("1970","22","Galisteo");
INSERT INTO localidades VALUES("1971","22","Gálvez");
INSERT INTO localidades VALUES("1972","22","Garabalto");
INSERT INTO localidades VALUES("1973","22","Garibaldi");
INSERT INTO localidades VALUES("1974","22","Gato Colorado");
INSERT INTO localidades VALUES("1975","22","Gdor. Crespo");
INSERT INTO localidades VALUES("1976","22","Gessler");
INSERT INTO localidades VALUES("1977","22","Godoy");
INSERT INTO localidades VALUES("1978","22","Golondrina");
INSERT INTO localidades VALUES("1979","22","Gral. Gelly");
INSERT INTO localidades VALUES("1980","22","Gral. Lagos");
INSERT INTO localidades VALUES("1981","22","Granadero Baigorria");
INSERT INTO localidades VALUES("1982","22","Gregoria Perez De Denis");
INSERT INTO localidades VALUES("1983","22","Grutly");
INSERT INTO localidades VALUES("1984","22","Guadalupe N.");
INSERT INTO localidades VALUES("1985","22","Gödeken");
INSERT INTO localidades VALUES("1986","22","Helvecia");
INSERT INTO localidades VALUES("1987","22","Hersilia");
INSERT INTO localidades VALUES("1988","22","Hipatía");
INSERT INTO localidades VALUES("1989","22","Huanqueros");
INSERT INTO localidades VALUES("1990","22","Hugentobler");
INSERT INTO localidades VALUES("1991","22","Hughes");
INSERT INTO localidades VALUES("1992","22","Humberto 1º");
INSERT INTO localidades VALUES("1993","22","Humboldt");
INSERT INTO localidades VALUES("1994","22","Ibarlucea");
INSERT INTO localidades VALUES("1995","22","Ing. Chanourdie");
INSERT INTO localidades VALUES("1996","22","Intiyaco");
INSERT INTO localidades VALUES("1997","22","Ituzaingó");
INSERT INTO localidades VALUES("1998","22","Jacinto L. Aráuz");
INSERT INTO localidades VALUES("1999","22","Josefina");
INSERT INTO localidades VALUES("2000","22","Juan B. Molina");
INSERT INTO localidades VALUES("2001","22","Juan de Garay");
INSERT INTO localidades VALUES("2002","22","Juncal");
INSERT INTO localidades VALUES("2003","22","La Brava");
INSERT INTO localidades VALUES("2004","22","La Cabral");
INSERT INTO localidades VALUES("2005","22","La Camila");
INSERT INTO localidades VALUES("2006","22","La Chispa");
INSERT INTO localidades VALUES("2007","22","La Clara");
INSERT INTO localidades VALUES("2008","22","La Criolla");
INSERT INTO localidades VALUES("2009","22","La Gallareta");
INSERT INTO localidades VALUES("2010","22","La Lucila");
INSERT INTO localidades VALUES("2011","22","La Pelada");
INSERT INTO localidades VALUES("2012","22","La Penca");
INSERT INTO localidades VALUES("2013","22","La Rubia");
INSERT INTO localidades VALUES("2014","22","La Sarita");
INSERT INTO localidades VALUES("2015","22","La Vanguardia");
INSERT INTO localidades VALUES("2016","22","Labordeboy");
INSERT INTO localidades VALUES("2017","22","Laguna Paiva");
INSERT INTO localidades VALUES("2018","22","Landeta");
INSERT INTO localidades VALUES("2019","22","Lanteri");
INSERT INTO localidades VALUES("2020","22","Larrechea");
INSERT INTO localidades VALUES("2021","22","Las Avispas");
INSERT INTO localidades VALUES("2022","22","Las Bandurrias");
INSERT INTO localidades VALUES("2023","22","Las Garzas");
INSERT INTO localidades VALUES("2024","22","Las Palmeras");
INSERT INTO localidades VALUES("2025","22","Las Parejas");
INSERT INTO localidades VALUES("2026","22","Las Petacas");
INSERT INTO localidades VALUES("2027","22","Las Rosas");
INSERT INTO localidades VALUES("2028","22","Las Toscas");
INSERT INTO localidades VALUES("2029","22","Las Tunas");
INSERT INTO localidades VALUES("2030","22","Lazzarino");
INSERT INTO localidades VALUES("2031","22","Lehmann");
INSERT INTO localidades VALUES("2032","22","Llambi Campbell");
INSERT INTO localidades VALUES("2033","22","Logroño");
INSERT INTO localidades VALUES("2034","22","Loma Alta");
INSERT INTO localidades VALUES("2035","22","López");
INSERT INTO localidades VALUES("2036","22","Los Amores");
INSERT INTO localidades VALUES("2037","22","Los Cardos");
INSERT INTO localidades VALUES("2038","22","Los Laureles");
INSERT INTO localidades VALUES("2039","22","Los Molinos");
INSERT INTO localidades VALUES("2040","22","Los Quirquinchos");
INSERT INTO localidades VALUES("2041","22","Lucio V. Lopez");
INSERT INTO localidades VALUES("2042","22","Luis Palacios");
INSERT INTO localidades VALUES("2043","22","Ma. Juana");
INSERT INTO localidades VALUES("2044","22","Ma. Luisa");
INSERT INTO localidades VALUES("2045","22","Ma. Susana");
INSERT INTO localidades VALUES("2046","22","Ma. Teresa");
INSERT INTO localidades VALUES("2047","22","Maciel");
INSERT INTO localidades VALUES("2048","22","Maggiolo");
INSERT INTO localidades VALUES("2049","22","Malabrigo");
INSERT INTO localidades VALUES("2050","22","Marcelino Escalada");
INSERT INTO localidades VALUES("2051","22","Margarita");
INSERT INTO localidades VALUES("2052","22","Matilde");
INSERT INTO localidades VALUES("2053","22","Mauá");
INSERT INTO localidades VALUES("2054","22","Máximo Paz");
INSERT INTO localidades VALUES("2055","22","Melincué");
INSERT INTO localidades VALUES("2056","22","Miguel Torres");
INSERT INTO localidades VALUES("2057","22","Moisés Ville");
INSERT INTO localidades VALUES("2058","22","Monigotes");
INSERT INTO localidades VALUES("2059","22","Monje");
INSERT INTO localidades VALUES("2060","22","Monte Obscuridad");
INSERT INTO localidades VALUES("2061","22","Monte Vera");
INSERT INTO localidades VALUES("2062","22","Montefiore");
INSERT INTO localidades VALUES("2063","22","Montes de Oca");
INSERT INTO localidades VALUES("2064","22","Murphy");
INSERT INTO localidades VALUES("2065","22","Ñanducita");
INSERT INTO localidades VALUES("2066","22","Naré");
INSERT INTO localidades VALUES("2067","22","Nelson");
INSERT INTO localidades VALUES("2068","22","Nicanor E. Molinas");
INSERT INTO localidades VALUES("2069","22","Nuevo Torino");
INSERT INTO localidades VALUES("2070","22","Oliveros");
INSERT INTO localidades VALUES("2071","22","Palacios");
INSERT INTO localidades VALUES("2072","22","Pavón");
INSERT INTO localidades VALUES("2073","22","Pavón Arriba");
INSERT INTO localidades VALUES("2074","22","Pedro Gómez Cello");
INSERT INTO localidades VALUES("2075","22","Pérez");
INSERT INTO localidades VALUES("2076","22","Peyrano");
INSERT INTO localidades VALUES("2077","22","Piamonte");
INSERT INTO localidades VALUES("2078","22","Pilar");
INSERT INTO localidades VALUES("2079","22","Piñero");
INSERT INTO localidades VALUES("2080","22","Plaza Clucellas");
INSERT INTO localidades VALUES("2081","22","Portugalete");
INSERT INTO localidades VALUES("2082","22","Pozo Borrado");
INSERT INTO localidades VALUES("2083","22","Progreso");
INSERT INTO localidades VALUES("2084","22","Providencia");
INSERT INTO localidades VALUES("2085","22","Pte. Roca");
INSERT INTO localidades VALUES("2086","22","Pueblo Andino");
INSERT INTO localidades VALUES("2087","22","Pueblo Esther");
INSERT INTO localidades VALUES("2088","22","Pueblo Gral. San Martín");
INSERT INTO localidades VALUES("2089","22","Pueblo Irigoyen");
INSERT INTO localidades VALUES("2090","22","Pueblo Marini");
INSERT INTO localidades VALUES("2091","22","Pueblo Muñoz");
INSERT INTO localidades VALUES("2092","22","Pueblo Uranga");
INSERT INTO localidades VALUES("2093","22","Pujato");
INSERT INTO localidades VALUES("2094","22","Pujato N.");
INSERT INTO localidades VALUES("2095","22","Rafaela");
INSERT INTO localidades VALUES("2096","22","Ramayón");
INSERT INTO localidades VALUES("2097","22","Ramona");
INSERT INTO localidades VALUES("2098","22","Reconquista");
INSERT INTO localidades VALUES("2099","22","Recreo");
INSERT INTO localidades VALUES("2100","22","Ricardone");
INSERT INTO localidades VALUES("2101","22","Rivadavia");
INSERT INTO localidades VALUES("2102","22","Roldán");
INSERT INTO localidades VALUES("2103","22","Romang");
INSERT INTO localidades VALUES("2104","22","Rosario");
INSERT INTO localidades VALUES("2105","22","Rueda");
INSERT INTO localidades VALUES("2106","22","Rufino");
INSERT INTO localidades VALUES("2107","22","Sa Pereira");
INSERT INTO localidades VALUES("2108","22","Saguier");
INSERT INTO localidades VALUES("2109","22","Saladero M. Cabal");
INSERT INTO localidades VALUES("2110","22","Salto Grande");
INSERT INTO localidades VALUES("2111","22","San Agustín");
INSERT INTO localidades VALUES("2112","22","San Antonio de Obligado");
INSERT INTO localidades VALUES("2113","22","San Bernardo (N.J.)");
INSERT INTO localidades VALUES("2114","22","San Bernardo (S.J.)");
INSERT INTO localidades VALUES("2115","22","San Carlos Centro");
INSERT INTO localidades VALUES("2116","22","San Carlos N.");
INSERT INTO localidades VALUES("2117","22","San Carlos S.");
INSERT INTO localidades VALUES("2118","22","San Cristóbal");
INSERT INTO localidades VALUES("2119","22","San Eduardo");
INSERT INTO localidades VALUES("2120","22","San Eugenio");
INSERT INTO localidades VALUES("2121","22","San Fabián");
INSERT INTO localidades VALUES("2122","22","San Fco. de Santa Fé");
INSERT INTO localidades VALUES("2123","22","San Genaro");
INSERT INTO localidades VALUES("2124","22","San Genaro N.");
INSERT INTO localidades VALUES("2125","22","San Gregorio");
INSERT INTO localidades VALUES("2126","22","San Guillermo");
INSERT INTO localidades VALUES("2127","22","San Javier");
INSERT INTO localidades VALUES("2128","22","San Jerónimo del Sauce");
INSERT INTO localidades VALUES("2129","22","San Jerónimo N.");
INSERT INTO localidades VALUES("2130","22","San Jerónimo S.");
INSERT INTO localidades VALUES("2131","22","San Jorge");
INSERT INTO localidades VALUES("2132","22","San José de La Esquina");
INSERT INTO localidades VALUES("2133","22","San José del Rincón");
INSERT INTO localidades VALUES("2134","22","San Justo");
INSERT INTO localidades VALUES("2135","22","San Lorenzo");
INSERT INTO localidades VALUES("2136","22","San Mariano");
INSERT INTO localidades VALUES("2137","22","San Martín de Las Escobas");
INSERT INTO localidades VALUES("2138","22","San Martín N.");
INSERT INTO localidades VALUES("2139","22","San Vicente");
INSERT INTO localidades VALUES("2140","22","Sancti Spititu");
INSERT INTO localidades VALUES("2141","22","Sanford");
INSERT INTO localidades VALUES("2142","22","Santo Domingo");
INSERT INTO localidades VALUES("2143","22","Santo Tomé");
INSERT INTO localidades VALUES("2144","22","Santurce");
INSERT INTO localidades VALUES("2145","22","Sargento Cabral");
INSERT INTO localidades VALUES("2146","22","Sarmiento");
INSERT INTO localidades VALUES("2147","22","Sastre");
INSERT INTO localidades VALUES("2148","22","Sauce Viejo");
INSERT INTO localidades VALUES("2149","22","Serodino");
INSERT INTO localidades VALUES("2150","22","Silva");
INSERT INTO localidades VALUES("2151","22","Soldini");
INSERT INTO localidades VALUES("2152","22","Soledad");
INSERT INTO localidades VALUES("2153","22","Soutomayor");
INSERT INTO localidades VALUES("2154","22","Sta. Clara de Buena Vista");
INSERT INTO localidades VALUES("2155","22","Sta. Clara de Saguier");
INSERT INTO localidades VALUES("2156","22","Sta. Isabel");
INSERT INTO localidades VALUES("2157","22","Sta. Margarita");
INSERT INTO localidades VALUES("2158","22","Sta. Maria Centro");
INSERT INTO localidades VALUES("2159","22","Sta. María N.");
INSERT INTO localidades VALUES("2160","22","Sta. Rosa");
INSERT INTO localidades VALUES("2161","22","Sta. Teresa");
INSERT INTO localidades VALUES("2162","22","Suardi");
INSERT INTO localidades VALUES("2163","22","Sunchales");
INSERT INTO localidades VALUES("2164","22","Susana");
INSERT INTO localidades VALUES("2165","22","Tacuarendí");
INSERT INTO localidades VALUES("2166","22","Tacural");
INSERT INTO localidades VALUES("2167","22","Tartagal");
INSERT INTO localidades VALUES("2168","22","Teodelina");
INSERT INTO localidades VALUES("2169","22","Theobald");
INSERT INTO localidades VALUES("2170","22","Timbúes");
INSERT INTO localidades VALUES("2171","22","Toba");
INSERT INTO localidades VALUES("2172","22","Tortugas");
INSERT INTO localidades VALUES("2173","22","Tostado");
INSERT INTO localidades VALUES("2174","22","Totoras");
INSERT INTO localidades VALUES("2175","22","Traill");
INSERT INTO localidades VALUES("2176","22","Venado Tuerto");
INSERT INTO localidades VALUES("2177","22","Vera");
INSERT INTO localidades VALUES("2178","22","Vera y Pintado");
INSERT INTO localidades VALUES("2179","22","Videla");
INSERT INTO localidades VALUES("2180","22","Vila");
INSERT INTO localidades VALUES("2181","22","Villa Amelia");
INSERT INTO localidades VALUES("2182","22","Villa Ana");
INSERT INTO localidades VALUES("2183","22","Villa Cañas");
INSERT INTO localidades VALUES("2184","22","Villa Constitución");
INSERT INTO localidades VALUES("2185","22","Villa Eloísa");
INSERT INTO localidades VALUES("2186","22","Villa Gdor. Gálvez");
INSERT INTO localidades VALUES("2187","22","Villa Guillermina");
INSERT INTO localidades VALUES("2188","22","Villa Minetti");
INSERT INTO localidades VALUES("2189","22","Villa Mugueta");
INSERT INTO localidades VALUES("2190","22","Villa Ocampo");
INSERT INTO localidades VALUES("2191","22","Villa San José");
INSERT INTO localidades VALUES("2192","22","Villa Saralegui");
INSERT INTO localidades VALUES("2193","22","Villa Trinidad");
INSERT INTO localidades VALUES("2194","22","Villada");
INSERT INTO localidades VALUES("2195","22","Virginia");
INSERT INTO localidades VALUES("2196","22","Wheelwright");
INSERT INTO localidades VALUES("2197","22","Zavalla");
INSERT INTO localidades VALUES("2198","22","Zenón Pereira");
INSERT INTO localidades VALUES("2199","23","Añatuya");
INSERT INTO localidades VALUES("2200","23","Árraga");
INSERT INTO localidades VALUES("2201","23","Bandera");
INSERT INTO localidades VALUES("2202","23","Bandera Bajada");
INSERT INTO localidades VALUES("2203","23","Beltrán");
INSERT INTO localidades VALUES("2204","23","Brea Pozo");
INSERT INTO localidades VALUES("2205","23","Campo Gallo");
INSERT INTO localidades VALUES("2206","23","Capital");
INSERT INTO localidades VALUES("2207","23","Chilca Juliana");
INSERT INTO localidades VALUES("2208","23","Choya");
INSERT INTO localidades VALUES("2209","23","Clodomira");
INSERT INTO localidades VALUES("2210","23","Col. Alpina");
INSERT INTO localidades VALUES("2211","23","Col. Dora");
INSERT INTO localidades VALUES("2212","23","Col. El Simbolar Robles");
INSERT INTO localidades VALUES("2213","23","El Bobadal");
INSERT INTO localidades VALUES("2214","23","El Charco");
INSERT INTO localidades VALUES("2215","23","El Mojón");
INSERT INTO localidades VALUES("2216","23","Estación Atamisqui");
INSERT INTO localidades VALUES("2217","23","Estación Simbolar");
INSERT INTO localidades VALUES("2218","23","Fernández");
INSERT INTO localidades VALUES("2219","23","Fortín Inca");
INSERT INTO localidades VALUES("2220","23","Frías");
INSERT INTO localidades VALUES("2221","23","Garza");
INSERT INTO localidades VALUES("2222","23","Gramilla");
INSERT INTO localidades VALUES("2223","23","Guardia Escolta");
INSERT INTO localidades VALUES("2224","23","Herrera");
INSERT INTO localidades VALUES("2225","23","Icaño");
INSERT INTO localidades VALUES("2226","23","Ing. Forres");
INSERT INTO localidades VALUES("2227","23","La Banda");
INSERT INTO localidades VALUES("2228","23","La Cañada");
INSERT INTO localidades VALUES("2229","23","Laprida");
INSERT INTO localidades VALUES("2230","23","Lavalle");
INSERT INTO localidades VALUES("2231","23","Loreto");
INSERT INTO localidades VALUES("2232","23","Los Juríes");
INSERT INTO localidades VALUES("2233","23","Los Núñez");
INSERT INTO localidades VALUES("2234","23","Los Pirpintos");
INSERT INTO localidades VALUES("2235","23","Los Quiroga");
INSERT INTO localidades VALUES("2236","23","Los Telares");
INSERT INTO localidades VALUES("2237","23","Lugones");
INSERT INTO localidades VALUES("2238","23","Malbrán");
INSERT INTO localidades VALUES("2239","23","Matara");
INSERT INTO localidades VALUES("2240","23","Medellín");
INSERT INTO localidades VALUES("2241","23","Monte Quemado");
INSERT INTO localidades VALUES("2242","23","Nueva Esperanza");
INSERT INTO localidades VALUES("2243","23","Nueva Francia");
INSERT INTO localidades VALUES("2244","23","Palo Negro");
INSERT INTO localidades VALUES("2245","23","Pampa de Los Guanacos");
INSERT INTO localidades VALUES("2246","23","Pinto");
INSERT INTO localidades VALUES("2247","23","Pozo Hondo");
INSERT INTO localidades VALUES("2248","23","Quimilí");
INSERT INTO localidades VALUES("2249","23","Real Sayana");
INSERT INTO localidades VALUES("2250","23","Sachayoj");
INSERT INTO localidades VALUES("2251","23","San Pedro de Guasayán");
INSERT INTO localidades VALUES("2252","23","Selva");
INSERT INTO localidades VALUES("2253","23","Sol de Julio");
INSERT INTO localidades VALUES("2254","23","Sumampa");
INSERT INTO localidades VALUES("2255","23","Suncho Corral");
INSERT INTO localidades VALUES("2256","23","Taboada");
INSERT INTO localidades VALUES("2257","23","Tapso");
INSERT INTO localidades VALUES("2258","23","Termas de Rio Hondo");
INSERT INTO localidades VALUES("2259","23","Tintina");
INSERT INTO localidades VALUES("2260","23","Tomas Young");
INSERT INTO localidades VALUES("2261","23","Vilelas");
INSERT INTO localidades VALUES("2262","23","Villa Atamisqui");
INSERT INTO localidades VALUES("2263","23","Villa La Punta");
INSERT INTO localidades VALUES("2264","23","Villa Ojo de Agua");
INSERT INTO localidades VALUES("2265","23","Villa Río Hondo");
INSERT INTO localidades VALUES("2266","23","Villa Salavina");
INSERT INTO localidades VALUES("2267","23","Villa Unión");
INSERT INTO localidades VALUES("2268","23","Vilmer");
INSERT INTO localidades VALUES("2269","23","Weisburd");
INSERT INTO localidades VALUES("2270","24","Río Grande");
INSERT INTO localidades VALUES("2271","24","Tolhuin");
INSERT INTO localidades VALUES("2272","24","Ushuaia");
INSERT INTO localidades VALUES("2273","25","Acheral");
INSERT INTO localidades VALUES("2274","25","Agua Dulce");
INSERT INTO localidades VALUES("2275","25","Aguilares");
INSERT INTO localidades VALUES("2276","25","Alderetes");
INSERT INTO localidades VALUES("2277","25","Alpachiri");
INSERT INTO localidades VALUES("2278","25","Alto Verde");
INSERT INTO localidades VALUES("2279","25","Amaicha del Valle");
INSERT INTO localidades VALUES("2280","25","Amberes");
INSERT INTO localidades VALUES("2281","25","Ancajuli");
INSERT INTO localidades VALUES("2282","25","Arcadia");
INSERT INTO localidades VALUES("2283","25","Atahona");
INSERT INTO localidades VALUES("2284","25","Banda del Río Sali");
INSERT INTO localidades VALUES("2285","25","Bella Vista");
INSERT INTO localidades VALUES("2286","25","Buena Vista");
INSERT INTO localidades VALUES("2287","25","Burruyacú");
INSERT INTO localidades VALUES("2288","25","Capitán Cáceres");
INSERT INTO localidades VALUES("2289","25","Cevil Redondo");
INSERT INTO localidades VALUES("2290","25","Choromoro");
INSERT INTO localidades VALUES("2291","25","Ciudacita");
INSERT INTO localidades VALUES("2292","25","Colalao del Valle");
INSERT INTO localidades VALUES("2293","25","Colombres");
INSERT INTO localidades VALUES("2294","25","Concepción");
INSERT INTO localidades VALUES("2295","25","Delfín Gallo");
INSERT INTO localidades VALUES("2296","25","El Bracho");
INSERT INTO localidades VALUES("2297","25","El Cadillal");
INSERT INTO localidades VALUES("2298","25","El Cercado");
INSERT INTO localidades VALUES("2299","25","El Chañar");
INSERT INTO localidades VALUES("2300","25","El Manantial");
INSERT INTO localidades VALUES("2301","25","El Mojón");
INSERT INTO localidades VALUES("2302","25","El Mollar");
INSERT INTO localidades VALUES("2303","25","El Naranjito");
INSERT INTO localidades VALUES("2304","25","El Naranjo");
INSERT INTO localidades VALUES("2305","25","El Polear");
INSERT INTO localidades VALUES("2306","25","El Puestito");
INSERT INTO localidades VALUES("2307","25","El Sacrificio");
INSERT INTO localidades VALUES("2308","25","El Timbó");
INSERT INTO localidades VALUES("2309","25","Escaba");
INSERT INTO localidades VALUES("2310","25","Esquina");
INSERT INTO localidades VALUES("2311","25","Estación Aráoz");
INSERT INTO localidades VALUES("2312","25","Famaillá");
INSERT INTO localidades VALUES("2313","25","Gastone");
INSERT INTO localidades VALUES("2314","25","Gdor. Garmendia");
INSERT INTO localidades VALUES("2315","25","Gdor. Piedrabuena");
INSERT INTO localidades VALUES("2316","25","Graneros");
INSERT INTO localidades VALUES("2317","25","Huasa Pampa");
INSERT INTO localidades VALUES("2318","25","J. B. Alberdi");
INSERT INTO localidades VALUES("2319","25","La Cocha");
INSERT INTO localidades VALUES("2320","25","La Esperanza");
INSERT INTO localidades VALUES("2321","25","La Florida");
INSERT INTO localidades VALUES("2322","25","La Ramada");
INSERT INTO localidades VALUES("2323","25","La Trinidad");
INSERT INTO localidades VALUES("2324","25","Lamadrid");
INSERT INTO localidades VALUES("2325","25","Las Cejas");
INSERT INTO localidades VALUES("2326","25","Las Talas");
INSERT INTO localidades VALUES("2327","25","Las Talitas");
INSERT INTO localidades VALUES("2328","25","Los Bulacio");
INSERT INTO localidades VALUES("2329","25","Los Gómez");
INSERT INTO localidades VALUES("2330","25","Los Nogales");
INSERT INTO localidades VALUES("2331","25","Los Pereyra");
INSERT INTO localidades VALUES("2332","25","Los Pérez");
INSERT INTO localidades VALUES("2333","25","Los Puestos");
INSERT INTO localidades VALUES("2334","25","Los Ralos");
INSERT INTO localidades VALUES("2335","25","Los Sarmientos");
INSERT INTO localidades VALUES("2336","25","Los Sosa");
INSERT INTO localidades VALUES("2337","25","Lules");
INSERT INTO localidades VALUES("2338","25","M. García Fernández");
INSERT INTO localidades VALUES("2339","25","Manuela Pedraza");
INSERT INTO localidades VALUES("2340","25","Medinas");
INSERT INTO localidades VALUES("2341","25","Monte Bello");
INSERT INTO localidades VALUES("2342","25","Monteagudo");
INSERT INTO localidades VALUES("2343","25","Monteros");
INSERT INTO localidades VALUES("2344","25","Padre Monti");
INSERT INTO localidades VALUES("2345","25","Pampa Mayo");
INSERT INTO localidades VALUES("2346","25","Quilmes");
INSERT INTO localidades VALUES("2347","25","Raco");
INSERT INTO localidades VALUES("2348","25","Ranchillos");
INSERT INTO localidades VALUES("2349","25","Río Chico");
INSERT INTO localidades VALUES("2350","25","Río Colorado");
INSERT INTO localidades VALUES("2351","25","Río Seco");
INSERT INTO localidades VALUES("2352","25","Rumi Punco");
INSERT INTO localidades VALUES("2353","25","San Andrés");
INSERT INTO localidades VALUES("2354","25","San Felipe");
INSERT INTO localidades VALUES("2355","25","San Ignacio");
INSERT INTO localidades VALUES("2356","25","San Javier");
INSERT INTO localidades VALUES("2357","25","San José");
INSERT INTO localidades VALUES("2358","25","San Miguel de 25");
INSERT INTO localidades VALUES("2359","25","San Pedro");
INSERT INTO localidades VALUES("2360","25","San Pedro de Colalao");
INSERT INTO localidades VALUES("2361","25","Santa Rosa de Leales");
INSERT INTO localidades VALUES("2362","25","Sgto. Moya");
INSERT INTO localidades VALUES("2363","25","Siete de Abril");
INSERT INTO localidades VALUES("2364","25","Simoca");
INSERT INTO localidades VALUES("2365","25","Soldado Maldonado");
INSERT INTO localidades VALUES("2366","25","Sta. Ana");
INSERT INTO localidades VALUES("2367","25","Sta. Cruz");
INSERT INTO localidades VALUES("2368","25","Sta. Lucía");
INSERT INTO localidades VALUES("2369","25","Taco Ralo");
INSERT INTO localidades VALUES("2370","25","Tafí del Valle");
INSERT INTO localidades VALUES("2371","25","Tafí Viejo");
INSERT INTO localidades VALUES("2372","25","Tapia");
INSERT INTO localidades VALUES("2373","25","Teniente Berdina");
INSERT INTO localidades VALUES("2374","25","Trancas");
INSERT INTO localidades VALUES("2375","25","Villa Belgrano");
INSERT INTO localidades VALUES("2376","25","Villa Benjamín Araoz");
INSERT INTO localidades VALUES("2377","25","Villa Chiligasta");
INSERT INTO localidades VALUES("2378","25","Villa de Leales");
INSERT INTO localidades VALUES("2379","25","Villa Quinteros");
INSERT INTO localidades VALUES("2380","25","Yánima");
INSERT INTO localidades VALUES("2381","25","Yerba Buena");
INSERT INTO localidades VALUES("2382","25","Yerba Buena (S)");



CREATE TABLE `matarife` (
  `id_matarife` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `cuit` varchar(45) NOT NULL,
  `establecimiento` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_matarife`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO matarife VALUES("17","brucemar s.a","matarife-default.jpg","12345","municipalidad de malargue","francocara18@gmail.com");
INSERT INTO matarife VALUES("18","gutierrez","matarife-default.jpg","20311672526","loncoche","francocara18@yahoo.com");
INSERT INTO matarife VALUES("19","manzano","matarife-default.jpg","012345","municipalidad de malargue","francocara182016@gmail.com");



CREATE TABLE `paises` (
  `Codigo` varchar(2) NOT NULL,
  `Pais` varchar(100) NOT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO paises VALUES("AU","Australia");
INSERT INTO paises VALUES("CN","China");
INSERT INTO paises VALUES("JP","Japan");
INSERT INTO paises VALUES("TH","Thailand");
INSERT INTO paises VALUES("IN","India");
INSERT INTO paises VALUES("MY","Malaysia");
INSERT INTO paises VALUES("KR","Kore");
INSERT INTO paises VALUES("HK","Hong Kong");
INSERT INTO paises VALUES("TW","Taiwan");
INSERT INTO paises VALUES("PH","Philippines");
INSERT INTO paises VALUES("VN","Vietnam");
INSERT INTO paises VALUES("FR","France");
INSERT INTO paises VALUES("EU","Europe");
INSERT INTO paises VALUES("DE","Germany");
INSERT INTO paises VALUES("SE","Sweden");
INSERT INTO paises VALUES("IT","Italy");
INSERT INTO paises VALUES("GR","Greece");
INSERT INTO paises VALUES("ES","Spain");
INSERT INTO paises VALUES("AT","Austria");
INSERT INTO paises VALUES("GB","United Kingdom");
INSERT INTO paises VALUES("NL","Netherlands");
INSERT INTO paises VALUES("BE","Belgium");
INSERT INTO paises VALUES("CH","Switzerland");
INSERT INTO paises VALUES("AE","United Arab Emirates");
INSERT INTO paises VALUES("IL","Israel");
INSERT INTO paises VALUES("UA","Ukraine");
INSERT INTO paises VALUES("RU","Russian Federation");
INSERT INTO paises VALUES("KZ","Kazakhstan");
INSERT INTO paises VALUES("PT","Portugal");
INSERT INTO paises VALUES("SA","Saudi Arabia");
INSERT INTO paises VALUES("DK","Denmark");
INSERT INTO paises VALUES("IR","Ira");
INSERT INTO paises VALUES("NO","Norway");
INSERT INTO paises VALUES("US","United States");
INSERT INTO paises VALUES("MX","Mexico");
INSERT INTO paises VALUES("CA","Canada");
INSERT INTO paises VALUES("A1","Anonymous Proxy");
INSERT INTO paises VALUES("SY","Syrian Arab Republic");
INSERT INTO paises VALUES("CY","Cyprus");
INSERT INTO paises VALUES("CZ","Czech Republic");
INSERT INTO paises VALUES("IQ","Iraq");
INSERT INTO paises VALUES("TR","Turkey");
INSERT INTO paises VALUES("RO","Romania");
INSERT INTO paises VALUES("LB","Lebanon");
INSERT INTO paises VALUES("HU","Hungary");
INSERT INTO paises VALUES("GE","Georgia");
INSERT INTO paises VALUES("BR","Brazil");
INSERT INTO paises VALUES("AZ","Azerbaijan");
INSERT INTO paises VALUES("A2","Satellite Provider");
INSERT INTO paises VALUES("PS","Palestinian Territory");
INSERT INTO paises VALUES("LT","Lithuania");
INSERT INTO paises VALUES("OM","Oman");
INSERT INTO paises VALUES("SK","Slovakia");
INSERT INTO paises VALUES("RS","Serbia");
INSERT INTO paises VALUES("FI","Finland");
INSERT INTO paises VALUES("IS","Iceland");
INSERT INTO paises VALUES("BG","Bulgaria");
INSERT INTO paises VALUES("SI","Slovenia");
INSERT INTO paises VALUES("MD","Moldov");
INSERT INTO paises VALUES("MK","Macedonia");
INSERT INTO paises VALUES("LI","Liechtenstein");
INSERT INTO paises VALUES("JE","Jersey");
INSERT INTO paises VALUES("PL","Poland");
INSERT INTO paises VALUES("HR","Croatia");
INSERT INTO paises VALUES("BA","Bosnia and Herzegovina");
INSERT INTO paises VALUES("EE","Estonia");
INSERT INTO paises VALUES("LV","Latvia");
INSERT INTO paises VALUES("JO","Jordan");
INSERT INTO paises VALUES("KG","Kyrgyzstan");
INSERT INTO paises VALUES("RE","Reunion");
INSERT INTO paises VALUES("IE","Ireland");
INSERT INTO paises VALUES("LY","Libya");
INSERT INTO paises VALUES("LU","Luxembourg");
INSERT INTO paises VALUES("AM","Armenia");
INSERT INTO paises VALUES("VG","Virgin Island");
INSERT INTO paises VALUES("YE","Yemen");
INSERT INTO paises VALUES("BY","Belarus");
INSERT INTO paises VALUES("GI","Gibraltar");
INSERT INTO paises VALUES("MQ","Martinique");
INSERT INTO paises VALUES("PA","Panama");
INSERT INTO paises VALUES("DO","Dominican Republic");
INSERT INTO paises VALUES("GU","Guam");
INSERT INTO paises VALUES("PR","Puerto Rico");
INSERT INTO paises VALUES("VI","Virgin Island");
INSERT INTO paises VALUES("MN","Mongolia");
INSERT INTO paises VALUES("NZ","New Zealand");
INSERT INTO paises VALUES("SG","Singapore");
INSERT INTO paises VALUES("ID","Indonesia");
INSERT INTO paises VALUES("NP","Nepal");
INSERT INTO paises VALUES("PG","Papua New Guinea");
INSERT INTO paises VALUES("PK","Pakistan");
INSERT INTO paises VALUES("AP","Asia/Pacific Region");
INSERT INTO paises VALUES("BS","Bahamas");
INSERT INTO paises VALUES("LC","Saint Lucia");
INSERT INTO paises VALUES("AR","Argentina");
INSERT INTO paises VALUES("BD","Bangladesh");
INSERT INTO paises VALUES("TK","Tokelau");
INSERT INTO paises VALUES("KH","Cambodia");
INSERT INTO paises VALUES("MO","Macau");
INSERT INTO paises VALUES("MV","Maldives");
INSERT INTO paises VALUES("AF","Afghanistan");
INSERT INTO paises VALUES("NC","New Caledonia");
INSERT INTO paises VALUES("FJ","Fiji");
INSERT INTO paises VALUES("WF","Wallis and Futuna");
INSERT INTO paises VALUES("QA","Qatar");
INSERT INTO paises VALUES("AL","Albania");
INSERT INTO paises VALUES("BZ","Belize");
INSERT INTO paises VALUES("UZ","Uzbekistan");
INSERT INTO paises VALUES("KW","Kuwait");
INSERT INTO paises VALUES("ME","Montenegro");
INSERT INTO paises VALUES("PE","Peru");
INSERT INTO paises VALUES("BM","Bermuda");
INSERT INTO paises VALUES("CW","Curacao");
INSERT INTO paises VALUES("CO","Colombia");
INSERT INTO paises VALUES("VE","Venezuela");
INSERT INTO paises VALUES("CL","Chile");
INSERT INTO paises VALUES("EC","Ecuador");
INSERT INTO paises VALUES("ZA","South Africa");
INSERT INTO paises VALUES("IM","Isle of Man");
INSERT INTO paises VALUES("BO","Bolivia");
INSERT INTO paises VALUES("GG","Guernsey");
INSERT INTO paises VALUES("MT","Malta");
INSERT INTO paises VALUES("TJ","Tajikistan");
INSERT INTO paises VALUES("SC","Seychelles");
INSERT INTO paises VALUES("BH","Bahrain");
INSERT INTO paises VALUES("EG","Egypt");
INSERT INTO paises VALUES("ZW","Zimbabwe");
INSERT INTO paises VALUES("LR","Liberia");
INSERT INTO paises VALUES("KE","Kenya");
INSERT INTO paises VALUES("GH","Ghana");
INSERT INTO paises VALUES("NG","Nigeria");
INSERT INTO paises VALUES("TZ","Tanzani");
INSERT INTO paises VALUES("ZM","Zambia");
INSERT INTO paises VALUES("MG","Madagascar");
INSERT INTO paises VALUES("AO","Angola");
INSERT INTO paises VALUES("NA","Namibia");
INSERT INTO paises VALUES("CI","Cote D'Ivoire");
INSERT INTO paises VALUES("SD","Sudan");
INSERT INTO paises VALUES("CM","Cameroon");
INSERT INTO paises VALUES("MW","Malawi");
INSERT INTO paises VALUES("GA","Gabon");
INSERT INTO paises VALUES("ML","Mali");
INSERT INTO paises VALUES("BJ","Benin");
INSERT INTO paises VALUES("TD","Chad");
INSERT INTO paises VALUES("BW","Botswana");
INSERT INTO paises VALUES("CV","Cape Verde");
INSERT INTO paises VALUES("RW","Rwanda");
INSERT INTO paises VALUES("CG","Congo");
INSERT INTO paises VALUES("UG","Uganda");
INSERT INTO paises VALUES("MZ","Mozambique");
INSERT INTO paises VALUES("GM","Gambia");
INSERT INTO paises VALUES("LS","Lesotho");
INSERT INTO paises VALUES("MU","Mauritius");
INSERT INTO paises VALUES("MA","Morocco");
INSERT INTO paises VALUES("DZ","Algeria");
INSERT INTO paises VALUES("GN","Guinea");
INSERT INTO paises VALUES("CD","Cong");
INSERT INTO paises VALUES("SZ","Swaziland");
INSERT INTO paises VALUES("BF","Burkina Faso");
INSERT INTO paises VALUES("SL","Sierra Leone");
INSERT INTO paises VALUES("SO","Somalia");
INSERT INTO paises VALUES("NE","Niger");
INSERT INTO paises VALUES("CF","Central African Republic");
INSERT INTO paises VALUES("TG","Togo");
INSERT INTO paises VALUES("BI","Burundi");
INSERT INTO paises VALUES("GQ","Equatorial Guinea");
INSERT INTO paises VALUES("SS","South Sudan");
INSERT INTO paises VALUES("SN","Senegal");
INSERT INTO paises VALUES("MR","Mauritania");
INSERT INTO paises VALUES("DJ","Djibouti");
INSERT INTO paises VALUES("KM","Comoros");
INSERT INTO paises VALUES("IO","British Indian Ocean Territory");
INSERT INTO paises VALUES("TN","Tunisia");
INSERT INTO paises VALUES("GL","Greenland");
INSERT INTO paises VALUES("VA","Holy See (Vatican City State)");
INSERT INTO paises VALUES("CR","Costa Rica");
INSERT INTO paises VALUES("KY","Cayman Islands");
INSERT INTO paises VALUES("JM","Jamaica");
INSERT INTO paises VALUES("GT","Guatemala");
INSERT INTO paises VALUES("MH","Marshall Islands");
INSERT INTO paises VALUES("AQ","Antarctica");
INSERT INTO paises VALUES("BB","Barbados");
INSERT INTO paises VALUES("AW","Aruba");
INSERT INTO paises VALUES("MC","Monaco");
INSERT INTO paises VALUES("AI","Anguilla");
INSERT INTO paises VALUES("KN","Saint Kitts and Nevis");
INSERT INTO paises VALUES("GD","Grenada");
INSERT INTO paises VALUES("PY","Paraguay");
INSERT INTO paises VALUES("MS","Montserrat");
INSERT INTO paises VALUES("TC","Turks and Caicos Islands");
INSERT INTO paises VALUES("AG","Antigua and Barbuda");
INSERT INTO paises VALUES("TV","Tuvalu");
INSERT INTO paises VALUES("PF","French Polynesia");
INSERT INTO paises VALUES("SB","Solomon Islands");
INSERT INTO paises VALUES("VU","Vanuatu");
INSERT INTO paises VALUES("ER","Eritrea");
INSERT INTO paises VALUES("TT","Trinidad and Tobago");
INSERT INTO paises VALUES("AD","Andorra");
INSERT INTO paises VALUES("HT","Haiti");
INSERT INTO paises VALUES("SH","Saint Helena");
INSERT INTO paises VALUES("FM","Micronesi");
INSERT INTO paises VALUES("SV","El Salvador");
INSERT INTO paises VALUES("HN","Honduras");
INSERT INTO paises VALUES("UY","Uruguay");
INSERT INTO paises VALUES("LK","Sri Lanka");
INSERT INTO paises VALUES("EH","Western Sahara");
INSERT INTO paises VALUES("CX","Christmas Island");
INSERT INTO paises VALUES("WS","Samoa");
INSERT INTO paises VALUES("SR","Suriname");
INSERT INTO paises VALUES("CK","Cook Islands");
INSERT INTO paises VALUES("KI","Kiribati");
INSERT INTO paises VALUES("NU","Niue");
INSERT INTO paises VALUES("TO","Tonga");
INSERT INTO paises VALUES("TF","French Southern Territories");
INSERT INTO paises VALUES("YT","Mayotte");
INSERT INTO paises VALUES("NF","Norfolk Island");
INSERT INTO paises VALUES("BN","Brunei Darussalam");
INSERT INTO paises VALUES("TM","Turkmenistan");
INSERT INTO paises VALUES("PN","Pitcairn Islands");
INSERT INTO paises VALUES("SM","San Marino");
INSERT INTO paises VALUES("AX","Aland Islands");
INSERT INTO paises VALUES("FO","Faroe Islands");
INSERT INTO paises VALUES("SJ","Svalbard and Jan Mayen");
INSERT INTO paises VALUES("CC","Cocos (Keeling) Islands");
INSERT INTO paises VALUES("NR","Nauru");
INSERT INTO paises VALUES("GS","South Georgia and the South Sandwich Islands");
INSERT INTO paises VALUES("UM","United States Minor Outlying Islands");
INSERT INTO paises VALUES("GW","Guinea-Bissau");
INSERT INTO paises VALUES("PW","Palau");
INSERT INTO paises VALUES("AS","American Samoa");
INSERT INTO paises VALUES("BT","Bhutan");
INSERT INTO paises VALUES("GF","French Guiana");
INSERT INTO paises VALUES("GP","Guadeloupe");
INSERT INTO paises VALUES("MF","Saint Martin");
INSERT INTO paises VALUES("VC","Saint Vincent and the Grenadines");
INSERT INTO paises VALUES("PM","Saint Pierre and Miquelon");
INSERT INTO paises VALUES("BL","Saint Barthelemy");
INSERT INTO paises VALUES("DM","Dominica");
INSERT INTO paises VALUES("ST","Sao Tome and Principe");
INSERT INTO paises VALUES("KP","Kore");
INSERT INTO paises VALUES("FK","Falkland Islands (Malvinas)");
INSERT INTO paises VALUES("MP","Northern Mariana Islands");
INSERT INTO paises VALUES("TL","Timor-Leste");
INSERT INTO paises VALUES("BQ","Bonair");
INSERT INTO paises VALUES("MM","Myanmar");
INSERT INTO paises VALUES("NI","Nicaragua");
INSERT INTO paises VALUES("SX","Sint Maarten (Dutch part)");
INSERT INTO paises VALUES("GY","Guyana");
INSERT INTO paises VALUES("LA","Lao People's Democratic Republic");
INSERT INTO paises VALUES("CU","Cuba");
INSERT INTO paises VALUES("ET","Ethiopia");



CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';




CREATE TABLE `procedencia` (
  `id_procedencia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_procedencia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO procedencia VALUES("1","remate feria","5ff86d274a283-5f47e934962fa-3.jpg");
INSERT INTO procedencia VALUES("3","consignacion directa","procedencia-default.jpg");
INSERT INTO procedencia VALUES("4","estancia","procedencia-default.jpg");



CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `tropa` int(11) NOT NULL,
  `matarife` int(11) NOT NULL,
  `fecha` varchar(110) NOT NULL,
  `ano` int(11) NOT NULL,
  `estado` varchar(110) NOT NULL,
  PRIMARY KEY (`id_proceso`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4;

INSERT INTO proceso VALUES("159","1","17","28/02/2021 10:01:10","2021","INGRESO");
INSERT INTO proceso VALUES("160","1","17","2021-02-28 10:31:19","2021","TOTALIDAD");
INSERT INTO proceso VALUES("161","1","17","2021-02-28 10:55:25","2021","FINALIZADO");
INSERT INTO proceso VALUES("162","185","17","28/02/2021 11:37:15","2021","INGRESO");
INSERT INTO proceso VALUES("163","185","17","2021-02-28 11:52:12","2021","TOTALIDAD");
INSERT INTO proceso VALUES("164","185","17","2021-02-28 11:53:35","2021","FINALIZADO");
INSERT INTO proceso VALUES("165","226","18","28/02/2021 12:07:48","2021","INGRESO");
INSERT INTO proceso VALUES("166","226","18","2021-02-28 12:39:13","2021","FINALIZADO");
INSERT INTO proceso VALUES("167","227","18","28/02/2021 12:47:53","2021","INGRESO");
INSERT INTO proceso VALUES("168","227","18","2021-02-28 12:52:01","2021","FINALIZADO");
INSERT INTO proceso VALUES("169","2","17","01/03/2021 11:23:43","2021","INGRESO");
INSERT INTO proceso VALUES("170","2","17","2021-03-01 11:26:29","2021","TOTALIDAD");
INSERT INTO proceso VALUES("171","2","17","2021-03-01 12:52:34","2021","FINALIZADO");
INSERT INTO proceso VALUES("172","2","17","2021-03-02 10:13:59","2021","FINALIZADO");



CREATE TABLE `productor` (
  `id_productor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `cuit` text NOT NULL,
  `establecimiento` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_productor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO productor VALUES("1","ROJAS RAMON ALBERTO","20-31167252-6","COIHUECO NORTE","prod-default.jpg");
INSERT INTO productor VALUES("7","CUNCO SA","30-70951386-5","ESTANCIA las chacras","prod-default.jpg");
INSERT INTO productor VALUES("8","coop. las vegas","20-31167252-68","las chacras","prod-default.jpg");



CREATE TABLE `provincias` (
  `id_provincia` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_provincia`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO provincias VALUES("1","Buenos Aires");
INSERT INTO provincias VALUES("2","Buenos Aires-GBA");
INSERT INTO provincias VALUES("3","Capital Federal");
INSERT INTO provincias VALUES("4","Catamarca");
INSERT INTO provincias VALUES("5","Chaco");
INSERT INTO provincias VALUES("6","Chubut");
INSERT INTO provincias VALUES("7","Córdoba");
INSERT INTO provincias VALUES("8","Corrientes");
INSERT INTO provincias VALUES("9","Entre Ríos");
INSERT INTO provincias VALUES("10","Formosa");
INSERT INTO provincias VALUES("11","Jujuy");
INSERT INTO provincias VALUES("12","La Pampa");
INSERT INTO provincias VALUES("13","La Rioja");
INSERT INTO provincias VALUES("14","Mendoza");
INSERT INTO provincias VALUES("15","Misiones");
INSERT INTO provincias VALUES("16","Neuquén");
INSERT INTO provincias VALUES("17","Río Negro");
INSERT INTO provincias VALUES("18","Salta");
INSERT INTO provincias VALUES("19","San Juan");
INSERT INTO provincias VALUES("20","San Luis");
INSERT INTO provincias VALUES("21","Santa Cruz");
INSERT INTO provincias VALUES("22","Santa Fe");
INSERT INTO provincias VALUES("23","Santiago del Estero");
INSERT INTO provincias VALUES("24","Tierra del Fuego");
INSERT INTO provincias VALUES("25","Tucumán");



CREATE TABLE `reducir` (
  `id_reducir` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `tropa` int(11) NOT NULL,
  `clasificacion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `desde` int(11) NOT NULL,
  `hasta` int(11) NOT NULL,
  `faenados` int(11) NOT NULL,
  `comienzo` int(11) NOT NULL,
  `reduccion` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `corral` int(11) NOT NULL,
  `etapa` varchar(11) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_reducir`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4;




CREATE TABLE `subespeces` (
  `id_subespecies` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(110) NOT NULL,
  `diente` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `id_especie` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_subespecies`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

INSERT INTO subespeces VALUES("6","04.02","","cabra","4","cabra","subesp-default.jpg");
INSERT INTO subespeces VALUES("7","04.05","","Cabrillas/chivitos","4","Cabrillas/chivitos","subesp-default.jpg");
INSERT INTO subespeces VALUES("8","04.03","","cabrito","4","cabrito","subesp-default.jpg");
INSERT INTO subespeces VALUES("9","04.04","","capon","4","capon","subesp-default.jpg");
INSERT INTO subespeces VALUES("10","04.01","","chivo","4","chivo","subesp-default.jpg");
INSERT INTO subespeces VALUES("11","02.03","","borrego/a","2","borrego/a","subesp-default.jpg");
INSERT INTO subespeces VALUES("12","02.04","","capon","2","capon","subesp-default.jpg");
INSERT INTO subespeces VALUES("13","02.01","","carnero","2","carnero","subesp-default.jpg");
INSERT INTO subespeces VALUES("14","02.05","","cordero/a","2","cordero/a","subesp-default.jpg");
INSERT INTO subespeces VALUES("15","02.02","","oveja","2","oveja","subesp-default.jpg");
INSERT INTO subespeces VALUES("16","03.07","","cachorra","3","cachorra","subesp-default.jpg");
INSERT INTO subespeces VALUES("17","03.05","","cachorro","3","cachorro","subesp-default.jpg");
INSERT INTO subespeces VALUES("18","03.04","","capon","3","capon","subesp-default.jpg");
INSERT INTO subespeces VALUES("19","03.02","","cerda","3","cerda","subesp-default.jpg");
INSERT INTO subespeces VALUES("20","03.03","","lechon","3","lechon","subesp-default.jpg");
INSERT INTO subespeces VALUES("21","03.06","","m.e.i","3","m.e.i","subesp-default.jpg");
INSERT INTO subespeces VALUES("22","03.01","","padrillo","3","padrillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("23","2d - nt","hasta 2 dientes","novillito","1","novillito","subesp-default.jpg");
INSERT INTO subespeces VALUES("24","4d - nt","hasta 4 dientes","novillito","1","novillito","subesp-default.jpg");
INSERT INTO subespeces VALUES("25","8d - no","hasta 8 dientes","novillo","1","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("27","6d -no","hasta 6 dientes","novillo","1","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("28","2d -mej","hasta 2 dientes","torito","1","torito","subesp-default.jpg");
INSERT INTO subespeces VALUES("29",">8d-to","mas de 8 dientes","toro","1","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("30","6d-to","hasta 6 dientes","toro","1","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("31","4d-to","hasta 4 dientes","toro","1","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("32","6d-va","hasta 6 dientes","vaca","1","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("33","8d-va","hasta 8 dientes","vaca","1","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("34",">8d-va","mas de 8 dientes","vaca","1","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("35","4d-vq","hasta 4 dientes","vaquillona","1","vaquillona","subesp-default.jpg");
INSERT INTO subespeces VALUES("36","2d-vq","hasta 2 dientes","vaquillona","1","vaquillona","subesp-default.jpg");
INSERT INTO subespeces VALUES("37","19.01","","ciervos","19","ciervos","subesp-default.jpg");
INSERT INTO subespeces VALUES("38","08.01","","conejos","8","conejos","subesp-default.jpg");
INSERT INTO subespeces VALUES("39",">8d-no","mas de 8 dientes","novillo","1","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("40","8d-to","hasta 8 dientes","toro","1","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("41","4d-nt","hasta 4 dientes","novillito","9","novillito","subesp-default.jpg");
INSERT INTO subespeces VALUES("42","2d-nt","hasta 2 dientes","novillito","9","novillito","subesp-default.jpg");
INSERT INTO subespeces VALUES("43","8d-no","hasta 8 dientes","novillo","9","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("44",">8d-no","mas de 8 dientes","novillo","9","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("45","6d-no","hasta 6 dientes","novillo","9","novillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("46","2d-mej","hasta 2 dientes","torito","9","torito","subesp-default.jpg");
INSERT INTO subespeces VALUES("47","8d-to","hasta 8 dientes","toro","9","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("48","6d-to","hasta 6 dientes","toro","9","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("49","4d-to","hasta 4 dientes","toro","9","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("50",">8d-to","mas de 8 dientes","toro","9","toro","subesp-default.jpg");
INSERT INTO subespeces VALUES("51","8d-va","hasta 8 dientes","vaca","9","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("52","6d-va","hasta 6 dientes","vaca","9","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("53",">8d-va","mas de 8 dientes","vaca","9","vaca","subesp-default.jpg");
INSERT INTO subespeces VALUES("54","4d-vq","hasta 4 dientes","vaquillona","9","vaquillona","subesp-default.jpg");
INSERT INTO subespeces VALUES("55","2d-vq","hasta 2 dientes","vaquillona","9","vaquillona","subesp-default.jpg");
INSERT INTO subespeces VALUES("56","14.07","","guanaco macho","14","guanaco macho","subesp-default.jpg");
INSERT INTO subespeces VALUES("57","14.02","","llama hembra","14","llama hembra","subesp-default.jpg");
INSERT INTO subespeces VALUES("58","14.01","","llama macho","14","llama macho","subesp-default.jpg");
INSERT INTO subespeces VALUES("59","14.03","","malton hembra","14","malton hembra","subesp-default.jpg");
INSERT INTO subespeces VALUES("60","14.04","","malton macho","14","malton macho","subesp-default.jpg");
INSERT INTO subespeces VALUES("61","14.05","","teke hembra","14","teke hembra","subesp-default.jpg");
INSERT INTO subespeces VALUES("62","14.06","","teke macho","14","teke macho","subesp-default.jpg");
INSERT INTO subespeces VALUES("63","05.07","","asno","5","asno","subesp-default.jpg");
INSERT INTO subespeces VALUES("64","05.06","","burro","5","burro","subesp-default.jpg");
INSERT INTO subespeces VALUES("65","05.02","","caballo","5","caballo","subesp-default.jpg");
INSERT INTO subespeces VALUES("66","05.05","","mula","5","mula","subesp-default.jpg");
INSERT INTO subespeces VALUES("67","05.01","","padrillo","5","padrillo","subesp-default.jpg");
INSERT INTO subespeces VALUES("68","05.04","","potrillo/a","5","potrillo/a","subesp-default.jpg");
INSERT INTO subespeces VALUES("69","05.03","","yegua","5","yegua","subesp-default.jpg");



CREATE TABLE `tipo_us` (
  `id_tipo_us` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_us`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tipo_us VALUES("1","Administrador");
INSERT INTO tipo_us VALUES("2","Tecnico");
INSERT INTO tipo_us VALUES("3","Root");
INSERT INTO tipo_us VALUES("4","Matarife");



CREATE TABLE `transporte` (
  `id_transporte` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transporte`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO transporte VALUES("2","mmk583","5ffb23ffda277-avatar.png");



CREATE TABLE `tropas` (
  `id_tropas` int(11) NOT NULL AUTO_INCREMENT,
  `matarife` varchar(255) NOT NULL,
  `procedencia` varchar(255) NOT NULL,
  `especie` varchar(255) NOT NULL,
  `vigencia` date NOT NULL,
  `desde` int(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `hasta` int(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `usados` int(255) NOT NULL DEFAULT 0,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`id_tropas`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

INSERT INTO tropas VALUES("14","17","4","4","2021-02-28","1","100","101","tropas-default.jpg","2","2021");
INSERT INTO tropas VALUES("15","18","1","19","2021-02-28","102","50","152","tropas-default.jpg","0","2021");
INSERT INTO tropas VALUES("17","18","4","14","2021-02-28","153","31","184","tropas-default.jpg","0","2021");
INSERT INTO tropas VALUES("18","17","4","19","2021-02-28","185","40","225","tropas-default.jpg","1","2021");
INSERT INTO tropas VALUES("19","18","4","9","2021-02-28","226","5","231","tropas-default.jpg","2","2021");



CREATE TABLE `ultimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;

INSERT INTO ultimo VALUES("66","2021-02-20","34");
INSERT INTO ultimo VALUES("67","2021-02-26","23");
INSERT INTO ultimo VALUES("68","2021-03-01","22");



CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_us` varchar(45) NOT NULL,
  `apellidos_us` varchar(45) NOT NULL,
  `edad` date NOT NULL,
  `dni_us` varchar(45) NOT NULL,
  `contrasena_us` varchar(255) NOT NULL,
  `telefono_us` varchar(11) DEFAULT NULL,
  `domicilio_us` varchar(45) DEFAULT NULL,
  `email_us` varchar(25) DEFAULT NULL,
  `sexo_us` varchar(25) DEFAULT NULL,
  `adicional_us` varchar(500) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `us_tipo` int(11) NOT NULL,
  `secretaria` varchar(255) NOT NULL,
  `id_matarife` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `us_tipo_idx` (`us_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","Franco","Cara","1984-09-03","31167252","31167252","2604201082","anglat 570","francocara18@yahoo.com","masculino","Secretario de Obras Publicas","5f538ddd44d49-Koala.jpg","3","Root","0");
INSERT INTO usuario VALUES("12","brucemar s.a","","0000-00-00","12345","12345","","","francocara18@gmail.com","","","avatar.png","4","Matarife","17");
INSERT INTO usuario VALUES("13","gutierrez","","0000-00-00","20311672526","20311672526","911","Gral Villegas Oeste 1226","francocara18@yahoo.com","masculino","","avatar.png","4","Matarife","18");
INSERT INTO usuario VALUES("14","manzano","","0000-00-00","012345","012345","","","francocara182016@gmail.co","","","avatar.png","4","","19");

