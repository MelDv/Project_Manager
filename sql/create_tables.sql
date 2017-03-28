-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TYPE rights AS ENUM ('Admin', 'Worker', 'Intern', 'Visitor');
CREATE TYPE status AS ENUM('Pending', 'Underway', 'Finished');

CREATE TABLE work_group(
    id SERIAL PRIMARY KEY,
    name varchar(40) NOT NULL UNIQUE,
    description varchar(2000)
);

CREATE TABLE person(
    id SERIAL PRIMARY KEY,
    name varchar(40) NOT NULL,
    password varchar(40) NOT NULL,
    email varchar(40) NOT NULL UNIQUE,
    description varchar(2000),
    active BOOLEAN DEFAULT TRUE,
    current_rights rights DEFAULT 'visitor'
);

CREATE TABLE project(
    id SERIAL PRIMARY KEY,
    manager INTEGER REFERENCES person(id) NOT NULL,
    name varchar(50) NOT NULL UNIQUE,
    current_status status DEFAULT 'pending',
    late BOOLEAN DEFAULT FALSE,
    description varchar(400),
    start_date DATE,
    deadline DATE,
    approved BOOLEAN DEFAULT FALSE
);

CREATE TABLE task(
    id SERIAL PRIMARY KEY,
    project INTEGER REFERENCES project(id),
    name varchar(50) NOT NULL UNIQUE,
    current_status status DEFAULT 'pending',
    late BOOLEAN DEFAULT FALSE,
    description varchar(400),
    start_date DATE,
    deadline DATE,
    approved BOOLEAN DEFAULT FALSE
);

-- liitostaulu tehtävän ja tekijöiden väliin
CREATE TABLE workers_tasks (
    id SERIAL PRIMARY KEY,
    owner_task INTEGER REFERENCES task,
    worker INTEGER REFERENCES person
);

--liitostaulu tekijöiden ja ryhmien väliin

CREATE TABLE workers_groups (
    id SERIAL PRIMARY KEY,
    owner_person INTEGER REFERENCES person,
    owner_group INTEGER REFERENCES work_group
);