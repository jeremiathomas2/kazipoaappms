<script>
// ===== SIDEBAR TOGGLE =====
let sidebarCollapsed = false;
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebarCollapsed = !sidebarCollapsed;
  sidebar.classList.toggle('collapsed', sidebarCollapsed);
}

// ===== SUBMENU TOGGLE =====
function toggleSubMenu(e, id) {
  e.preventDefault();
  const item = e.currentTarget.closest('.sidebar-nav-item');
  const isOpen = item.classList.contains('open');
  // close all
  document.querySelectorAll('.sidebar-nav-item.open').forEach(el => el.classList.remove('open'));
  if (!isOpen) item.classList.add('open');
}

// ===== NAVIGATION =====
function navigateTo(page, itemEl) {
  // If we're on a multi-page Laravel app, we might want to actually navigate
  // but for this SPA-like demo, we'll keep it as is or update to Laravel routes.
  // For now, let's keep the SPA logic but allow it to work with Laravel URLs if needed.
  
  const target = document.getElementById('page-' + page);
  if (target) {
    // hide all pages
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    target.classList.add('active');

    // update sidebar active
    if (itemEl) {
      document.querySelectorAll('.sidebar-nav-item').forEach(el => el.classList.remove('active'));
      itemEl.classList.add('active');
    }
  } else {
    // If page doesn't exist in DOM, it might be a Laravel route
    window.location.href = '/' + page;
  }

  // close dropdowns
  document.querySelectorAll('.dropdown.open').forEach(d => d.classList.remove('open'));

  // render charts
  if (page === 'dashboard') renderChart('mainChart');
  if (page === 'analytics') renderChart('analyticsChart');
}

// ===== DROPDOWN TOGGLE =====
function toggleDropdown(id, forceClose) {
  const el = document.getElementById(id);
  if (!el) return;
  if (forceClose) { el.classList.remove('open'); return; }
  el.classList.toggle('open');
  document.querySelectorAll('.dropdown.open').forEach(d => {
    if (d.id !== id) d.classList.remove('open');
  });
}
document.addEventListener('click', e => {
  if (!e.target.closest('.dropdown')) {
    document.querySelectorAll('.dropdown.open').forEach(d => d.classList.remove('open'));
  }
});

// ===== THEME TOGGLE =====
function toggleTheme() {
  const html = document.documentElement;
  const isDark = html.getAttribute('data-theme') === 'dark';
  const newTheme = isDark ? 'light' : 'dark';
  
  html.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  
  const btn = document.getElementById('themeBtn');
  if (btn) btn.innerHTML = isDark ? '<i class="fa fa-moon"></i>' : '<i class="fa fa-sun"></i>';
  const toggle = document.getElementById('darkModeToggle');
  if (toggle) toggle.checked = !isDark;
}

// Apply theme on load
(function() {
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
})();

// ===== COLORS =====
function applyColor(varName, value, swatchId) {
  document.documentElement.style.setProperty('--' + varName, value);
  if (swatchId) {
    const swatch = document.getElementById(swatchId);
    if (swatch) swatch.style.background = value;
  }
  // Save custom colors to localStorage
  const colors = JSON.parse(localStorage.getItem('customColors') || '{}');
  colors[varName] = value;
  localStorage.setItem('customColors', JSON.stringify(colors));
}

function resetColors() {
  const defaults = {
    'sidebar-bg': '#0D1B2A', 'header-bg': '#FFFFFF',
    'footer-bg': '#F4F6FA', 'primary': '#1A6EFF', 'body-bg': '#F0F4FB'
  };
  const swatches = {
    'sidebar-bg': 'sidebarSwatch', 'header-bg': 'headerSwatch',
    'footer-bg': 'footerSwatch', 'primary': 'primarySwatch', 'body-bg': 'bodySwatch'
  };
  for (const [key, val] of Object.entries(defaults)) {
    document.documentElement.style.setProperty('--' + key, val);
    const swatch = document.getElementById(swatches[key]);
    if (swatch) swatch.style.background = val;
  }
  localStorage.removeItem('customColors');
  showToast('Colors reset to default', 'success');
}

