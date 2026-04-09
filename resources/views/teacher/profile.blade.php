<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>My Profile — Readerly</title>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#1E40AF;--blue-dark:#1E3A5F;--blue-light:#EFF6FF;--blue-mid:#3B82F6;
  --orange:#F97316;--yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --green:#059669;--green-light:#ECFDF5;
  --red:#DC2626;--red-light:#FEF2F2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;--gray-300:#D1D5DB;
  --gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;--white:#fff;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;
}
body{font-family:var(--font-body);background:var(--gray-50);min-height:100vh;color:var(--gray-900)}

/* ── SIDEBAR ── */
.sidebar{position:fixed;left:0;top:0;bottom:0;width:var(--sidebar-w);background:var(--blue-dark);display:flex;flex-direction:column;z-index:200;transition:transform .3s}
.sidebar-logo{padding:0 1.4rem;height:var(--topbar-h);display:flex;align-items:center;border-bottom:1px solid rgba(255,255,255,.08);font-family:var(--font-display);font-size:1.35rem;font-weight:800;color:#fff;text-decoration:none}
.sidebar-logo span{color:var(--yellow)}
.sidebar-nav{flex:1;padding:1rem .75rem;overflow-y:auto}
.nav-section{font-size:.62rem;font-weight:700;color:rgba(255,255,255,.35);letter-spacing:1.2px;padding:.5rem .75rem;margin-bottom:.2rem;margin-top:.6rem}
.nav-link{display:flex;align-items:center;gap:.7rem;padding:.65rem .75rem;border-radius:10px;color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;font-weight:500;transition:all .2s;margin-bottom:.15rem}
.nav-link:hover{background:rgba(255,255,255,.1);color:#fff}
.nav-link.active{background:rgba(255,255,255,.12);color:#fff}
.sidebar-footer{padding:1rem .75rem;border-top:1px solid rgba(255,255,255,.08)}
.sidebar-user{display:flex;align-items:center;gap:.75rem;padding:.75rem;background:rgba(255,255,255,.07);border-radius:12px;margin-bottom:.65rem;cursor:pointer;text-decoration:none;transition:background .2s}
.sidebar-user:hover{background:rgba(255,255,255,.12)}
.user-avatar{width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:.82rem;font-weight:800;color:#fff;flex-shrink:0;background:rgba(255,255,255,.15);overflow:hidden}
.user-info .name{font-size:.8rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:140px}
.user-info .role{font-size:.68rem;color:rgba(255,255,255,.45)}
.signout-btn{width:100%;padding:.6rem;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:10px;color:rgba(255,255,255,.6);font-size:.8rem;font-weight:500;cursor:pointer;transition:all .2s;font-family:var(--font-body)}
.signout-btn:hover{background:rgba(255,255,255,.14);color:#fff}

/* Sidebar overlay (mobile) */
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:199}
.sidebar-overlay.open{display:block}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);min-height:100vh}

/* ── TOPBAR ── */
.topbar{height:var(--topbar-h);background:#fff;border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);position:sticky;top:0;z-index:100;gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.hamburger{display:none;flex-direction:column;gap:4px;cursor:pointer;padding:.35rem;border:none;background:transparent}
.hamburger span{display:block;width:20px;height:2px;background:var(--gray-700);border-radius:2px;transition:all .25s}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-time{font-size:.8rem;color:var(--gray-500)}

/* ── PAGE ── */
.page{padding:clamp(1.25rem,3vw,2rem)}
.page-header{margin-bottom:2rem}
.page-header h1{font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gray-900)}
.page-header p{font-size:.88rem;color:var(--gray-500);margin-top:.25rem}

/* PROFILE HERO */
.profile-hero{background:linear-gradient(135deg,var(--blue-dark),var(--blue));border-radius:20px;padding:clamp(1.25rem,3vw,2rem);margin-bottom:2rem;display:flex;align-items:center;gap:clamp(1rem,3vw,2rem);position:relative;overflow:hidden;flex-wrap:wrap}
.profile-hero::before{content:'';position:absolute;top:-40px;right:-40px;width:200px;height:200px;background:rgba(255,255,255,.06);border-radius:50%;pointer-events:none}
.avatar-picker-wrap{position:relative;z-index:1;flex-shrink:0}
.profile-avatar-large{width:80px;height:80px;border-radius:50%;border:3px solid rgba(255,255,255,.3);display:flex;align-items:center;justify-content:center;font-size:2.4rem;cursor:pointer;transition:transform .2s;background:rgba(255,255,255,.1);overflow:hidden}
.profile-avatar-large:hover{transform:scale(1.05)}
.avatar-change-hint{font-size:.65rem;color:rgba(255,255,255,.55);text-align:center;margin-top:.35rem}
.profile-hero-info{flex:1;position:relative;z-index:1;min-width:180px}
.profile-hero-name{font-family:var(--font-display);font-size:clamp(1.2rem,3vw,1.6rem);font-weight:800;color:#fff;margin-bottom:.25rem}
.profile-hero-role{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.15);color:#fff;font-size:.75rem;font-weight:700;padding:.25rem .75rem;border-radius:50px;letter-spacing:.4px}
.profile-hero-joined{font-size:.75rem;color:rgba(255,255,255,.55);margin-top:.5rem}
.profile-hero-stats{display:flex;gap:clamp(1rem,3vw,1.5rem);margin-top:1rem;flex-wrap:wrap}
.hero-stat .hs-num{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:#fff;line-height:1}
.hero-stat .hs-lbl{font-size:.65rem;color:rgba(255,255,255,.55);margin-top:.1rem}

/* GRID */
.profile-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
.card{background:#fff;border-radius:16px;border:1.5px solid var(--gray-200);padding:1.5rem;margin-bottom:1.5rem}
.card:last-child{margin-bottom:0}
.card-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:1.2rem;display:flex;align-items:center;gap:.5rem}
.ct-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem}

/* FORM */
.form-group{margin-bottom:1rem}
.form-group label{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.35rem}
.form-group input{width:100%;padding:.7rem .95rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.88rem;color:var(--gray-900);outline:none;transition:border-color .2s}
.form-group input:focus{border-color:var(--blue-mid)}
.form-group input[readonly]{background:var(--gray-50);color:var(--gray-500)}
.btn{font-family:var(--font-body);font-weight:600;font-size:.85rem;padding:.65rem 1.3rem;border-radius:10px;border:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:.4rem}
.btn-primary{background:var(--blue);color:#fff}
.btn-primary:hover{background:var(--blue-dark);transform:translateY(-1px)}
.btn-danger{background:var(--red-light);color:var(--red);border:1.5px solid rgba(220,38,38,.2)}
.btn-danger:hover{background:var(--red);color:#fff}

/* CLASSES LIST */
.class-item{display:flex;align-items:center;justify-content:space-between;padding:.75rem;background:var(--gray-50);border-radius:10px;margin-bottom:.5rem}
.class-item-left .ci-name{font-size:.88rem;font-weight:600;color:var(--gray-900)}
.class-item-left .ci-grade{font-size:.72rem;color:var(--gray-500);margin-top:.1rem}
.ci-count{font-size:.75rem;font-weight:700;background:var(--blue-light);color:var(--blue);padding:.2rem .6rem;border-radius:50px}

/* STATS */
.stat-row{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1rem}
.mini-stat{background:var(--gray-50);border-radius:12px;padding:1rem;text-align:center}
.mini-stat .ms-num{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--gray-900);line-height:1}
.mini-stat .ms-lbl{font-size:.7rem;color:var(--gray-500);margin-top:.15rem}

/* TAGS */
.tag{display:inline-flex;align-items:center;gap:.35rem;font-size:.75rem;font-weight:700;padding:.3rem .8rem;border-radius:50px}
.tag-blue{background:var(--blue-light);color:var(--blue-dark)}
.tag-green{background:var(--green-light);color:var(--green)}

/* DIVIDER */
.divider{height:1px;background:var(--gray-100);margin:1.2rem 0}

/* ALERTS */
.alert-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:var(--green);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1rem}
.alert-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:var(--red);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1rem}

/* ── RESPONSIVE ── */
@media(max-width:900px){
  .profile-grid{grid-template-columns:1fr}
}
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .hamburger{display:flex}
  .topbar-time{display:none}
}
@media(max-width:480px){
  .page{padding:1rem}
  .profile-hero{flex-direction:column;align-items:flex-start}
  .profile-hero-stats{gap:1rem}
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <a href="{{ route('teacher.dashboard') }}" class="sidebar-logo">Reader<span>ly</span></a>
  <nav class="sidebar-nav">
    <div class="nav-section">MAIN</div>
    <a href="{{ route('teacher.dashboard') }}" class="nav-link">🏠 Dashboard</a>
    <div class="nav-section">CLASSES</div>
    <a href="{{ route('teacher.classes') }}" class="nav-link">🏫 My Classes</a>
    <div class="nav-section">REPORTS</div>
    <a href="{{ route('teacher.reports') }}" class="nav-link">📄 PDF Reports</a>
    <a href="{{ route('teacher.analytics') }}" class="nav-link">📊 Analytics</a>
  </nav>
  <div class="sidebar-footer">
    <a href="{{ route('teacher.profile') }}" class="sidebar-user">
      <div class="user-avatar">
        @if(session('user')['avatar'] ?? false)
          <img src="{{ Storage::url(session('user')['avatar']) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover">
        @else
          <svg viewBox="0 0 24 24" fill="currentColor" style="width:1.5rem;height:1.5rem;color:rgba(255,255,255,.6)">
            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
          </svg>
        @endif
      </div>
      <div class="user-info">
        <div class="name">{{ session('user')['name'] ?? 'Teacher' }}</div>
        <div class="role">Teacher</div>
      </div>
    </a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="signout-btn">Sign Out</button>
    </form>
  </div>
</aside>

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- MAIN -->
<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <!-- HAMBURGER (shows on mobile) -->
      <button class="hamburger" id="hamburger" aria-label="Open menu">
        <span></span><span></span><span></span>
      </button>
      <div class="topbar-title">My Profile</div>
    </div>
    <div class="topbar-time" id="clock"></div>
  </div>

  <div class="page">

    @if(session('success'))
      <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    {{-- PROFILE HERO --}}
    <div class="profile-hero">
      <div class="avatar-picker-wrap">
        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none">
        <form id="photoUploadForm" enctype="multipart/form-data" style="display:contents">@csrf</form>
        <div class="profile-avatar-large" id="heroAvatar">
          @if(session('user')['avatar'] ?? false)
            <img src="{{ Storage::url(session('user')['avatar']) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
          @else
            <svg viewBox="0 0 24 24" fill="currentColor" style="width:3rem;height:3rem;color:rgba(255,255,255,.6)">
              <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
            </svg>
          @endif
        </div>
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(0,0,0,.5);color:#fff;padding:4px 12px;border-radius:20px;font-size:.65rem;font-weight:600;opacity:0;transition:opacity .2s;pointer-events:none" id="uploadHint">📸 Upload</div>
        <div class="avatar-change-hint">Click to change</div>
      </div>
      <div class="profile-hero-info">
        <div class="profile-hero-name">{{ $user['name'] }}</div>
        <div class="profile-hero-role">✓ Verified Educator</div>
        <div class="profile-hero-joined">Member since {{ \Carbon\Carbon::parse($user['created_at'])->format('F Y') }}</div>
        <div class="profile-hero-stats">
          <div class="hero-stat"><div class="hs-num">{{ count($classes) }}</div><div class="hs-lbl">Classes</div></div>
          <div class="hero-stat"><div class="hs-num">{{ $totalStudents }}</div><div class="hs-lbl">Students</div></div>
          <div class="hero-stat"><div class="hs-num" style="color:#FCA5A5">{{ $atRisk }}</div><div class="hs-lbl">At Risk</div></div>
        </div>
      </div>
    </div>

    <div class="profile-grid">
      {{-- LEFT COLUMN --}}
      <div>
        <div class="card">
          <div class="card-title"><div class="ct-icon" style="background:var(--blue-light)">👤</div> Account Details</div>
          <form method="POST" action="{{ route('teacher.profile.update') }}">
            @csrf
            <input type="hidden" name="avatar" value="{{ $user['avatar'] ?? '' }}">
            <div class="form-group"><label>Full Name</label><input type="text" name="name" value="{{ $user['name'] }}" required></div>
            <div class="form-group"><label>Email Address</label><input type="email" name="email" value="{{ $user['email'] }}"></div>
            <div class="form-group"><label>Role</label><input type="text" value="Teacher" readonly></div>
            <div class="form-group"><label>Member Since</label><input type="text" value="{{ \Carbon\Carbon::parse($user['created_at'])->format('F d, Y') }}" readonly></div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
          </form>
        </div>

        <div class="card">
          <div class="card-title"><div class="ct-icon" style="background:#FEF2F2">🔒</div> Security Settings</div>
          <form method="POST" action="{{ route('teacher.profile.password') }}">
            @csrf
            <div class="form-group"><label>Current Password</label><input type="password" name="current_password" placeholder="Enter current password" required></div>
            <div class="form-group"><label>New Password</label><input type="password" name="password" placeholder="Min. 6 characters" required></div>
            <div class="form-group"><label>Confirm New Password</label><input type="password" name="password_confirmation" placeholder="Repeat new password" required></div>
            <button type="submit" class="btn btn-primary">Update Password</button>
          </form>
          <div class="divider"></div>
          <div>
            <div style="font-size:.82rem;font-weight:600;color:var(--red);margin-bottom:.5rem">Danger Zone</div>
            <p style="font-size:.78rem;color:var(--gray-500);margin-bottom:.75rem">Permanently delete your account and all associated data. This cannot be undone.</p>
            <button class="btn btn-danger" onclick="confirmDelete()">🗑 Delete Account</button>
          </div>
        </div>
      </div>

      {{-- RIGHT COLUMN --}}
      <div>
        <div class="card">
          <div class="card-title"><div class="ct-icon" style="background:var(--green-light)">🛡️</div> System Permissions</div>
          <div style="display:flex;flex-wrap:wrap;gap:.5rem">
            <span class="tag tag-blue">✓ Verified Educator</span>
            <span class="tag tag-green">✓ Class Management</span>
            <span class="tag tag-green">✓ Assign Passages</span>
            <span class="tag tag-green">✓ Export Reports</span>
            <span class="tag tag-blue">✓ AI Story Generator</span>
          </div>
          <div class="divider"></div>
          <div style="font-size:.8rem;color:var(--gray-500)">
            <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
              <span>AI Story Generations this month</span>
              <span style="font-weight:700;color:var(--blue)">∞ Unlimited</span>
            </div>
            <div style="display:flex;justify-content:space-between">
              <span>JWT Role</span>
              <span style="font-weight:700;color:var(--gray-700)">teacher</span>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-title"><div class="ct-icon" style="background:var(--blue-light)">🏫</div> Handled Classes</div>
          <div class="stat-row">
            <div class="mini-stat"><div class="ms-num">{{ $totalStudents }}</div><div class="ms-lbl">Total Students</div></div>
            <div class="mini-stat"><div class="ms-num" style="color:var(--red)">{{ $atRisk }}</div><div class="ms-lbl">At Risk (&lt;60%)</div></div>
          </div>
          @forelse($classes as $class)
            <div class="class-item">
              <div class="class-item-left">
                <div class="ci-name">{{ $class['name'] }}</div>
                <div class="ci-grade">{{ $class['grade_level'] }}</div>
              </div>
              <span class="ci-count">{{ count($class['students'] ?? []) }} students</span>
            </div>
          @empty
            <p style="font-size:.83rem;color:var(--gray-400)">No classes yet.</p>
          @endforelse
        </div>
      </div>
    </div>

    {{-- DELETE FORM --}}
    <form method="POST" action="{{ route('teacher.profile.delete') }}" id="deleteForm">
      @csrf
      @method('DELETE')
    </form>

  </div>
</div>

<script>
// ── Sidebar toggle (hamburger) ──
const sidebar  = document.getElementById('sidebar');
const overlay  = document.getElementById('sidebarOverlay');
const hamburger = document.getElementById('hamburger');
hamburger?.addEventListener('click', () => {
  sidebar.classList.toggle('open');
  overlay.classList.toggle('open');
});
overlay?.addEventListener('click', () => {
  sidebar.classList.remove('open');
  overlay.classList.remove('open');
});

// ── Clock ──
function updateClock() {
  const el = document.getElementById('clock');
  if (el) el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateClock();
setInterval(updateClock, 1000);

// ── Photo upload ──
document.addEventListener('DOMContentLoaded', function() {
  const heroAvatar = document.getElementById('heroAvatar');
  const fileInput  = document.getElementById('profile_photo');
  const uploadHint = document.getElementById('uploadHint');

  heroAvatar.addEventListener('mouseenter', () => uploadHint.style.opacity = '1');
  heroAvatar.addEventListener('mouseleave', () => uploadHint.style.opacity = '0');
  heroAvatar.addEventListener('click', (e) => { e.stopPropagation(); fileInput.click(); });

  fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      heroAvatar.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
      const formData = new FormData(document.getElementById('photoUploadForm'));
      formData.append('profile_photo', file);
      fetch('{{ route("teacher.profile.photo") }}', {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          heroAvatar.innerHTML = `<img src="${data.avatar}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
          document.querySelector('.user-avatar').innerHTML = `<img src="${data.avatar}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
          Swal.fire({ icon:'success', title:'Photo Updated!', timer:2000, showConfirmButton:false });
        } else { throw new Error(data.error || 'Upload failed'); }
      })
      .catch(() => Swal.fire({ icon:'error', title:'Upload Failed', text:'Please try again.' }));
    };
    reader.readAsDataURL(file);
  });
});

// ── Delete account ──
function confirmDelete() {
  Swal.fire({
    title:'Delete your account?',
    text:'This will permanently delete your account and all your data.',
    icon:'error',showCancelButton:true,
    confirmButtonColor:'#DC2626',cancelButtonColor:'#6B7280',
    confirmButtonText:'Yes, delete it',
    input:'password',inputPlaceholder:'Enter your password to confirm'
  }).then(r => { if(r.isConfirmed) document.getElementById('deleteForm').submit(); });
}

@if(session('success'))
Swal.fire({ title:'Updated!', text:'{{ session("success") }}', icon:'success', timer:2500, timerProgressBar:true, showConfirmButton:false });
@endif
</script>
</body>
</html>