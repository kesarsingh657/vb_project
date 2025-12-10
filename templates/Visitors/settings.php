<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Settings</div>

        <?= $this->Form->create() ?>

        <input class="input-box" type="text" name="username" value="<?= $user->username ?>" required>
        <input class="input-box" type="text" name="password" value="<?= $user->password ?>" required>

        <button class="main-btn" type="submit">Update</button>

        <?= $this->Form->end() ?>
    </div>
</div>
