# 🔐 PHP Login System with Sessions

A simple PHP login authentication system demonstrating session management, database connectivity, and user authentication flow.

## ⚠️ Educational Purpose Notice

This project is intended for **learning purposes only**. It demonstrates basic PHP session handling but contains security practices that should be improved before any production use.

## 🌟 Features

- User login with username and password
- PHP session management
- Session-based authentication
- Profile page access control
- Logout functionality
- Basic SQL injection protection (mysqli_real_escape_string)

## 🛠️ Tech Stack

| Component | Technology |
|-----------|------------|
| Backend | PHP 7+ |
| Database | MySQL (MySQLi) |
| Sessions | PHP Native Sessions |
| Frontend | HTML5, CSS3 |

## 📁 Project Structure

```
Login/
├── index.php       # Login form (entry point)
├── login.php       # Authentication logic
├── session.php     # Session validation
├── profile.php     # Protected profile page
├── logout.php      # Session destruction
├── style.css       # Styling
└── db.example.php  # Database config template
```

## 🚀 Installation

### Prerequisites

- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/RajmaniShukla/Login.git
   cd Login
   ```

2. **Create Database**
   ```sql
   CREATE DATABASE company;
   USE company;
   
   CREATE TABLE login (
     id INT(11) AUTO_INCREMENT PRIMARY KEY,
     username VARCHAR(50) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   
   -- Insert a test user (use hashed password in production!)
   INSERT INTO login (username, password) VALUES ('admin', 'admin123');
   ```

3. **Configure Database**
   ```bash
   cp db.example.php db.php
   # Edit db.php with your credentials
   ```

4. **Run the Application**
   ```
   http://localhost/Login/
   ```

## 🗄️ Database Schema

```sql
CREATE TABLE login (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🔒 Security Recommendations

**⚠️ This code needs security improvements for production:**

### 1. Password Hashing
```php
// When creating users - HASH passwords
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// When verifying - use password_verify()
if (password_verify($input_password, $stored_hash)) {
    // Login successful
}
```

### 2. Prepared Statements
```php
// Instead of string concatenation, use prepared statements
$stmt = $connection->prepare("SELECT * FROM login WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
```

### 3. Session Security
```php
// Regenerate session ID after login
session_regenerate_id(true);

// Set secure session cookie parameters
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,    // HTTPS only
    'httponly' => true,  // No JavaScript access
    'samesite' => 'Strict'
]);
```

### 4. CSRF Protection
```php
// Generate token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// In forms
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

// Validate on submit
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token validation failed');
}
```

## 📝 File Descriptions

| File | Purpose |
|------|---------|
| `index.php` | Main entry point, displays login form |
| `login.php` | Handles authentication logic |
| `session.php` | Validates active sessions |
| `profile.php` | Protected page (requires login) |
| `logout.php` | Destroys session and redirects |
| `style.css` | Form styling |

## 🔄 Authentication Flow

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│  index.php  │───▶│  login.php  │───▶│ profile.php │
│ (Login Form)│    │ (Auth Check)│    │ (Protected) │
└─────────────┘    └─────────────┘    └──────┬──────┘
                          │                   │
                          │                   │
                   ┌──────▼──────┐    ┌───────▼──────┐
                   │ session.php │    │  logout.php  │
                   │(Validation) │    │ (End Session)│
                   └─────────────┘    └──────────────┘
```

## 🧪 Testing

Default test credentials (if using the sample INSERT):
- Username: `admin`
- Password: `admin123`

## 🔧 Troubleshooting

| Issue | Solution |
|-------|----------|
| Cannot connect to database | Check credentials in session.php and login.php |
| Session not persisting | Ensure `session_start()` is called before any output |
| Redirect loops | Clear browser cookies and PHP sessions |
| Blank page | Enable PHP error reporting for debugging |

## 📚 Learning Resources

- [PHP Sessions Documentation](https://www.php.net/manual/en/book.session.php)
- [MySQLi Prepared Statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)
- [Password Hashing in PHP](https://www.php.net/manual/en/function.password-hash.php)
- [OWASP Authentication Guide](https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Implement security improvements
4. Submit a pull request

## 📄 License

Open source for educational purposes.

## 👤 Author

**Rajmani Shukla**
- GitHub: [@RajmaniShukla](https://github.com/RajmaniShukla)

---

<p align="center">
  <b>⚡ Remember: Always hash passwords and use prepared statements in production! ⚡</b>
</p>
