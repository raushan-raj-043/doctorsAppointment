CREATE DATABASE doctors_db;
USE doctors_db;


CREATE TABLE doctors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(255) UNIQUE NOT NULL,
    specialty VARCHAR(255) NOT NULL
);

CREATE TABLE slots (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
    time TIME NOT NULL,
    doctor_id INT,
    booked BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

CREATE TABLE booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    doctor_id INT,
    user_id INT,
    time TIME NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE fees_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    consultation_fee DECIMAL(10, 2) NOT NULL,
    doctor_id INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    otp INT NOT NULL
);

CREATE TABLE appointments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    slot_id INT,
    email VARCHAR(255),
    FOREIGN KEY (slot_id) REFERENCES slots(id),
    FOREIGN KEY (email) REFERENCES users(email)
);