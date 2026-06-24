<?php
/**
 * ForgotPassword Utility
 * Handles token generation for secure password recovery.
 */

class PasswordRecovery {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function requestReset($email) {
        // 1. Verify user exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // 2. Generate secure token
            $token = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

            // 3. Store token in DB
            $stmt = $this->db->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
            $stmt->execute([$token, $expiry, $email]);

            // 4. Send email (Conceptual)
            $resetLink = "https://yourdomain.com/reset.php?token=" . $token;
            // mail($email, "Password Reset", "Click here to reset: " . $resetLink);
            
            return "Check your email for the reset link.";
        }
        return "If that email exists, a link has been sent.";
    }
}
