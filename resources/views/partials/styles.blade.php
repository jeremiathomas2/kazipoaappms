<style>
/* ===== CSS VARIABLES ===== */
:root {
  --primary: #1A6EFF;
  --primary-light: #EAF1FF;
  --primary-dark: #0F4FCC;
  --accent: #FF6B35;
  --accent-light: #FFF0EB;
  --success: #18C16E;
  --success-light: #E6FAF2;
  --warning: #F5A623;
  --warning-light: #FFF8EB;
  --danger: #F03E3E;
  --danger-light: #FFF0F0;
  --info: #6C63FF;

  /* Sidebar */
  --sidebar-bg: #0D1B2A;
  --sidebar-text: #B0BEC5;
  --sidebar-text-active: #FFFFFF;
  --sidebar-icon: #607D8B;
  --sidebar-icon-active: #1A6EFF;
  --sidebar-hover: rgba(26,110,255,0.10);
  --sidebar-active-bg: rgba(26,110,255,0.18);
  --sidebar-border: rgba(255,255,255,0.07);
  --sidebar-width: 260px;
  --sidebar-collapsed: 68px;
  --sidebar-sub-bg: rgba(0,0,0,0.18);

  /* Header */
  --header-bg: #FFFFFF;
  --header-border: #E8EAED;
  --header-text: #1C2B3A;
  --header-height: 64px;

  /* Footer */
  --footer-bg: #F4F6FA;
  --footer-border: #E0E4EE;
  --footer-text: #78849E;

  /* Body / Content */
  --body-bg: #F0F4FB;
  --card-bg: #FFFFFF;
  --card-border: #E6EAF2;
  --card-shadow: 0 2px 16px rgba(26,110,255,0.07);
  --card-shadow-hover: 0 8px 32px rgba(26,110,255,0.14);
  --text-primary: #1C2B3A;
  --text-secondary: #607D8B;
  --text-muted: #A0AEC0;
  --border-radius: 12px;
  --border-radius-sm: 8px;
  --border-radius-lg: 18px;

  /* Transitions */
  --transition: 0.22s cubic-bezier(0.4,0,0.2,1);
  --transition-slow: 0.4s cubic-bezier(0.4,0,0.2,1);

  font-family: 'Nunito Sans', sans-serif;
}

/* DARK THEME */
[data-theme="dark"] {
  --primary: #4D8EFF;
  --primary-light: rgba(77,142,255,0.12);
  --header-bg: #141C2B;
  --header-border: #1E2A3E;
  --header-text: #E2E8F0;
  --footer-bg: #0D1525;
  --footer-border: #1E2A3E;
  --footer-text: #607D8B;
  --body-bg: #0F1827;
  --card-bg: #141C2B;
  --card-border: #1E2A3E;
  --card-shadow: 0 2px 16px rgba(0,0,0,0.32);
  --card-shadow-hover: 0 8px 32px rgba(0,0,0,0.48);
  --text-primary: #E2E8F0;
  --text-secondary: #8096B0;
  --text-muted: #4A6080;
  --sidebar-bg: #0A1120;
  --sidebar-border: rgba(255,255,255,0.05);
  --success-light: rgba(24,193,110,0.1);
  --warning-light: rgba(245,166,35,0.1);
  --danger-light: rgba(240,62,62,0.1);
  --accent-light: rgba(255,107,53,0.1);
}

* { margin:0; padding:0; box-sizing:border-box; }

html, body {
  height: 100%;
  font-family: 'Nunito Sans', sans-serif;
  background: var(--body-bg);
  color: var(--text-primary);
  transition: background var(--transition), color var(--transition);
  overflow: hidden;
}

/* ===== LAYOUT ===== */
.app-layout {
  display: flex;
  height: 100vh;
  overflow: hidden;
}

/* ===== SIDEBAR ===== */
.sidebar {
  width: var(--sidebar-width);
  background: var(--sidebar-bg);
  display: flex;
  flex-direction: column;
  height: 100vh;
  position: relative;
  z-index: 100;
  transition: width var(--transition-slow), background var(--transition);
  flex-shrink: 0;
  box-shadow: 4px 0 24px rgba(0,0,0,0.15);
  overflow: hidden;
}

