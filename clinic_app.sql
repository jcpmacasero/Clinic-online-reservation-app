-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 09:55 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assignsec`
--

CREATE TABLE `tbl_assignsec` (
  `assign_id` varchar(10) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_assignsec`
--

INSERT INTO `tbl_assignsec` (`assign_id`, `user_id`) VALUES
('1', '2-2017');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `bill_id` varchar(30) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `bill_amt` double(30,2) DEFAULT NULL,
  `date_billed` date DEFAULT NULL,
  `receipt_no` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE `tbl_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_topic` varchar(100) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`chat_id`, `chat_topic`, `created_by`, `create_date`) VALUES
(1, 'wla', '2-2017', '2017-12-01 01:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chatmessages`
--

CREATE TABLE `tbl_chatmessages` (
  `chat_message_id` int(11) NOT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `chat_message_content` varchar(500) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chatmessages`
--

INSERT INTO `tbl_chatmessages` (`chat_message_id`, `chat_id`, `user_id`, `chat_message_content`, `create_date`) VALUES
(2, 1, '2-2017', 'Hi There', '2017-12-01 02:23:39'),
(3, 1, '3-2017', 'hi', '2017-12-14 23:57:40'),
(4, 1, '2-2017', 'hello doc', '2018-01-01 09:29:12'),
(5, 1, '2-2017', 'hello sec diay', '2018-01-01 09:29:28'),
(6, 1, '2-2017', 'sinong sunod', '2018-01-01 09:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_check_up`
--

CREATE TABLE `tbl_check_up` (
  `check_up_id` varchar(30) NOT NULL,
  `queue_id` varchar(30) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `bill_id` varchar(30) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `complaint` varchar(255) DEFAULT NULL,
  `check_up_date` datetime DEFAULT NULL,
  `finding` varchar(30) DEFAULT NULL,
  `patient_weight` varchar(30) DEFAULT NULL,
  `patient_height` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` varchar(25) NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `province_id` varchar(25) DEFAULT NULL,
  `zip_code` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `city_name`, `province_id`, `zip_code`) VALUES
('1', 'Bangued', '1', '2800'),
('10', 'Lagangilang', '1', '2802'),
('100', 'San Remigio', '6', NULL),
('1000', 'Naval City', '14', NULL),
('1001', 'Almeria', '14', NULL),
('1002', 'Biliran', '14', NULL),
('1003', 'Cabucgayan', '14', NULL),
('1004', 'Caibiran', '14', NULL),
('1005', 'Culaba', '14', NULL),
('1006', 'Kawayan', '14', NULL),
('1007', 'Maripipi', '14', NULL),
('1008', 'Naval', '14', NULL),
('1009', 'Alburquerque', '15', NULL),
('101', 'Sebaste', '6', NULL),
('1010', 'Alicia', '15', NULL),
('1011', 'Anda', '15', NULL),
('1012', 'Antequera', '15', NULL),
('1013', 'Baclayon', '15', NULL),
('1014', 'Balilihan', '15', NULL),
('1015', 'Batuan', '15', NULL),
('1016', 'Bien Unido', '15', NULL),
('1017', 'Bilar', '15', NULL),
('1018', 'Buenavista', '15', NULL),
('1019', 'Calape', '15', NULL),
('102', 'Sibalom', '6', NULL),
('1020', 'Candijay', '15', NULL),
('1021', 'Carmen', '15', NULL),
('1022', 'Catigbian', '15', NULL),
('1023', 'Clarin', '15', NULL),
('1024', 'Corella', '15', NULL),
('1025', 'Cortes', '15', NULL),
('1026', 'Dagohoy', '15', NULL),
('1027', 'Danao', '15', NULL),
('1028', 'Dauis', '15', NULL),
('1029', 'Dimiao', '15', NULL),
('103', 'Tibiao', '6', NULL),
('1030', 'Duero', '15', NULL),
('1031', 'Garcia Hernandez', '15', NULL),
('1032', 'Guindulman', '15', NULL),
('1033', 'Inabanga', '15', NULL),
('1034', 'Jagna', '15', NULL),
('1035', 'Jetafe', '15', NULL),
('1036', 'Lila', '15', NULL),
('1037', 'Loay', '15', NULL),
('1038', 'Loboc', '15', NULL),
('1039', 'Loon', '15', NULL),
('104', 'Tobias Fornier', '6', NULL),
('1040', 'Mabini', '15', NULL),
('1041', 'Maribojoc', '15', NULL),
('1042', 'Panglao', '15', NULL),
('1043', 'Pilar', '15', NULL),
('1044', 'Pres. Carlos P. Garcia', '15', NULL),
('1045', 'Sagbayan', '15', NULL),
('1046', 'San Isidro', '15', NULL),
('1047', 'San Miguel', '15', NULL),
('1048', 'Sevilla', '15', NULL),
('1049', 'Sierra Bullones', '15', NULL),
('105', 'Valderrama', '6', NULL),
('1050', 'Sikatuna', '15', NULL),
('1051', 'Tagbilaran City', '15', NULL),
('1052', 'Talibon', '15', NULL),
('1053', 'Trinidad', '15', NULL),
('1054', 'Tubigon', '15', NULL),
('1055', 'Ubay', '15', NULL),
('1056', 'Valencia', '15', NULL),
('1057', 'Malaybalay City', '16', NULL),
('1058', 'Valencia City', '16', NULL),
('1059', 'Baungon', '16', NULL),
('106', 'Calanasan', '7', NULL),
('1060', 'Cabanglasan', '16', NULL),
('1061', 'Damulog', '16', NULL),
('1062', 'Dangcagan', '16', NULL),
('1063', 'Don Carlos', '16', NULL),
('1064', 'Impasug', '16', NULL),
('1065', 'Kadingilan', '16', NULL),
('1066', 'Kalilangan', '16', NULL),
('1067', 'Kibawe', '16', NULL),
('1068', 'Kitaotao', '16', NULL),
('1069', 'Lantapan', '16', NULL),
('107', 'Conner', '7', NULL),
('1070', 'Libona', '16', NULL),
('1071', 'Malitbog', '16', NULL),
('1072', 'Manolo Fortich', '16', NULL),
('1073', 'Maramag', '16', NULL),
('1074', 'Pangantucan', '16', NULL),
('1075', 'Quezon', '16', NULL),
('1076', 'San Fernando', '16', NULL),
('1077', 'Sumilao', '16', NULL),
('1078', 'Talakag', '16', NULL),
('1079', 'Malolos City', '17', NULL),
('108', 'Flora', '7', NULL),
('1080', 'Meycauayan City', '17', NULL),
('1081', 'San Jose del Monte City', '17', NULL),
('1082', 'Angat', '17', NULL),
('1083', 'Balagtas', '17', NULL),
('1084', 'Baliuag', '17', NULL),
('1085', 'Bocaue', '17', NULL),
('1086', 'Bulacan', '17', NULL),
('1087', 'Bustos', '17', NULL),
('1088', 'Calumpit', '17', NULL),
('1089', 'Doña Remedios Trinidad', '17', NULL),
('109', 'Kabugao', '7', NULL),
('1090', 'Guiguinto', '17', NULL),
('1091', 'Hagonoy', '17', NULL),
('1092', 'Marilao', '17', NULL),
('1093', 'Norzagaray', '17', NULL),
('1094', 'Obando', '17', NULL),
('1095', 'Pandi', '17', NULL),
('1096', 'Paombong', '17', NULL),
('1097', 'Plaridel', '17', NULL),
('1098', 'Pulilan', '17', NULL),
('1099', 'San Ildefonso', '17', NULL),
('11', 'Lagayan', '1', NULL),
('110', 'Luna', '7', NULL),
('1100', 'San Miguel', '17', NULL),
('1101', 'San Rafael', '17', NULL),
('1102', 'Santa Maria', '17', NULL),
('1103', 'Tuguegarao City', '18', NULL),
('1104', 'Abulug', '18', NULL),
('1105', 'Alcala', '18', NULL),
('1106', 'Allacapan', '18', NULL),
('1107', 'Amulung', '18', NULL),
('1108', 'Aparri', '18', NULL),
('1109', 'Baggao', '18', NULL),
('111', 'Pudtol', '7', NULL),
('1110', 'Ballesteros', '18', NULL),
('1111', 'Buguey', '18', NULL),
('1112', 'Calayan', '18', NULL),
('1113', 'Camalaniugan', '18', NULL),
('1114', 'Claveria', '18', NULL),
('1115', 'Enrile', '18', NULL),
('1116', 'Gattaran', '18', NULL),
('1117', 'Gonzaga', '18', NULL),
('1118', 'Iguig', '18', NULL),
('1119', 'Lal-Lo', '18', NULL),
('112', 'Santa Marcela', '7', NULL),
('1120', 'Lasam', '18', NULL),
('1121', 'Pamplona', '18', NULL),
('1122', 'Peñablanca', '18', NULL),
('1123', 'Piat', '18', NULL),
('1124', 'Rizal', '18', NULL),
('1125', 'Sanchez-Mira', '18', NULL),
('1126', 'Santa Ana', '18', NULL),
('1127', 'Santa Praxedes', '18', NULL),
('1128', 'Santa Teresita', '18', NULL),
('1129', 'Santo Niño', '18', NULL),
('113', 'Baler', '8', NULL),
('1130', 'Solana', '18', NULL),
('1131', 'Tuao', '18', NULL),
('1132', 'Daet', '19', NULL),
('1133', 'Basud', '19', NULL),
('1134', 'Capalonga', '19', NULL),
('1135', 'Daet', '19', NULL),
('1136', 'Jose Panganiban', '19', NULL),
('1137', 'Labo', '19', NULL),
('1138', 'Mercedes', '19', NULL),
('1139', 'Paracale', '19', NULL),
('114', 'Casiguran', '8', NULL),
('1140', 'San Lorenzo Ruiz', '19', NULL),
('1141', 'San Vicente', '19', NULL),
('1142', 'Santa Elena', '19', NULL),
('1143', 'Talisay', '19', NULL),
('1144', 'Vinzons', '19', NULL),
('1145', 'Pili', '20', NULL),
('1146', 'Iriga City', '20', NULL),
('1147', 'Naga City', '20', NULL),
('1148', 'Baao', '20', NULL),
('1149', 'Balatan', '20', NULL),
('115', 'Dilasag', '8', NULL),
('1150', 'Bato', '20', NULL),
('1151', 'Bombon', '20', NULL),
('1152', 'Buhi', '20', NULL),
('1153', 'Bula', '20', NULL),
('1154', 'Cabusao', '20', NULL),
('1155', 'Calabanga', '20', NULL),
('1156', 'Camaligan', '20', NULL),
('1157', 'Canaman', '20', NULL),
('1158', 'Caramoan', '20', NULL),
('1159', 'Del Gallego', '20', NULL),
('116', 'Dinalungan', '8', NULL),
('1160', 'Gainza', '20', NULL),
('1161', 'Garchitorena', '20', NULL),
('1162', 'Goa', '20', NULL),
('1163', 'Lagonoy', '20', NULL),
('1164', 'Libmanan', '20', NULL),
('1165', 'Lupi', '20', NULL),
('1166', 'Magarao', '20', NULL),
('1167', 'Milaor', '20', NULL),
('1168', 'Minalabac', '20', NULL),
('1169', 'Nabua', '20', NULL),
('117', 'Dingalan', '8', NULL),
('1170', 'Ocampo', '20', NULL),
('1171', 'Pamplona', '20', NULL),
('1172', 'Pasacao', '20', NULL),
('1173', 'Pili', '20', NULL),
('1174', 'Presentacion', '20', NULL),
('1175', 'Ragay', '20', NULL),
('1176', 'Sagñay', '20', NULL),
('1177', 'San Fernando', '20', NULL),
('1178', 'San Jose', '20', NULL),
('1179', 'Sipocot', '20', NULL),
('118', 'Dipaculao', '8', NULL),
('1180', 'Siruma', '20', NULL),
('1181', 'Tigaon', '20', NULL),
('1182', 'Tinambac', '20', NULL),
('1183', 'Catarman', '21', NULL),
('1184', 'Guinsiliban', '21', NULL),
('1185', 'Mahinog', '21', NULL),
('1186', 'Mambajao', '21', NULL),
('1187', 'Sagay', '21', NULL),
('1188', 'Roxas City', '22', NULL),
('1189', 'Cuartero', '22', NULL),
('119', 'Maria Aurora', '8', NULL),
('1190', 'Dao', '22', NULL),
('1191', 'Dumalag', '22', NULL),
('1192', 'Dumarao', '22', NULL),
('1193', 'Ivisan', '22', NULL),
('1194', 'Jamindan', '22', NULL),
('1195', 'Ma-ayon', '22', NULL),
('1196', 'Mambusao', '22', NULL),
('1197', 'Panay', '22', NULL),
('1198', 'Panitan', '22', NULL),
('1199', 'Pilar', '22', NULL),
('12', 'Langiden', '1', '2807'),
('120', 'San Luis', '8', NULL),
('1200', 'Pontevedra', '22', NULL),
('1201', 'President Roxas', '22', NULL),
('1202', 'Sapi-an', '22', NULL),
('1203', 'Sigma', '22', NULL),
('1204', 'Tapaz', '22', NULL),
('1205', 'Bagamanoc', '23', NULL),
('1206', 'Baras', '23', NULL),
('1207', 'Bato', '23', NULL),
('1208', 'Caramoran', '23', NULL),
('1209', 'Gigmoto', '23', NULL),
('121', 'Isabela City', '9', NULL),
('1210', 'Pandan', '23', NULL),
('1211', 'Panganiban', '23', NULL),
('1212', 'San Andres', '23', NULL),
('1213', 'San Miguel', '23', NULL),
('1214', 'Viga', '23', NULL),
('1215', 'Virac', '23', NULL),
('1216', 'Cavite City', '24', NULL),
('1217', 'Tagaytay City', '24', NULL),
('1218', 'Trece Martires City', '24', NULL),
('1219', 'Alfonso', '24', NULL),
('122', 'Lamitan City', '9', NULL),
('1220', 'Amadeo', '24', NULL),
('1221', 'Bacoor', '24', NULL),
('1222', 'Carmona', '24', NULL),
('1223', 'Dasmariñas', '24', NULL),
('1224', 'Gen. Mariano Alvarez', '24', NULL),
('1225', 'Gen. Emilio Aguinaldo', '24', NULL),
('1226', 'Gen. Trias', '24', NULL),
('1227', 'Imus', '24', NULL),
('1228', 'Indang', '24', NULL),
('1229', 'Kawit', '24', NULL),
('123', 'Akbar', '9', NULL),
('1230', 'Magallanes', '24', NULL),
('1231', 'Maragondon', '24', NULL),
('1232', 'Mendez', '24', NULL),
('1233', 'Naic', '24', NULL),
('1234', 'Noveleta', '24', NULL),
('1235', 'Rosario', '24', NULL),
('1236', 'Silang', '24', NULL),
('1237', 'Tanza', '24', NULL),
('1238', 'Ternate', '24', NULL),
('1239', 'Argao City', '25', NULL),
('124', 'Al-Barka', '9', NULL),
('1240', 'Bogo City', '25', NULL),
('1241', 'Carcar City', '25', NULL),
('1242', 'Cebu City', '25', NULL),
('1243', 'Danao City', '25', NULL),
('1244', 'Lapu-Lapu City', '25', NULL),
('1245', 'Mandaue City', '25', NULL),
('1246', 'Talisay City', '25', NULL),
('1247', 'Toledo City', '25', NULL),
('1248', 'Naga City', '25', NULL),
('1249', 'Compostela', '26', NULL),
('125', 'Hadji Mohammad Aju', '9', NULL),
('1250', 'Laak', '26', NULL),
('1251', 'Mabini', '26', NULL),
('1252', 'Maco', '26', NULL),
('1253', 'Maragusan', '26', NULL),
('1254', 'Mawab', '26', NULL),
('1255', 'Monkayo', '26', NULL),
('1256', 'Montevista', '26', NULL),
('1257', 'Nabunturan', '26', NULL),
('1258', 'New Bataan', '26', NULL),
('1259', 'Pantukan', '26', NULL),
('126', 'Lantawan', '9', NULL),
('1260', 'Kidapawan City', '27', NULL),
('1261', 'Island Garden City of Samal', '28', NULL),
('1262', 'Panabo City', '28', NULL),
('1263', 'Tagum City', '28', NULL),
('1264', 'Davao City', '29', NULL),
('1265', 'Digos City', '29', NULL),
('1266', 'Mati City', '30', NULL),
('1267', 'San Jose', '31', NULL),
('1268', 'Borongan City', '32', NULL),
('1269', 'Buenavista', '33', NULL),
('127', 'Maluso', '9', NULL),
('1270', 'Jordan', '33', NULL),
('1271', 'Nueva Valencia', '33', NULL),
('1272', 'San Lorenzo', '33', NULL),
('1273', 'Sibunag', '33', NULL),
('1274', 'Aguinaldo', '34', NULL),
('1275', 'Alfonso Lista', '34', NULL),
('1276', 'Asipulo', '34', NULL),
('1277', 'Banaue', '34', NULL),
('1278', 'Hingyon', '34', NULL),
('1279', 'Hungduan', '34', NULL),
('128', 'Sumisip', '9', NULL),
('1280', 'Kiangan', '34', NULL),
('1281', 'Lagawe', '34', NULL),
('1282', 'Lamut', '34', NULL),
('1283', 'Mayoyao', '34', NULL),
('1284', 'Tinoc', '34', NULL),
('1285', 'Laoag City', '35', NULL),
('1286', 'Batac City', '35', NULL),
('1287', 'Candon City', '36', NULL),
('1288', 'Vigan City', '36', NULL),
('1289', 'Passi City', '37', NULL),
('129', 'Tipo-Tipo', '9', NULL),
('1290', 'Iloilo City', '37', NULL),
('1291', 'Cauayan City', '38', NULL),
('1292', 'Santiago City', '38', NULL),
('1293', 'Tabuk City', '39', NULL),
('1294', 'San Fernando City', '40', NULL),
('1295', 'Calamba City', '41', NULL),
('1296', 'San Pablo City', '41', NULL),
('1297', 'Santa Rosa City', '41', NULL),
('1298', 'Iligan City', '42', NULL),
('1299', 'Marawi City', '43', NULL),
('13', 'Licuan-Baay', '1', NULL),
('130', 'Tuburan', '9', NULL),
('1300', 'Baybay City', '44', NULL),
('1301', 'Ormoc City', '44', NULL),
('1302', 'Tacloban City', '44', NULL),
('1303', 'Cotabato City', '45', NULL),
('1304', 'Boac', '46', NULL),
('1305', 'Buenavista', '46', NULL),
('1306', 'Gasan', '46', NULL),
('1307', 'Mogpog', '46', NULL),
('1308', 'Santa Cruz', '46', NULL),
('1309', 'Torrijos', '46', NULL),
('131', 'Ungkaya Pukan', '9', NULL),
('1310', 'Masbate City', '47', NULL),
('1311', 'Caloocan City', '48', NULL),
('1312', 'Las Piñas City', '48', NULL),
('1313', 'Makati City', '48', NULL),
('1314', 'Malabon City', '48', NULL),
('1315', 'Mandaluyong City', '48', NULL),
('1316', 'Manila City', '48', NULL),
('1317', 'Marikina City', '48', NULL),
('1318', 'Muntinlupa City', '48', NULL),
('1319', 'Navotas City', '48', NULL),
('132', 'Balanga City', '10', NULL),
('1320', 'Parañaque City', '48', NULL),
('1321', 'Pasay City', '48', NULL),
('1322', 'Pasig City', '48', NULL),
('1323', 'Quezon City', '48', NULL),
('1324', 'San Juan City', '48', NULL),
('1325', 'Taguig City', '48', NULL),
('1326', 'Valenzuela City', '48', NULL),
('1327', 'Oroquieta City', '49', NULL),
('1328', 'Ozamis City', '49', NULL),
('1329', 'Tangub City', '49', NULL),
('133', 'Abucay', '10', NULL),
('1330', 'Cagayan de Oro', '50', NULL),
('1331', 'Gingoog City', '50', NULL),
('1332', 'El Salvador City', '50', NULL),
('1333', 'Barlig', '51', NULL),
('1334', 'Bauko', '51', NULL),
('1335', 'Besao', '51', NULL),
('1336', 'Bontoc', '51', NULL),
('1337', 'Natonin', '51', NULL),
('1338', 'Paracelis', '51', NULL),
('1339', 'Sabangan', '51', NULL),
('134', 'Bagac', '10', NULL),
('1340', 'Sadanga', '51', NULL),
('1341', 'Sagada', '51', NULL),
('1342', 'Tadian', '51', NULL),
('1343', 'Bacolod City', '52', NULL),
('1344', 'Bago City', '52', NULL),
('1345', 'Cadiz City', '52', NULL),
('1346', 'Escalante City', '52', NULL),
('1347', 'Himamaylan City', '52', NULL),
('1348', 'Kabankalan City', '52', NULL),
('1349', 'La Carlota City', '52', NULL),
('135', 'Dinalupihan', '10', NULL),
('1350', 'Sagay City', '52', NULL),
('1351', 'San Carlos City', '52', NULL),
('1352', 'Silay City', '52', NULL),
('1353', 'Sipalay City', '52', NULL),
('1354', 'Talisay City', '52', NULL),
('1355', 'Victorias City', '52', NULL),
('1356', 'Bais City', '53', NULL),
('1357', 'Bayawan City', '53', NULL),
('1358', 'Canlaon City', '53', NULL),
('1359', 'Dumaguete City', '53', NULL),
('136', 'Hermosa', '10', NULL),
('1360', 'Guihulngan City', '53', NULL),
('1361', 'Tanjay City', '53', NULL),
('1362', 'Allen', '54', NULL),
('1363', 'Biri', '54', NULL),
('1364', 'Bobon', '54', NULL),
('1365', 'Capul', '54', NULL),
('1366', 'Catarman', '54', NULL),
('1367', 'Catubig', '54', NULL),
('1368', 'Gamay', '54', NULL),
('1369', 'Laoang', '54', NULL),
('137', 'Limay', '10', NULL),
('1370', 'Lapinig', '54', NULL),
('1371', 'Las Navas', '54', NULL),
('1372', 'Lavezares', '54', NULL),
('1373', 'Lope de Vega', '54', NULL),
('1374', 'Mapanas', '54', NULL),
('1375', 'Mondragon', '54', NULL),
('1376', 'Palapag', '54', NULL),
('1377', 'Pambujan', '54', NULL),
('1378', 'Rosario', '54', NULL),
('1379', 'San Antonio', '54', NULL),
('138', 'Mariveles', '10', NULL),
('1380', 'San Isidro', '54', NULL),
('1381', 'San Jose', '54', NULL),
('1382', 'San Roque', '54', NULL),
('1383', 'San Vicente', '54', NULL),
('1384', 'Silvino Lobos', '54', NULL),
('1385', 'Victoria', '54', NULL),
('1386', 'Cabanatuan City', '55', NULL),
('1387', 'Gapan City', '55', NULL),
('1388', 'Palayan City', '55', NULL),
('1389', 'San Jose City', '55', NULL),
('139', 'Morong', '10', NULL),
('1390', 'Science City of Muñoz', '55', NULL),
('1391', 'Alfonso Castaneda', '56', NULL),
('1392', 'Ambaguio', '56', NULL),
('1393', 'Aritao', '56', NULL),
('1394', 'Bagabag', '56', NULL),
('1395', 'Bambang', '56', NULL),
('1396', 'Bayombong', '56', NULL),
('1397', 'Diadi', '56', NULL),
('1398', 'Dupax del Norte', '56', NULL),
('1399', 'Dupax del Sur', '56', NULL),
('14', 'Luba', '1', '2813'),
('140', 'Orani', '10', NULL),
('1400', 'Kasibu', '56', NULL),
('1401', 'Kayapa', '56', NULL),
('1402', 'Quezon', '56', NULL),
('1403', 'Santa Fe', '56', NULL),
('1404', 'Solano', '56', NULL),
('1405', 'Villaverde', '56', NULL),
('1406', 'Abra de Ilog', '57', NULL),
('1407', 'Calintaan', '57', NULL),
('1408', 'Looc', '57', NULL),
('1409', 'Lubang', '57', NULL),
('141', 'Orion', '10', NULL),
('1410', 'Magsaysay', '57', NULL),
('1411', 'Mamburao', '57', NULL),
('1412', 'Paluan', '57', NULL),
('1413', 'Rizal', '57', NULL),
('1414', 'Sablayan', '57', NULL),
('1415', 'San Jose', '57', NULL),
('1416', 'Santa Cruz', '57', NULL),
('1417', 'Calapan City', '58', NULL),
('1418', 'Puerto Princesa City', '59', NULL),
('1419', 'Angeles City', '60', NULL),
('142', 'Pilar', '10', NULL),
('1420', 'City of San Fernando', '60', NULL),
('1421', 'Alaminos City', '61', NULL),
('1422', 'Dagupan City', '61', NULL),
('1423', 'San Carlos City', '61', NULL),
('1424', 'Urdaneta City', '61', NULL),
('1425', 'Lucena City', '62', NULL),
('1426', 'Tayabas City', '62', NULL),
('1427', 'Aglipay', '63', NULL),
('1428', 'Cabarroguis', '63', NULL),
('1429', 'Diffun', '63', NULL),
('143', 'Samal', '10', NULL),
('1430', 'Maddela', '63', NULL),
('1431', 'Nagtipunan', '63', NULL),
('1432', 'Saguday', '63', NULL),
('1433', 'Pasig City', '64', NULL),
('1434', 'Antipolo City', '64', NULL),
('1435', 'Angono', '64', NULL),
('1436', 'Baras', '64', NULL),
('1437', 'Binangonan', '64', NULL),
('1438', 'Cainta', '64', NULL),
('1439', 'Cardona', '64', NULL),
('144', 'Basco', '11', NULL),
('1440', 'Jalajala', '64', NULL),
('1441', 'Morong', '64', NULL),
('1442', 'Pililla', '64', NULL),
('1443', 'Rodriguez', '64', NULL),
('1444', 'San Mateo', '64', NULL),
('1445', 'Tanay', '64', NULL),
('1446', 'Taytay', '64', NULL),
('1447', 'Teresa', '64', NULL),
('1448', 'Alcantara', '65', NULL),
('1449', 'Banton', '65', NULL),
('145', 'Itbayat', '11', NULL),
('1450', 'Cajidiocan', '65', NULL),
('1451', 'Calatrava', '65', NULL),
('1452', 'Concepcion', '65', NULL),
('1453', 'Corcuera', '65', NULL),
('1454', 'Ferrol', '65', NULL),
('1455', 'Looc', '65', NULL),
('1456', 'Magdiwang', '65', NULL),
('1457', 'Odiongan', '65', NULL),
('1458', 'Romblon', '65', NULL),
('1459', 'San Agustin', '65', NULL),
('146', 'Ivana', '11', NULL),
('1460', 'San Andres', '65', NULL),
('1461', 'San Fernando', '65', NULL),
('1462', 'San Jose', '65', NULL),
('1463', 'Santa Fe', '65', NULL),
('1464', 'Santa Maria', '65', NULL),
('1465', 'Catbalogan City', '66', NULL),
('1466', 'Calbayog City', '66', NULL),
('1467', 'Alabel', '67', NULL),
('1468', 'Glan', '67', NULL),
('1469', 'Kiamba', '67', NULL),
('147', 'Mahatao', '11', NULL),
('1470', 'Maasim', '67', NULL),
('1471', 'Maitum', '67', NULL),
('1472', 'Malapatan', '67', NULL),
('1473', 'Malungon', '67', NULL),
('1474', 'Barira', '68', NULL),
('1475', 'Buldon', '68', NULL),
('1476', 'Datu Blah T. Sinsuat', '68', NULL),
('1477', 'Datu Odin Sinsuat', '68', NULL),
('1478', 'Kabuntalan', '68', NULL),
('1479', 'Matanog', '68', NULL),
('148', 'Sabtang', '11', NULL),
('1480', 'Northern Kabuntalan', '68', NULL),
('1481', 'Parang', '68', NULL),
('1482', 'Sultan Kudarat', '68', NULL),
('1483', 'Sultan Mastura', '68', NULL),
('1484', 'Upi', '68', NULL),
('1485', 'Enrique Villanueva', '69', NULL),
('1486', 'Larena', '69', NULL),
('1487', 'Lazi', '69', NULL),
('1488', 'Maria', '69', NULL),
('1489', 'San Juan', '69', NULL),
('149', 'Uyugan', '11', NULL),
('1490', 'Siquijor', '69', NULL),
('1491', 'Sorsogon City', '70', NULL),
('1492', 'General Santos City', '71', NULL),
('1493', 'Koronadal City', '71', NULL),
('1494', 'Maasin CIty', '72', NULL),
('1495', 'Tacurong City', '73', NULL),
('1496', 'Jolo City', '74', NULL),
('1497', 'Surigao City', '75', NULL),
('1498', 'Bislig CIty', '76', NULL),
('1499', 'Tandag CIty', '76', NULL),
('15', 'Malibcong', '1', NULL),
('150', 'Batangas City', '12', NULL),
('1500', 'Tarlac City', '77', NULL),
('1501', 'Bongao', '78', NULL),
('1502', 'Languyan', '78', NULL),
('1503', 'Mapun', '78', NULL),
('1504', 'Panglima Sugala', '78', NULL),
('1505', 'Sapa-Sapa', '78', NULL),
('1506', 'Sibutu', '78', NULL),
('1507', 'Simunul', '78', NULL),
('1508', 'Sitangkai', '78', NULL),
('1509', 'South Ubian', '78', NULL),
('151', 'Lipa City', '12', NULL),
('1510', 'Tandubas', '78', NULL),
('1511', 'Turtle Islands', '78', NULL),
('1512', 'Olongapo City', '79', NULL),
('1513', 'Dapitan City', '80', NULL),
('1514', 'Dipolog CIty', '80', NULL),
('1515', 'Pagadian City', '81', NULL),
('1516', 'Zamboanga City', '81', NULL),
('1517', 'Alicia', '82', NULL),
('1518', 'Buug', '82', NULL),
('1519', 'Diplahan', '82', NULL),
('152', 'Tanauan City', '12', NULL),
('1520', 'Imelda', '82', NULL),
('1521', 'Ipil', '82', NULL),
('1522', 'Kabasalan', '82', NULL),
('1523', 'Mabuhay', '82', NULL),
('1524', 'Malangas', '82', NULL),
('1525', 'Naga', '82', NULL),
('1526', 'Olutanga', '82', NULL),
('1527', 'Payao', '82', NULL),
('1528', 'Roseller Lim', '82', NULL),
('1529', 'Siay', '82', NULL),
('153', 'Agoncillo', '12', NULL),
('1530', 'Talusan', '82', NULL),
('1531', 'Titay', '82', NULL),
('1532', 'Tungawan', '82', NULL),
('154', 'Alitagtag', '12', NULL),
('155', 'Balayan', '12', NULL),
('156', 'Balete', '12', NULL),
('157', 'Bauan', '12', NULL),
('158', 'Calaca', '12', NULL),
('159', 'Calatagan', '12', NULL),
('16', 'Manabo', '1', '2810'),
('160', 'Cuenca', '12', NULL),
('161', 'Ibaan', '12', NULL),
('162', 'Laurel', '12', NULL),
('163', 'Lemery', '12', NULL),
('164', 'Lian', '12', NULL),
('165', 'Lobo', '12', NULL),
('166', 'Mabini', '12', NULL),
('167', 'Malvar', '12', NULL),
('168', 'Mataas na Kahoy', '12', NULL),
('169', 'Nasugbu', '12', NULL),
('17', 'Peñarrubia', '1', '2804'),
('170', 'Padre Garcia', '12', NULL),
('171', 'Rosario', '12', NULL),
('172', 'San Jose', '12', NULL),
('173', 'San Juan', '12', NULL),
('174', 'San Luis', '12', NULL),
('175', 'San Nicolas', '12', NULL),
('176', 'San Pascual', '12', NULL),
('177', 'Santa Teresita', '12', NULL),
('178', 'Santo Tomas', '12', NULL),
('179', 'Taal', '12', NULL),
('18', 'Pidigan', '1', '2806'),
('180', 'Talisay', '12', NULL),
('181', 'Taysan', '12', NULL),
('182', 'Tingloy', '12', NULL),
('183', 'Tuy', '12', NULL),
('184', 'Baguio City', '13', NULL),
('185', 'Atok', '13', NULL),
('186', 'Bakun', '13', NULL),
('187', 'Bokod', '13', NULL),
('188', 'Buguias', '13', NULL),
('189', 'Itogon', '13', NULL),
('19', 'Pilar', '1', '2812'),
('190', 'Kabayan', '13', NULL),
('191', 'Kapangan', '13', NULL),
('192', 'Kibungan', '13', NULL),
('193', 'La Trinidad', '13', NULL),
('194', 'Mankayan', '13', NULL),
('195', 'Sablan', '13', NULL),
('196', 'Tuba', '13', NULL),
('197', 'Tublay', '13', NULL),
('2', 'Boliney', ' 1', '2815'),
('20', 'Sallapadan', '1', '2818'),
('21', 'San Isidro', '1', '2809'),
('22', 'San Juan', '1', NULL),
('23', 'San Quintin', '1', '2808'),
('24', 'Tayum', '1', '2803'),
('25', 'Tineg', '1', NULL),
('26', 'Tubo', '1', '2814'),
('27', 'Villaviciosa', '1', '2811'),
('28', 'Butuan City', '2', NULL),
('29', 'Cabadbaran City', '2', NULL),
('3', 'Bucay', ' 1', '2805'),
('30', 'Buenavista', '2', NULL),
('31', 'Carmen', '2', NULL),
('32', 'Jabonga', '2', NULL),
('33', 'Kitcharao', '2', NULL),
('34', 'Las Nieves', '2', NULL),
('35', 'Magallanes', '2', NULL),
('36', 'Nasipit', '2', NULL),
('37', 'Remedios T. Romualdez', '2', NULL),
('38', 'Santiago', '2', NULL),
('39', 'Tubay', '2', NULL),
('4', 'Bucloc', '1', '2817'),
('40', 'Bayugan', '3', NULL),
('41', 'Bunawan', '3', NULL),
('42', 'Esperanza', '3', NULL),
('43', 'La Paz', '3', NULL),
('44', 'Loreto', '3', NULL),
('45', 'Prosperidad', '3', NULL),
('46', 'Rosario', '3', NULL),
('47', 'San Francisco', '3', NULL),
('48', 'San Luis', '3', NULL),
('49', 'Santa Josefa', '3', NULL),
('5', 'Daguioman', '1', '2816'),
('50', 'Sibagat', '3', NULL),
('51', 'Talacogon', '3', NULL),
('52', 'Trento', '3', NULL),
('53', 'Veruela', '3', NULL),
('54', 'Altavas', '4', NULL),
('55', 'Balete', '4', NULL),
('56', 'Banga', '4', NULL),
('57', 'Batan', '4', NULL),
('58', 'Buruanga', '4', NULL),
('59', 'Ibajay', '4', NULL),
('6', 'Danglas', '1', NULL),
('60', 'Kalibo', '4', NULL),
('61', 'Lezo', '4', NULL),
('62', 'Libacao', '4', NULL),
('63', 'Madalag', '4', NULL),
('64', 'Makato', '4', NULL),
('65', 'Malay', '4', NULL),
('66', 'Malinao', '4', NULL),
('67', 'Nabas', '4', NULL),
('68', 'New Washington', '4', NULL),
('69', 'Numancia', '4', NULL),
('7', 'Dolores', '1', '2801'),
('70', 'Tangalan', '4', NULL),
('71', 'Ligao City', '5', NULL),
('72', 'Tabaco City', '5', NULL),
('73', 'Bacacay', '5', NULL),
('74', 'Camalig', '5', NULL),
('75', 'Daraga', '5', NULL),
('76', 'Guinobatan', '5', NULL),
('77', 'Jovellar', '5', NULL),
('78', 'Libon', '5', NULL),
('79', 'Malilipot', '5', NULL),
('8', 'La Paz', '1', NULL),
('80', 'Malinao', '5', NULL),
('81', 'Manito', '5', NULL),
('82', 'Oas', '5', NULL),
('83', 'Pio Duran', '5', NULL),
('84', 'Polangui', '5', NULL),
('85', 'Rapu-Rapu', '5', NULL),
('86', 'Santo Domingo', '5', NULL),
('87', 'Tiwi', '5', NULL),
('88', 'Anini-y', '6', NULL),
('89', 'Barbaza', '6', NULL),
('9', 'Lacub', '1', NULL),
('90', 'Belison', '6', NULL),
('91', 'Bugasong', '6', NULL),
('92', 'Caluya', '6', NULL),
('93', 'Culasi', '6', NULL),
('94', 'Hamtic', '6', NULL),
('95', 'Laua-an', '6', NULL),
('96', 'Libertad', '6', NULL),
('97', 'Pandan', '6', NULL),
('98', 'Patnongon', '6', NULL),
('99', 'San Jose', '6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinics`
--

CREATE TABLE `tbl_clinics` (
  `clinic_id` int(11) NOT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `clinic_status` varchar(30) DEFAULT NULL,
  `clinic_logo` varchar(255) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `clinic_address` varchar(255) DEFAULT NULL,
  `city_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_clinics`
--

INSERT INTO `tbl_clinics` (`clinic_id`, `clinic_name`, `clinic_status`, `clinic_logo`, `user_id`, `clinic_address`, `city_id`) VALUES
(12, 'Deloitte & Touche', 'OPEN', 'http://localhost/clinic/asset/uploaded_images/clinicdefault.jpg', '2-2017', 'Oklahoma Neon Inc.', '29'),
(13, 'Myclinic', 'OPEN', 'http://localhost/clinic/asset/uploaded_images/clinicdefault.jpg', '2-2017', 'Session Rd', '145');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis`
--

CREATE TABLE `tbl_diagnosis` (
  `diagnosis_id` int(30) NOT NULL,
  `diagnosis` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_diagnosis`
--

INSERT INTO `tbl_diagnosis` (`diagnosis_id`, `diagnosis`, `description`, `status`) VALUES
(3, 'Headache', 'headache', 'ACCEPTED'),
(4, 'back pain', 'Back Pain', 'ACCEPTED'),
(5, 'Skin Disease', 'Psoariasis', 'ACCEPTED'),
(6, 'Stomach ache', 'Stomach Ache', 'ACCEPTED'),
(7, 'Over Fatigue', 'Over Fatigue', 'ACCEPTED'),
(8, 'Kawasaki disease', 'Kawasaki Disease', 'ACCEPTED'),
(9, 'Chronic Eye problem', 'Eye Problem', 'ACCEPTED'),
(10, 'Sakit Ulo', 'Ambot', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis_patient`
--

CREATE TABLE `tbl_diagnosis_patient` (
  `patient_diagnosis_id` int(30) NOT NULL,
  `diagnosis_id` int(30) DEFAULT NULL,
  `check_up_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_details`
--

CREATE TABLE `tbl_login_details` (
  `login_details_id` int(255) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login_details`
--

INSERT INTO `tbl_login_details` (`login_details_id`, `user_id`, `login_date`, `logout_date`) VALUES
(86, '2-2017', '2017-12-15 15:43:17', '2018-12-10 16:45:33'),
(87, '2-2017', '2017-12-18 09:04:51', '2018-12-10 16:45:33'),
(88, '3-2017', '2017-12-18 12:09:03', '2017-12-18 13:05:27'),
(89, '2-2017', '2017-12-18 12:10:00', '2018-12-10 16:45:33'),
(90, '3-2017', '2017-12-18 12:11:32', '2017-12-18 13:05:27'),
(91, '2-2017', '2017-12-18 12:14:09', '2018-12-10 16:45:33'),
(92, '3-2017', '2017-12-18 12:24:26', '2017-12-18 13:05:27'),
(93, '3-2017', '2017-12-18 12:36:01', '2017-12-18 13:05:27'),
(94, '2-2017', '2017-12-18 12:39:57', '2018-12-10 16:45:33'),
(95, '3-2017', '2017-12-18 12:41:59', '2017-12-18 13:05:27'),
(96, '2-2017', '2017-12-18 12:42:42', '2018-12-10 16:45:33'),
(97, '3-2017', '2017-12-18 12:43:00', '2017-12-18 13:05:27'),
(98, '2-2017', '2017-12-18 12:52:04', '2018-12-10 16:45:33'),
(99, '3-2017', '2017-12-18 12:52:32', '2017-12-18 13:05:27'),
(100, '2-2017', '2017-12-18 16:32:23', '2018-12-10 16:45:33'),
(101, '2-2017', '2017-12-18 16:46:35', '2018-12-10 16:45:33'),
(102, '2-2017', '2017-12-18 17:11:01', '2018-12-10 16:45:33'),
(103, '2-2017', '2017-12-18 17:36:21', '2018-12-10 16:45:33'),
(104, '4-2017', '2017-12-18 17:43:11', NULL),
(105, '2-2017', '2017-12-18 20:30:51', '2018-12-10 16:45:33'),
(106, '2-2017', '2017-12-19 22:00:15', '2018-12-10 16:45:33'),
(107, '5-2017', '2017-12-19 22:24:59', '2018-01-01 13:56:28'),
(108, '2-2017', '2017-12-20 00:35:53', '2018-12-10 16:45:33'),
(109, '5-2017', '2017-12-20 01:29:55', '2018-01-01 13:56:28'),
(110, '2-2017', '2017-12-20 12:34:13', '2018-12-10 16:45:33'),
(111, '2-2017', '2017-12-20 13:27:12', '2018-12-10 16:45:33'),
(112, '5-2017', '2017-12-20 13:30:13', '2018-01-01 13:56:28'),
(113, '2-2017', '2017-12-23 10:05:42', '2018-12-10 16:45:33'),
(114, '5-2017', '2017-12-23 18:12:00', '2018-01-01 13:56:28'),
(115, '2-2017', '2017-12-23 23:17:53', '2018-12-10 16:45:33'),
(116, '5-2017', '2017-12-23 23:19:01', '2018-01-01 13:56:28'),
(117, '2-2017', '2017-12-23 23:19:30', '2018-12-10 16:45:33'),
(118, '2-2017', '2017-12-25 23:09:56', '2018-12-10 16:45:33'),
(119, '2-2017', '2017-12-25 23:37:54', '2018-12-10 16:45:33'),
(120, '5-2017', '2017-12-25 23:45:45', '2018-01-01 13:56:28'),
(121, '2-2017', '2018-01-01 13:27:21', '2018-12-10 16:45:33'),
(122, '5-2017', '2018-01-01 13:53:10', '2018-01-01 13:56:28'),
(123, '2-2017', '2018-01-01 13:56:37', '2018-12-10 16:45:33'),
(124, '102', '2018-01-01 15:39:09', '2018-01-01 17:02:46'),
(125, '102', '2018-01-01 15:50:51', '2018-01-01 17:02:46'),
(126, '101', '2018-01-01 15:55:12', '2018-12-10 15:51:33'),
(127, '101', '2018-01-01 16:18:38', '2018-12-10 15:51:33'),
(128, '102', '2018-01-01 16:19:02', '2018-01-01 17:02:46'),
(129, '2-2017', '2018-01-01 16:29:42', '2018-12-10 16:45:33'),
(130, '2-2017', '2018-01-01 16:31:27', '2018-12-10 16:45:33'),
(131, '102', '2018-01-01 16:36:49', '2018-01-01 17:02:46'),
(132, '2-2017', '2018-01-01 17:26:48', '2018-12-10 16:45:33'),
(133, '2-2017', '2018-01-02 16:13:02', '2018-12-10 16:45:33'),
(134, '2-2017', '2018-02-14 00:49:23', '2018-12-10 16:45:33'),
(135, '2-2017', '2018-02-14 00:50:07', '2018-12-10 16:45:33'),
(136, '2-2017', '2018-02-14 00:57:42', '2018-12-10 16:45:33'),
(137, '2-2017', '2018-02-14 01:01:04', '2018-12-10 16:45:33'),
(138, '2-2017', '2018-02-14 09:15:12', '2018-12-10 16:45:33'),
(139, '2-2017', '2018-02-18 13:50:48', '2018-12-10 16:45:33'),
(140, '2-2017', '2018-02-23 12:09:44', '2018-12-10 16:45:33'),
(141, '2-2017', '2018-02-24 08:10:36', '2018-12-10 16:45:33'),
(142, '101', '2018-05-21 16:31:37', '2018-12-10 15:51:33'),
(143, '101', '2018-05-21 16:42:40', '2018-12-10 15:51:33'),
(144, '101', '2018-05-21 16:43:52', '2018-12-10 15:51:33'),
(145, '101', '2018-12-10 15:51:18', '2018-12-10 15:51:33'),
(146, '2-2017', '2018-12-10 15:54:11', '2018-12-10 16:45:33'),
(147, '2-2017', '2018-12-10 15:55:22', '2018-12-10 16:45:33'),
(148, '2-2017', '2018-12-10 15:59:55', '2018-12-10 16:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth`
--

CREATE TABLE `tbl_oauth` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(50) NOT NULL,
  `oauth_uid` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_oauth`
--

INSERT INTO `tbl_oauth` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `link`) VALUES
(4, 'Facebook', '1380130388672959', 'Jc', 'John', 'iamjohnx3303@yahoo.com', 'male', 'en_US', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/11800070_1018786838140651_3213143716561284892_n.jpg?oh=3ad565481e23f432159f7ff929ee0320&oe=58E9ABFA', 'https://www.facebook.com/app_scoped_user_id/1380130388672959/'),
(5, 'Facebook', '1380130388672959', 'Jc', 'John', 'iamjohnx3303@yahoo.com', 'male', 'en_US', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/11800070_1018786838140651_3213143716561284892_n.jpg?oh=3ad565481e23f432159f7ff929ee0320&oe=58E9ABFA', 'https://www.facebook.com/app_scoped_user_id/1380130388672959/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` varchar(30) NOT NULL,
  `patient_fname` varchar(30) DEFAULT NULL,
  `patient_mname` varchar(30) DEFAULT NULL,
  `patient_lname` varchar(30) DEFAULT NULL,
  `patient_address` varchar(30) DEFAULT NULL,
  `patient_contact_info` varchar(30) DEFAULT NULL,
  `patient_sex` varchar(30) DEFAULT NULL,
  `patient_civil_status` varchar(30) DEFAULT NULL,
  `patient_age` varchar(30) DEFAULT NULL,
  `patient_bday` date DEFAULT NULL,
  `patient_blood` varchar(15) DEFAULT NULL,
  `patient_photo` varchar(255) DEFAULT NULL,
  `patient_password` varchar(255) DEFAULT NULL,
  `patient_username` varchar(255) DEFAULT NULL,
  `creator_id` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `patient_fname`, `patient_mname`, `patient_lname`, `patient_address`, `patient_contact_info`, `patient_sex`, `patient_civil_status`, `patient_age`, `patient_bday`, `patient_blood`, `patient_photo`, `patient_password`, `patient_username`, `creator_id`) VALUES
('1', 'Daniel', 'Scourge', 'Man', 'baghdad', '09432551592', 'Male', 'Single', '17', '2001-12-10', 'B-', 'https://drapp.cliniccounter.com/asset/uploaded_images/patients/101.jpg', NULL, NULL, '2-2017'),
('2', 'Huuray', 'hahah', 'Muuray', 'ambot', '09432251906', 'Male', 'Single', '5', '2012-07-18', 'AB', 'https://app.cliniccounter.com/asset/uploaded_images/patients/8.jpeg', NULL, NULL, '2-2017'),
('3', 'Michael', 'Angelo', 'Kuripot', 'Ong Yiu', '09288592918', 'Male', 'Single', '23', '1995-06-12', 'AB', 'https://app.cliniccounter.com/asset/uploaded_images/13.jpg', NULL, NULL, '2-2017'),
('4', 'Huey', 'H', 'Marcille', '169 Journal Sq', '780-639-361', 'Male', 'Married', '21', '1997-11-28', 'B-', 'https://drapp.cliniccounter.com/asset/uploaded_images/patients/9.jpeg', NULL, NULL, '2-2017');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `province_id` varchar(25) NOT NULL,
  `province_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_province`
--

INSERT INTO `tbl_province` (`province_id`, `province_name`) VALUES
('1', 'Abra'),
('10', 'Bataan'),
('11', 'Batanes'),
('12', 'Batangas'),
('13', 'Benguet'),
('14', 'Biliran'),
('15', 'Bohol'),
('16', 'Bukidnon'),
('17', 'Bulacan'),
('18', 'Cagayan'),
('19', 'Camarines Norte'),
('2', 'Agusan del Norte'),
('20', 'Camarines Sur'),
('21', 'Camiguin'),
('22', 'Capiz'),
('23', 'Catanduanes'),
('24', 'Cavite'),
('25', 'Cebu'),
('26', 'Compostela Valley'),
('27', 'Cotabato'),
('28', 'Davao del Norte'),
('29', 'Davao del Sur'),
('3', 'Agusan del Sur'),
('30', 'Davao Oriental'),
('31', 'Dinagat Islands'),
('32', 'Eastern Samar'),
('33', 'Guimaras'),
('34', 'Ifugao'),
('35', 'Ilocos Norte'),
('36', 'Ilocos Sur'),
('37', 'Iloilo'),
('38', 'Isabela'),
('39', 'Kalinga'),
('4', 'Aklan'),
('40', 'La Union'),
('41', 'Laguna'),
('42', 'Lanao del Norte'),
('43', 'Lanao del Sur'),
('44', 'Leyte'),
('45', 'Maguindanao'),
('46', 'Marinduque'),
('47', 'Masbate'),
('48', 'Metro Manila'),
('49', 'Misamis Occidental'),
('5', 'Albay'),
('50', 'Misamis Oriental'),
('51', 'Mountain Province'),
('52', 'Negros Occidental'),
('53', 'Negros Oriental'),
('54', 'Northern Samar'),
('55', 'Nueva Ecija'),
('56', 'Nueva Vizcaya'),
('57', 'Occidental Mindoro'),
('58', 'Oriental Mindoro'),
('59', 'Palawan'),
('6', 'Antique'),
('60', 'Pampanga'),
('61', 'Pangasinan'),
('62', 'Quezon'),
('63', 'Quirino'),
('64', 'Rizal'),
('65', 'Romblon'),
('66', 'Samar'),
('67', 'Sarangani'),
('68', 'Shariff Kabunsuan'),
('69', 'Siquijor'),
('7', 'Apayao'),
('70', 'Sorsogon'),
('71', 'South Cotabato'),
('72', 'Southern Leyte'),
('73', 'Sultan Kudarat'),
('74', 'Sulu'),
('75', 'Surigao del Norte'),
('76', 'Surigao del Sur'),
('77', 'Tarlac'),
('78', 'Tawi-Tawi'),
('79', 'Zambales'),
('8', 'Aurora'),
('80', 'Zamboanga del Norte'),
('81', 'Zamboanga del Sur'),
('82', 'Zamboanga Sibugay'),
('9', 'Basilan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_queue`
--

CREATE TABLE `tbl_queue` (
  `queue_id` int(30) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `time_sched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_queue`
--

INSERT INTO `tbl_queue` (`queue_id`, `user_id`, `clinic_id`, `order_num`, `patient_id`, `status`, `time_sched`) VALUES
(3, '2-2017', 13, 1, '3', '2', NULL),
(4, '2-2017', 13, 2, '2', '2', NULL),
(5, '2-2017', 13, 3, '1', '2', NULL),
(6, '2-2017', 13, 1, '3', '2', NULL),
(10, '2-2017', 12, 3, '2', '2', NULL),
(11, '2-2017', 12, 4, '3', '2', NULL),
(12, '2-2017', 12, 5, '4', '2', NULL),
(13, '2-2017', 13, 1, '4', '2', NULL),
(14, '2-2017', 12, 1, '4', '2', NULL),
(15, '2-2017', 13, 1, '2', '0', NULL),
(16, '2-2017', 13, 1, '2', '0', NULL),
(17, '2-2017', 12, 1, '1', '2', NULL),
(18, '2-2017', 12, 1, '2', '0', NULL),
(19, '2-2017', 12, 2, '3', '0', NULL),
(20, '2-2017', 12, 3, '3', '0', NULL),
(21, '2-2017', 12, 4, '4', '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_removequeue`
--

CREATE TABLE `tbl_removequeue` (
  `remove_id` varchar(30) NOT NULL,
  `queue_id` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `time_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_removequeue`
--

INSERT INTO `tbl_removequeue` (`remove_id`, `queue_id`, `user_id`, `clinic_id`, `order_num`, `patient_id`, `time_deleted`) VALUES
('1', '2', '4-2017', 12, 2, '2', '2017-12-18 19:35:35'),
('2', '9', '4-2017', 12, 2, '2', '2017-12-18 19:35:42'),
('3', '1', '4-2017', 12, 1, '1', '2017-12-18 19:35:47'),
('4', '7', '4-2017', 12, 1, '1', '2017-12-18 19:35:50'),
('5', '8', '5-2017', 12, 1, '1', '2017-12-23 18:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sec`
--

CREATE TABLE `tbl_sec` (
  `Sec_id` varchar(30) NOT NULL,
  `creator_id` varchar(30) DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sec`
--

INSERT INTO `tbl_sec` (`Sec_id`, `creator_id`, `user_id`) VALUES
('1', '2-2017', '3-2017'),
('2', '2-2017', '4-2017'),
('3', '2-2017', '5-2017'),
('4', '2-2017', '6-2017');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` varchar(30) NOT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_fname` varchar(30) DEFAULT NULL,
  `user_mname` varchar(30) DEFAULT NULL,
  `user_lname` varchar(30) DEFAULT NULL,
  `user_address` varchar(30) DEFAULT NULL,
  `user_contact_info` varchar(30) DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `user_status` varchar(10) DEFAULT NULL,
  `user_gender` varchar(6) DEFAULT NULL,
  `user_bdate` date DEFAULT NULL,
  `assign_id` varchar(30) DEFAULT NULL,
  `chat_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_type`, `user_name`, `user_password`, `user_fname`, `user_mname`, `user_lname`, `user_address`, `user_contact_info`, `user_photo`, `user_status`, `user_gender`, `user_bdate`, `assign_id`, `chat_id`) VALUES
('101', 'ut1', 'jcjohn', 'fc5e038d38a57032085441e7fe7010b0', 'jc', 'j', 'john', 'R.calo', '09432251906', 'https://drapp.cliniccounter.com/asset/uploaded_images/5.jpg', 'OK', 'Male', NULL, NULL, NULL),
('102', 'ut1', 'adminalbert', 'fc5e038d38a57032085441e7fe7010b0', 'kian', 'b', 'cee', 'mission rd', '12345678', 'http://[::1]/clinic/asset/uploaded_images/Killua_close_up.png', 'OK', 'Male', NULL, NULL, NULL),
('2-2017', 'ut2', 'DrLeo', 'cd1b8ecf103743a98958211a11e33b71', 'Leo', 'L', 'Bolilan', 'BGC', '09228848281', 'https://drapp.cliniccounter.com/asset/uploaded_images/dr.jpg', 'OK', 'MALE', '1981-03-11', NULL, 1),
('3-2017', 'ut3', 'LeoSecretary', 'fc5e038d38a57032085441e7fe7010b0', 'Leo', 'Sec', 'Sec', 'ambot', '09218848285', 'http://localhost/clinic/asset/uploaded_images/DrStylish3.png', 'OK', 'MALE', '2009-02-25', '1', 1),
('4-2017', 'ut3', 'secleo2', 'fc5e038d38a57032085441e7fe7010b0', 'Anne', 'D', 'Cee', 'A', '12345678', 'http://192.168.1.5/clinic/asset/uploaded_images/sec2.jpeg', 'OK', 'FEMALE', '1995-12-26', '1', 1),
('5-2017', 'ut3', 'secretary1', 'fc5e038d38a57032085441e7fe7010b0', 'Andree', 'A', 'Christmann', '765 Rock Island Rd', '519-872-6826', 'https://app.cliniccounter.com/asset/uploaded_images/thumb_12.jpg', 'OK', 'MALE', '1995-03-20', '1', 1),
('6-2017', 'ut3', 'secretary2', '70cc3d7cc560827460fbb85af8858038', 'Elise', 'E', 'Michelle', '88 E Saint Elmo Rd', '905-652-4509', 'https://app.cliniccounter.com/asset/uploaded_images/default-img.png', 'OK', 'FEMALE', '1995-12-12', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `user_type` varchar(30) NOT NULL,
  `position` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`user_type`, `position`) VALUES
('ut1', 'Admin'),
('ut2', 'Clinic Doctor'),
('ut3', 'Secretary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `tbl_chatmessages`
--
ALTER TABLE `tbl_chatmessages`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `tbl_check_up`
--
ALTER TABLE `tbl_check_up`
  ADD PRIMARY KEY (`check_up_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_clinics`
--
ALTER TABLE `tbl_clinics`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `tbl_diagnosis`
--
ALTER TABLE `tbl_diagnosis`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- Indexes for table `tbl_diagnosis_patient`
--
ALTER TABLE `tbl_diagnosis_patient`
  ADD PRIMARY KEY (`patient_diagnosis_id`),
  ADD KEY `diagnosis_id` (`diagnosis_id`);

--
-- Indexes for table `tbl_login_details`
--
ALTER TABLE `tbl_login_details`
  ADD PRIMARY KEY (`login_details_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_oauth`
--
ALTER TABLE `tbl_oauth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  ADD PRIMARY KEY (`queue_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `clinic_id` (`clinic_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `tbl_removequeue`
--
ALTER TABLE `tbl_removequeue`
  ADD PRIMARY KEY (`remove_id`);

--
-- Indexes for table `tbl_sec`
--
ALTER TABLE `tbl_sec`
  ADD PRIMARY KEY (`Sec_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_chatmessages`
--
ALTER TABLE `tbl_chatmessages`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_clinics`
--
ALTER TABLE `tbl_clinics`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_diagnosis`
--
ALTER TABLE `tbl_diagnosis`
  MODIFY `diagnosis_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_diagnosis_patient`
--
ALTER TABLE `tbl_diagnosis_patient`
  MODIFY `patient_diagnosis_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_login_details`
--
ALTER TABLE `tbl_login_details`
  MODIFY `login_details_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tbl_oauth`
--
ALTER TABLE `tbl_oauth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  MODIFY `queue_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `tbl_bill_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_diagnosis_patient`
--
ALTER TABLE `tbl_diagnosis_patient`
  ADD CONSTRAINT `diagnosis_id` FOREIGN KEY (`diagnosis_id`) REFERENCES `tbl_diagnosis` (`diagnosis_id`);

--
-- Constraints for table `tbl_login_details`
--
ALTER TABLE `tbl_login_details`
  ADD CONSTRAINT `tbl_login_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_queue`
--
ALTER TABLE `tbl_queue`
  ADD CONSTRAINT `tbl_queue_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`),
  ADD CONSTRAINT `tbl_queue_ibfk_2` FOREIGN KEY (`clinic_id`) REFERENCES `tbl_clinics` (`clinic_id`),
  ADD CONSTRAINT `tbl_queue_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `tbl_user_type` (`user_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
