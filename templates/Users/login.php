<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <?= $this->Html->css('login') ?>
</head>
<body>

<div class="login-wrapper">

    <div class="login-box">

        <h2 class="login-title">USER LOGIN</h2>

        <?= $this->Form->create(null, ['class' => 'login-form']) ?>

        <!-- ROLE -->
        <select name="role" required class="input-box">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="security">Security</option>
            <option value="employee">Employee</option>
        </select>

        <!-- USERNAME -->
        <input type="text" 
               name="username" 
               placeholder="username" 
               required 
               class="input-box">

        <!-- PASSWORD -->
        <input type="password" 
               name="password" 
               placeholder="password" 
               required 
               class="input-box">

        <!-- LOGIN BUTTON -->
        <button type="submit" class="login-btn">Login</button>

        <?= $this->Form->end() ?>

    </div>

</div>

</body>
</html>