.sidebar.collapsed { width: var(--sidebar-collapsed); }
.sidebar.collapsed .sidebar-label,
.sidebar.collapsed .nav-badge,
.sidebar.collapsed .sub-arrow,
.sidebar.collapsed .sidebar-section-title,
.sidebar.collapsed .brand-text,
.sidebar.collapsed .sidebar-user-info,
.sidebar.collapsed .sub-menu { display: none !important; }
.sidebar.collapsed .sidebar-logo { justify-content: center; padding: 18px 0; }
.sidebar.collapsed .sidebar-nav-item > a { justify-content: center; padding: 13px 0; }
.sidebar.collapsed .sidebar-user { justify-content: center; padding: 12px 0; }
.sidebar.collapsed .sidebar-user-avatar { margin:0; }

/* Logo */
.sidebar-logo {
  display: flex; align-items: center; gap: 12px;
  padding: 20px 20px 16px;
  border-bottom: 1px solid var(--sidebar-border);
  transition: padding var(--transition);
  flex-shrink: 0;
}

.logo-icon {
  width: 38px; height: 38px;
  background: linear-gradient(135deg, var(--primary) 0%, #6C63FF 100%);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; color: #fff; font-weight: 900;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(26,110,255,0.4);
}

.brand-text { display: flex; flex-direction: column; line-height: 1; }
.brand-name { color: #fff; font-size: 18px; font-weight: 800; letter-spacing: -0.3px; }
.brand-tagline { color: var(--sidebar-text); font-size: 10px; font-weight: 500; letter-spacing: 0.8px; text-transform: uppercase; margin-top: 2px; }

/* Sidebar nav */
.sidebar-nav {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 12px 0;
  scrollbar-width: thin;
  scrollbar-color: rgba(255,255,255,0.08) transparent;
}
.sidebar-nav::-webkit-scrollbar { width: 4px; }
.sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 2px; }

.sidebar-section-title {
  font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
  text-transform: uppercase; color: var(--sidebar-icon);
  padding: 16px 20px 6px;
  transition: opacity var(--transition);
}

/* Nav items */
.sidebar-nav-item { position: relative; }

.sidebar-nav-item > a,
.sidebar-nav-item > .nav-link-btn {
  display: flex; align-items: center; gap: 12px;
  padding: 11px 20px;
  color: var(--sidebar-text);
  text-decoration: none;
  font-size: 13.5px; font-weight: 600;
  border-left: 3px solid transparent;
  transition: all var(--transition);
  cursor: pointer;
  background: none; border: none; width: 100%;
  position: relative; overflow: hidden;
  white-space: nowrap;
}

.sidebar-nav-item > a::before,
.sidebar-nav-item > .nav-link-btn::before {
  content: ''; position: absolute; inset: 0;
  background: var(--sidebar-hover);
  opacity: 0; transition: opacity var(--transition);
  border-radius: 0 8px 8px 0;
}

.sidebar-nav-item > a:hover::before,
.sidebar-nav-item > .nav-link-btn:hover::before { opacity: 1; }

.sidebar-nav-item > a:hover,
.sidebar-nav-item > .nav-link-btn:hover {
  color: var(--sidebar-text-active);
  border-left-color: var(--primary);
}
.sidebar-nav-item > a:hover .nav-icon,
.sidebar-nav-item > .nav-link-btn:hover .nav-icon { color: var(--primary); }

.sidebar-nav-item.active > a,
.sidebar-nav-item.active > .nav-link-btn {
  color: var(--sidebar-text-active);
  background: var(--sidebar-active-bg);
  border-left-color: var(--primary);
}
.sidebar-nav-item.active > a .nav-icon,
.sidebar-nav-item.active > .nav-link-btn .nav-icon { color: var(--primary); }

.nav-icon {
  width: 20px; text-align: center;
  font-size: 15px; color: var(--sidebar-icon);
  transition: color var(--transition), transform var(--transition);
  flex-shrink: 0;
}

.nav-badge {
  margin-left: auto;
  background: var(--primary);
  color: #fff; font-size: 10px; font-weight: 700;
  padding: 2px 7px; border-radius: 20px;
  line-height: 1.4;
  transition: transform var(--transition);
}
.nav-badge.danger { background: var(--danger); }
.nav-badge.success { background: var(--success); }
.nav-badge.warning { background: var(--warning); color: #1C2B3A; }

.sub-arrow {
  margin-left: auto; font-size: 10px;
  color: var(--sidebar-icon);
  transition: transform var(--transition), color var(--transition);
}
.sidebar-nav-item.open > a .sub-arrow,
.sidebar-nav-item.open > .nav-link-btn .sub-arrow { transform: rotate(90deg); color: var(--primary); }

/* Submenu */
.sub-menu {
  overflow: hidden;
  max-height: 0;
  background: var(--sidebar-sub-bg);
  transition: max-height 0.38s cubic-bezier(0.4,0,0.2,1), opacity 0.3s;
  opacity: 0;
}
.sidebar-nav-item.open .sub-menu { max-height: 600px; opacity: 1; }

.sub-menu a {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 20px 9px 52px;
  color: var(--sidebar-text);
  text-decoration: none; font-size: 12.5px; font-weight: 500;
  transition: all var(--transition);
  white-space: nowrap;
  position: relative;
}

.sub-menu a::before {
  content: ''; position: absolute; left: 38px; top: 50%;
  transform: translateY(-50%);
  width: 5px; height: 5px; border-radius: 50%;
  background: var(--sidebar-icon);
  transition: background var(--transition), transform var(--transition);
}

.sub-menu a:hover { color: var(--sidebar-text-active); background: var(--sidebar-hover); }
.sub-menu a:hover::before { background: var(--primary); transform: translateY(-50%) scale(1.5); }
.sub-menu a.active { color: var(--primary); font-weight: 700; }
.sub-menu a.active::before { background: var(--primary); }

/* Sidebar user */
.sidebar-user {
  display: flex; align-items: center; gap: 10px;
  padding: 14px 18px;
  border-top: 1px solid var(--sidebar-border);
  margin-top: auto; cursor: pointer;
  transition: background var(--transition);
}
.sidebar-user:hover { background: var(--sidebar-hover); }

.sidebar-user-avatar {
  width: 36px; height: 36px; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--info));
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-size: 14px; font-weight: 800;
  flex-shrink: 0;
}

