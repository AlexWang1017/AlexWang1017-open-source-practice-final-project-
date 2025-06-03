# 🛠️ Installation Guide – Simple Message Wall

This guide explains how to install and run the Simple Message Wall project on a **Raspberry Pi Zero 2 W**.

---

## 📦 Prerequisites

Make sure your Raspberry Pi Zero 2 W is running a Debian-based OS (e.g., Raspberry Pi OS or DietPi) and has internet access.

You will need:

* Apache2 (or any HTTP server)
* PHP 8+ (must include `php-mysql` module)
* MariaDB
* Git (optional but recommended)

---

## 🔧 Step-by-Step Installation

### 1. Update System Packages

```bash
sudo apt update
```

### 2. Install Apache, PHP, MariaDB

```bash
sudo apt install apache2 php mariadb-server php-mysql
```

Restart Apache to enable PHP:

```bash
sudo systemctl restart apache2
```

### 3. Clone the Project (or upload manually)

To install Git (if not already installed):

```bash
sudo apt install git
```

If using GitHub:

```bash
sudo mkdir /var/www/html/message_wall
cd /var/www/html/message_wall
sudo git clone https://github.com/AlexWang1017/AlexWang1017-open-source-practice-final-project-.git .
sudo chown -R www-data:www-data /var/www/html/message_wall

```

Or upload your files (e.g., using SCP or VS Code remote SSH) into `/var/www/html/message_wall/`

### 4. Import Database Schema

Run MariaDB:

```bash
sudo mariadb
```

Then inside MariaDB:

```sql
SOURCE /var/www/html/message_wall/src/schema.sql;
```

This creates the database `message_wall` and a table called `messages`.

### 5. Create Application DB User

Still in MariaDB:

```sql
CREATE USER 'user'@'localhost' IDENTIFIED BY '0000';
GRANT ALL PRIVILEGES ON message_wall.* TO 'user'@'localhost';
FLUSH PRIVILEGES;
```

Make sure this matches the credentials used in `db.php`

### 6. Set Permissions (optional)

```bash
sudo chown -R www-data:www-data /var/www/html/message_wall
```

---

## ✅ Test It!

Open a browser and visit:

```
http://<your_rpi_ip>/message_wall/src
```

You should see the message wall interface. Try posting a message.

---

## 🧪 Default Admin Credentials

* **Username:** admin
* **Password:** 0000

Go to `/message_wall/src/login.php` to access the admin dashboard.
