-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.19-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para ci_teste
CREATE DATABASE IF NOT EXISTS `ci_teste` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ci_teste`;

-- Copiando estrutura para tabela ci_teste.pessoas
CREATE TABLE IF NOT EXISTS `pessoas` (
  `cd_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pessoa` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ci_teste.pessoas: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` (`cd_pessoa`, `nm_pessoa`, `email`, `fone`) VALUES
	(1, 'Romulo Fernando', 'romulo@email.com', '47 8888888'),
	(2, 'Carlos', 'carlos@email.com', '47 8852642'),
	(3, 'Maria', 'maria@email.com', '47 41255556');
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
