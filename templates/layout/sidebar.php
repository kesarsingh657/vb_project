<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $this->fetch('title') ?></title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #d7263d, #ff4f63);
            color: white;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .welcome-box {
            text-align: center;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
            font-size: 15px;
            transition: 0.25s;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
        }

        .active {
            background: rgba(255,255,255,0.28);
            border-left: 4px solid white;
            padding-left: 21px;
        }

        .menu-icon {
            font-size: 18px;
        }

        .content-area {
            margin-left: 240px;
            padding: 25px;
        }

    </style>
</head>

<body>

<?php
    $current = $this->request->getPath();
?>

<div class="sidebar">

    <h2>🔐 VB<br>Visitor Mgmt</h2>

    <div class="welcome-box">
        Welcome <b><?= $role ?? 'User' ?></b>
    </div>

    <!-- USING YOUR EXACT ROUTES NOW -->

    <a href="/dashboard/admin"
       class="menu-item <?= ($current == '/dashboard/admin') ? 'active' : '' ?>">
        <span class="menu-icon">📊</span> Dashboard
    </a>

    <a href="/visitors/add-single"
       class="menu-item <?= ($current == '/visitors/add-single') ? 'active' : '' ?>">
        <span class="menu-icon">➕</span> New Visitor
    </a>

    <a href="/visitors/invite"
       class="menu-item <?= ($current == '/visitors/invite') ? 'active' : '' ?>">
        <span class="menu-icon">✉️</span> Invite
    </a>

    <a href="/visitors/reports"
       class="menu-item <?= ($current == '/visitors/reports') ? 'active' : '' ?>">
        <span class="menu-icon">📄</span> Reports
    </a>

    <a href="/visitors/settings"
       class="menu-item <?= ($current == '/visitors/settings') ? 'active' : '' ?>">
        <span class="menu-icon">⚙️</span> Settings
    </a>

    <a href="/users/logout"
       class="menu-item <?= ($current == '/users/logout') ? 'active' : '' ?>">
        <span class="menu-icon">🚪</span> Logout
    </a>

</div>

<div class="content-area">
    <?= $this->fetch('content') ?>
</div>

</body>
</html>
