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
        'Blarps!1'
    ),
    (
        'nicky',
        'adminvendt',
        'nicky@sensimedia.nl',
        'sensimedia',
        'nicky',
        'Blarps!1'
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
        'mcdonald',
        'sensimedia',
        'www.mcdonalds.nl'
    ),
    (
        '1',
        'hema',
        'hema',
        'www.hema.nl'
    );

INSERT INTO resume (usersid, educations, workexperience, internships, courses, skills, languages, reference) VALUES
    (
        '1',
        '{"nova college","7 years","it was hard work but now its finally over!"}',
        '{{army},{20 years},{het was erg leuk en spannend}}',
        '{{"sensimedia"},{"defensie"}}',
        '{"VCA"}',
        '{{winner},{victor}}',
        '{{Dutch},{English},{Spanish}}',
        '{{the army},{nova college},{sensimedia}}'
    );

GRANT ALL PRIVILEGES ON database nicky TO nicky;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO nicky;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO nicky;