.sidebar-user-info { display: flex; flex-direction: column; }
.sidebar-user-name { color: #fff; font-size: 13px; font-weight: 700; }
.sidebar-user-role { color: var(--sidebar-icon); font-size: 11px; font-weight: 500; }

/* ===== MAIN CONTENT ===== */
.main-content {
  flex: 1; display: flex; flex-direction: column;
  height: 100vh; overflow: hidden;
  min-width: 0;
  transition: all var(--transition);
}

/* ===== HEADER ===== */
.header {
  height: var(--header-height);
  background: var(--header-bg);
  border-bottom: 1px solid var(--header-border);
  display: flex; align-items: center;
  padding: 0 24px; gap: 16px;
  z-index: 50; flex-shrink: 0;
  transition: background var(--transition), border-color var(--transition);
}

.header-search {
  flex: 1; max-width: 380px;
  display: flex; align-items: center; gap: 10px;
  background: var(--body-bg);
  border: 1.5px solid var(--card-border);
  border-radius: 24px; padding: 7px 16px;
  transition: all var(--transition);
}
.header-search:focus-within {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-light);
}
.header-search i { color: var(--text-muted); font-size: 13px; }
.header-search input {
  border: none; background: transparent; font-family: 'Nunito Sans', sans-serif;
  font-size: 13.5px; color: var(--text-primary); flex: 1; outline: none;
}
.header-search input::placeholder { color: var(--text-muted); }

.header-actions {
  display: flex; align-items: center; gap: 8px; margin-left: auto;
}

.header-btn {
  width: 38px; height: 38px; border-radius: 10px;
  border: none; cursor: pointer; background: var(--body-bg);
  color: var(--text-secondary); font-size: 15px;
  display: flex; align-items: center; justify-content: center;
  position: relative; transition: all var(--transition);
}
.header-btn:hover { background: var(--primary-light); color: var(--primary); transform: translateY(-1px); }

.header-badge {
  position: absolute; top: 4px; right: 4px;
  width: 8px; height: 8px; background: var(--danger);
  border-radius: 50%; border: 2px solid var(--header-bg);
}

.header-avatar {
  width: 38px; height: 38px; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--info));
  color: #fff; font-weight: 800; font-size: 14px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; flex-shrink: 0;
  border: 2px solid var(--primary-light);
  transition: all var(--transition);
}
.header-avatar:hover { transform: scale(1.08); box-shadow: 0 4px 12px rgba(26,110,255,0.3); }

.header-divider { width: 1px; height: 24px; background: var(--card-border); margin: 0 4px; }

/* Dropdown */
.dropdown { position: relative; }
.dropdown-menu {
  position: absolute; top: calc(100% + 10px); right: 0;
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius); padding: 8px;
  min-width: 200px; z-index: 1000;
  box-shadow: var(--card-shadow-hover);
  display: none; animation: dropDown 0.18s ease;
}
.dropdown.open .dropdown-menu { display: block; }

