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

The password in `database.sql` is stored as a `password_hash()` compatible hash.

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

## Deployment Note

Vercel does not provide native persistent PHP hosting or permanent local file storage like a traditional PHP host. This project includes a simple `vercel.json` for PHP runtime preparation, but a standard PHP host, shared hosting, or VPS is usually simpler for this stack.

For production image uploads, use persistent storage from the hosting provider or a simple external storage service. Local `uploads/` works for XAMPP development.

