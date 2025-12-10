<?php
$this->assign('title','New Visitor - Group');
?>
<div class="page-wrapper">
  <div class="card">

    <div class="tab-container">
      <a href="/visitors/add-single" class="tab-inactive">Single Visit</a>
      <a href="/visitors/add-group" class="tab-active">Group Visit</a>
    </div>

    <?= $this->Form->create(null, ['url' => ['controller'=>'Visitors','action'=>'addGroup']]) ?>

    <div class="section-box">
      <label>Group Name *</label>
      <?= $this->Form->control('group_name', ['type'=>'text','class'=>'input-field','label'=>false,'required'=>true]) ?>

      <label>Visit Reason *</label>
      <?= $this->Form->control('visit_reason', [
            'type'=>'select',
            'options' => (isset($reasons) ? collection($reasons)->extract('reason')->toList() : []),
            'empty'=>'-- Select reason --',
            'class'=>'input-field',
            'label'=>false,
            'required'=>true
      ]) ?>

      <div class="row-4">
        <div class="col">
          <label>Visit Date</label>
          <?= $this->Form->control('visit_date', ['type'=>'date','class'=>'input-field','label'=>false,'value'=>date('Y-m-d')]) ?>
        </div>
        <div class="col">
          <label>Visit Time</label>
          <?= $this->Form->control('visit_time', ['type'=>'time','class'=>'input-field','label'=>false,'value'=>date('H:i')]) ?>
        </div>
      </div>
    </div>

    <div class="section-box">
      <h3 style="color:#ff4f63;margin-top:0;">Visitor List</h3>

      <div id="visitor-rows">
        <!-- Row 0 -->
        <div class="row-4 visitor-row" data-index="0">
          <div class="col">
            <label>Phone *</label>
            <input type="text" name="members[0][mobile]" class="input-field" required>
          </div>
          <div class="col">
            <label>Name *</label>
            <input type="text" name="members[0][name]" class="input-field" required>
          </div>
          <div class="col">
            <label>Email</label>
            <input type="text" name="members[0][email]" class="input-field">
          </div>
          <div class="col">
            <label>Address</label>
            <input type="text" name="members[0][address]" class="input-field">
          </div>
        </div>
      </div>

      <div style="margin-top:10px;">
        <button type="button" class="add-row-btn" onclick="addGroupRow()">+ Add Row</button>
      </div>
    </div>

    <div style="margin-top:12px;">
      <?= $this->Form->button('Create Group Visit', ['class'=>'btn-primary']) ?>
      <?= $this->Form->button('Save & Create New', ['type'=>'submit','class'=>'btn-secondary','name'=>'save_and_new']) ?>
    </div>

    <?= $this->Form->end() ?>

  </div>
</div>

<script>
let groupIndex = 0;
function addGroupRow(){
  groupIndex++;
  const html = `
    <div class="row-4 visitor-row" data-index="${groupIndex}">
      <div class="col">
        <label>Phone *</label>
        <input type="text" name="members[${groupIndex}][mobile]" class="input-field" required>
      </div>
      <div class="col">
        <label>Name *</label>
        <input type="text" name="members[${groupIndex}][name]" class="input-field" required>
      </div>
      <div class="col">
        <label>Email</label>
        <input type="text" name="members[${groupIndex}][email]" class="input-field">
      </div>
      <div class="col">
        <label>Address</label>
        <input type="text" name="members[${groupIndex}][address]" class="input-field">
      </div>
      <div style="display:flex;align-items:flex-end;">
        <button type="button" class="remove-btn" onclick="removeRow(${groupIndex})">Remove</button>
      </div>
    </div>
  `;
  document.getElementById('visitor-rows').insertAdjacentHTML('beforeend', html);
}
function removeRow(i){
  const el = document.querySelector('.visitor-row[data-index="'+i+'"]');
  if(el) el.remove();
}
</script>