@keyframes dropDown {
  from { opacity:0; transform: translateY(-8px); }
  to { opacity:1; transform: translateY(0); }
}

.dropdown-item {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 12px; border-radius: 8px;
  color: var(--text-primary); text-decoration: none;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: all var(--transition);
}
.dropdown-item:hover { background: var(--primary-light); color: var(--primary); }
.dropdown-item i { width: 16px; text-align: center; font-size: 13px; color: var(--text-muted); }
.dropdown-item:hover i { color: var(--primary); }
.dropdown-divider { height: 1px; background: var(--card-border); margin: 6px 0; }

/* ===== PAGE CONTENT ===== */
.page-content {
  flex: 1; overflow-y: auto; overflow-x: hidden;
  padding: 24px;
  scrollbar-width: thin;
  scrollbar-color: var(--card-border) transparent;
}
.page-content::-webkit-scrollbar { width: 6px; }
.page-content::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 3px; }

/* Pages */
.page { display: none; animation: fadeIn 0.28s ease; }
.page.active { display: block; }

@keyframes fadeIn {
  from { opacity:0; transform: translateY(8px); }
  to { opacity:1; transform: translateY(0); }
}

/* Page header */
.page-header {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
}
.page-title { font-size: 22px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }
.page-subtitle { font-size: 13px; color: var(--text-secondary); margin-top: 2px; font-weight: 500; }
.page-header-actions { display: flex; gap: 10px; flex-wrap: wrap; }

/* ===== BUTTONS ===== */
.btn {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 9px 20px; border-radius: var(--border-radius-sm);
  font-size: 13px; font-weight: 700; font-family: 'Nunito Sans', sans-serif;
  cursor: pointer; border: none; transition: all var(--transition);
  text-decoration: none; line-height: 1;
}
.btn-primary { background: var(--primary); color: #fff; box-shadow: 0 3px 10px rgba(26,110,255,0.3); }
.btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(26,110,255,0.4); }
.btn-secondary { background: var(--body-bg); color: var(--text-primary); border: 1.5px solid var(--card-border); }
.btn-secondary:hover { background: var(--primary-light); color: var(--primary); border-color: var(--primary); transform: translateY(-1px); }
.btn-success { background: var(--success); color: #fff; }
.btn-success:hover { background: #12a55e; transform: translateY(-2px); }
.btn-danger { background: var(--danger); color: #fff; }
.btn-danger:hover { background: #d43030; transform: translateY(-2px); }
.btn-accent { background: var(--accent); color: #fff; }
.btn-accent:hover { background: #e55c25; transform: translateY(-2px); }
.btn-sm { padding: 6px 14px; font-size: 12px; }
.btn-lg { padding: 12px 28px; font-size: 15px; }
.btn-icon { padding: 9px; border-radius: 8px; }

/* ===== CARDS ===== */
.card {
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-lg); padding: 20px;
  box-shadow: var(--card-shadow);
  transition: all var(--transition);
}
.card:hover { box-shadow: var(--card-shadow-hover); }
body.no-hover-lift .card:hover { transform: none !important; }

/* Filter Bar */
.filter-bar {
  background: var(--card-bg);
  border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius);
  padding: 12px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
  flex-wrap: wrap;
}
.filter-item { flex: 1; min-width: 150px; }
.view-switcher {
  display: flex;
  background: var(--body-bg);
  border-radius: 8px;
  padding: 4px;
  gap: 4px;
}
.view-btn {
  width: 36px; height: 36px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 6px; border: none; background: transparent;
  color: var(--text-muted); cursor: pointer; transition: all var(--transition);
}
.view-btn.active {
  background: var(--card-bg);
  color: var(--primary);
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* Professional List View */
.pro-list { display: flex; flex-direction: column; gap: 12px; }
.pro-list-item {
  background: var(--card-bg);
  border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius);
  padding: 14px 20px;
  display: flex;
  align-items: center;
  gap: 20px;
  transition: all var(--transition);
}
.pro-list-item:hover { transform: translateX(5px); border-color: var(--primary); }
.pro-list-info { flex: 1; display: flex; align-items: center; gap: 20px; }
.pro-list-meta { display: flex; gap: 24px; color: var(--text-secondary); font-size: 13px; font-weight: 600; }
.card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
.card-title { font-size: 15px; font-weight: 800; color: var(--text-primary); }
.card-subtitle { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

/* ===== STAT CARDS ===== */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px; margin-bottom: 24px;
}

.stat-card {
  background: var(--card-bg);
  border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-lg);
  padding: 20px 22px;
  display: flex; align-items: flex-start; justify-content: space-between;
  transition: all var(--transition);
  box-shadow: var(--card-shadow);
  position: relative; overflow: hidden;
}

.stat-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 3px; border-radius: 2px 2px 0 0;
  background: var(--stat-color, var(--primary));
}

.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--card-shadow-hover);
}

