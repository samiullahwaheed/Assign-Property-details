CREATE DATABASE IF NOT EXISTS property_finder CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE property_finder;

DROP TABLE IF EXISTS inquiries;
DROP TABLE IF EXISTS properties;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE properties (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    property_type ENUM('House', 'Apartment', 'Villa', 'Commercial') NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    contact_name VARCHAR(150) NOT NULL,
    contact_phone VARCHAR(50) NOT NULL,
    contact_email VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inquiries (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    property_id INT UNSIGNED NULL,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_inquiries_properties
        FOREIGN KEY (property_id) REFERENCES properties(id)
        ON DELETE SET NULL
);

INSERT INTO admins (email, password) VALUES
('admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi');

INSERT INTO properties
(title, location, price, property_type, description, image, contact_name, contact_phone, contact_email)
VALUES
('Green View Family House', 'Lahore', 145000, 'House', 'A clean family house with bright rooms, parking space, and a quiet residential location.', 'assets/images/property-1.svg', 'Ali Khan', '+92 300 1111111', 'ali@example.com'),
('City Center Apartment', 'Karachi', 95000, 'Apartment', 'A modern apartment close to shops, offices, and public transport.', 'assets/images/property-2.svg', 'Sara Ahmed', '+92 300 2222222', 'sara@example.com'),
('Palm Villa Residence', 'Islamabad', 260000, 'Villa', 'A spacious villa with open living areas, private outdoor space, and quality finishes.', 'assets/images/property-3.svg', 'Hassan Raza', '+92 300 3333333', 'hassan@example.com'),
('Main Road Commercial Unit', 'Faisalabad', 185000, 'Commercial', 'A practical commercial space on a busy road, suitable for a shop or office.', 'assets/images/property-4.svg', 'Ayesha Malik', '+92 300 4444444', 'ayesha@example.com'),
('Parkside House', 'Rawalpindi', 132000, 'House', 'A comfortable house near a public park with simple, well-kept interiors.', 'assets/images/property-5.svg', 'Bilal Shah', '+92 300 5555555', 'bilal@example.com'),
('Skyline Apartment', 'Lahore', 120000, 'Apartment', 'An apartment with city views, secure entry, and convenient access to daily services.', 'assets/images/property-6.svg', 'Mina Tariq', '+92 300 6666666', 'mina@example.com'),
('Executive Villa', 'Karachi', 310000, 'Villa', 'A large villa designed for comfortable living with spacious bedrooms and reception areas.', 'assets/images/property-7.svg', 'Omar Farooq', '+92 300 7777777', 'omar@example.com'),
('Office Floor', 'Islamabad', 225000, 'Commercial', 'An office floor with an open layout, reception area, and central business access.', 'assets/images/property-8.svg', 'Nadia Iqbal', '+92 300 8888888', 'nadia@example.com');

