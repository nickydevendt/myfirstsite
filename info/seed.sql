DELETE FROM users;
DELETE FROM visitors;
DELETE FROM affiliatedcompanys;
DELETE FROM projects;

ALTER SEQUENCE users_id_seq RESTART WITH 1;
ALTER SEQUENCE visitors_id_seq RESTART WITH 1;
ALTER SEQUENCE affiliatedcompanys_id_seq RESTART WITH 1;
ALTER SEQUENCE projects_id_seq RESTART WITH 1;

-- password == blarps

INSERT INTO users (firstname, lastname, email, currentemployer, username, password) VALUES
    (
        'admin',
        'admin',
        'admin@admin.com',
        'sensimedia',
        'admin',
        'blarps'
    ),
    (
        'nickyadmin',
        'adminvendt',
        'nicky@sensimedia.nl',
        'sensimedia',
        'nicky',
        'blarps'
    );

INSERT INTO affiliatedcompanys (name, website) VALUES
    (
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        'sensimedia',
        'www.sensimedia.nl'
    );

INSERT INTO projects (developer, name, companyname, companywebsite) VALUES 
    (
        '1',
        'myfirstsite',
        'sensimedia',
        'www.sensimedia.nl'
    ),
    (
        '1',
        'mc donald',
        'sensimedia',
        'www.mcdonalds.nl'
    ),
    (
        '1',
        'hema',
        'hema',
        'www.hema.nl'
    );
GRANT ALL PRIVILEGES ON database nicky TO nicky;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO nicky;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO nicky;

