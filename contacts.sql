/* 
Name: Dipu Pravinbhai Dodiya
Date: 04/05/2022
Course Code: 78296
File namre: contacts.sql
*/

DROP TABLE IF EXISTS contacts;

CREATE TABLE contacts(
    email_address VARCHAR(255),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone_number VARCHAR(25),
    created_on DATE
);

ALTER TABLE `contacts` ADD UNIQUE(`email_address`);

INSERT INTO contacts(email_address, first_name, last_name, phone_number, created_on)
            VALUES('Muath.alzghool@mail.com', 'Muath', 'Alzghool', '(123)456-7890', '2022-04-01');
INSERT INTO contacts(email_address, first_name, last_name, phone_number, created_on)
            VALUES('dipudodiya1901@gmail.com', 'Dipu', 'Dodiya', '(980)123-6574', '2022-04-05');
     
SELECT email_address, first_name, last_name, phone_number, created_on from contacts
ORDER BY last_name ASC;