<!DOCTYPE html>
<html>
<head>
    <style>

    .page-wrapper {
        background: #f3f4f7;
        min-height: 100vh;
        padding: 40px;
        display: flex;
        justify-content: center;
    }

    .form-card {
        width: 900px;
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    .title {
        font-size: 22px;
        font-weight: bold;
        color: #ff4f63;
        margin-bottom: 25px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 30px;
    }

    .input-box {
        width: 100%;
        padding: 13px;
        border-radius: 12px;
        background: #f1f2f6;
        border: 1px solid #ddd;
        font-size: 15px;
        outline: none;
    }

    .textarea-box {
        width: 100%;
        padding: 13px;
        border-radius: 12px;
        background: #f1f2f6;
        border: 1px solid #ddd;
        font-size: 15px;
        height: 90px;
        resize: none;
        outline: none;
    }

    
    .photo-box {
        width: 160px;
        height: 190px;
        background: #e3e3e3;
        border-radius: 12px;
        border: 1px solid #ccc;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-btn {
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        background: #ff4f63;
        color: white;
        font-size: 14px;
        cursor: pointer;
    }

    /* Buttons */
    .btn-row {
        margin-top: 30px;
        display: flex;
        gap: 20px;
    }

    .main-btn {
        padding: 14px 20px;
        font-size: 16px;
        border-radius: 12px;
        border: none;
        background: #ff4f63;
        color: white;
        cursor: pointer;
        flex: 1;
    }

    .secondary-btn {
        padding: 14px 20px;
        font-size: 16px;
        border-radius: 12px;
        border: none;
        background: #ff7a89;
        color: white;
        cursor: pointer;
        flex: 1;
    }

    </style>
</head>

<body>

<div class="page-wrapper">
    <div class="form-card">

        <div class="title">Walk-In Visitor Registration</div>

        <?= $this->Form->create(null, ['type' => 'file']) ?>

        <div class="form-grid">

            <input type="text" name="visitor_mobile" class="input-box" placeholder="Visitor Mobile*" required>
            <input type="text" name="visitor_name" class="input-box" placeholder="Visitor Name*" required>

            <input type="email" name="visitor_email" class="input-box" placeholder="Email">
            <input type="text" name="company" class="input-box" placeholder="Company (optional)">

            <textarea name="visitor_address" class="textarea-box" placeholder="Visitor Address*" required></textarea>

            <select name="visit_reason" class="input-box" required>
                <option value="">Select Visit Reason*</option>
                <?php foreach ($reasons as $r): ?>
                    <option value="<?= $r->visit_reason ?>"><?= $r->visit_reason ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="host_name" class="input-box" placeholder="Host Name*" required>

            <input type="text" name="host_department" class="input-box" placeholder="Host Department*" required>
            <input type="text" name="host_mobile" class="input-box" placeholder="Host Mobile*" required>

            
            <input type="date" name="visit_date" class="input-box" required value="<?= date('Y-m-d') ?>">
            <input type="time" name="visit_time" class="input-box" required value="<?= date('H:i') ?>">

        </div>

        <br><br>

        
        <div class="section-title" style="color:#ff4f63;font-weight:bold;margin-bottom:10px;">Visitor Photo</div>

        <div class="photo-box" id="previewBox">
            <img id="previewImg" src="/img/default.png">
        </div>

        <input type="file" name="visitor_photo" accept="image/*" onchange="previewPhoto(this)" required class="upload-btn">

        <script>
        function previewPhoto(input) {
            let file = input.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = e => document.getElementById('previewImg').src = e.target.result;
                reader.readAsDataURL(file);
            }
        }
        </script>

        
        <div class="btn-row">
            <button class="main-btn" type="submit">Create Visit</button>
            <button class="secondary-btn" type="submit" name="save_and_new" value="1">Save & Create New</button>
        </div>

        <?= $this->Form->end() ?>

    </div>
</div>

</body>
</html>
