# Property Finder

A small PHP and MySQL property finder website for a university project. Users can browse, filter, view property details, and submit inquiries. Admins can log in, manage listings, view inquiries, and log out.

## Technologies

- HTML5
- CSS3
- Vanilla JavaScript
- PHP with PDO
- MySQL / SQL
- XAMPP for local Apache and MySQL

## Features

Public:
- Browse properties
- Filter by location, minimum price, maximum price, and property type
- View image, description, and contact details
- Submit inquiry

Admin:
- Login and logout
- View listings
- Add, edit, and delete listings
- View submitted inquiries

## Database Setup

1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin.
3. Import `database.sql`.
4. The database name is `property_finder`.

Seeded admin login:

- Email: `admin@example.com`
- Password: `password`

The demo password in `database.sql` is stored as plain text for a simple university demo.

## Local Setup

1. Place this folder inside your XAMPP `htdocs` directory, for example `htdocs/property-finder`.
2. Import `database.sql`.
3. Open `http://localhost/property-finder/index.php`.
4. Admin login is at `http://localhost/property-finder/admin/login.php`.

Default local database settings are in `config/database.php`:

- Host: `localhost`
- Port: `3306`
- Database: `property_finder`
- User: `root`
- Password: empty

## Production Environment Variables

Set these variables for production:

- `DB_HOST`
- `DB_PORT`
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`

Do not use the local XAMPP database for production. Use a remote MySQL database.

## InfinityFree Deployment

InfinityFree supports PHP and MySQL, so it is a suitable simple deployment target for this project.

Basic deployment steps:

1. Upload the project files to the InfinityFree `htdocs` folder.
2. Create a MySQL database from the InfinityFree control panel.
3. Import `database.sql` using phpMyAdmin.
4. Update `config/database.php` with the database host, name, username, and password from InfinityFree.
5. Make sure the `uploads/` folder is writable for property images.
6. Open your InfinityFree site URL and test the public pages and admin panel.