.stat-info { flex: 1; }
.stat-label { font-size: 12px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.6px; }
.stat-value { font-size: 28px; font-weight: 900; color: var(--text-primary); margin: 4px 0 6px; letter-spacing: -1px; }
.stat-change { font-size: 12px; font-weight: 700; display: flex; align-items: center; gap: 4px; }
.stat-change.up { color: var(--success); }
.stat-change.down { color: var(--danger); }

.stat-icon {
  width: 48px; height: 48px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px; flex-shrink: 0;
  background: var(--stat-icon-bg, var(--primary-light));
  color: var(--stat-color, var(--primary));
}

/* ===== GRIDS ===== */
.grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 16px; }
.grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }
.grid-1-2 { display: grid; grid-template-columns: 1fr 2fr; gap: 16px; }
.grid-2-1 { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; }

/* ===== TABLE ===== */
.table-wrap { overflow-x: auto; border-radius: var(--border-radius); }
table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
thead th {
  padding: 12px 16px; text-align: left;
  background: var(--body-bg); color: var(--text-muted);
  font-size: 11px; font-weight: 700; letter-spacing: 0.8px;
  text-transform: uppercase; white-space: nowrap;
  border-bottom: 1px solid var(--card-border);
}
tbody td {
  padding: 13px 16px; border-bottom: 1px solid var(--card-border);
  color: var(--text-primary); vertical-align: middle;
  transition: background var(--transition);
}
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover td { background: var(--primary-light); }

/* ===== BADGES ===== */
.badge {
  display: inline-flex; align-items: center; gap: 4px;
  padding: 3px 10px; border-radius: 20px;
  font-size: 11px; font-weight: 700; white-space: nowrap;
}
.badge-primary { background: var(--primary-light); color: var(--primary); }
.badge-success { background: var(--success-light); color: var(--success); }
.badge-warning { background: var(--warning-light); color: var(--warning); }
.badge-danger { background: var(--danger-light); color: var(--danger); }
.badge-accent { background: var(--accent-light); color: var(--accent); }
.badge-info { background: rgba(108,99,255,0.1); color: var(--info); }

/* ===== AVATAR GROUP ===== */
.avatar { width:32px;height:32px;border-radius:50%;object-fit:cover;background:var(--primary-light);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:var(--primary);flex-shrink:0; }

/* ===== PROGRESS ===== */
.progress { height: 6px; background: var(--card-border); border-radius: 3px; overflow: hidden; }
.progress-bar {
  height: 100%; border-radius: 3px;
  background: var(--primary);
  transition: width 0.8s cubic-bezier(0.4,0,0.2,1);
}

/* ===== TOGGLE ===== */
.toggle-switch {
  position: relative; width: 40px; height: 22px;
  display: inline-block;
}
.toggle-switch input { opacity:0;width:0;height:0;position:absolute; }
.toggle-slider {
  position: absolute; inset: 0;
  background: var(--card-border); border-radius: 22px;
  cursor: pointer; transition: background var(--transition);
}
.toggle-slider::before {
  content: ''; position: absolute;
  width: 16px; height: 16px; background: #fff;
  border-radius: 50%; left: 3px; top: 3px;
  transition: transform var(--transition);
  box-shadow: 0 1px 4px rgba(0,0,0,0.2);
}
.toggle-switch input:checked + .toggle-slider { background: var(--primary); }
.toggle-switch input:checked + .toggle-slider::before { transform: translateX(18px); }

/* ===== FORM ELEMENTS ===== */
.form-group { margin-bottom: 16px; }
.form-label { display: block; font-size: 12px; font-weight: 700; color: var(--text-secondary); margin-bottom: 6px; letter-spacing: 0.4px; text-transform: uppercase; }
.form-control {
  width: 100%; padding: 10px 14px;
  background: var(--body-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-sm);
  color: var(--text-primary); font-family: 'Nunito Sans', sans-serif;
  font-size: 13.5px; font-weight: 500;
  transition: all var(--transition); outline: none;
}
.form-control:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px var(--primary-light);
}
select.form-control { cursor: pointer; }

