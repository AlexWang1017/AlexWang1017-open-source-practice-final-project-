
# Final Project Demonstration

## 1. Demo Scenario Overview

### What will the demo include?

The demo will showcase a fully functional web-based message wall deployed on a Raspberry Pi Zero 2 W. Users can leave public messages, view all messages, and interact with messages using like buttons. An admin can log in to delete inappropriate messages.

### Features to be demonstrated:
- User can submit messages with nickname and content.
- Messages display immediately in reverse chronological order.
- Each message shows timestamp and like count.
- Keyword search with highlighting.
- Date filtering and sorting (newest/oldest/likes).
- Hashtag linking (#tag).
- Admin login and message deletion.

### User actions shown:
- Posting a message
- Searching by keyword
- Filtering by date range
- Sorting by likes
- Liking a message
- Admin login/logout
- Deleting a message

### Functional components:
All features are functional:
- Server-side rendering with PHP
- Database operations via PDO and MariaDB
- Minimal client-side scripting (e.g., like button, show/hide password)

---

## 2. Planned URL Endpoints

| URL Path     | Method   | HTTP Variables                      | Session Variables    | DB Operations                        |
|--------------|----------|-------------------------------------|----------------------|--------------------------------------|
| /index.php   | GET      | search, start_date, end_date, sort_order | admin (optional)     | SELECT messages (filtered/sorted)   |
| /submit.php  | POST     | nickname, content                   | —                    | INSERT new message                   |
| /like.php    | GET      | id                                  | —                    | UPDATE like_count                    |
| /login.php   | GET/POST | username, password                  | admin (set on login) | Validate login credentials           |
| /logout.php  | GET      | —                                   | admin (cleared)      | —                                    |
| /admin.php   | GET      | —                                   | admin (required)     | SELECT all messages                  |
| /delete.php  | GET      | id                                  | admin (required)     | DELETE message by ID                 |

---

## 3. Database Design

### a. Entity-Relationship Diagram (ERD)

Entities:
- Message (id, nickname, content, created_at, like_count)
- AdminSession (session only, not stored in DB)

Since the app is simple, it only includes one main table (messages).

### b. Relational Model

Table: messages

| Column      | Data Type   | Constraints                     |
|-------------|-------------|----------------------------------|
| id          | INT         | PRIMARY KEY, AUTO_INCREMENT      |
| nickname    | VARCHAR(50) | NOT NULL                         |
| content     | TEXT        | NOT NULL                         |
| created_at  | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP        |
| like_count  | INT         | DEFAULT 0                        |

---

## 📷 Message Table Image (ERD)

![Message Table](message_table.png)
