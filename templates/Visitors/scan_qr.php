<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<?= $this->element('sidebar') ?>

<div class="main-content" style="margin-left: 250px; padding: 20px;">
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="mb-4">📷 Scan Visitor QR Code</h3>

                <?= $this->Form->create(null, ['url' => ['action' => 'scanQr']]) ?>
                
                <div class="mb-3">
                    <input type="text" name="qr_code" class="form-control form-control-lg" 
                           placeholder="Scan or enter QR code" autofocus required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                    Search Visitor
                </button>

                <?= $this->Form->end() ?>

                <?php if (isset($found) && $found): ?>
                    <div class="alert alert-success mt-4">
                        <h4>✓ Visitor Found</h4>
                        <p><strong>Name:</strong> <?= h($visitor->visitor_name) ?></p>
                        <p><strong>Mobile:</strong> <?= h($visitor->mobile_number) ?></p>
                        <p><strong>Host:</strong> <?= h($visitor->host_name) ?></p>
                        <p><strong>Purpose:</strong> <?= h($visitor->visit_reason) ?></p>
                        
                        <?= $this->Html->link('Check In Visitor', 
                            ['action' => 'qrCheckIn', $visitor->id], 
                            ['class' => 'btn btn-success btn-lg mt-3']) ?>
                    </div>
                <?php elseif (isset($found) && !$found): ?>
                    <div class="alert alert-danger mt-4">
                        Invalid QR Code. Please try again.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>