-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 17, 2023 alle 09:37
-- Versione del server: 10.4.6-MariaDB
-- Versione PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bandogite`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `agenzia`
--

CREATE TABLE `agenzia` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Indirizzo` varchar(100) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Organizzatore` varchar(50) NOT NULL,
  `TelefonoOrganizzatore` varchar(20) NOT NULL,
  `CertificazioneISO` tinyint(1) NOT NULL,
  `Assicurazione` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `agenzia`
--

INSERT INTO `agenzia` (`ID`, `Nome`, `Indirizzo`, `Telefono`, `Organizzatore`, `TelefonoOrganizzatore`, `CertificazioneISO`, `Assicurazione`) VALUES
(1, 'Viaggi e Vacanze', 'Via Roma 10', '02-12345678', 'Mario Rossi', '338-1234567', 1, 1),
(2, 'EasyTravel', 'Via Milano 20', '02-87654321', 'Paolo Verdi', '335-9876543', 0, 1),
(3, 'Avventure nel Mondo', 'Via Torino 30', '02-23456789', 'Giuseppe Bianchi', '339-4567890', 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `offerta`
--

CREATE TABLE `offerta` (
  `ID` int(11) NOT NULL,
  `IDLotto` int(11) NOT NULL,
  `IDAgenzia` int(11) NOT NULL,
  `IDUtente` int(11) NOT NULL,
  `Prezzo` float NOT NULL,
  `Stelle` varchar(50) DEFAULT NULL,
  `Alunni` int(11) NOT NULL,
  `Zona` varchar(50) DEFAULT NULL,
  `Mezzi` tinyint(1) NOT NULL,
  `Ristorazione` varchar(50) DEFAULT NULL,
  `Servizio` varchar(50) DEFAULT NULL,
  `Treno` varchar(50) DEFAULT NULL,
  `Bus` varchar(50) DEFAULT NULL,
  `Esperienza` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `offerta`
--

INSERT INTO `offerta` (`ID`, `IDLotto`, `IDAgenzia`, `IDUtente`, `Prezzo`, `Stelle`, `Alunni`, `Zona`, `Mezzi`, `Ristorazione`, `Servizio`, `Treno`, `Bus`, `Esperienza`) VALUES
(1, 1, 1, 1, 500, '4', 5, 'Centrale', 1, 'Hotel', 'Buffet', 'Alta velocità', 'No', '> 5 anni'),
(2, 2, 2, 1, 300, '3', 6, 'Limitrofa', 0, 'Ristorante', 'Servito', 'Intercity', '1 Autista', '< 4 anni'),
(3, 5, 1, 1, 700, '5', 10, 'Periferica', 1, 'Ristorante', 'Buffet', 'Cuccette 4', '2 Autisti', '> 5 anni'),
(4, 1, 2, 1, 400, '2', 4, 'Centrale', 0, 'Hotel', 'Servito', 'Alta velocità', 'No', 'tra 4 e 5 anni'),
(5, 5, 3, 1, 600, '5', 20, 'Limitrofa', 1, 'Ristorante', 'Buffet', 'No', 'Viaggio A/R', '> 5 anni'),
(6, 6, 3, 1, 800, '4', 15, 'Semicentrale', 0, 'Hotel', 'Servito', 'Cuccette 6', '2 Autisti', '> 5 anni'),
(7, 6, 4, 1, 250, '2', 8, 'Centrale', 1, 'Hotel', 'Servito', 'Cuccette 4', 'No', '< 3 anni'),
(8, 8, 5, 1, 400, '5', 30, 'Centrale', 1, 'Ristorante', 'Buffet', 'Intercity', '1 Autista', '> 5 anni');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Amministratore` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `Username`, `Password`, `Amministratore`) VALUES
(1, 'admin', 'admin', 1),
(8, 'MarioRossi', 'Password123', 0),
(9, 'LuigiVerdi', 'SecretPassword', 1),
(10, 'GiovanniBianchi', 'Password123', 0),
(11, 'PaoloNeri', 'Paolo123', 0),
(12, 'AlessandroVerdi', 'Alessandro123', 1),
(13, 'ChiaraBianchi', 'Chiara123', 0),
(14, 'RobertoRossi', 'Roberto123', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
  `ID` int(11) NOT NULL,
  `Meta` varchar(20) NOT NULL,
  `Partenza` varchar(20) NOT NULL,
  `Giorni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `viaggio`
--

INSERT INTO `viaggio` (`ID`, `Meta`, `Partenza`, `Giorni`) VALUES
(1, 'Londra', '25/05/2023', 4),
(2, 'Amsterdam', '12/07/2023', 3),
(3, 'Berlino', '08/09/2023', 6),
(4, 'Tokyo', '17/11/2023', 12),
(5, 'Madrid', '21/02/2024', 5),
(6, 'Atene', '09/04/2024', 7),
(7, 'San Francisco', '12/06/2024', 10),
(8, 'Sidney', '03/09/2024', 14);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agenzia`
--
ALTER TABLE `agenzia`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `offerta`
--
ALTER TABLE `offerta`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `viaggio`
--
ALTER TABLE `viaggio`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `agenzia`
--
ALTER TABLE `agenzia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `offerta`
--
ALTER TABLE `offerta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
