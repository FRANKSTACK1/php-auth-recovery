# PHP Password Recovery Utility

A lightweight and secure PHP utility for handling password reset requests in authentication-based web applications. This utility generates secure reset tokens, stores them in a database, and prepares password reset links that can be sent to users via email.

## Overview

`forgot-password-logic.php` is designed to simplify the password recovery process for websites that require user authentication.

When a user forgets their password, this utility:

1. Verifies that the email address belongs to an existing user.
2. Generates a cryptographically secure reset token.
3. Stores the token and its expiration time in the database.
4. Creates a password reset link containing the token.
5. Allows the application to send the reset link to the user's email address.

This approach ensures that users can securely regain access to their accounts without exposing sensitive information.

---

## Features

* Secure token generation using `random_bytes()`
* Password reset token expiration
* PDO prepared statements for SQL injection protection
* Easy integration into existing authentication systems
* Email-based password recovery workflow
* Lightweight and framework-independent

---

## File Structure

```text
forgot-password-logic.php
```

---

## Requirements

* PHP 7.4+
* MySQL Database
* PDO Extension Enabled
* Users table containing:

```sql
id
email
reset_token
token_expiry
```

---

## How It Works

### Step 1: User Requests Password Reset

The user submits their email address through a "Forgot Password" form.

```php
$recovery = new PasswordRecovery($pdo);
echo $recovery->requestReset('user@example.com');
```

### Step 2: Verify User

The utility checks if the email exists in the database.

### Step 3: Generate Secure Token

A unique reset token is generated using:

```php
bin2hex(random_bytes(32));
```

### Step 4: Store Token

The generated token and expiration time are saved in the database.

### Step 5: Create Reset Link

A reset URL is generated:

```php
https://yourdomain.com/reset.php?token=TOKEN_HERE
```

The link can then be emailed to the user.

### Step 6: Reset Password

After clicking the link, the user is taken to a password reset page where the token is validated before allowing a new password to be set.

---

## Why Password Recovery Is Important

Password recovery is a critical component of any authentication system.

Without a secure password reset mechanism:

* Users can become permanently locked out of their accounts.
* Administrators may need to manually reset passwords.
* User experience suffers.
* Security risks increase when insecure recovery methods are used.

A properly implemented password recovery system improves:

* User retention
* Account security
* User experience
* Authentication reliability

---

## Security Considerations

This utility follows several security best practices:

* Uses cryptographically secure token generation.
* Stores token expiration times.
* Uses PDO prepared statements.
* Prevents direct password exposure.
* Supports email-based verification.

For production environments, it is recommended to:

* Hash reset tokens before storing them.
* Use HTTPS.
* Implement rate limiting.
* Add email verification services.
* Log password reset activities.

---

## Example Use Cases

This utility can be integrated into:

* User Login Systems
* Membership Platforms
* SaaS Applications
* E-commerce Websites
* School Portals
* Admin Dashboards
* Community Platforms
* Content Management Systems (CMS)

---

## Author

**FRANKSTACK**

Portfolio: https://frankstack.com.ng

GitHub: Build. Secure. Scale.

---

## License

This project is open-source and available for educational and commercial use.
