-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-12-2019 a las 21:42:00
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parkeando`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` int(10) NOT NULL,
  `saldo` float NOT NULL,
  `tarjeta` varchar(250) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_cuenta`, `saldo`, `tarjeta`, `usuario`, `id_usuario`) VALUES
(36, 0, 'PAGO_CON_PAYPAL', 'David', 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamiento`
--

CREATE TABLE `estacionamiento` (
  `id_estacionamiento` int(10) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `cuota` float NOT NULL,
  `qrEntrada` varchar(250) NOT NULL,
  `qrSalida` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estacionamiento`
--

INSERT INTO `estacionamiento` (`id_estacionamiento`, `nombre`, `direccion`, `cuota`, `qrEntrada`, `qrSalida`) VALUES
(1, 'Plaza Comercial', 'Calle 2 Num 33, Chalco, Estado de Mexico', 10, 'plazaComercial@parkeandoEntrada', 'plazaComercial@parkeandoSalida'),
(2, 'Estacionamiento Privado', 'Colonia Centro, CDMX', 20, 'EstacionamientoPrivado@parkeandoEntrada', 'EstacionamientoPrivado@parkeandoSalida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `lugar` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estacionamiento` int(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `lugar`, `id_usuario`, `id_estacionamiento`, `fecha`) VALUES
(47, 'Plaza Comercial', 42, 1, '2019-12-30 19:35:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `ID_Marca` int(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`ID_Marca`, `Nombre`) VALUES
(1000, 'Acura'),
(1001, 'Alfa Romero'),
(1002, 'Aston Martin'),
(1003, 'Audi'),
(1004, 'Bentley'),
(1005, 'BMW'),
(1006, 'Cadillac'),
(1007, 'Chevrolet'),
(1008, 'Chrysler'),
(1009, 'Datsun'),
(1010, 'Dodge'),
(1011, 'FAW'),
(1012, 'Ferrari'),
(1013, 'Fiat'),
(1014, 'Ford'),
(1015, 'GMC'),
(1016, 'Honda'),
(1017, 'Hyundai'),
(1018, 'Infiniti'),
(1019, 'Jaguar'),
(1020, 'Jeep'),
(1021, 'Kia'),
(1022, 'Lamborghini'),
(1023, 'Land Rover'),
(1024, 'Lincoln'),
(1025, 'Lotus'),
(1026, 'Maserati'),
(1027, 'Mazda'),
(1028, 'Mercedes Benz'),
(1029, 'Mercury'),
(1030, 'Mini'),
(1031, 'Mitsubishi'),
(1032, 'Nissan'),
(1033, 'Peugeot'),
(1034, 'Porsche'),
(1035, 'Renault'),
(1036, 'Rolls Royce'),
(1037, 'Sabb'),
(1038, 'Seat'),
(1039, 'Smart'),
(1040, 'Subaru'),
(1041, 'Susuki'),
(1042, 'Toyota'),
(1043, 'Volkswagen'),
(1044, 'Volvo'),
(1045, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `ID_Modelo` int(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ID_Marca` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`ID_Modelo`, `Nombre`, `ID_Marca`) VALUES
(1000, 'MDX', 1000),
(1001, 'RDX', 1000),
(1002, 'RL', 1000),
(1003, 'TL', 1000),
(1004, 'TSX', 1000),
(1005, 'Otro', 1000),
(1006, '4C', 1001),
(1007, 'Giuletta', 1001),
(1008, 'Mitto', 1001),
(1009, 'Otro', 1001),
(1010, 'CC100', 1002),
(1011, 'Cygnet', 1002),
(1012, 'DB9', 1002),
(1013, 'Rapide S', 1002),
(1014, 'Vanquish', 1002),
(1015, 'Vantage', 1002),
(1016, 'Otro', 1002),
(1017, 'A1', 1003),
(1018, 'A2', 1003),
(1019, 'A3', 1003),
(1020, 'A4', 1003),
(1021, 'A5', 1003),
(1022, 'A6', 1003),
(1023, 'A7', 1003),
(1024, 'A8', 1003),
(1025, 'Q5', 1003),
(1026, 'Q7', 1003),
(1027, 'S3', 1003),
(1028, 'S4', 1003),
(1029, 'S5', 1003),
(1030, 'S6', 1003),
(1031, 'TT', 1003),
(1032, 'TTS', 1003),
(1033, 'Otro', 1003),
(1034, 'Continental', 1004),
(1035, 'Mulsanne', 1004),
(1036, 'Otro', 1004),
(1037, 'Serie 1', 1005),
(1038, 'Serie 2', 1005),
(1039, 'Serie 3', 1005),
(1040, 'Serie 4', 1005),
(1041, 'Serie 5', 1005),
(1042, 'Serie 6', 1005),
(1043, 'Serie 7', 1005),
(1044, 'X1', 1005),
(1045, 'X3', 1005),
(1046, 'X5', 1005),
(1047, 'X6', 1005),
(1048, 'Z4', 1005),
(1049, 'M3', 1005),
(1050, 'M5', 1005),
(1051, 'M6', 1005),
(1052, 'Otro', 1005),
(1053, 'ATS', 1006),
(1054, 'CTS', 1006),
(1055, 'SRX', 1006),
(1056, 'Otro', 1006),
(1057, 'Astra', 1007),
(1058, 'Avalanche', 1007),
(1059, 'Aveo', 1007),
(1060, 'Blazer', 1007),
(1061, 'Camaro', 1007),
(1062, 'Captiva', 1007),
(1063, 'Cavalier', 1007),
(1064, 'Chevy', 1007),
(1065, 'Cheyenne', 1007),
(1066, 'Colorado', 1007),
(1067, 'Corsa', 1007),
(1068, 'Corvette', 1007),
(1069, 'Cutlass', 1007),
(1070, 'Cruze', 1007),
(1071, 'Equinox', 1007),
(1072, 'Express', 1007),
(1073, 'Lumina', 1007),
(1074, 'Malibu', 1007),
(1075, 'Matiz', 1007),
(1076, 'Meriva', 1007),
(1077, 'Silverado', 1007),
(1078, 'Sonic', 1007),
(1079, 'Spark', 1007),
(1080, 'Suburban', 1007),
(1081, 'Tahoe', 1007),
(1082, 'Tracker', 1007),
(1083, 'TrailBlazer', 1007),
(1084, 'Tornado', 1007),
(1085, 'Traverse', 1007),
(1086, 'Trax', 1007),
(1087, 'Vectra', 1007),
(1088, 'Zafir', 1007),
(1089, 'Otro', 1007),
(1090, '300', 1008),
(1091, 'Aspen', 1008),
(1092, 'Caravan', 1008),
(1093, 'Cirrus', 1008),
(1094, 'Concorde', 1008),
(1095, 'Corssfire', 1008),
(1096, 'Intrepid', 1008),
(1097, 'Phatom', 1008),
(1098, 'PT Cruiser', 1008),
(1099, 'Shadow', 1008),
(1100, 'Town And Country', 1008),
(1101, 'Voyager', 1008),
(1102, 'Viper', 1008),
(1103, 'Otro', 1008),
(1104, 'Redi-Go', 1009),
(1105, 'GO', 1009),
(1106, 'GO+', 1009),
(1107, 'ON-DO', 1009),
(1108, 'MI-DO', 1009),
(1109, '120y', 1009),
(1110, 'Cross', 1009),
(1111, '100a Cherry', 1009),
(1112, 'Attitude', 1010),
(1113, 'Avenger', 1010),
(1114, 'Caliber', 1010),
(1115, 'Caravan', 1010),
(1116, 'Challenger', 1010),
(1117, 'Charger', 1010),
(1118, 'Cherokee', 1010),
(1119, 'Dart', 1010),
(1120, 'Dakota', 1010),
(1121, 'Durango', 1010),
(1122, 'GTS', 1010),
(1123, 'H100', 1010),
(1124, 'i10', 1010),
(1125, 'Intrepid', 1010),
(1126, 'Journey', 1010),
(1127, 'Neon', 1010),
(1128, 'Nitro', 1010),
(1129, 'RAM', 1010),
(1130, 'Stratus', 1010),
(1131, 'Verna', 1010),
(1132, 'Otro', 1010),
(1133, 'F1', 1011),
(1134, 'Otro', 1011),
(1135, '458 Italia', 1012),
(1136, '458 Spider', 1012),
(1137, 'California', 1012),
(1138, 'Enzo', 1012),
(1139, 'F12 Berlinetta', 1012),
(1140, 'FF', 1012),
(1141, 'Otro', 1012),
(1142, 'Albea', 1013),
(1143, 'Bravo', 1013),
(1144, 'Idea', 1013),
(1145, 'Panda', 1013),
(1146, 'Palio', 1013),
(1147, 'Punto', 1013),
(1148, 'Uno', 1013),
(1149, 'Strada', 1013),
(1150, 'Otro', 1013),
(1151, 'Aerostar', 1014),
(1152, 'Bronco', 1014),
(1153, 'Countour', 1014),
(1154, 'Cougar', 1014),
(1155, 'Courier', 1014),
(1156, 'E150', 1014),
(1157, 'EcoSport', 1014),
(1158, 'Edge', 1014),
(1159, 'Escape', 1014),
(1160, 'Escort', 1014),
(1161, 'Excursion', 1014),
(1162, 'Expedition', 1014),
(1163, 'Explorer', 1014),
(1164, 'F150', 1014),
(1165, 'F250', 1014),
(1166, 'F350', 1014),
(1167, 'F450', 1014),
(1168, 'Fiesta', 1014),
(1169, 'Focus', 1014),
(1170, 'Freestar', 1014),
(1171, 'Fusion', 1014),
(1172, 'Grand Marquis', 1014),
(1173, 'Ikon', 1014),
(1174, 'Ka', 1014),
(1175, 'Lobo', 1014),
(1176, 'Mercury', 1014),
(1177, 'Mustang', 1014),
(1178, 'Ranger', 1014),
(1179, 'Sable', 1014),
(1180, 'Taurus', 1014),
(1181, 'Thunder Bird', 1014),
(1182, 'Topaz', 1014),
(1183, 'Transit', 1014),
(1184, 'Windstar', 1014),
(1185, 'Otro', 1014),
(1186, 'Acadia', 1015),
(1187, 'Astro van', 1015),
(1188, 'Canyon', 1015),
(1189, 'Savana', 1015),
(1190, 'Sierra', 1015),
(1191, 'Terrain', 1015),
(1192, 'Yukon', 1015),
(1193, 'Otro', 1015),
(1194, 'Accord', 1016),
(1195, 'City', 1016),
(1196, 'CR-V', 1016),
(1197, 'Element', 1016),
(1198, 'Fit', 1016),
(1199, 'Odyssey', 1016),
(1200, 'Passport', 1016),
(1201, 'Pilot', 1016),
(1202, 'Ringeline', 1016),
(1203, 'Accent', 1017),
(1204, 'Atos', 1017),
(1205, 'Elantra', 1017),
(1206, 'H1', 1017),
(1207, 'Otro', 1017),
(1208, 'G Sedan', 1018),
(1209, 'G Coupe', 1018),
(1210, 'M', 1018),
(1211, 'FX', 1018),
(1212, 'JX', 1018),
(1213, 'QX', 1018),
(1214, 'Otro', 1018),
(1215, 'F-Type', 1019),
(1216, 'XF', 1019),
(1217, 'XJ', 1019),
(1218, 'XKR', 1019),
(1219, 'Otro', 1019),
(1220, 'Cherokee', 1020),
(1221, 'Comanche', 1020),
(1222, 'Commander', 1020),
(1223, 'Grand Cherokee', 1020),
(1224, 'Liberty', 1020),
(1225, 'Patriot', 1020),
(1226, 'Rubicon', 1020),
(1227, 'Wrangler', 1020),
(1228, 'Forte Hatchback', 1021),
(1229, 'Forte Sedan', 1021),
(1230, 'Niro', 1021),
(1231, 'Optima', 1021),
(1232, 'Rio Hatchback', 1021),
(1233, 'Rio Sedan', 1021),
(1234, 'Sorento', 1021),
(1235, 'Soul', 1021),
(1236, 'Sportage', 1021),
(1237, 'Stinger', 1021),
(1238, 'Aventador', 1022),
(1239, 'Gallardo', 1022),
(1240, 'Murcielago', 1022),
(1241, 'Otro', 1022),
(1242, 'LR2', 1023),
(1243, 'LR4', 1023),
(1244, 'Range Rover', 1023),
(1245, 'Otro', 1023),
(1246, 'Mark LT', 1024),
(1247, 'MKZ', 1024),
(1248, 'MKS', 1024),
(1249, 'MKX', 1024),
(1250, 'Navigator', 1024),
(1251, 'Otro', 1024),
(1252, 'Elise', 1025),
(1253, 'Exige', 1025),
(1254, 'Evora', 1025),
(1255, 'Otro', 1025),
(1256, 'Ghibli', 1026),
(1257, 'Gran Turismo', 1026),
(1258, 'GranCabrio', 1026),
(1259, 'Quattroporte', 1026),
(1260, 'Otro', 1026),
(1261, 'CX-5', 1027),
(1262, 'CX-7', 1027),
(1263, 'CX-9', 1027),
(1264, 'Mazda 2', 1027),
(1265, 'Mazda 3', 1027),
(1266, 'Mazda 5', 1027),
(1267, 'Mazda 6', 1027),
(1268, 'MX-5', 1027),
(1269, 'MX-6', 1027),
(1270, 'Otro', 1027),
(1271, 'Clase A', 1028),
(1272, 'Clase B', 1028),
(1273, 'Clase C', 1028),
(1274, 'Clase CL', 1028),
(1275, 'Clase CLA', 1028),
(1276, 'Clase CLS', 1028),
(1277, 'Clase E', 1028),
(1278, 'CLase G', 1028),
(1279, 'Clase GL', 1028),
(1280, 'Clase GLK', 1028),
(1281, 'Clase M', 1028),
(1282, 'Clase R', 1028),
(1283, 'Clase S', 1028),
(1284, 'Clase SLK', 1028),
(1285, 'Clase SL', 1028),
(1286, 'SLS AMG', 1028),
(1287, 'Otro', 1028),
(1288, 'Grand Marquis', 1029),
(1289, 'Mariner', 1029),
(1290, 'Millan', 1029),
(1291, 'Mountaineer', 1029),
(1292, 'Otro', 1029),
(1293, 'Mini', 1030),
(1294, 'Mini Coupe', 1030),
(1295, 'Mini Countryman', 1030),
(1296, 'Mini Convertible', 1030),
(1297, 'Mini Clubman', 1030),
(1298, 'Mini Paceman', 1030),
(1299, 'Mini Roadster', 1030),
(1300, 'Otro', 1030),
(1301, '300GT', 1031),
(1302, 'Eclipse', 1031),
(1303, 'Edeavour', 1031),
(1304, 'Galant', 1031),
(1305, 'Grandis', 1031),
(1306, 'L200', 1031),
(1307, 'Lancer', 1031),
(1308, 'Montero', 1031),
(1309, 'Outlander', 1031),
(1310, 'Otro', 1031),
(1311, '370z', 1032),
(1312, 'Almera', 1032),
(1313, 'Altima', 1032),
(1314, 'Aprio', 1032),
(1315, 'Armada', 1032),
(1316, 'Cavstar', 1032),
(1317, 'Estaca', 1032),
(1318, 'Frontier', 1032),
(1319, 'Juke', 1032),
(1320, 'Leaf', 1032),
(1321, 'March', 1032),
(1322, 'Maxima', 1032),
(1323, 'Micra', 1032),
(1324, 'Murano', 1032),
(1325, 'Note', 1032),
(1326, 'NP300', 1032),
(1327, 'NV2500', 1032),
(1328, 'Pathfinder', 1032),
(1329, 'Platina', 1032),
(1330, 'Quest', 1032),
(1331, 'Rogue', 1032),
(1332, 'Sentra', 1032),
(1333, 'Tiida', 1032),
(1334, 'Titan', 1032),
(1335, 'Tsuru', 1032),
(1336, 'Urvan', 1032),
(1337, 'Versa', 1032),
(1338, 'X-Terra', 1032),
(1339, 'X-Trail', 1032),
(1340, 'Otro', 1032),
(1341, '206', 1033),
(1342, '207', 1033),
(1343, '207cc', 1033),
(1344, '208', 1033),
(1345, '301', 1033),
(1346, '306', 1033),
(1347, '307', 1033),
(1348, '308', 1033),
(1349, '308cc', 1033),
(1350, '406', 1033),
(1351, '407', 1033),
(1352, '508', 1033),
(1353, '607', 1033),
(1354, '3008', 1033),
(1355, 'Expert', 1033),
(1356, 'Grand Raid', 1033),
(1357, 'Manager', 1033),
(1358, 'RCZ', 1033),
(1359, 'Partner', 1033),
(1360, 'Otro', 1033),
(1361, '718 Cayman', 1034),
(1362, '718 Cayman S', 1034),
(1363, '718 Boxter', 1034),
(1364, '718 Boxter S', 1034),
(1365, '911 Carrera', 1034),
(1366, '911 Carrera S', 1034),
(1367, '911 Carrera S Cabriolet', 1034),
(1368, '911 Carrera 4', 1034),
(1369, '911 Carrera 4s', 1034),
(1370, '911 Carrera 4 Cabriolet', 1034),
(1371, '911 Carrera 4s Cabriolet', 1034),
(1372, '911 Targa 4', 1034),
(1373, '911 Targa 4s', 1034),
(1374, '911 Carrera Black Edition', 1034),
(1375, '911 Carrera Cabriolet Black Edition', 1034),
(1376, '911 Carrera 4 Black Edition', 1034),
(1377, '911 Carrera 4 Cabriolet Black Edition', 1034),
(1378, '911 Carrera GTS', 1034),
(1379, '911 Carrera GTS Cabriolet', 1034),
(1380, '911 Carrera 4 GTS', 1034),
(1381, '911 Carrera 4 GTS Cabriolet', 1034),
(1382, '911 Targa 4 GTS', 1034),
(1383, '911 Turbo', 1034),
(1384, '911 Turbo S', 1034),
(1385, '911 Turbo Cabriolet', 1034),
(1386, '911 Turbo S Cabriolet', 1034),
(1387, '911 R', 1034),
(1388, '911 GT3', 1034),
(1389, '911 GT3 RS', 1034),
(1390, '918 Spyder', 1034),
(1391, '918 Spyder Weissach', 1034),
(1392, 'Panamera 4S', 1034),
(1393, 'Panamera Turbo', 1034),
(1394, 'Macan S', 1034),
(1395, 'Macans S Diesel', 1034),
(1396, 'Macan GTS', 1034),
(1397, 'Macan Turbo', 1034),
(1398, 'Cayenne', 1034),
(1399, 'Cayenne Platinun Edition', 1034),
(1400, 'Cayenne Diesel', 1034),
(1401, 'Cayenne Diesel Platinum Edition', 1034),
(1402, 'Cayenne S', 1034),
(1403, 'Cayenne S E-Hybrid', 1034),
(1404, 'Cayenne S E-Hybrid Platinun Edition', 1034),
(1405, 'Cayenne GTS', 1034),
(1406, 'Cayenne Turbo', 1034),
(1407, 'Cayenne Turbo S', 1034),
(1408, 'Otro', 1034),
(1409, 'Alliance', 1035),
(1410, 'Clio', 1035),
(1411, 'Duster', 1035),
(1412, 'Fluence', 1035),
(1413, 'Kango', 1035),
(1414, 'Koleos', 1035),
(1415, 'Laguna', 1035),
(1416, 'Safrane', 1035),
(1417, 'Sandero', 1035),
(1418, 'Stepway', 1035),
(1419, 'Trafic', 1035),
(1420, 'Otro', 1035),
(1421, 'Ghost', 1036),
(1422, 'Phantom', 1036),
(1423, 'Wraith', 1036),
(1424, 'Otro', 1036),
(1425, 'Otro', 1037),
(1426, 'Alhambra', 1038),
(1427, 'Altea', 1038),
(1428, 'Bocanegra', 1038),
(1429, 'Cordoba', 1038),
(1430, 'Freetrack', 1038),
(1431, 'Ibiza', 1038),
(1432, 'Leon', 1038),
(1433, 'Toledo', 1038),
(1434, 'Otro', 1038),
(1435, 'Fortwo coupe', 1039),
(1436, 'Fortwo cabrio', 1039),
(1437, 'Fortour', 1039),
(1438, 'Otro', 1039),
(1439, 'Forester', 1040),
(1440, 'Impreza', 1040),
(1441, 'Legacy', 1040),
(1442, 'Outback', 1040),
(1443, 'WRX', 1040),
(1444, 'XV', 1040),
(1445, 'Grand Vitara', 1041),
(1446, 'Kizashi', 1041),
(1447, 'Swift', 1041),
(1448, 'SX 4 Crossover', 1041),
(1449, 'SX Sedan', 1041),
(1450, 'Otro', 1041),
(1451, '4Runner', 1042),
(1452, 'Avalon', 1042),
(1453, 'Avanza', 1042),
(1454, 'Camry', 1042),
(1455, 'Celica', 1042),
(1456, 'Corolla', 1042),
(1457, 'Hiace', 1042),
(1458, 'Highlander', 1042),
(1459, 'Hilux', 1042),
(1460, 'Matrix', 1042),
(1461, 'MR2', 1042),
(1462, 'Prius', 1042),
(1463, 'RAV4', 1042),
(1464, 'Sequoia', 1042),
(1465, 'Sienna', 1042),
(1466, 'Solara', 1042),
(1467, 'T-1000', 1042),
(1468, 'Tacoma', 1042),
(1469, 'Tundra', 1042),
(1470, 'Yaris', 1042),
(1471, 'Amarok', 1043),
(1472, 'Atlantic', 1043),
(1473, 'Beetle', 1043),
(1474, 'Bora', 1043),
(1475, 'CC', 1043),
(1476, 'Cabriolet', 1043),
(1477, 'Caribe', 1043),
(1478, 'Clasico', 1043),
(1479, 'Combi', 1043),
(1480, 'Corsar', 1043),
(1481, 'Crafter', 1043),
(1482, 'Crossfox', 1043),
(1483, 'Derby', 1043),
(1484, 'Eos', 1043),
(1485, 'GLI', 1043),
(1486, 'Gol', 1043),
(1487, 'Golf', 1043),
(1488, 'GTI', 1043),
(1489, 'Jetta', 1043),
(1490, 'Lupo', 1043),
(1491, 'Passat', 1043),
(1492, 'Pointer', 1043),
(1493, 'Polo', 1043),
(1494, 'Sedan', 1043),
(1495, 'Sharan', 1043),
(1496, 'Tiguan', 1043),
(1497, 'Touareg', 1043),
(1498, 'Otro', 1043),
(1499, 'C30', 1044),
(1500, 'C70', 1044),
(1501, 'S40', 1044),
(1502, 'S60', 1044),
(1503, 'S80', 1044),
(1504, 'V50', 1044),
(1505, 'XC60', 1044),
(1506, 'XC70', 1044),
(1507, 'XC90', 1044),
(1508, 'Otro', 1044),
(1509, 'Otro', 1045);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioEstacionamiento`
--

CREATE TABLE `usuarioEstacionamiento` (
  `num_control` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `horaEntrada` varchar(250) NOT NULL,
  `horaSalida` varchar(250) NOT NULL,
  `id_estacionamiento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`) VALUES
(42, 'David', 'david.oivd911@gmail.com', '$2y$10$U5kmOLApJu.JBy0W05BoxeKPdezjoAEDg2un3bHFCDjqdrapnpGbm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD PRIMARY KEY (`id_estacionamiento`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`ID_Marca`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`ID_Modelo`),
  ADD KEY `ID_Marca` (`ID_Marca`);

--
-- Indices de la tabla `usuarioEstacionamiento`
--
ALTER TABLE `usuarioEstacionamiento`
  ADD PRIMARY KEY (`num_control`),
  ADD KEY `usuario_usuario` (`id_usuario`),
  ADD KEY `estacionamiento_estaciona` (`id_estacionamiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id_cuenta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  MODIFY `id_estacionamiento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `ID_Marca` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1046;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `ID_Modelo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1510;

--
-- AUTO_INCREMENT de la tabla `usuarioEstacionamiento`
--
ALTER TABLE `usuarioEstacionamiento`
  MODIFY `num_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`ID_Marca`) REFERENCES `marcas` (`ID_Marca`);

--
-- Filtros para la tabla `usuarioEstacionamiento`
--
ALTER TABLE `usuarioEstacionamiento`
  ADD CONSTRAINT `estacionamiento_estaciona` FOREIGN KEY (`id_estacionamiento`) REFERENCES `estacionamiento` (`id_estacionamiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
