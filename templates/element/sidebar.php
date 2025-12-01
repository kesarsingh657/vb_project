<!-- File: src/Template/Element/sidebar.ctp -->

<style>
/* ---------- SIDEBAR STYLES ---------- */
.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    min-height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    padding: 20px;
    color: white;
    z-index: 1000;
}

.logo {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
}

.logo h2 { 
    font-size: 22px; 
    margin: 0;
}

.logo p { 
    font-size: 12px; 
    opacity: 0.8; 
    margin: 5px 0 0 0;
}

.menu-items { 
    list-style: none; 
    padding: 0;
    margin: 0;
}

.menu-items li {
    margin-bottom: 8px;
}

.menu-items a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-radius: 5px;
    transition: all 0.3s;
    font-size: 14px;
}

.menu-items a:hover,
.menu-items a.active {
    background-color: rgba(255, 255, 255, 0.2);
    padding-left: 20px;
}

.menu-items a span {
    margin-right: 10px;
    font-size: 18px;
}
</style>

<!-- SIDEBAR HTML -->
<div class="sidebar">
    <div class="logo">
        <h2>🔐 VB</h2>
        <p>Visitor Mgmt</p>
    </div>

    <ul class="menu-items">
        <li>
            <a href="<?= $this->Url->build(['action' => 'dashboard']) ?>" 
               class="<?= ($this->request->getParam('action') == 'dashboard') ? 'active' : '' ?>">
                <span>📊</span> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" 
               class="<?= ($this->request->getParam('action') == 'add') ? 'active' : '' ?>">
                <span>👥</span> New Visitor
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['action' => 'invite']) ?>" 
               class="<?= ($this->request->getParam('action') == 'invite') ? 'active' : '' ?>">
                <span>✉️</span> Invite
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['action' => 'reports']) ?>" 
               class="<?= ($this->request->getParam('action') == 'reports') ? 'active' : '' ?>">
                <span>📈</span> Reports
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['action' => 'settings']) ?>" 
               class="<?= ($this->request->getParam('action') == 'settings') ? 'active' : '' ?>">
                <span>⚙️</span> Settings
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Admin', 'action' => 'logout']) ?>">
                <span>🚪</span> Logout
            </a>
        </li>
    </ul>
</div>