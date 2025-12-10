<?php
$this->assign('title','Admin Dashboard');
?>
<div class="page-wrapper">
  <div class="admin-card">

    <div class="top-section">
      <div>
        <span class="date-box">From: <input type="date" id="filterFrom"></span>
        <span class="date-box">To: <input type="date" id="filterTo"></span>
      </div>

      <input type="text" id="searchBox" class="search-input" placeholder="Search Visitor">

      <div class="btn-group">
        <a href="/visitors/add-single" class="btn-new">+ New Visitor</a>
        <a href="/invite" class="btn-invite">Invite Visitor</a>
      </div>
    </div>

    <h3>Today's Visitors</h3>

    <table>
      <tr>
        <th>Image</th>
        <th>Visitor</th>
        <th>Host</th>
        <th>Host Status</th>
        <th>Group</th>
        <th>Date-Time</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Action</th>
      </tr>

      <?php if (!empty($visits)): foreach ($visits as $v): ?>
      <tr>
        <td>
          <?php if (!empty($v->visitor_photo)): ?>
            <img src="<?= $this->Url->build('/img/'.$v->visitor_photo) ?>" alt="" style="width:45px;height:45px;border-radius:6px;">
          <?php else: ?>
            <div class="visitor-img"></div>
          <?php endif; ?>
        </td>
        <td>
          <?= h($v->visitor_name) ?><br>
          <small><?= h($v->visitor_mobile) ?></small>
        </td>
        <td>
          <?= h($v->host_name) ?><br><small><?= h($v->host_department) ?></small>
        </td>
        <td><?= h(ucfirst($v->host_status)) ?></td>
        <td><?= $v->group_visit ? 'Yes' : 'No' ?></td>
        <td><?= h($v->visit_date) ?> <?= h($v->visit_time) ?></td>
        <td>
          <?= $v->check_in ? h($v->check_in) : $this->Html->link('Check-In', ['controller'=>'Visitors','action'=>'checkIn',$v->id]) ?>
        </td>
        <td>
          <?= $v->check_out ? h($v->check_out) : $this->Html->link('Check-Out', ['controller'=>'Visitors','action'=>'checkOut',$v->id]) ?>
        </td>
        <td>
          <?= $this->Html->link('View', ['controller'=>'Visitors','action'=>'view',$v->id], ['class'=>'action-btn']) ?>
        </td>
      </tr>
      <?php endforeach; else: ?>
      <tr><td colspan="9" style="text-align:center;padding:20px;">No visits found</td></tr>
      <?php endif; ?>
    </table>

  </div>
</div>
