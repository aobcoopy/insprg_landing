CREATE TABLE address (id int(11) NOT NULL AUTO_INCREMENT, address varchar(255), states int(11), country int(11), city int(11), district int(11), subdistrict int(11), postal varchar(255), created datetime NULL, updated datetime NULL, contact int(11), organization int(11), priority int(11), latitude float, longitude float, altitude float, PRIMARY KEY (id));
CREATE TABLE cities (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), country int(11), state int(11), PRIMARY KEY (id));
CREATE TABLE contacts (id int(11) NOT NULL AUTO_INCREMENT, title varchar(255), name varchar(255), surname varchar(255), dob date, gender varchar(255), email varchar(255), phone varchar(255), mobile varchar(255), joined date, created datetime NULL, updated datetime NULL, status int(11), website varchar(255), skype varchar(255), facebook varchar(255), citizen_id varchar(255), avatar varchar(255), nickname varchar(255), PRIMARY KEY (id));
CREATE TABLE countries (id int(11) NOT NULL AUTO_INCREMENT, code varchar(5), name varchar(255), PRIMARY KEY (id));
CREATE TABLE customer_groups (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), setting text, PRIMARY KEY (id));
CREATE TABLE customers (id int(11) NOT NULL AUTO_INCREMENT, code varchar(255), type varchar(255), organization int(11), contact int(11) NOT NULL, created datetime NULL, updated datetime NULL, username varchar(255), password varchar(255), last_login datetime NULL, status int(11), gid int(11) NOT NULL, PRIMARY KEY (id));
CREATE TABLE districts (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), city int(11), PRIMARY KEY (id));
CREATE TABLE employees (id int(11) NOT NULL AUTO_INCREMENT, code varchar(255), position int(11) NOT NULL, working_period int(11) NOT NULL, status int(11), `user` int(11) NOT NULL, joined date, extension varchar(255), created datetime NULL, updated datetime NULL, comment text, info text, branch int(11), PRIMARY KEY (id));
CREATE TABLE groups (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), created datetime NULL, updated datetime NULL, role int(11), PRIMARY KEY (id));
CREATE TABLE industries (id int(11) NOT NULL AUTO_INCREMENT, code varchar(255), name varchar(1023), PRIMARY KEY (id));
CREATE TABLE messages (id int(11) NOT NULL AUTO_INCREMENT, type varchar(255), from_type varchar(255), `from` int(11), to_type varchar(255), `to` int(11), created datetime NULL, updated datetime NULL, sent datetime NULL, viewed datetime NULL, acknowledge datetime NULL, header text, body text, footer text, flagged int(11), tag varchar(255), ref int(11), extra text, PRIMARY KEY (id));
CREATE TABLE notifications (id int(11) NOT NULL AUTO_INCREMENT, type varchar(255), topic varchar(255), detail text, `user` int(11), created datetime NULL, updated datetime NULL, acknowledge datetime NULL, PRIMARY KEY (id));
CREATE TABLE organizations (id int(11) NOT NULL AUTO_INCREMENT, code varchar(255), name varchar(255), email varchar(255), phone varchar(255), fax varchar(255), website varchar(255), created datetime NULL, updated datetime NULL, type varchar(255), industry int(11) NOT NULL, parent int(11), logo varchar(255), taxid varchar(255), PRIMARY KEY (id));
CREATE TABLE permissions (id int(11) NOT NULL AUTO_INCREMENT, gid int(11) NOT NULL, name varchar(255), action varchar(255), PRIMARY KEY (id));
CREATE TABLE positions (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), detail text, setting text, PRIMARY KEY (id));
CREATE TABLE states (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), country int(11), PRIMARY KEY (id));
CREATE TABLE subdistricts (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), district int(11), PRIMARY KEY (id));
CREATE TABLE users (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), password varchar(255), status int(11), created datetime NULL, updated datetime NULL, validated datetime NULL, last_login datetime NULL, gid int(11) NOT NULL, contact int(11) NOT NULL, setting text, PRIMARY KEY (id));
CREATE TABLE variable (id int(11) NOT NULL AUTO_INCREMENT, name varchar(255), value text, updated datetime NULL, PRIMARY KEY (id));

CREATE TABLE logs(
	log_id INT AUTO_INCREMENT PRIMARY KEY,
	log_datetime DATETIME,
	log_user_type INT,
	log_user INT,
	log_action VARCHAR(255),
	log_value TEXT,
	log_location VARCHAR(255),
	log_data TEXT
);








ALTER TABLE permissions ADD INDEX FKpermission650610 (gid), ADD CONSTRAINT FKpermission650610 FOREIGN KEY (gid) REFERENCES groups (id);
ALTER TABLE organizations ADD INDEX FKorganizati683407 (parent), ADD CONSTRAINT FKorganizati683407 FOREIGN KEY (parent) REFERENCES organizations (id);
ALTER TABLE address ADD INDEX FKaddress614585 (contact), ADD CONSTRAINT FKaddress614585 FOREIGN KEY (contact) REFERENCES contacts (id);
ALTER TABLE address ADD INDEX FKaddress883002 (organization), ADD CONSTRAINT FKaddress883002 FOREIGN KEY (organization) REFERENCES organizations (id);
ALTER TABLE address ADD INDEX FKaddress780643 (country), ADD CONSTRAINT FKaddress780643 FOREIGN KEY (country) REFERENCES countries (id);
ALTER TABLE address ADD INDEX FKaddress182593 (city), ADD CONSTRAINT FKaddress182593 FOREIGN KEY (city) REFERENCES cities (id);
ALTER TABLE address ADD INDEX FKaddress858152 (district), ADD CONSTRAINT FKaddress858152 FOREIGN KEY (district) REFERENCES districts (id);
ALTER TABLE address ADD INDEX FKaddress257556 (subdistrict), ADD CONSTRAINT FKaddress257556 FOREIGN KEY (subdistrict) REFERENCES subdistricts (id);
ALTER TABLE customers ADD INDEX FKcustomers373869 (organization), ADD CONSTRAINT FKcustomers373869 FOREIGN KEY (organization) REFERENCES organizations (id);
ALTER TABLE customers ADD INDEX FKcustomers642286 (contact), ADD CONSTRAINT FKcustomers642286 FOREIGN KEY (contact) REFERENCES contacts (id);
ALTER TABLE customers ADD INDEX FKcustomers880205 (gid), ADD CONSTRAINT FKcustomers880205 FOREIGN KEY (gid) REFERENCES customer_groups (id);
ALTER TABLE organizations ADD INDEX FKorganizati460309 (industry), ADD CONSTRAINT FKorganizati460309 FOREIGN KEY (industry) REFERENCES industries (id);
ALTER TABLE users ADD INDEX FKusers657349 (contact), ADD CONSTRAINT FKusers657349 FOREIGN KEY (contact) REFERENCES contacts (id);
ALTER TABLE users ADD INDEX FKusers777324 (gid), ADD CONSTRAINT FKusers777324 FOREIGN KEY (gid) REFERENCES groups (id);
ALTER TABLE employees ADD INDEX FKemployees967762 (`user`), ADD CONSTRAINT FKemployees967762 FOREIGN KEY (`user`) REFERENCES users (id);
ALTER TABLE employees ADD INDEX FKemployees779280 (position), ADD CONSTRAINT FKemployees779280 FOREIGN KEY (position) REFERENCES positions (id);
ALTER TABLE address ADD INDEX FKaddress315877 (states), ADD CONSTRAINT FKaddress315877 FOREIGN KEY (states) REFERENCES states (id);
