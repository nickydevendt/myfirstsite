CREATE SEQUENCE users_id_seq;

CREATE TABLE users (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('users_id_seq'::regclass),
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    currentemployer VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BIGINT NOT NULL DEFAULT 1
);

CREATE UNIQUE INDEX ON users(username);
CREATE UNIQUE INDEX ON users(email);

CREATE SEQUENCE visitors_id_seq;

CREATE TABLE visitors (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('visitors_id_seq'::regclass),
    randomid UUID DEFAULT gen_random_uuid(),
    firstname VARCHAR(255) DEFAULT NULL,
    lastname VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    datecreated TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),
    expiredate TIMESTAMP WITH TIME ZONE DEFAULT NOW() + interval '7 days'
);

CREATE UNIQUE INDEX ON visitors(email);

CREATE SEQUENCE employers_id_seq;

CREATE TABLE employers (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('employers_id_seq'::regclass),
    userid BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    workyears BIGINT NOT NULL DEFAULT 0
);

ALTER TABLE employers ADD FOREIGN KEY(userid) REFERENCES users(id) ON DELETE CASCADE;

CREATE SEQUENCE affiliatedcompanys_id_seq;

CREATE TABLE affiliatedcompanys (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('affiliatedcompanys_id_seq'::regclass),
    name VARCHAR(255) NOT NULL,
    website VARCHAR(255) NOT NULL,
    datecreated TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),
    datemodified TIMESTAMP WITH TIME ZONE
);

CREATE SEQUENCE projects_id_seq;

CREATE TABLE projects (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('projects_id_seq'::regclass),
    developer BIGINT,
    name VARCHAR(255) NOT NULL,
    companyname VARCHAR(255) NOT NULL,
    companyid BIGINT NOT NULL
);

ALTER TABLE projects ADD FOREIGN key(companyid) REFERENCES affiliatedcompanys(id) ON DELETE CASCADE;