/* ===== COLOR PICKER INPUT ===== */
.color-input-row {
  display: flex; align-items: center; gap: 10px;
}
.color-preview {
  width: 36px; height: 36px; border-radius: 8px;
  border: 2px solid var(--card-border); cursor: pointer;
  overflow: hidden; flex-shrink: 0;
}
.color-preview input[type=color] {
  width: 100%; height: 100%; border: none;
  cursor: pointer; padding: 0; opacity: 0;
  position: absolute;
}
.color-swatch {
  width: 100%; height: 100%; border-radius: 6px;
}

/* ===== FOOTER ===== */
.footer {
  background: var(--footer-bg);
  border-top: 1px solid var(--footer-border);
  padding: 12px 24px;
  display: flex; align-items: center; justify-content: space-between;
  font-size: 12px; color: var(--footer-text); font-weight: 500;
  flex-shrink: 0;
  transition: background var(--transition), border-color var(--transition);
}
.footer a { color: var(--primary); text-decoration: none; font-weight: 700; }
.footer-links { display: flex; gap: 16px; }

/* ===== MINI CHART (SVG) ===== */
.sparkline { width: 100%; height: 50px; }

/* ===== PROFILE CARD ===== */
.pro-card {
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-lg); padding: 18px;
  display: flex; flex-direction: column; gap: 12px;
  transition: all var(--transition);
  box-shadow: var(--card-shadow);
}
.pro-card:hover { transform: translateY(-3px); box-shadow: var(--card-shadow-hover); }

.pro-card-top { display: flex; align-items: center; gap: 12px; }
.pro-avatar {
  width: 48px; height: 48px; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--info));
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; font-weight: 800; color: #fff; flex-shrink: 0;
}
.pro-name { font-size: 14px; font-weight: 800; color: var(--text-primary); }
.pro-service { font-size: 12px; color: var(--text-muted); margin-top: 1px; font-weight: 500; }
.pro-verified { color: var(--primary); font-size: 11px; margin-top: 2px; }

.pro-rating { display: flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 700; color: var(--warning); }
.pro-stats { display: flex; gap: 12px; }
.pro-stat { text-align: center; }
.pro-stat-value { font-size: 15px; font-weight: 900; color: var(--text-primary); }
.pro-stat-label { font-size: 10px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }

.pro-card-btns { display: flex; gap: 8px; }
.pro-card-btns .btn { flex: 1; justify-content: center; }

/* ===== LIVE SESSION CARD ===== */
.live-card {
  background: linear-gradient(135deg, #0D1B2A 0%, #1A2E45 100%);
  border: 1.5px solid rgba(26,110,255,0.25);
  border-radius: var(--border-radius-lg);
  padding: 20px; color: #fff;
  position: relative; overflow: hidden;
  box-shadow: 0 8px 32px rgba(26,110,255,0.2);
  transition: all var(--transition);
}
.live-card:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(26,110,255,0.3); }
.live-card::before {
  content: ''; position: absolute;
  width: 200px; height: 200px;
  background: radial-gradient(circle, rgba(26,110,255,0.15) 0%, transparent 70%);
  top: -60px; right: -60px;
  border-radius: 50%;
}
.live-pulse {
  display: inline-flex; align-items: center; gap: 6px;
  background: rgba(240,62,62,0.15); border: 1px solid rgba(240,62,62,0.4);
  border-radius: 20px; padding: 3px 10px;
  font-size: 11px; font-weight: 700; color: #FF6B6B; margin-bottom: 10px;
}
.live-dot {
  width: 7px; height: 7px; background: var(--danger); border-radius: 50%;
  animation: pulse-dot 1.2s infinite;
}
@keyframes pulse-dot {
  0%,100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.5; transform: scale(1.3); }
}
.live-title { font-size: 16px; font-weight: 800; margin-bottom: 4px; }
.live-sub { font-size: 12px; color: rgba(255,255,255,0.6); }
.live-timer { font-size: 28px; font-weight: 900; letter-spacing: -1px; margin: 10px 0; font-variant-numeric: tabular-nums; }
.live-actions { display: flex; gap: 8px; }

