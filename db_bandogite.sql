-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 18, 2023 alle 00:51
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `agenzia`
--

INSERT INTO `agenzia` (`ID`, `Nome`, `Indirizzo`, `Telefono`, `Organizzatore`, `TelefonoOrganizzatore`, `CertificazioneISO`, `Assicurazione`) VALUES
(1, 'Viaggi e Vacanze', 'Via Roma 10', '02-12345678', 'Mario Rossi', '338-1234567', 1, 1),
(2, 'EasyTravel', 'Via Milano 20', '02-87654321', 'Paolo Verdi', '335-9876543', 0, 1),
(3, 'Avventure nel Mondo', 'Via Torino 30', '02-23456789', 'Giuseppe Bianchi', '339-4567890', 1, 0),
(4, 'Topolino', 'via G. da Procida', '02-563436', 'Pippo Pluto', '45-541354', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `offerta`
--

CREATE TABLE `offerta` (
  `ID` int(11) NOT NULL,
  `IDViaggio` int(11) NOT NULL,
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
  `Esperienza` varchar(50) DEFAULT NULL,
  `Punti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `offerta`
--

INSERT INTO `offerta` (`ID`, `IDViaggio`, `IDAgenzia`, `IDUtente`, `Prezzo`, `Stelle`, `Alunni`, `Zona`, `Mezzi`, `Ristorazione`, `Servizio`, `Treno`, `Bus`, `Esperienza`, `Punti`) VALUES
(1, 1, 1, 1, 500, '4', 5, 'Centrale', 1, 'Hotel', 'Buffet', 'Alta velocità', 'No', '> 5 anni', 58),
(2, 2, 2, 2, 300, '3', 6, 'Limitrofa', 0, 'Ristorante', 'Servito', 'Intercity', '1 Autista', '< 4 anni', 75),
(3, 4, 1, 3, 700, '5', 10, 'Periferica', 1, 'Ristorante', 'Buffet', 'Cuccette 4', '2 Autisti', '> 5 anni', 43),
(4, 3, 2, 4, 400, '2', 4, 'Centrale', 0, 'Hotel', 'Servito', 'Alta velocità', 'No', 'tra 4 e 5 anni', 85),
(5, 5, 3, 5, 600, '5', 20, 'Limitrofa', 1, 'Ristorante', 'Buffet', 'No', 'Viaggio A/R', '> 5 anni', 52),
(7, 5, 1, 7, 250, '2', 8, 'Centrale', 1, 'Hotel', 'Servito', 'Cuccette 4', 'No', '< 3 anni', 23),
(8, 4, 2, 4, 400, '5', 30, 'Centrale', 1, 'Ristorante', 'Buffet', 'Intercity', '1 Autista', '> 5 anni', 24),
(15, 3, 2, 1, 156, '4', 2, 'Centrale', 0, 'Hotel', 'Servito', 'No', '1', '1', 45),
(16, 3, 2, 1, 156, '4', 2, 'Centrale', 0, 'Hotel', 'Servito', 'No', '1', '1', 65),
(17, 3, 2, 1, 156, '4', 2, 'Centrale', 0, 'Hotel', 'Servito', 'No', '1', '1', 20),
(18, 3, 2, 1, 156, '4', 2, 'Centrale', 0, 'Hotel', 'Servito', 'No', '1', '1', 75),
(19, 7, 1, 1, 522, '3 sup.', 5, 'Semicentrale', 0, 'Ristorante', 'Buffet', 'Alta velocità', '3', '1', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `punti`
--

CREATE TABLE `punti` (
  `id` int(6) UNSIGNED NOT NULL,
  `offerta_id` int(6) DEFAULT NULL,
  `prezzo_point` int(11) UNSIGNED DEFAULT 0,
  `stelle_point` int(11) UNSIGNED DEFAULT 0,
  `alunni_point` int(11) UNSIGNED DEFAULT 0,
  `zona_point` int(11) UNSIGNED DEFAULT 0,
  `mezzi_point` int(11) UNSIGNED DEFAULT 0,
  `ristorazione_point` int(11) UNSIGNED DEFAULT 0,
  `servizio_point` int(11) UNSIGNED DEFAULT 0,
  `treno_point` int(11) UNSIGNED DEFAULT 0,
  `bus_point` int(11) UNSIGNED DEFAULT 0,
  `esperienza_point` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `punti`
--

INSERT INTO `punti` (`id`, `offerta_id`, `prezzo_point`, `stelle_point`, `alunni_point`, `zona_point`, `mezzi_point`, `ristorazione_point`, `servizio_point`, `treno_point`, `bus_point`, `esperienza_point`) VALUES
(1, 18, 58, 8, 5, 5, 8, 8, 6, 6, 4, 7),
(2, 19, 10, 4, 8, 11, 14, 11, 15, 10, 9, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Amministrazione` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `Username`, `Password`, `Amministrazione`) VALUES
(1, 'admin', 'admin', 1),
(2, 'MarioRossi', 'Password123', 0),
(3, 'LuigiVerdi', 'SecretPassword', 1),
(4, 'GiovanniBianchi', 'Password123', 0),
(5, 'PaoloNeri', 'Paolo123', 0),
(6, 'AlessandroVerdi', 'Alessandro123', 1),
(7, 'ChiaraBianchi', 'Chiara123', 0),
(8, 'RobertoRossi', 'Roberto123', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
  `ID` int(11) NOT NULL,
  `Meta` varchar(50) NOT NULL,
  `Partenza` date NOT NULL,
  `Giorni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `viaggio`
--

INSERT INTO `viaggio` (`ID`, `Meta`, `Partenza`, `Giorni`) VALUES
(1, 'Londra', '2023-05-25', 4),
(2, 'Amsterdam', '2023-09-18', 3),
(3, 'Berlino', '2024-05-07', 6),
(4, 'Tokyo', '2023-03-25', 12),
(5, 'Madrid', '2024-06-17', 5),
(6, 'Atene', '2023-05-22', 7),
(7, 'Dubai', '2025-03-04', 3),
(9, 'Dublino', '2022-02-09', 3);

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `offerta-agenzia` (`IDAgenzia`),
  ADD KEY `offerta-utente` (`IDUtente`),
  ADD KEY `offerta-viaggio` (`IDViaggio`);

--
-- Indici per le tabelle `punti`
--
ALTER TABLE `punti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offerta_id` (`offerta_id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `offerta`
--
ALTER TABLE `offerta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `punti`
--
ALTER TABLE `punti`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `viaggio`
--
ALTER TABLE `viaggio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `offerta`
--
ALTER TABLE `offerta`
  ADD CONSTRAINT `offerta-agenzia` FOREIGN KEY (`IDAgenzia`) REFERENCES `agenzia` (`ID`),
  ADD CONSTRAINT `offerta-utente` FOREIGN KEY (`IDUtente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `offerta-viaggio` FOREIGN KEY (`IDViaggio`) REFERENCES `viaggio` (`ID`);

--
-- Limiti per la tabella `punti`
--
ALTER TABLE `punti`
  ADD CONSTRAINT `punti_ibfk_1` FOREIGN KEY (`offerta_id`) REFERENCES `offerta` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
