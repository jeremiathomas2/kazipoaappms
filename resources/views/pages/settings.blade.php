@extends('layouts.app')

@section('content')
<div class="page active" id="page-settings">
    <div class="breadcrumb"><a href="{{ route('dashboard') }}">Home</a><span>/</span> Settings</div>
    <div class="page-header">
        <div class="page-title">System Settings</div>
        <div class="page-subtitle">Customize the Kazipoa system appearance, behavior and preferences.</div>
    </div>
    <div class="grid-2">
        <!-- Appearance -->
        <div class="card">
            <div class="settings-section">
                <div class="settings-section-title"><i class="fa fa-palette"></i> Appearance & Theme</div>
                <div class="settings-row">
                    <div><div class="settings-label">Dark Mode</div><div class="settings-desc">Switch between light and dark interface</div></div>
                    <label class="toggle-switch"><input type="checkbox" id="darkModeToggle" onchange="toggleTheme()"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row" style="flex-direction:column;align-items:flex-start;gap:12px">
                    <div><div class="settings-label">Interface Colors</div><div class="settings-desc">Customize system branding and background colors</div></div>
                    
                    <div class="color-input-row">
                        <div class="color-preview" style="position:relative">
                            <div class="color-swatch" id="sidebarSwatch" style="background:#0D1B2A"></div>
                            <input type="color" value="#0D1B2A" oninput="applyColor('sidebar-bg',this.value,'sidebarSwatch')" style="position:absolute;inset:0;opacity:0;cursor:pointer"/>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Sidebar Color</div>
                            <div style="font-size:11px;color:var(--text-muted)">Default: #0D1B2A</div>
                        </div>
                    </div>

                    <div class="color-input-row">
                        <div class="color-preview" style="position:relative">
                            <div class="color-swatch" id="headerSwatch" style="background:#FFFFFF"></div>
                            <input type="color" value="#FFFFFF" oninput="applyColor('header-bg',this.value,'headerSwatch')" style="position:absolute;inset:0;opacity:0;cursor:pointer"/>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Header Color</div>
                            <div style="font-size:11px;color:var(--text-muted)">Default: #FFFFFF</div>
                        </div>
                    </div>

                    <div class="color-input-row">
                        <div class="color-preview" style="position:relative">
                            <div class="color-swatch" id="footerSwatch" style="background:#F4F6FA"></div>
                            <input type="color" value="#F4F6FA" oninput="applyColor('footer-bg',this.value,'footerSwatch')" style="position:absolute;inset:0;opacity:0;cursor:pointer"/>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Footer Color</div>
                            <div style="font-size:11px;color:var(--text-muted)">Default: #F4F6FA</div>
                        </div>
                    </div>

                    <div class="color-input-row">
                        <div class="color-preview" style="position:relative">
                            <div class="color-swatch" id="primarySwatch" style="background:#1A6EFF"></div>
                            <input type="color" value="#1A6EFF" oninput="applyColor('primary',this.value,'primarySwatch')" style="position:absolute;inset:0;opacity:0;cursor:pointer"/>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Primary Accent</div>
                            <div style="font-size:11px;color:var(--text-muted)">Default: #1A6EFF</div>
                        </div>
                    </div>

                    <div class="color-input-row">
                        <div class="color-preview" style="position:relative">
                            <div class="color-swatch" id="bodySwatch" style="background:#F0F4FB"></div>
                            <input type="color" value="#F0F4FB" oninput="applyColor('body-bg',this.value,'bodySwatch')" style="position:absolute;inset:0;opacity:0;cursor:pointer"/>
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:var(--text-primary)">Body Background</div>
                            <div style="font-size:11px;color:var(--text-muted)">Default: #F0F4FB</div>
                        </div>
                    </div>

                    <button class="btn btn-secondary btn-sm" onclick="resetColors()"><i class="fa fa-rotate-left"></i> Reset to Default</button>
                </div>
            </div>
        </div>

        <!-- Hover & Animation -->
        <div class="card">
            <div class="settings-section">
                <div class="settings-section-title"><i class="fa fa-wand-magic-sparkles"></i> Hover & Transitions</div>
                <div class="settings-row">
                    <div><div class="settings-label">Card Hover Lift</div><div class="settings-desc">Cards elevate on hover</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('cardHover', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Sidebar Animations</div><div class="settings-desc">Smooth sidebar transitions</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('sidebarAnim', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Transition Speed</div><div class="settings-desc">Adjust animation duration</div></div>
                    <select class="form-control" style="width:auto;padding:7px 12px;font-size:12.5px" onchange="setTransitionSpeed(this.value)">
                        <option value="0.12s">Fast</option>
                        <option value="0.22s" selected>Normal</option>
                        <option value="0.4s">Slow</option>
                    </select>
                </div>
            </div>

            <div class="settings-section">
                <div class="settings-section-title"><i class="fa fa-bell"></i> Notifications</div>
                <div class="settings-row">
                    <div><div class="settings-label">Live Session Alerts</div><div class="settings-desc">Notify when KaziLive starts</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('notifLive', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Chat Notifications</div><div class="settings-desc">Notify on new messages</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('notifChat', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
            </div>
        </div>

        <!-- Platform settings -->
        <div class="card">
            <div class="settings-section">
                <div class="settings-section-title"><i class="fa fa-gears"></i> Platform Behavior</div>
                <div class="settings-row">
                    <div><div class="settings-label">Auto-start KaziLive</div><div class="settings-desc">Sessions start automatically at booking time</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('autoKazi', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Recurring Bookings</div><div class="settings-desc">Enable recurring schedule generation</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('recurring', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Guest Browse Mode</div><div class="settings-desc">Allow non-registered users to browse</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('guestBrowse', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="card">
            <div class="settings-section">
                <div class="settings-section-title"><i class="fa fa-shield-halved"></i> Security</div>
                <div class="settings-row">
                    <div><div class="settings-label">OTP Verification</div><div class="settings-desc">Phone number verification via OTP</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('otp', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
                <div class="settings-row">
                    <div><div class="settings-label">Role-based Access</div><div class="settings-desc">RBAC for clients, pros and admins</div></div>
                    <label class="toggle-switch"><input type="checkbox" checked onchange="saveConfig('rbac', this.checked)"/><div class="toggle-slider"></div></label>
                </div>
            </div>
            <button class="btn btn-primary" onclick="showToast('Settings saved successfully!','success')">
                <i class="fa fa-save"></i> Save All Settings
            </button>
        </div>
    </div>
</div>
@endsection
