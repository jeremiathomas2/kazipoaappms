<aside class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
      <div class="logo-icon">K</div>
      <div class="brand-text">
        <span class="brand-name">Kazipoa</span>
        <span class="brand-tagline">Service Marketplace</span>
      </div>
    </div>

    <!-- Nav -->
    <nav class="sidebar-nav" id="sidebarNav">

      <!-- Main -->
      <div class="sidebar-section-title">Main</div>

      <div class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-th-large nav-icon"></i>
          <span class="sidebar-label">Dashboard</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
        <a href="{{ route('bookings.index') }}">
          <i class="fa fa-calendar-check nav-icon"></i>
          <span class="sidebar-label">Bookings</span>
          <span class="nav-badge danger">12</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('kazilive.*') ? 'open' : '' }}" id="navKazi">
        <a href="#" class="nav-link-btn" onclick="toggleSubMenu(event,'subKazi')">
          <i class="fa fa-bolt nav-icon"></i>
          <span class="sidebar-label">KaziLive</span>
          <span class="nav-badge success">3</span>
          <i class="fa fa-chevron-right sub-arrow"></i>
        </a>
        <div class="sub-menu" id="subKazi">
          <a href="{{ route('kazilive.index') }}" class="{{ request()->routeIs('kazilive.index') ? 'active' : '' }}"><i class="fa fa-circle-dot" style="width:14px;font-size:11px;color:var(--success)"></i> Active Sessions</a>
          <a href="{{ route('kazilive.upcoming') }}" class="{{ request()->routeIs('kazilive.upcoming') ? 'active' : '' }}"><i class="fa fa-clock" style="width:14px;font-size:11px"></i> Upcoming Sessions</a>
          <a href="{{ route('kazilive.history') }}" class="{{ request()->routeIs('kazilive.history') ? 'active' : '' }}"><i class="fa fa-history" style="width:14px;font-size:11px"></i> Session History</a>
        </div>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('professionals.*') ? 'active' : '' }}">
        <a href="{{ route('professionals.index') }}">
          <i class="fa fa-user-tie nav-icon"></i>
          <span class="sidebar-label">Professionals</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
        <a href="{{ route('clients.index') }}">
          <i class="fa fa-users nav-icon"></i>
          <span class="sidebar-label">Clients</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('chat.*') ? 'active' : '' }}" id="navChat">
        <a href="{{ route('chat.index') }}">
          <i class="fa fa-comment-dots nav-icon"></i>
          <span class="sidebar-label">Chat</span>
          <span class="nav-badge">5</span>
        </a>
      </div>

      <!-- Analytics -->
      <div class="sidebar-section-title">Analytics</div>

      <div class="sidebar-nav-item {{ request()->routeIs('analytics.*') ? 'active' : '' }}">
        <a href="{{ route('analytics.index') }}">
          <i class="fa fa-chart-line nav-icon"></i>
          <span class="sidebar-label">Analytics</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('reports.*') ? 'open' : '' }}" id="navReports">
        <a href="#" class="nav-link-btn" onclick="toggleSubMenu(event,'subReports')">
          <i class="fa fa-file-chart-column nav-icon"></i>
          <span class="sidebar-label">Reports</span>
          <i class="fa fa-chevron-right sub-arrow"></i>
        </a>
        <div class="sub-menu" id="subReports">
          <a href="{{ route('reports.bookings') }}" class="{{ request()->routeIs('reports.bookings') ? 'active' : '' }}"><i class="fa fa-chart-bar" style="width:14px;font-size:11px"></i> Booking Reports</a>
          <a href="{{ route('reports.revenue') }}" class="{{ request()->routeIs('reports.revenue') ? 'active' : '' }}"><i class="fa fa-chart-pie" style="width:14px;font-size:11px"></i> Revenue Reports</a>
          <a href="{{ route('reports.activity') }}" class="{{ request()->routeIs('reports.activity') ? 'active' : '' }}"><i class="fa fa-user-chart" style="width:14px;font-size:11px"></i> User Activity</a>
          <a href="{{ route('reports.regional') }}" class="{{ request()->routeIs('reports.regional') ? 'active' : '' }}"><i class="fa fa-map-marker-alt" style="width:14px;font-size:11px"></i> Regional Stats</a>
        </div>
      </div>

      <!-- System -->
      <div class="sidebar-section-title">System</div>

      <div class="sidebar-nav-item {{ request()->routeIs('schedule.*') ? 'active' : '' }}" id="navSchedule">
        <a href="{{ route('schedule.index') }}">
          <i class="fa fa-calendar-days nav-icon"></i>
          <span class="sidebar-label">Scheduling</span>
        </a>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('users.*') ? 'open' : '' }}" id="navUsers">
        <a href="#" class="nav-link-btn" onclick="toggleSubMenu(event,'subUsers')">
          <i class="fa fa-users-cog nav-icon"></i>
          <span class="sidebar-label">User Management</span>
          <i class="fa fa-chevron-right sub-arrow"></i>
        </a>
        <div class="sub-menu" id="subUsers">
          <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="fa fa-user-plus" style="width:14px;font-size:11px"></i> All Users</a>
          <a href="{{ route('users.suspensions') }}" class="{{ request()->routeIs('users.suspensions') ? 'active' : '' }}"><i class="fa fa-ban" style="width:14px;font-size:11px"></i> Suspensions</a>
          <a href="{{ route('users.verifications') }}" class="{{ request()->routeIs('users.verifications') ? 'active' : '' }}"><i class="fa fa-shield-check" style="width:14px;font-size:11px"></i> Verifications</a>
        </div>
      </div>

      <div class="sidebar-nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
        <a href="{{ route('settings.index') }}">
          <i class="fa fa-gear nav-icon"></i>
          <span class="sidebar-label">Settings</span>
        </a>
      </div>

    </nav>

    <!-- User -->
    <div class="sidebar-user" onclick="showToast('Profile settings coming soon','')">
      <div class="sidebar-user-avatar">A</div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name">{{ auth()->user()->name ?? 'Admin User' }}</span>
        <span class="sidebar-user-role">Super Admin</span>
      </div>
    </div>
</aside>
