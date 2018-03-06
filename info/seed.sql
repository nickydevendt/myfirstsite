DELETE FROM users;
DELETE FROM visitors;
DELETE FROM employers;
DELETE FROM affiliatedcompanys;
DELETE FROM projects;

ALTER SEQUENCE users_id_seq RESTART WITH 1;
ALTER SEQUENCE visitors_id_seq RESTART WITH 1;
ALTER SEQUENCE employers_id_seq RESTART WITH 1;
ALTER SEQUENCE affiliatedcompanys_id_seq RESTART WITH 1;
ALTER SEQUENCE projects_id_seq RESTART WITH 1;

-- password == blarps

INSERT INTO users (firstname, lastname, email, currentemployer, username, password) VALUES
    (
        'Nicky',
        'de Vendt',
        'nickydevendt@hotmail.com',
        'defensie',
        'nickydevendt',
        'blarps'
    ),
    (
        'nickyadmin',
        'adminvendt',
        'nicky@sensimedia.nl',
        'sensimedia',
        'admin',
        'blarps'
    );

INSERT INTO visitors (randomid, firstname, lastname, email) VALUES
    (
        'abcdefghijklmnop123456',
        'doetje',
        'de barbaar',
        'barbarenzijngevaarlijk@hotmail.com'
    );

INSERT INTO employers (userid, name, workyears) VALUES
    (
        '1',
        'sensimedia',
        '25'
    );

INSERT INTO affiliatedcompanys (name, website) VALUES
    (
        'sensimedia',
        'www.sensimedia.nl'
    );

INSERT INTO projects (developer, name, companyname, companyid) VALUES 
    (
        '1',
        'myfirstsite',
        'sensimedia',
        '1'
    );