function setTransitionSpeed(val) {
  document.documentElement.style.setProperty('--transition', val + ' cubic-bezier(0.4,0,0.2,1)');
  localStorage.setItem('transitionSpeed', val);
}

// ===== CONFIG SAVING =====
function saveConfig(key, value) {
  const config = JSON.parse(localStorage.getItem('systemConfig') || '{}');
  config[key] = value;
  localStorage.setItem('systemConfig', JSON.stringify(config));
  
  // Apply specific logic if needed
  if (key === 'cardHover') {
    document.body.classList.toggle('no-hover-lift', !value);
  }
}

// ===== MODAL =====
function openModal(title, type) {
  const modalTitle = document.getElementById('modalTitle');
  if (modalTitle) modalTitle.textContent = title;
  const modalOverlay = document.getElementById('modalOverlay');
  if (modalOverlay) modalOverlay.classList.add('open');
}
function closeModal() {
  const modalOverlay = document.getElementById('modalOverlay');
  if (modalOverlay) modalOverlay.classList.remove('open');
}

// ===== TOAST =====
function showToast(msg, type = '') {
  const container = document.getElementById('toastContainer');
  if (!container) return;
  const toast = document.createElement('div');
  toast.className = 'toast ' + type;
  const icons = { success:'fa-circle-check', danger:'fa-circle-xmark', warning:'fa-triangle-exclamation', '':'fa-bell' };
  const icon = icons[type] || 'fa-bell';
  const colors = { success:'var(--success)', danger:'var(--danger)', warning:'var(--warning)', '':'var(--primary)' };
  toast.innerHTML = `<i class="fa ${icon}" style="color:${colors[type]||'var(--primary)'}"></i><span>${msg}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.animation = 'slideInToast 0.3s ease reverse';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

// ===== CHARTS =====
function renderChart(id) {
  const el = document.getElementById(id);
  if (!el || el.children.length > 0) return;
  const vals = [40,55,35,70,85,60,90,75,50,95,80,65];
  vals.forEach((v, i) => {
    const bar = document.createElement('div');
    bar.className = 'chart-bar';
    bar.style.height = '0';
    bar.style.background = i % 3 === 0 ? 'var(--primary)' : i % 3 === 1 ? 'var(--success)' : 'var(--info)';
    bar.title = `Week ${i+1}: ${v} bookings`;
    el.appendChild(bar);
    setTimeout(() => { bar.style.height = v + '%'; }, 100 + i * 50);
  });
}

// ===== LIVE TIMER =====
let sec = 5078;
setInterval(() => {
  sec++;
  const h = String(Math.floor(sec/3600)).padStart(2,'0');
  const m = String(Math.floor((sec%3600)/60)).padStart(2,'0');
  const s = String(sec%60).padStart(2,'0');
  const el = document.getElementById('kazi-timer');
  if (el) el.textContent = `${h}:${m}:${s}`;
}, 1000);

// Countdown
let cdown = 298;
setInterval(() => {
  if (cdown > 0) cdown--;
  const m = String(Math.floor(cdown/60)).padStart(2,'0');
  const s = String(cdown%60).padStart(2,'0');
  const el = document.getElementById('countdownTimer');
  if (el) el.textContent = `00:${m}:${s}`;
}, 1000);

// ===== CHAT =====
function sendChat(e) {
  if (e.key === 'Enter') sendChatBtn();
}
function sendChatBtn() {
  const input = document.getElementById('chatInput');
  if (!input) return;
  const val = input.value.trim();
  if (!val) return;
  const msgs = document.querySelector('.chat-messages');
  if (!msgs) return;
  const msgEl = document.createElement('div');
  msgEl.className = 'msg out';
  msgEl.innerHTML = `<div class="avatar" style="background:linear-gradient(135deg,var(--primary),var(--info));flex-shrink:0">A</div><div><div class="msg-bubble">${val}</div><div class="msg-time">Just now</div></div>`;
  msgs.appendChild(msgEl);
  msgs.scrollTop = msgs.scrollHeight;
  input.value = '';
  // Simulate reply
  setTimeout(() => {
    const reply = document.createElement('div');
    reply.className = 'msg';
    reply.innerHTML = `<div class="avatar" style="background:linear-gradient(135deg,#FF6B35,#FFB347);flex-shrink:0">JH</div><div><div class="msg-bubble">Nimepokea ujumbe wako. Asante! <i class="fa fa-thumbs-up"></i></div><div class="msg-time">Just now</div></div>`;
    msgs.appendChild(reply);
    msgs.scrollTop = msgs.scrollHeight;
  }, 1200);
}

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
  renderChart('mainChart');
  renderChart('analyticsChart');
  
  // Sync theme toggle UI
  const savedTheme = localStorage.getItem('theme') || 'light';
  const btn = document.getElementById('themeBtn');
  if (btn) btn.innerHTML = savedTheme === 'dark' ? '<i class="fa fa-sun"></i>' : '<i class="fa fa-moon"></i>';
  const toggle = document.getElementById('darkModeToggle');
  if (toggle) toggle.checked = (savedTheme === 'dark');

  // Load custom colors
  const savedColors = JSON.parse(localStorage.getItem('customColors') || '{}');
  for (const [key, val] of Object.entries(savedColors)) {
    document.documentElement.style.setProperty('--' + key, val);
    const swatchId = key.split('-')[0] + 'Swatch';
    const swatch = document.getElementById(swatchId);
    if (swatch) swatch.style.background = val;
    // Update color input value
    const input = document.querySelector(`input[oninput*="${key}"]`);
    if (input) input.value = val;
  }

  // Load transition speed
  const savedSpeed = localStorage.getItem('transitionSpeed');
  if (savedSpeed) {
    document.documentElement.style.setProperty('--transition', savedSpeed + ' cubic-bezier(0.4,0,0.2,1)');
    const speedSelect = document.querySelector('select[onchange*="setTransitionSpeed"]');
    if (speedSelect) speedSelect.value = savedSpeed;
  }

  // Load system config
  const savedConfig = JSON.parse(localStorage.getItem('systemConfig') || '{}');
  for (const [key, val] of Object.entries(savedConfig)) {
    const input = document.querySelector(`input[onchange*="saveConfig('${key}'"]`);
    if (input) input.checked = val;
    if (key === 'cardHover') document.body.classList.toggle('no-hover-lift', !val);
  }

  // Modal close on overlay click
  const modalOverlay = document.getElementById('modalOverlay');
  if (modalOverlay) {
    modalOverlay.addEventListener('click', e => {
      if (e.target === e.currentTarget) closeModal();
    });
  }

  // Live activity ticker
  const feed = document.getElementById('activityFeed');
  if (feed) {
    const activities = [
      ['Booking #BK-4825 created','Client Hassan requested plumbing'],
      ['New Pro registration','Ali Mwamba — Gardener, Dodoma'],
      ['KaziLive session ended','Rating submitted: ★4.8'],
      ['Recurring booking generated','Weekly cleaning for Amina auto-scheduled'],
    ];
    let idx = 0;
    setInterval(() => {
      const item = document.createElement('div');
      item.className = 'timeline-item';
      item.style.opacity = '0';
      item.innerHTML = `<div class="timeline-dot" style="background:var(--primary)"></div><div class="timeline-line"></div><div class="timeline-content"><div class="timeline-title">${activities[idx][0]}</div><div class="timeline-sub">${activities[idx][1]}</div><div class="timeline-time">Just now</div></div>`;
      feed.insertBefore(item, feed.firstChild);
      setTimeout(() => { item.style.opacity='1'; item.style.transition='opacity 0.4s'; }, 50);
      if (feed.children.length > 8) feed.removeChild(feed.lastChild);
      idx = (idx + 1) % activities.length;
    }, 6000);
  }
});
</script>
