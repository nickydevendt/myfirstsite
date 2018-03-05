CREATE SEQUENCE users_id_seq;

CREATE TABLE users (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('users_id_seq'::regclass),
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    currentemployer VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BIGINT NOT NULL DEFAULT 0
);

CREATE SEQUENCE visitor_id_seq;

CREATE TABLE visitors (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('visitor_id_seq'::regclass),
    randomid BIGINT,
    username VARCHAR(255) DEFAULT NULL,
    password VARCHAR(255) DEFAULT NULL,
    firstname VARCHAR(255) DEFAULT NULL,
    lastname VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    datecreated TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),
    expiredate TIMESTAMP WITH TIME ZONE DEFAULT NOW() + interval '7 days';
);

CREATE SEQUENCE oldemployer_id_seq;
CREATE TABLE oldemployers (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('oldemployer_id_seq'::regclass),
    name VARCHAR(255) NOT NULL,
    workyears BIGINT NOT NULL DEFAULT 0
);

CREATE SEQUENCE affiliatedcompanys_id_seq;

CREATE TABLE affiliatedcompanys (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('affiliatedcompanys_id_seq'::regclass),
    name VARCHAR(255) NOT NULL PRIMARY KEY,
    website VARCHAR(255) NOT NULL,
    datecreated TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT NOW(),
    datemodified TIMESTAMP WITH TIME ZONE
);

CREATE SEQUENCE project_id_seq;

CREATE TABLE projects (
    id BIGINT NOT NULL PRIMARY KEY DEFAULT NEXTVAL('project_id_seq'::regclass),
    developer BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    companyname VARCHAR(255) NOT NULL,
    companyid BIGINT NOT NULL
);

ALTER TABLE projects ADD FOREIGN key(developer) REFERENCES users(id) ON DELETE RESTRICT;
ALTER TABLE projects ADD FOREIGN KEY(companyname) REFERENCES affiliatedcompanys(name) ON DELETE RESTRICT;
ALTER TABLE projects ADD FOREIGN key(companyid) REFERENCES affiliatedcompanys(id) ON DELETE RESTRICT;

