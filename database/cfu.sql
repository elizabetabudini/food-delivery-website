-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 06, 2019 alle 16:21
-- Versione del server: 10.1.37-MariaDB
-- Versione PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cfu`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alimento`
--

CREATE TABLE `alimento` (
  `disponibilita` char(1) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `info` varchar(100) NOT NULL,
  `prezzo` decimal(5,2) NOT NULL,
  `id_ristorante` int(11) NOT NULL,
  `nome_menu` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `alimento`
--

INSERT INTO `alimento` (`disponibilita`, `nome`, `info`, `prezzo`, `id_ristorante`, `nome_menu`, `id`) VALUES
('1', 'laboratorio 2.888', 'ciao', '1.00', 34, 'laboratorio 2.2', 1),
('1', 'af', '', '34.00', 42, 'gelato', 29),
('1', 'asfa', '', '3.00', 5, NULL, 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `id_prenotazione` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `id_ristorante` int(11) NOT NULL,
  `nome_menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria_ristoranti`
--

CREATE TABLE `categoria_ristoranti` (
  `nome_categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categoria_ristoranti`
--

INSERT INTO `categoria_ristoranti` (`nome_categoria`) VALUES
('cinese'),
('fast-food'),
('gelateria'),
('giapponese'),
('indiano'),
('paninoteca'),
('pizzeria'),
('ristorante');

-- --------------------------------------------------------

--
-- Struttura della tabella `luogo`
--

CREATE TABLE `luogo` (
  `nome` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `luogo`
--

INSERT INTO `luogo` (`nome`) VALUES
('Aula 2.1'),
('Aula 2.10'),
('Aula 2.11'),
('Aula 2.12'),
('Aula 2.13'),
('Aula 2.3'),
('Aula 2.4'),
('Aula 2.5'),
('Aula 2.6'),
('Aula 2.7'),
('Aula 2.8'),
('Aula 2.9'),
('aula 3.10'),
('Aula 3.11'),
('Aula 3.7'),
('Aula 4.1'),
('Aula Magna 3.4'),
('Biblioteca'),
('Laboratorio 2.2'),
('Laboratorio 3.1'),
('Laboratorio 3.3'),
('Punto Ristoro');

-- --------------------------------------------------------

--
-- Struttura della tabella `menu`
--

CREATE TABLE `menu` (
  `id_ristorante` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `menu`
--

INSERT INTO `menu` (`id_ristorante`, `nome`) VALUES
(5, ''),
(5, 'gelatp'),
(5, 'luca'),
(34, 'laboratorio 2.2'),
(42, 'gelato'),
(42, 'panini'),
(42, 'pizza');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `testo` text NOT NULL,
  `data` datetime NOT NULL,
  `letto` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`id`, `email`, `testo`, `data`, `letto`) VALUES
(2, 'fornitore6@fornitore.it', 'Buone notizie! Il tuo ristorante Ã¨ stato approvato dal nostro Team, ora puoi aggiungere il tuo listino. Benvenuto!', '2019-01-03 00:01:00', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `persona`
--

CREATE TABLE `persona` (
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `id_ristorante` int(11) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `privilegi` int(11) NOT NULL,
  `cellulare` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `persona`
--

INSERT INTO `persona` (`nome`, `cognome`, `email`, `id_ristorante`, `password`, `privilegi`, `cellulare`) VALUES
('admin', 'admin', 'admin@admin.it', NULL, '$2y$10$2Da8BumFyFneTSqNKzS3mOs0mA27HFBnTx9g5b7ugQFXqEKNM./ue', 2, ''),
('dasdsad', 'dasdas', 'fornitore3@fornitore.it', 32, '$2y$10$zCL.39lKdz4uV.0FBjAhhe24j4XuP8HPnGvTAo/DA6qWosJiMLdp.', 1, ''),
('Elizabeta', 'Budini', 'fornitore6@fornitore.it', 34, '$2y$10$QDAR1sqaamqF8u4O28637ORaGVS9h6chwyqncC/UNFwVeN50QHApW', 1, ''),
('Giovanni', 'Santi', 'fornitore@fornitore.it', 5, '$2y$10$DMBzaOgVYlXFy7Kx0N27OuYeyoqI2oFyKb3/WNgWdRNbM6djsI.wm', 1, ''),
('prova', 'prova', 'not_logged_in', NULL, 'ciao', 0, ''),
('corrado', 'orazi', 'orazifilippo@gmail.com', 42, '$2y$10$hS2qvvQnhtgbfv5kurfmjOvLe6ra5wFeLwBLvDNI5C0x2oC..xM8W', 1, ''),
('corrado', 'orazi', 'orazifilipppo@gmail.com', 43, '$2y$10$k6zembTnvac0OU25C5j2J.4zU.ikj7G0/GSO42hnaWMGDW7.rs5u2', 1, ''),
('utente', 'utente', 'utente@utente.it', NULL, '$2y$10$R3RXjbjdBvYryUTSbtjUFOTVfyfGMc45hK6rzNMITUlQDCF6DycKS', 0, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `info_prenotazione` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `id_ristorante` int(11) DEFAULT NULL,
  `email_cliente` varchar(40) NOT NULL,
  `data_consegna` datetime NOT NULL,
  `stato` int(11) NOT NULL,
  `totale` int(11) NOT NULL,
  `luogo_consegna` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`info_prenotazione`, `id`, `id_ristorante`, `email_cliente`, `data_consegna`, `stato`, `totale`, `luogo_consegna`) VALUES
('', 2, NULL, 'not_logged_in', '2019-01-03 00:00:00', 0, 0, 'aula 2.3'),
('', 3, 34, 'utente@utente.it', '2019-01-04 00:00:00', 1, 1, 'Aula 2.1'),
('', 4, NULL, 'not_logged_in', '2019-01-04 00:00:00', 0, 0, 'Aula 3.11'),
('', 5, NULL, 'not_logged_in', '2019-01-04 00:00:00', 0, 0, 'Aula 2.1'),
('', 6, NULL, 'not_logged_in', '2019-01-04 00:00:00', 0, 0, 'Aula 2.1'),
('', 7, NULL, 'not_logged_in', '2019-01-04 00:00:00', 0, 0, 'Laboratorio 2.2'),
('', 8, NULL, 'not_logged_in', '2019-01-04 00:00:00', 0, 0, 'Aula 2.1'),
('', 9, NULL, 'not_logged_in', '2019-01-05 00:00:00', 0, 0, 'Aula 2.1'),
('', 10, NULL, 'not_logged_in', '2019-01-05 00:00:00', 0, 0, 'Aula 2.1'),
('', 11, NULL, 'not_logged_in', '2019-01-06 00:00:00', 0, 0, 'Aula 2.8');

-- --------------------------------------------------------

--
-- Struttura della tabella `ristorante`
--

CREATE TABLE `ristorante` (
  `id` int(11) NOT NULL,
  `email_proprietario` varchar(40) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `indirizzo` varchar(40) NOT NULL,
  `nome_categoria` varchar(20) DEFAULT NULL,
  `info` varchar(100) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `approvato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ristorante`
--

INSERT INTO `ristorante` (`id`, `email_proprietario`, `nome`, `indirizzo`, `nome_categoria`, `info`, `rating`, `approvato`) VALUES
(5, 'fornitore@fornitore.it', 'villamarina', 'via mare 12', NULL, '', 0, 1),
(32, 'fornitore3@fornitore.it', 'fadsadsa', 'dasdsa', NULL, '', 0, 1),
(34, 'fornitore6@fornitore.it', 'Elizabeta Budini', 'via A. Severini nÂ°11', NULL, '', 0, 1),
(42, 'orazifilippo@gmail.com', 'Lo Sfizio Cesena', 'Via san fortunato 13', 'gelateria', 'pizzeria di cesena\r\n', 0, 1),
(43, 'orazifilipppo@gmail.com', 'la peppa', 'Via san fortunato 13', 'indiano', 'la lu e scema', 0, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alimento`
--
ALTER TABLE `alimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKpartecipa` (`id_ristorante`,`nome_menu`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`id_prenotazione`,`nome`,`id_ristorante`,`nome_menu`),
  ADD KEY `FKcomprende` (`nome`,`id_ristorante`,`nome_menu`);

--
-- Indici per le tabelle `categoria_ristoranti`
--
ALTER TABLE `categoria_ristoranti`
  ADD PRIMARY KEY (`nome_categoria`);

--
-- Indici per le tabelle `luogo`
--
ALTER TABLE `luogo`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_ristorante`,`nome`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinatario` (`email`);

--
-- Indici per le tabelle `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`email`),
  ADD KEY `FKappartiene` (`id_ristorante`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKeffettua` (`email_cliente`),
  ADD KEY `FKconsegna` (`luogo_consegna`),
  ADD KEY `FKriferisce` (`id_ristorante`);

--
-- Indici per le tabelle `ristorante`
--
ALTER TABLE `ristorante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FKappartiene_ID` (`email_proprietario`),
  ADD UNIQUE KEY `FKinclude_ID` (`nome_categoria`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alimento`
--
ALTER TABLE `alimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `ristorante`
--
ALTER TABLE `ristorante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `alimento`
--
ALTER TABLE `alimento`
  ADD CONSTRAINT `FKpartecipa` FOREIGN KEY (`id_ristorante`,`nome_menu`) REFERENCES `menu` (`id_ristorante`, `nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FKlistapre` FOREIGN KEY (`id_prenotazione`) REFERENCES `prenotazione` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FKoffre` FOREIGN KEY (`id_ristorante`) REFERENCES `ristorante` (`id`);

--
-- Limiti per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `destinatario` FOREIGN KEY (`email`) REFERENCES `persona` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FKappartiene` FOREIGN KEY (`id_ristorante`) REFERENCES `ristorante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `FKconsegna` FOREIGN KEY (`luogo_consegna`) REFERENCES `luogo` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKeffettua` FOREIGN KEY (`email_cliente`) REFERENCES `persona` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKriferisce` FOREIGN KEY (`id_ristorante`) REFERENCES `ristorante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ristorante`
--
ALTER TABLE `ristorante`
  ADD CONSTRAINT `FKappartiene_FK` FOREIGN KEY (`email_proprietario`) REFERENCES `persona` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKinclude_FK` FOREIGN KEY (`nome_categoria`) REFERENCES `categoria_ristoranti` (`nome_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
