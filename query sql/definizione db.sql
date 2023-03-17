/*Utente{
    ID
    Username
    Passowrd
    Amministratore
}

Viaggio{
    ID
    Meta
    Partenza
    Giorni
}

Agenzia{
    ID
    Nome
    Indirizzo
    Telefono
    Organizzatore
    TelefonoOrganizzatore
    CertificazioneISO
    Assicurazione
}

Offerta{
    ID
    IDLotto
    IDAgenzia
    IDUtente
    Prezzo
    Stelle
    Alunni
    Zona
    Mezzi
    Ristorazione
    Servizio
    Treno
    Bus
    Esperienza
}*/


DROP TABLE Utente, Viaggio, Agenzia, Offerta;

CREATE TABLE Utente (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Amministrazione BOOLEAN NOT NULL
);

INSERT INTO Utente (Username, Password, Amministrazione)
VALUES
    ('admin', 'admin', 1),
    ('MarioRossi', 'Password123', 0),
    ('LuigiVerdi', 'SecretPassword', 1),
    ('GiovanniBianchi', 'Password123', 0),
    ('PaoloNeri', 'Paolo123', 0),
    ('AlessandroVerdi', 'Alessandro123', 1),
    ('ChiaraBianchi', 'Chiara123', 0),
    ('RobertoRossi', 'Roberto123', 0);

CREATE TABLE Viaggio (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Meta VARCHAR(50) NOT NULL,
    Partenza DATE NOT NULL,
    Giorni INT NOT NULL
);

INSERT INTO Viaggio (Meta, Partenza, Giorni)
VALUES
    ('Londra', '2023-05-25', 4),
    ('Amsterdam', '2023-09-18', 3),
    ('Berlino', '2024-05-07', 6),
    ('Tokyo', '2023-03-25', 12),
    ('Madrid', '2024-06-17', 5),
    ('Atene', '2023-05-22', 7);

CREATE TABLE Agenzia (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(50) NOT NULL,
    Indirizzo VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20) NOT NULL,
    Organizzatore VARCHAR(50) NOT NULL,
    TelefonoOrganizzatore VARCHAR(20) NOT NULL,
    CertificazioneISO BOOLEAN NOT NULL,
    Assicurazione BOOLEAN NOT NULL
);

INSERT INTO Agenzia (Nome, Indirizzo, Telefono, Organizzatore, TelefonoOrganizzatore, CertificazioneISO, Assicurazione)
VALUES
    ('Viaggi e Vacanze', 'Via Roma 10', '02-12345678', 'Mario Rossi', '338-1234567', TRUE, TRUE),
    ('EasyTravel', 'Via Milano 20', '02-87654321', 'Paolo Verdi', '335-9876543', FALSE, TRUE),
    ('Avventure nel Mondo', 'Via Torino 30', '02-23456789', 'Giuseppe Bianchi', '339-4567890', TRUE, FALSE);

CREATE TABLE Offerta (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    IDViaggio INT NOT NULL,
    IDAgenzia INT NOT NULL,
    IDUtente INT NOT NULL,
    Prezzo FLOAT NOT NULL,
    Stelle VARCHAR(50),
    Alunni INT NOT NULL,
    Zona VARCHAR(50),
    Mezzi BOOLEAN NOT NULL,
    Ristorazione VARCHAR(50),
    Servizio VARCHAR(50),
    Treno VARCHAR(50),
    Bus VARCHAR(50),
    Esperienza VARCHAR(50)
);

INSERT INTO Offerta (IDViaggio, IDAgenzia, IDUtente, Prezzo, Stelle, Alunni, Zona, Mezzi, Ristorazione, Servizio, Treno, Bus, Esperienza)
VALUES
    (1, 1, 1, 500.00, 4, 5, 'Centrale', TRUE, 'Hotel', 'Buffet', 'Alta velocità', 'No', '> 5 anni'),
    (2, 2, 2, 300.00, 3, 6, 'Limitrofa', FALSE, 'Ristorante', 'Servito', 'Intercity', '1 Autista', '< 4 anni'),
    (4, 1, 3, 700.00, 5, 10, 'Periferica', TRUE, 'Ristorante', 'Buffet', 'Cuccette 4', '2 Autisti', '> 5 anni'),
    (3, 2, 4, 400.00, 2, 4, 'Centrale', FALSE, 'Hotel', 'Servito', 'Alta velocità', 'No', 'tra 4 e 5 anni'),
    (5, 3, 5, 600.00, 5, 20, 'Limitrofa', TRUE, 'Ristorante', 'Buffet', 'No', 'Viaggio A/R', '> 5 anni'),
    (3, 3, 6, 800.00, 4, 15, 'Semicentrale', FALSE, 'Hotel', 'Servito', 'Cuccette 6', '2 Autisti', '> 5 anni'),
    (5, 1, 7, 250.00, 2, 8, 'Centrale', TRUE, 'Hotel', 'Servito', 'Cuccette 4', 'No', '< 3 anni'),
    (4, 2, 4, 400.00, 5, 30, 'Centrale', TRUE, 'Ristorante', 'Buffet', 'Intercity', '1 Autista', '> 5 anni');