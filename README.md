# 📬 Simple Message Wall

A lightweight web-based message board system designed for the **Raspberry Pi Zero 2 W**.  
Built with **PHP**, **MariaDB**, and an **HTTP server**, it allows users to leave messages, view others' posts, and interact with likes — all via a responsive, mobile-friendly interface.

---

## 🌟 Features

- 📝 Leave public messages with nickname and content
- ⏰ Timestamped message display (latest first)
- ❤️ Like button for each message
- 🔍 Keyword search and content highlighting
- 📅 Date range filtering + sort by likes or time
- 🏷️ Hashtag linking (e.g., `#event`)
- 🔐 Admin login with delete access
- 📱 Responsive design (RWD for mobile)
- 🛠️ Admin dashboard (admin.php) for centralized control

---

## 🖥️ Runtime Environment

- **Hardware**: Raspberry Pi Zero 2 W  
- **Web Server**: Apache2 (or any HTTP server)  
- **Scripting**: PHP 8+ (no other languages used)  
- **Database**: MariaDB  

---

## 📂 Included Files

| File             | Description                                 |
|------------------|---------------------------------------------|
| `index.php`      | Main message board interface                |
| `submit.php`     | Form handler to save messages               |
| `delete.php`     | Admin-only message deletion logic           |
| `login.php`      | Admin login interface                       |
| `logout.php`     | Ends admin session                          |
| `admin.php`      | Admin dashboard for managing messages       |
| `like.php`       | Like count processor                        |
| `db.php`         | Centralized DB connection config            |
| `style.css`      | All frontend layout and RWD design          |
| `schema.sql`     | SQL schema to create the `messages` table   |


