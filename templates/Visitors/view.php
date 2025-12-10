<!DOCTYPE html>
<html>
<head>
<style>

.page-wrapper {
    background: #f3f4f7;
    min-height: 100vh;
    padding: 35px;
    display: flex;
    justify-content: center;
}

.main-card {
    width: 1000px;
    background: #fff;
    padding: 30px;
    border-radius: 22px;
    box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
}

/* Layout */
.details-container {
    display: flex;
    gap: 25px;
    margin-bottom: 30px;
}

/* Photo Box */
.photo-box {
    width: 200px;
    height: 240px;
    border-radius: 12px;
    background: #ddd;
    background-size: cover;
    background-position: center;
    border: 1px solid #ccc;
}

.detail-section {
    flex: 1;
}

.section-title {
    font-size: 18px;
    font-weight: bold;
    color: #ff4f63;
    margin-bottom: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-top: 15px;
}

.info-box {
    background: #f8f8f8;
    padding: 12px 15px;
    border-radius: 14px;
    border: 1px solid #e0e0e0;
}

.info-label {
    font-size: 13px;
    color: #666;
}

.info-value {
    font-size: 15px;
    font-weight: bold;
    margin-top: 5px;
}

/* Download Button */
.download-btn {
    margin-top: 15px;
    padding: 10px 18px;
    background: #ff4f63;
    color: #fff;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

/* Table – Previous Visits */
.history-title {
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
    color: #ff4f63;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

th {
    background: #f6f6f6;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

.view-link {
    color: #ff4f63;
    font-weight: bold;
    cursor: pointer;
}

</style>
</head>

<body>

<div class="page-wrapper">
    <div class="main-card">

        <!-- TOP: Photo + Details -->
        <div class="details-container">

            <!-- Photo -->
            <div class="photo-box"
                 style="background-image:url('<?= $this->Url->build('/img/' . ($visit->visitor_photo ?? 'default.png')) ?>');">
            </div>

            <!-- Details Section -->
            <div class="detail-section">

                <div class="section-title">Visitor Details</div>

                <div class="info-grid">

                    <div class="info-box">
                        <div class="info-label">Visitor Name</div>
                        <div class="info-value"><?= h($visit->visitor_name) ?></div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Mobile</div>
                        <div class="info-value"><?= h($visit->visitor_mobile) ?></div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= h($visit->visitor_email) ?></div>
                    </div>

                    <div class="info-box">
                        <div class="info-label">Company</div>
                        <div class="info-value"><?= h($visit->company ?? 'N/A') ?></div>
                    </div>

                    <div class="info-box" style="grid-column: span 2;">
                        <div class="info-label">Address</div>
                        <div class="info-value"><?= h($visit->visitor_address) ?></div>
                    </div>

                </div>

                <a href="<?= $this->Url->build('/img/' . $visit->visitor_photo) ?>" download>
                    <button class="download-btn">Download Photo</button>
                </a>

            </div>

        </div>

        <!-- HOST DETAILS -->
        <div class="section-title">Host Details</div>

        <div class="info-grid">

            <div class="info-box">
                <div class="info-label">Host Name</div>
                <div class="info-value"><?= h($visit->host_name) ?></div>
            </div>

            <div class="info-box">
                <div class="info-label">Department</div>
                <div class="info-value"><?= h($visit->host_department) ?></div>
            </div>

            <div class="info-box">
                <div class="info-label">Host Mobile</div>
                <div class="info-value"><?= h($visit->host_mobile) ?></div>
            </div>

            <div class="info-box">
                <div class="info-label">Visit Reason</div>
                <div class="info-value"><?= h($visit->visit_reason) ?></div>
            </div>

        </div>

        <!-- PREVIOUS VISITS -->
        <div class="history-title">Previous Visits</div>

        <table>
            <tr>
                <th>Visit Date</th>
                <th>Host</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php foreach ($history as $h): ?>
                <tr>
                    <td><?= h($h->visit_date) ?></td>
                    <td><?= h($h->host_name) ?></td>
                    <td><?= h($h->host_department) ?></td>
                    <td><?= ucfirst($h->host_status) ?></td>
                    <td>
                        <a href="<?= $this->Url->build('/visitors/view/'.$h->id) ?>" class="view-link">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>
</div>

</body>
</html>
