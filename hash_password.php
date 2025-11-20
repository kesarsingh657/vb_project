<?php
/**
 * Password Hash Generator
 * File: vb_project/hash_password.php
 * 
 * This file generates the correct bcrypt hash for a password
 */

// Password you want to use
$password = "admin123";

// Generate bcrypt hash
$hash = password_hash($password, PASSWORD_BCRYPT);

// Display the hash
echo "Password: " . $password . "<br>";
echo "Hash: " . $hash . "<br>";
echo "<br><br>";
echo "Use this SQL command in phpMyAdmin:<br><br>";
echo "UPDATE admins SET password = '" . $hash . "' WHERE username = 'admin';<br><br>";

// Also verify it works
echo "Verification: ";
if (password_verify($password, $hash)) {
    echo "✅ Password verification WORKS!";
} else {
    echo "❌ Password verification FAILED!";
}
?>
```

7. **Save file:** `Ctrl + S`

---

## 🌐 **Now Open in Browser:**

1. Open your browser
2. Go to: `http://localhost/vb_project/hash_password.php`

3. You will see something like:
```
Password: admin123
Hash: $2y$10$XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

Use this SQL command in phpMyAdmin:

UPDATE admins SET password = '$2y$10$XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX' WHERE username = 'admin';

Verification: ✅ Password verification WORKS!
```

---

## 🔧 **Copy that SQL and Update Database:**

1. Open **phpMyAdmin** → `http://localhost/phpmyadmin`
2. Click on **vb_data** database
3. Go to **SQL** tab
4. **Paste the SQL command** from the output above
5. Click **Go**

---

## ✅ **Now Try Login:**

Go to: `http://localhost:8765/admin/login`

Use:
- **Username:** `admin`
- **Password:** `admin123`

---

## 📁 **Visual Directory Structure:**
```
C:\xampp\htdocs\
├── vb_project\
│   ├── src\
│   ├── templates\
│   ├── config\
│   ├── public\
│   ├── hash_password.php  ← CREATE THIS FILE HERE
│   └── ... (other files)