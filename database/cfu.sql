-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 07, 2019 alle 14:45
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
  `disponibilita` char(1) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `prezzo` decimal(5,2) NOT NULL,
  `id_ristorante` int(11) NOT NULL,
  `nome_menu` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `alimento`
--

INSERT INTO `alimento` (`disponibilita`, `nome`, `info`, `prezzo`, `id_ristorante`, `nome_menu`, `id`) VALUES
('', 'Gnocchi al Sugo di Pesce e Vongole', '', '10.00', 44, 'primi piatti', 36),
('', 'Gnocchi alle Manzancolle e Pomodoro', '', '10.50', 44, 'primi piatti', 37),
(NULL, 'Tagliolini Gamberoni, Porcini e Rosso Pachino', '', '9.50', 44, 'primi piatti', 38),
(NULL, 'Fritto Misto di Pesce', '', '8.00', 44, 'secondi piatti', 39),
(NULL, 'Seppie Gratinate', '', '9.00', 44, 'secondi piatti', 40),
(NULL, 'Grigliata Mista di Pesce', '', '10.00', 44, 'secondi piatti', 41),
(NULL, 'Tagliolini Spada, Melanzane e Mentuccia', '', '11.00', 44, 'pasta', 42),
(NULL, 'Bruschetta \'La Boscaiola\'', 'Funghi di stagione, rucola, grana', '4.00', 45, 'Antipasti', 43),
(NULL, 'Frisella La Sfiziosa', 'burrata, pomodorini gialli, acciughe, rucola', '4.00', 45, 'Antipasti', 44),
(NULL, 'Toscano', 'Chianina 200gr, pomodoro, caciotta, lattuga, salsa burger', '9.00', 45, 'Hamburger', 45),
(NULL, 'Fassona', 'Fassona piemontese 200gr, speck, cheddar, funghi, salsa BBQ', '10.00', 45, 'Hamburger', 46),
(NULL, 'Tonnarelli', 'cacio e pepe', '10.00', 45, 'Primi piatti', 47);

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
('Cinese'),
('Fast-food'),
('Gelateria'),
('Giapponese'),
('Indiano'),
('Osteria'),
('Paninoteca'),
('Piadineria'),
('Pizzeria'),
('Ristorante');

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
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `menu`
--

