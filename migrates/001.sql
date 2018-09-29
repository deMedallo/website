-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.34-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para id7278274_demedallo
CREATE DATABASE IF NOT EXISTS `id7278274_demedallo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `id7278274_demedallo`;

-- Volcando estructura para tabla id7278274_demedallo.coins
DROP TABLE IF EXISTS `coins`;
CREATE TABLE IF NOT EXISTS `coins` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `decimals` int(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla id7278274_demedallo.coins: ~0 rows (aproximadamente)
DELETE FROM `coins`;
/*!40000 ALTER TABLE `coins` DISABLE KEYS */;
INSERT INTO `coins` (`id`, `name`, `symbol`, `decimals`) VALUES
	(1, 'deMedallo', 'DM', 8);
/*!40000 ALTER TABLE `coins` ENABLE KEYS */;

-- Volcando estructura para tabla id7278274_demedallo.transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `tx` varchar(66) NOT NULL,
  `from` varchar(250) NOT NULL,
  `to` varchar(250) NOT NULL,
  `value` double NOT NULL,
  `fee` double NOT NULL,
  `data` mediumtext NOT NULL,
  `coin` int(32) NOT NULL DEFAULT '0',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_transactions_coins` (`coin`),
  CONSTRAINT `FK_transactions_coins` FOREIGN KEY (`coin`) REFERENCES `coins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla id7278274_demedallo.transactions: ~0 rows (aproximadamente)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Volcando estructura para tabla id7278274_demedallo.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `nick` varchar(16) NOT NULL,
  `hash` text NOT NULL,
  `name` varchar(150) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `refers` varchar(250) NOT NULL DEFAULT '0',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`),
  UNIQUE KEY `mail` (`mail`),
  KEY `Columna 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla id7278274_demedallo.users: ~1 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nick`, `hash`, `name`, `mail`, `refers`, `create`, `last_activity`) VALUES
	(1, 'admin', 'cac2ad5e57748d8748072ee59ed314f0', 'Administrador del Sitio', 'admin@demedallo.com', '0', '2018-09-29 08:30:29', '2018-09-29 17:02:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla id7278274_demedallo.wallets
DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `userid` int(32) NOT NULL DEFAULT '0',
  `address` varchar(250) NOT NULL DEFAULT '0x',
  `coin` int(32) NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `FK_wallet_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla id7278274_demedallo.wallets: ~1 rows (aproximadamente)
DELETE FROM `wallets`;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` (`id`, `userid`, `address`, `coin`, `balance`, `create`, `update`) VALUES
	(1, 1, '0x4b9987ccafacb8d8fc08d22bbca79852', 1, 6.3172e20, '2018-09-29 08:30:29', '2018-09-29 09:59:22');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
