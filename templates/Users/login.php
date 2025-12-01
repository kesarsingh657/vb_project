<!DOCTYPE html>
<html>
<head>
    <title>Login - Visitor Management System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1 class="login-title">LAVA Visitor Management</h1>
            
            <?php if ($this->Flash->render()): ?>
                <div class="alert alert-error">
                    <?= $this->Flash->render() ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="/users/login" class="login-form">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="login-btn">LOGIN</button>
            </form>
            
            <div style="margin-top: 20px; padding: 15px; background-color: #f8f9fa; border-radius: 4px; font-size: 12px;">
                <strong>Demo Credentials:</strong><br>
                Security: security@lava.com / admin123<br>
                Employee: john@lava.com / admin123
            </div>
        </div>
    </div>
</body>
</html>