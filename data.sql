DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS task;

CREATE TABLE employee (id INTEGER PRIMARY KEY AUTO_INCREMENT,
                      first_name VARCHAR(255), last_name VARCHAR(255), picture VARCHAR(255));

CREATE TABLE task (id INTEGER PRIMARY KEY AUTO_INCREMENT, description VARCHAR(255), estimate VARCHAR(255),
                   employee_id VARCHAR(255), is_completed BOOL, status VARCHAR(255));

INSERT INTO employee VALUES (null, 'Mari', 'Karu', '');

INSERT INTO task VALUES (null, 'Meet the client', '2', '-1', 0, 'open');