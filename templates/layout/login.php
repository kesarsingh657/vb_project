<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login - Visitor Management</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: Arial;
            background: #ffffff;
        }

        .login-wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
        }

        .login-box {
            width: 420px;
            padding: 40px 35px;
            border-radius: 20px;
            background: white;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.08);
            text-align: center;
        }

    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-box">
        <?= $this->fetch('content') ?>
    </div>
</div>

</body>
</html>