INSERT INTO `menu` (`id_ristorante`, `nome`) VALUES
(44, 'Pasta'),
(44, 'Primi piatti'),
(44, 'Secondi piatti'),
(45, 'Antipasti e bruschette'),
(45, 'Carni alla griglia'),
(45, 'Hamburger'),
(45, 'Primi piatti');

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
(10, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:10:45', '0'),
(11, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:11:31', '0'),
(12, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:13:52', '0'),
(13, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:15:35', '0'),
(14, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:16:39', '0'),
(15, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:17:15', '0'),
(16, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:18:06', '0'),
(17, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:19:25', '0'),
(18, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:19:46', '0'),
(19, 'admin@admin.it', 'Il ristorante fasdf attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:22:33', '0'),
(20, 'admin@admin.it', 'Il ristorante locanda3 attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-06 23:22:59', '0'),
(41, 'utente@utente.it', 'L\'ordine id=29 verrÃ  spedito presso Aula 2.1 alle 2019-01-07 11:59:00', '2019-01-07 12:00:21', '1'),
(43, 'utente@utente.it', 'L\'ordine id=29 verrÃ  spedito presso Aula 2.1 alle 2019-01-07 11:59:00', '2019-01-07 12:03:56', '1'),
(46, 'admin@admin.it', 'Il ristorante Il cucinaro Osteria attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-07 12:09:33', '0'),
(47, 'scottadito@fornitore.it', 'Iscrizione avvenuta correttamente! Riceverai una notifica quando l\'iscrizione sarÃ  approvata dal nostro Team', '2019-01-07 12:16:05', '0'),
(48, 'admin@admin.it', 'Il ristorante Scottadito attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-07 12:16:05', '0'),
(49, 'daneopizzeria@fornitore.it', 'Iscrizione avvenuta correttamente! Riceverai una notifica quando l\'iscrizione sarÃ  approvata dal nostro Team', '2019-01-07 12:23:44', '0'),
(50, 'admin@admin.it', 'Il ristorante Da Neo Pizzeria attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-07 12:23:44', '0'),
(52, 'utente@utente.it', 'L\'ordine id=31 verrÃ  spedito presso Aula Magna 3.4 alle 0000-00-00 00:00:00', '2019-01-07 12:28:31', '0'),
(54, 'utente@utente.it', 'L\'ordine id=32 verrÃ  spedito presso Aula 2.1 alle ', '2019-01-07 13:25:51', '0'),
(57, 'utente@utente.it', 'L\'ordine id=35 verrÃ  spedito presso Aula 2.1 alle 0000-00-00 00:00:00', '2019-01-07 13:30:40', '0'),
(59, 'utente@utente.it', 'L\'ordine id=36 verrÃ  spedito presso Aula 2.1 alle 2019-01-07 13:51:00', '2019-01-07 13:31:32', '0'),
(61, 'admin@admin.it', 'Il ristorante Ristorante La Muccigna attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-07 13:42:20', '0'),
(62, 'chioscodelsavio@fornitore.it', 'Iscrizione avvenuta correttamente! Riceverai una notifica quando l\'iscrizione sarÃ  approvata dal nostro Team', '2019-01-07 13:50:29', '0'),
(63, 'admin@admin.it', 'Il ristorante Chiosco del Savio attende la tua approvazione, controlla i tuoi Strumenti', '2019-01-07 13:50:29', '0'),
(64, 'ilcucinaroosteria@fornitore.it', 'L\'ordine 38 attende di essere evaso. Vai nei tuoi Strumenti', '2019-01-07 14:05:00', '0'),
(65, 'utente@utente.it', 'L\'ordine id=38 verrÃ  spedito presso Aula 2.1 alle 2019-01-07 14:05:00', '2019-01-07 14:05:32', '0'),
(66, 'scottadito@fornitore.it', 'L\'ordine 39 attende di essere evaso. Vai nei tuoi Strumenti', '2019-01-07 14:29:00', '0'),
(67, 'utente@utente.it', 'L\'ordine id=39 verrÃ  spedito presso Aula 2.6 alle 2019-01-07 15:24:00', '2019-01-07 14:29:08', '0');

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
('Sara', 'Lombardi', 'chioscodelsavio@fornitore.it', 49, '$2y$10$m8zLP67ycymPXVLGXddqb.Hdzv5XtJEeKZVQ1zk7UlxfK.mviH9.u', 1, ''),
('Kristian', 'Budini', 'daneopizzeria@fornitore.it', 46, '$2y$10$.khuxdqP42WuB7WisPulSOsQoHQA8Zrp2GSY6Fk9DHBDG6eSLRDHq', 1, ''),
('Armando', 'Piccolillo', 'ilcucinaroosteria@fornitore.it', 44, '$2y$10$/Lohh6/7R3/HL/VrL1rEcOuf.lzDDfeZFlD/ZemCFGU3qsgj6Jy5K', 1, ''),
('prova', 'prova', 'not_logged_in', NULL, 'ciao', 0, ''),
('Alessandro', 'Marcantognini', 'ristorantelamuccigna@fornitore.it', 48, '$2y$10$j8gfly8pDx3KFkymXIwMfe./Slhw/ZG2oRDw3smQEX6ypravB1jfa', 1, ''),
('Giulia', 'Vozzi', 'scottadito@fornitore.it', 45, '$2y$10$UsMqcvUvIOnIPxe53dT6DOsLocGp0yIQTmt5vgGPbEGdVyyrg93gG', 1, ''),
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
  `data_consegna` datetime DEFAULT NULL,
  `stato` int(11) NOT NULL,
  `totale` int(11) NOT NULL,
  `luogo_consegna` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`info_prenotazione`, `id`, `id_ristorante`, `email_cliente`, `data_consegna`, `stato`, `totale`, `luogo_consegna`) VALUES
('', 24, NULL, 'not_logged_in', '0000-00-00 00:00:00', 0, 0, 'aula 2.1'),
('', 33, NULL, 'utente@utente.it', NULL, 0, 0, 'Aula 2.1'),
('', 34, NULL, 'utente@utente.it', NULL, 0, 0, 'Aula 2.1'),
('', 37, NULL, 'utente@utente.it', '2019-01-07 13:56:00', 0, 0, 'Aula 2.1'),
('', 38, 44, 'utente@utente.it', '2019-01-07 14:05:00', 0, 11, 'Aula 2.1'),
('', 39, 45, 'utente@utente.it', '2019-01-07 15:24:00', 0, 70, 'Aula 2.6');

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
(44, 'ilcucinaroosteria@fornitore.it', 'Il cucinaro Osteria', 'Via Boccaquattro, 4, 47521 Cesena FC', NULL, '', 0, 0),
(45, 'scottadito@fornitore.it', 'Scottadito', 'Via Mario Angeloni, 335, 47521 Cesena FC', NULL, '', 0, 0),
(46, 'daneopizzeria@fornitore.it', 'Da Neo Pizzeria', 'Via Fratelli Spazzoli, 225, 47521 Cesena', NULL, '', 0, 0),
(48, 'ristorantelamuccigna@fornitore.it', 'Ristorante La Muccig', 'Piazza del Popolo, 39, 47521 Cesena FC', NULL, '', 0, 0),
(49, 'chioscodelsavio@fornitore.it', 'Chiosco del Savio', 'Via IX Febbraio, 41, 47521 Cesena FC', NULL, '', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT per la tabella `ristorante`
--
ALTER TABLE `ristorante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `alimento`
--
ALTER TABLE `alimento`
  ADD CONSTRAINT `FKdel` FOREIGN KEY (`id_ristorante`) REFERENCES `ristorante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `FKlistapre` FOREIGN KEY (`id_prenotazione`) REFERENCES `prenotazione` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FKoffre` FOREIGN KEY (`id_ristorante`) REFERENCES `ristorante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
