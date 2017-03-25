-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO work_group (name, description) VALUES ('Ohjelmoijat', 'Käytettävissä olevat koodaajat. PHP, JavaScript, HTML5, Java, PostgreSQL');
INSERT INTO person (name, password, email, current_rights) VALUES ('Kalle', 'Kalle123', 'kalle@koti.home', 'admin');
INSERT INTO project (manager, name, current_status, description) VALUES (1, 'Web-sovellus', 'underway', 'Tehdään Bootstrap-projektinhallintasovellus');
INSERT INTO task (name, current_status) VALUES ('CSS', 'underway');
INSERT INTO workers_tasks (owner_task, worker) VALUES (1, 1);
INSERT INTO workers_groups (owner_person, owner_group) VALUES (1, 1);

