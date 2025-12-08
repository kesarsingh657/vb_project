<!-- File: templates/Users/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Visitor Management</title>

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
            width: 100%;
            max-width: 400px;
            border-top: 5px solid #dc3545;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }

        .login-header { text-align: center; margin-bottom: 25px; }
        .login-header h1 { color: #dc3545; font-size: 28px; }
        .login-header p { color: #777; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #dc3545;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn:hover { background: #b91d29; }

        .demo-box {
            margin-top: 20px;
            background: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 12px;
            border-radius: 5px;
        }

        .demo-box h4 { color: #dc3545; margin-bottom: 10px; font-size: 14px; }
        .demo-box p { font-size: 13px; margin: 4px 0; }

        .flash-message {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-header">
        <h1>🔐 Login</h1>
        <p>Visitor Management System</p>
    </div>

    <!-- Flash Messages -->
    <?= $this->Flash->render() ?>

    <!-- Login Form -->
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>

        <div class="form-group">
            <label for="role">Select Role</label>
            <select name="role" id="role" required onchange="autoFillCredentials()">
                <option value="">-- Select Role --</option>
                <option value="admin">👤 Admin</option>
                <option value="security">🔒 Security</option>
                <option value="employee">👔 Employee</option>
            </select>
        </div>

        <div class="form-group">
            <label>Username</label>
            <?= $this->Form->control('username', [
                'label' => false,
                'autocomplete' => 'off',
                'placeholder' => 'Enter your username',
                'required' => true
            ]) ?>
        </div>

        <div class="form-group">
            <label>Password</label>
            <?= $this->Form->control('password', [
                'label' => false,
                'autocomplete' => 'off',
                'placeholder' => 'Enter your password',
                'required' => true
            ]) ?>
        </div>

        <button class="submit-btn">Login</button>

    <?= $this->Form->end() ?>

    <!-- Demo Credential Box -->
    <div class="demo-box">
        <h4>Demo Credentials</h4>
        <p><strong>Admin:</strong> admin / admin</p>
        <p><strong>Security:</strong> security / security</p>
        <p><strong>Employee:</strong> employee / employee</p>
    </div>

</div>

<script>
    function autoFillCredentials() {
        let role = document.getElementById('role').value;
        document.getElementById("username").value = role ? role : '';
        document.getElementById("password").value = role ? role : '';
    }
</script>

</body>
</html>
