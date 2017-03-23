-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO job (name, current_status, short_description) VALUES ('Web-sovellus', 'underway', 'Tehdään Bootstrap-projektinhallintasovellus');
INSERT INTO person (name, password, sotu, email, phone, current_rights) VALUES ('Kalle', 'Kalle123', '11111111111', 'kalle@koti.home', 0988833322, 'admin');
INSERT INTO project (job, manager) VALUES (1, 1);
INSERT INTO task (job, owner_project) VALUES (1, 1);

