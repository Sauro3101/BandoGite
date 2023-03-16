Utente{
    ID
    Username
    Passowrd
    Amministratore
}

INSERT INTO Utente (Username, Password, Amministrazione)
VALUES
    ('MarioRossi', 'Password123', 0),
    ('LuigiVerdi', 'SecretPassword', 1),
    ('GiovanniBianchi', 'Password123', 0),
    ('PaoloNeri', 'Paolo123', 0),
    ('AlessandroVerdi', 'Alessandro123', 1),
    ('ChiaraBianchi', 'Chiara123', 0),
    ('RobertoRossi', 'Roberto123', 0);

Viaggio{
    ID
    Meta
    Partenza
    Giorni
}

INSERT INTO Viaggio (Meta, Partenza, Giorni)
VALUES
    ('Londra', '25/05/2023', 4),
    ('Amsterdam', '12/07/2023', 3),
    ('Berlino', '08/09/2023', 6),
    ('Tokyo', '17/11/2023', 12),
    ('Madrid', '21/02/2024', 5),
    ('Atene', '09/04/2024', 7),
    ('San Francisco', '12/06/2024', 10),
    ('Sidney', '03/09/2024', 14);

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

CREATE TABLE Agenzia (
    ID INT PRIMARY KEY,
    Nome VARCHAR(50) NOT NULL,
    Indirizzo VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20) NOT NULL,
    Organizzatore VARCHAR(50) NOT NULL,
    TelefonoOrganizzatore VARCHAR(20) NOT NULL,
    CertificazioneISO BOOLEAN NOT NULL,
    Assicurazione BOOLEAN NOT NULL
);

INSERT INTO Agenzia (ID, Nome, Indirizzo, Telefono, Organizzatore, TelefonoOrganizzatore, CertificazioneISO, Assicurazione)
VALUES
    (1, 'Viaggi e Vacanze', 'Via Roma 10', '02-12345678', 'Mario Rossi', '338-1234567', TRUE, TRUE),
    (2, 'EasyTravel', 'Via Milano 20', '02-87654321', 'Paolo Verdi', '335-9876543', FALSE, TRUE),
    (3, 'Avventure nel Mondo', 'Via Torino 30', '02-23456789', 'Giuseppe Bianchi', '339-4567890', TRUE, FALSE);

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
}

CREATE TABLE Offerta (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    IDLotto INT NOT NULL,
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

INSERT INTO Offerta (IDLotto, IDAgenzia, IDUtente, Prezzo, Stelle, Alunni, Zona, Mezzi, Ristorazione, Servizio, Treno, Bus, Esperienza)
VALUES
    (1, 1, 1, 500.00, 4, 5, 'Centrale', TRUE, 'Hotel', 'Buffet', 'Alta velocità', 'No', '> 5 anni'),
    (2, 2, 2, 300.00, 3, 6, 'Limitrofa', FALSE, 'Ristorante', 'Servito', 'Intercity', '1 Autista', '< 4 anni');

INSERT INTO Offerta (IDLotto, IDAgenzia, IDUtente, Prezzo, Stelle, Alunni, Zona, Mezzi, Ristorazione, Servizio, Treno, Bus, Esperienza)
VALUES
    (3, 1, 3, 700.00, 5, 10, 'Periferica', TRUE, 'Ristorante', 'Buffet', 'Cuccette 4', '2 Autisti', '> 5 anni'),
    (4, 2, 4, 400.00, 2, 4, 'Centrale', FALSE, 'Hotel', 'Servito', 'Alta velocità', 'No', 'tra 4 e 5 anni'),
    (5, 3, 5, 600.00, 5, 20, 'Limitrofa', TRUE, 'Ristorante', 'Buffet', 'No', 'Viaggio A/R', '> 5 anni'),
    (6, 3, 6, 800.00, 4, 15, 'Semicentrale', FALSE, 'Hotel', 'Servito', 'Cuccette 6', '2 Autisti', '> 5 anni'),
    (7, 4, 7, 250.00, 2, 8, 'Centrale', TRUE, 'Hotel', 'Servito', 'Cuccette 4', 'No', '< 3 anni'),
    (8, 5, 8, 400.00, 5, 30, 'Centrale', TRUE, 'Ristorante', 'Buffet', 'Intercity', '1 Autista', '> 5 anni');