/* ===== CHAT ===== */
.chat-layout {
  display: grid; grid-template-columns: 280px 1fr;
  height: calc(100vh - var(--header-height) - 60px - 48px);
  gap: 0; border-radius: var(--border-radius-lg); overflow: hidden;
  border: 1.5px solid var(--card-border);
  background: var(--card-bg);
  box-shadow: var(--card-shadow);
}
.chat-sidebar {
  border-right: 1px solid var(--card-border);
  display: flex; flex-direction: column;
}
.chat-sidebar-header {
  padding: 16px; border-bottom: 1px solid var(--card-border);
  font-size: 14px; font-weight: 800;
}
.chat-list { flex: 1; overflow-y: auto; }
.chat-item {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; cursor: pointer;
  transition: background var(--transition);
  border-left: 3px solid transparent;
}
.chat-item:hover, .chat-item.active {
  background: var(--primary-light);
  border-left-color: var(--primary);
}
.chat-item-name { font-size: 13px; font-weight: 700; color: var(--text-primary); }
.chat-item-preview { font-size: 12px; color: var(--text-muted); }
.chat-item-time { font-size: 10px; color: var(--text-muted); margin-left: auto; white-space: nowrap; }
.chat-main {
  display: flex; flex-direction: column;
}
.chat-header {
  padding: 14px 18px; border-bottom: 1px solid var(--card-border);
  display: flex; align-items: center; gap: 12px;
}
.chat-messages {
  flex: 1; overflow-y: auto; padding: 16px;
  display: flex; flex-direction: column; gap: 12px;
}
.msg { display: flex; gap: 8px; max-width: 72%; }
.msg.out { margin-left: auto; flex-direction: row-reverse; }
.msg-bubble {
  padding: 10px 14px; border-radius: 16px;
  font-size: 13.5px; font-weight: 500; line-height: 1.5;
}
.msg .msg-bubble { background: var(--body-bg); color: var(--text-primary); border-radius: 4px 16px 16px 16px; }
.msg.out .msg-bubble { background: var(--primary); color: #fff; border-radius: 16px 4px 16px 16px; }
.msg-time { font-size: 10px; color: var(--text-muted); margin-top: 4px; text-align: right; }
.chat-input-area {
  padding: 14px 18px; border-top: 1px solid var(--card-border);
  display: flex; gap: 10px; align-items: center;
}
.chat-input {
  flex: 1; padding: 10px 14px;
  background: var(--body-bg); border: 1.5px solid var(--card-border);
  border-radius: 24px; font-family: 'Nunito Sans',sans-serif;
  font-size: 13.5px; color: var(--text-primary); outline: none;
  transition: all var(--transition);
}
.chat-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }

/* ===== BOOKING CARDS ===== */
.booking-card {
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-lg); padding: 18px;
  box-shadow: var(--card-shadow); transition: all var(--transition);
  display: flex; flex-direction: column; gap: 12px;
}
.booking-card:hover { transform: translateY(-2px); box-shadow: var(--card-shadow-hover); }
.booking-card-header { display: flex; justify-content: space-between; align-items: flex-start; }
.booking-id { font-size: 11px; color: var(--text-muted); font-weight: 700; }
.booking-title { font-size: 14px; font-weight: 800; color: var(--text-primary); margin-top: 2px; }
.booking-meta { display: flex; flex-wrap: wrap; gap: 8px; }
.booking-meta-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: var(--text-secondary); font-weight: 500; }
.booking-meta-item i { font-size: 11px; color: var(--text-muted); }
.booking-actions { display: flex; gap: 8px; justify-content: flex-end; }

