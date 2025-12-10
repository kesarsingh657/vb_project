<!DOCTYPE html>
<html>
<head>
<style>

.page-wrapper {
    background: #f4f6f9;
    padding: 40px;
    display: flex;
    justify-content: center;
}

.form-card {
    width: 650px;
    background: #ffffff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.10);
}

.title {
    font-size: 22px;
    font-weight: bold;
    color: #ff4f63;
    margin-bottom: 25px;
    text-align: center;
}

.input-label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 6px;
    color: #555;
}

.input-box {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid #ddd;
    border-radius: 12px;
    margin-bottom: 18px;
    font-size: 15px;
    outline: none;
    background: #f8f8f8;
}

.main-btn {
    width: 100%;
    padding: 14px;
    background: #ff4f63;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 17px;
    cursor: pointer;
}

.main-btn:hover {
    background: #e93c55;
}

</style>
</head>

<body>

<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Account Settings</div>

        <?= $this->Form->create() ?>

        <!-- Username -->
        <label class="input-label">Username</label>
        <input class="input-box"
               type="text"
               name="username"
               value="<?= h($user['username']) ?>"
               required>

        <!-- Password -->
        <label class="input-label">Password</label>
        <input class="input-box"
               type="password"
               name="password"
               value="<?= h($user['password']) ?>"
               required>

        <!-- Submit -->
        <button class="main-btn" type="submit">Update Settings</button>

        <?= $this->Form->end() ?>

    </div>
</div>

</body>
</html>
