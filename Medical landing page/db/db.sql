CREATE TABLE user(
    
    user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE doctor(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    doctor_name VARCHAR(255) NOT NULL,
    doctor_specialty VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE services(
    service_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    service_name VARCHAR(255) NOT NULL,
    service_image VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL 
);