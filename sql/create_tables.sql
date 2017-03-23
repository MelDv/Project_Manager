-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TYPE rights AS ENUM ('admin', 'worker', 'intern', 'visitor');
CREATE TYPE status AS ENUM('pending', 'underway', 'finished');

CREATE TABLE person(
    id SERIAL PRIMARY KEY,
    name varchar(40) NOT NULL,
    password varchar(40) NOT NULL,
    sotu character(11),
    address varchar(120),
    email varchar(40) NOT NULL UNIQUE,
    phone INTEGER NOT NULL,
    workphone INTEGER,
    office varchar(10),
    title varchar(40),
    description varchar(2000),
    active BOOLEAN DEFAULT TRUE,
    current_rights rights DEFAULT 'visitor'
);

CREATE TABLE job(
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL UNIQUE,
    current_status status DEFAULT 'pending',
    late BOOLEAN DEFAULT FALSE,
    short_description varchar(400) NOT NULL,
    description varchar(5000),
    start_date DATE,
    deadline DATE,
    creator INTEGER REFERENCES person(id),
    approved BOOLEAN DEFAULT FALSE
);

CREATE TABLE project (
    job INTEGER REFERENCES job PRIMARY KEY,
    manager INTEGER REFERENCES person(id)
);

CREATE TABLE task (
    job INTEGER REFERENCES job PRIMARY KEY,
    owner_project varchar(50) NOT NULL
);

-- liitostaulu tehtävän ja tekijöiden väliin; workforcella voi olla yksi tehtävä, monta tekijää
CREATE TABLE workforce (
    id SERIAL PRIMARY KEY,
    owner_task INTEGER REFERENCES task(job),
    worker INTEGER REFERENCES person(id)
);