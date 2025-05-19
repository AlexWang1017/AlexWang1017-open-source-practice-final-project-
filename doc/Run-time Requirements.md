
# Run-time Requirements

The system is designed to run on Raspberry Pi Zero 2 W hardware, with the following software stack to ensure stable and reliable operation.

---

## 1. Hardware Requirements

- **Device**: Raspberry Pi Zero 2 W
- **CPU**: 1GHz quad-core ARM Cortex-A53
- **RAM**: 512MB LPDDR2 SDRAM
- **Storage**: At least 4GB (8GB+ microSD card recommended)
- **Networking**: Wi-Fi (for local and browser-based access)

---

## 2. Operating System

- **OS**: Raspberry Pi OS Lite or Ubuntu Server 20.04 / 22.04 (ARM version)
- **Shell**: bash or zsh
- **Remote Access**: SSH enabled (optional)

---

## 3. Software Dependencies

| Software      | Recommended Version | Description                              |
|---------------|---------------------|------------------------------------------|
| Apache2       | 2.4.x or above      | Web server to serve PHP pages            |
| PHP           | 7.4 or above        | Server-side scripting (with PDO support) |
| MariaDB       | 10.3 or above       | Database server to store messages        |
| php-mysql     | Matching PHP version| PHP module to connect to MariaDB         |
| PDO           | Enabled             | Preferred method for database access     |

---

## 4. Network Configuration

- When running in a QEMU virtual environment, the following port forwarding is recommended:

```bash
-net user,hostfwd=tcp::8080-:80,hostfwd=tcp::8822-:22
```

- Web service can be accessed via: `http://localhost:8080`
- SSH login available at: `ssh pi@localhost -p 8822` (if SSH is enabled)

---

## 5. Browser Compatibility

- Supports modern browsers: Chrome, Firefox, Edge, Safari
- Fully responsive layout for both desktop and mobile devices

---

## 6. User Roles

- **General Users**: Post messages, like, search, and sort
- **Admin**: Log in, view all messages, and delete inappropriate content

---
