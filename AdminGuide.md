# 👑 Admin Guide – Simple Message Wall

This guide explains how to configure, access, and maintain the **admin system** for the Simple Message Wall.

---

## 🔐 Admin Login

To access the admin dashboard:

1. Open a browser and go to:

```
http://<your_rpi_ip>/message_wall/src/login.php
```

2. Enter the default credentials:

- **Username**: `admin`
- **Password**: `0000`

> ✅ You can customize these credentials by editing `login.php` or extending it with password hashing (e.g., `password_hash()`).

---

## 🧭 Admin Features

After logging in, you'll be redirected to the **admin dashboard** (`admin.php`). The admin panel provides:

### ✏️ View All Messages
- Messages are listed newest first
- Each message includes: nickname, content, timestamp, and like count

### 🗑️ Delete Messages
- Click "🗑️ 刪除" to remove an inappropriate or test message
- A confirmation popup will appear before deletion

---

## ⚙️ Configuration Files

| File         | Role                              |
|--------------|-----------------------------------|
| `admin.php`  | Admin dashboard (message manager) |
| `login.php`  | Login form                        |
| `logout.php` | Ends admin session                |
| `db.php`     | Database connection info          |

---

## 🔐 Security Recommendations

| Item                         | Suggestion                                  |
|------------------------------|---------------------------------------------|
| 🔐 Use `password_hash()`     | Replace plain-text password check           |
| 🚫 Protect `admin.php`       | Already protected by `$_SESSION['admin']`   |
| 🧼 Input validation           | Already uses `htmlspecialchars()`           |
| 📁 Secure file permissions   | `chown -R www-data:www-data message_wall/` |

---

## 🔁 Maintenance Tips

| Task                           | How to do it                                                   |
|--------------------------------|----------------------------------------------------------------|
| Clear test messages            | Login as admin → delete manually                               |
| Reset admin password           | Modify `login.php` or implement database-based user auth       |
| Update database schema         | Edit and re-run `schema.sql` (backup first)                    |
| Update system code             | Pull latest code from GitHub (or replace manually via SCP)     |

---

## 🆘 Troubleshooting

| Problem                        | Solution                                                       |
|--------------------------------|----------------------------------------------------------------|
| Cannot log in                  | Check if session is working (`session_start()` in login.php)   |
| Message delete not working     | Ensure you are logged in as admin and `delete.php` exists      |
| Blank page after login         | Make sure `admin.php` is in the same directory and working     |
