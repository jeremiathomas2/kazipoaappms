<header class="header">
      <button class="header-btn" id="sidebarToggle" onclick="toggleSidebar()" data-tip="Toggle Sidebar" style="margin-right: 8px;">
        <i class="fa fa-bars" id="toggleIcon"></i>
      </button>

      <div class="header-search">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Search professionals, bookings, clients…"/>
      </div>

      <div class="header-actions">

        <!-- Theme Toggle -->
        <button class="header-btn" onclick="toggleTheme()" data-tip="Toggle Dark Mode" id="themeBtn">
          <i class="fa fa-moon"></i>
        </button>

        <!-- Notifications -->
        <div class="dropdown" id="notifDropdown">
          <button class="header-btn" onclick="toggleDropdown('notifDropdown')" data-tip="Notifications">
            <i class="fa fa-bell"></i>
            <span class="header-badge"></span>
          </button>
          <div class="dropdown-menu" style="min-width:300px;padding:12px;">
            <div style="font-size:13px;font-weight:800;margin-bottom:10px;color:var(--text-primary)">Notifications</div>
            <div class="timeline">
              <div class="timeline-item">
                <div class="timeline-dot" style="background:var(--success)"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                  <div class="timeline-title">New booking accepted</div>
                  <div class="timeline-sub">Juma Hassan accepted a cleaning job</div>
                  <div class="timeline-time">2 min ago</div>
                </div>
              </div>
              <div class="timeline-item">
                <div class="timeline-dot" style="background:var(--accent)"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                  <div class="timeline-title">New Pro registered</div>
                  <div class="timeline-sub">Fatuma Ali joined as Electrician</div>
                  <div class="timeline-time">15 min ago</div>
                </div>
              </div>
              <div class="timeline-item">
                <div class="timeline-dot" style="background:var(--warning)"></div>
                <div class="timeline-line"></div>
                <div class="timeline-content">
                  <div class="timeline-title">Session about to start</div>
                  <div class="timeline-sub">KaziLive #4821 starts in 5 minutes</div>
                  <div class="timeline-time">5 min</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Settings quick -->
        <button class="header-btn" onclick="navigateTo('settings',null);toggleDropdown('notifDropdown',true)" data-tip="Settings">
          <i class="fa fa-gear"></i>
        </button>

        <div class="header-divider"></div>

        <!-- Profile -->
        <div class="dropdown" id="profileDropdown">
          <div class="header-avatar" onclick="toggleDropdown('profileDropdown')">A</div>
          <div class="dropdown-menu">
            <div style="padding:8px 12px 10px">
              <div style="font-size:14px;font-weight:800;color:var(--text-primary)">{{ auth()->user()->name ?? 'Admin User' }}</div>
              <div style="font-size:12px;color:var(--text-muted)">{{ auth()->user()->email ?? 'admin@kazipoa.com' }}</div>
            </div>
            <div class="dropdown-divider"></div>
            <a href="{{ route('profile.edit') }}" class="dropdown-item"><i class="fa fa-user"></i> My Profile</a>
            <a href="{{ route('settings.index') }}" class="dropdown-item"><i class="fa fa-gear"></i> Settings</a>
            <a href="{{ route('password.edit') }}" class="dropdown-item"><i class="fa fa-key"></i> Change Password</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none">@csrf</form>
            <a class="dropdown-item" style="color:var(--danger)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt" style="color:var(--danger)"></i> Logout
            </a>
          </div>
        </div>
      </div>
</header>
