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
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 8px;
            width: 100%;
            max-width: 350px;
            border-top: 5px solid #dc3545;
            box-shadow: 0 4px 18px rgba(0,0,0,0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 22px;
        }

        .login-header h1 {
            color: #dc3545;
            font-size: 24px;
            font-weight: 600;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1.8px solid #dcdcdc;
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
            padding: 10px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
        }

        .submit-btn:hover {
            background: #b3202a;
        }

        .flash-message {
            padding: 10px;
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
        <h1>Login</h1>
        <p>Visitor Management System</p>
    </div>

    <!-- Flash Messages -->
    

    <!-- Login Form -->
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>

        <div class="form-group">
            <label for="role">Select Role</label>
            <select name="role" id="role" required onchange="autoFillCredentials()">
                <option value="">-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="security">Security</option>
                <option value="employee">Employee</option>
            </select>
        </div>

        <div class="form-group">
            <label>Username</label>
            <?= $this->Form->control('username', [
                'label' => false,
                'autocomplete' => 'off',
                'placeholder' => 'Enter your username',
                'required' => true,
                'id' => 'username'
            ]) ?>
        </div>

        <div class="form-group">
            <label>Password</label>
            <?= $this->Form->control('password', [
                'label' => false,
                'autocomplete' => 'off',
                'placeholder' => 'Enter your password',
                'required' => true,
                'id' => 'password'
            ]) ?>
        </div>

        <button class="submit-btn">Login</button>

    <?= $this->Form->end() ?>

</div>

<script>
document.getElementById('role').addEventListener('change', function() {
    const role = this.value;
    const credentials = {
        'admin': {username: 'admin', password: 'admin'},
        'security': {username: 'security', password: 'admin'},
        'employee': {username: 'employee', password: 'admin'}
    };
    
    if (credentials[role]) {
        document.getElementById('username').value = credentials[role].username;
        document.getElementById('password').value = credentials[role].password;
    }
});
</script>

</body>
</html>
