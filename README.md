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
- 🛠️ Admin dashboard (`admin.php`) for centralized control  

---

## 🖥️ Runtime Environment

- **Hardware**: Raspberry Pi Zero 2 W  
- **Web Server**: Apache2 (or compatible HTTP server)  
- **Scripting**: PHP 8+ (no JavaScript frameworks required)  
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
| `tag.php`        | Messages tagged                             |
| `style.css`      | All frontend layout and RWD design          |
| `schema.sql`     | SQL schema to create  tables                |

---

## 📄 Documentation

| File                          | Description                                                  |
|-------------------------------|--------------------------------------------------------------|
| [`Installation.md`](Installation.md) | Step-by-step setup instructions for Raspberry Pi 0 2W      |
| [`UserGuide.md`](UserGuide.md)       | Guide for general users: how to post, like, search, etc.   |
| [`AdminGuide.md`](AdminGuide.md)     | Admin-only features: login, delete, manage, troubleshoot   |
| [`Contributors.md`](Contributors.md) | List of contributors and student/team members              |

---

## ✅ Getting Started

If you're ready to install the system, start with:

👉 [`Installation.md`](Installation.md)

It includes:
- Installing Apache + PHP + MariaDB
- Importing `schema.sql`
- Setting up database user and permissions
- Verifying everything works on Raspberry Pi

---


