DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS task;

CREATE TABLE employee (id INTEGER PRIMARY KEY AUTO_INCREMENT,
                      first_name VARCHAR(255), last_name VARCHAR(255), picture VARCHAR(255));

CREATE TABLE task (id INTEGER PRIMARY KEY AUTO_INCREMENT, description VARCHAR(255), estimate INTEGER,
                   employee_id INTEGER, status VARCHAR(255));
