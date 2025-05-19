
# Project Title
**Smart Message Wall**

---

## High-Level Functionalities

- Users can post messages with nickname and content
- Messages are displayed with timestamp and like count
- Users can search, filter by date, and sort messages
- Hashtag links and automatic URL conversion enhance usability
- Admins can log in to delete messages
- Responsive design for desktop and mobile users

---

## Example Scenario 1: User Posts and Searches for a Message

- **User**: A visitor using a mobile browser  
- **Goal**: Post a message and search for related posts  

### System Flow:
1. User fills out and submits the message form  
2. `submit.php` sanitizes input and inserts it into the database  
3. User enters a keyword in the search bar  
4. `index.php` reads `$_GET` parameters and queries the database  
5. Results are displayed with highlights and links  

- **PHP logic**: `submit.php`, `index.php` (search, highlight, enrich text)  
- **Database operations**: `INSERT`, `SELECT ... WHERE ...`

---

## Example Scenario 2: Admin Deletes a Message

- **User**: Logged-in admin using a desktop browser  
- **Goal**: Remove inappropriate content  

### System Flow:
1. Admin logs in via `login.php`  
2. Admin sees delete icons on each message  
3. Clicks delete → `delete.php` verifies session and removes the message  

- **PHP logic**: `login.php`, `delete.php`  
- **Database operations**: `SELECT` (login), `DELETE FROM messages`

