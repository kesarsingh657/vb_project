<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - VB Visitor Management</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            border-top: 5px solid #dc3545;
        }
        .login-header { text-align: center; margin-bottom: 30px; }
        .login-header h1 { color: #dc3545; font-size: 26px; margin-bottom: 10px; }

        .form-group { margin-bottom: 20px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 12px; border: 2px solid #e0e0e0;
            border-radius: 5px; font-size: 14px;
        }
        .submit-btn {
            width: 100%; padding: 12px; background-color: #dc3545;
            color: white; border: none; border-radius: 5px;
            font-size: 16px; cursor: pointer;
        }
        .submit-btn:hover { background-color: #c82333; }

        .footer-text { text-align: center; color: #999; margin-top: 15px; font-size: 12px; }
    </style>

</head>
<body>

<div class="login-container">

    <div class="login-header">
        <h1>🔐 VB Admin</h1>
        <p>Visitor Management System</p>
    </div>

    <?= $this->Flash->render() ?>

    <?= $this->Form->create() ?>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your username" required autocomplete="off">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required autocomplete="off">
    </div>

    <button type="submit" class="submit-btn">Login</button>

    <?= $this->Form->end() ?>

    <div class="footer-text">
        <p><strong>Demo Credentials:</strong> admin / admin123</p>
    </div>

</div>

</body>
</html>