/* ===== SETTINGS PANEL ===== */
.settings-section { margin-bottom: 28px; }
.settings-section-title {
  font-size: 13px; font-weight: 800; color: var(--text-primary);
  margin-bottom: 14px; padding-bottom: 8px;
  border-bottom: 1.5px solid var(--card-border);
  text-transform: uppercase; letter-spacing: 0.5px;
}
.settings-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 12px 0; border-bottom: 1px solid var(--card-border);
}
.settings-row:last-child { border-bottom: none; }
.settings-label { font-size: 13.5px; font-weight: 600; color: var(--text-primary); }
.settings-desc { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

/* ===== ANALYTICS ===== */
.chart-placeholder {
  height: 200px;
  background: var(--body-bg);
  border-radius: 10px;
  display: flex; align-items: flex-end;
  padding: 0 12px 16px;
  gap: 8px; overflow: hidden;
}
.chart-bar {
  flex: 1; border-radius: 4px 4px 0 0;
  background: var(--primary); opacity: 0.7;
  transition: all 0.6s cubic-bezier(0.4,0,0.2,1);
  min-width: 0;
}
.chart-bar:nth-child(odd) { opacity: 0.5; }
.chart-bar:hover { opacity: 1; transform: scaleY(1.04); cursor: pointer; }

/* ===== TIMELINE ===== */
.timeline { display: flex; flex-direction: column; gap: 0; }
.timeline-item { display: flex; gap: 14px; padding: 0 0 18px; position: relative; }
.timeline-item:last-child { padding-bottom: 0; }
.timeline-dot {
  width: 12px; height: 12px; border-radius: 50%;
  background: var(--primary); flex-shrink: 0; margin-top: 5px;
  box-shadow: 0 0 0 3px var(--primary-light);
}
.timeline-line {
  position: absolute; left: 5px; top: 17px; bottom: 0;
  width: 2px; background: var(--card-border);
}
.timeline-item:last-child .timeline-line { display: none; }
.timeline-content { flex: 1; }
.timeline-title { font-size: 13px; font-weight: 700; color: var(--text-primary); }
.timeline-sub { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
.timeline-time { font-size: 11px; color: var(--text-muted); font-weight: 600; }

/* ===== BREADCRUMB ===== */
.breadcrumb {
  display: flex; align-items: center; gap: 6px;
  font-size: 12.5px; color: var(--text-muted); margin-bottom: 20px; font-weight: 600;
}
.breadcrumb a { color: var(--primary); text-decoration: none; }
.breadcrumb span { color: var(--text-muted); }

/* ===== NOTIFICATION TOAST ===== */
.toast-container {
  position: fixed; top: 80px; right: 24px;
  z-index: 9999; display: flex; flex-direction: column; gap: 8px;
}
.toast {
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius); padding: 14px 18px;
  box-shadow: var(--card-shadow-hover);
  display: flex; align-items: center; gap: 12px;
  min-width: 280px; animation: slideInToast 0.3s ease;
  font-size: 13.5px; font-weight: 600;
  border-left: 4px solid var(--primary);
}
@keyframes slideInToast {
  from { opacity:0; transform: translateX(40px); }
  to { opacity:1; transform: translateX(0); }
}
.toast.success { border-left-color: var(--success); }
.toast.warning { border-left-color: var(--warning); }
.toast.danger { border-left-color: var(--danger); }

/* ===== MODAL ===== */
.modal-overlay {
  position: fixed; inset: 0; background: rgba(0,0,0,0.45);
  z-index: 5000; display: none; align-items: center; justify-content: center;
  backdrop-filter: blur(4px);
  animation: fadeIn 0.2s ease;
}
.modal-overlay.open { display: flex; }
.modal {
  background: var(--card-bg); border: 1.5px solid var(--card-border);
  border-radius: var(--border-radius-lg); padding: 28px;
  max-width: 520px; width: 90%; position: relative;
  box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  animation: modalIn 0.28s cubic-bezier(0.4,0,0.2,1);
}
@keyframes modalIn {
  from { opacity:0; transform: scale(0.9) translateY(-20px); }
  to { opacity:1; transform: scale(1) translateY(0); }
}
.modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.modal-title { font-size: 17px; font-weight: 800; }
.modal-close { background: none; border: none; font-size: 18px; cursor: pointer; color: var(--text-muted); transition: color var(--transition); padding: 4px; border-radius: 6px; }
.modal-close:hover { color: var(--danger); background: var(--danger-light); }
.modal-footer { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
  .sidebar { width: var(--sidebar-collapsed); }
  .sidebar .sidebar-label, .sidebar .nav-badge, .sidebar .sub-arrow,
  .sidebar .sidebar-section-title, .sidebar .brand-text,
  .sidebar .sidebar-user-info, .sidebar .sub-menu { display: none !important; }
  .sidebar .sidebar-logo { justify-content: center; padding: 18px 0; }
  .sidebar .sidebar-nav-item > a { justify-content: center; padding: 13px 0; }
  .sidebar .sidebar-user { justify-content: center; padding: 12px 0; }
  .sidebar .sidebar-user-avatar { margin: 0; }
  .grid-2, .grid-3, .grid-1-2, .grid-2-1 { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: repeat(2,1fr); }
  .chat-layout { grid-template-columns: 1fr; }
  .chat-sidebar { display: none; }
}
@media (max-width: 540px) {
  .stats-grid { grid-template-columns: 1fr; }
  .header-search { display: none; }
  .page-content { padding: 14px; }
}
</style>
