<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>My Profile — Readerly</title>
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#1E40AF;--blue-dark:#1E3A5F;--blue-light:#EFF6FF;--blue-mid:#3B82F6;
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --green:#059669;--green-light:#ECFDF5;
  --red:#DC2626;--red-light:#FEF2F2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;--gray-300:#D1D5DB;
  --gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;
}
body{font-family:var(--font-body);background:var(--gray-50);min-height:100vh;color:var(--gray-900)}

.main{margin-left:var(--sidebar-w);min-height:100vh}

.topbar{height:var(--topbar-h);background:#fff;border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);position:sticky;top:0;z-index:100;gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-time{font-size:.8rem;color:var(--gray-500)}

.page{padding:clamp(1.25rem,3vw,2rem)}

.profile-hero{background:linear-gradient(135deg,var(--blue-dark),var(--blue));border-radius:20px;padding:clamp(1.25rem,3vw,2rem);margin-bottom:2rem;display:flex;align-items:center;gap:clamp(1rem,3vw,2rem);position:relative;overflow:hidden;flex-wrap:wrap}
.profile-hero::before{content:'';position:absolute;top:-40px;right:-40px;width:200px;height:200px;background:rgba(255,255,255,.06);border-radius:50%;pointer-events:none}
.avatar-picker-wrap{position:relative;z-index:1;flex-shrink:0}
.profile-avatar-large{width:80px;height:80px;border-radius:50%;border:3px solid rgba(255,255,255,.3);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:transform .2s;background:transparent;overflow:hidden;aspect-ratio:1/1}
.profile-avatar-large:hover{transform:scale(1.05)}
.avatar-change-hint{font-size:.65rem;color:rgba(255,255,255,.55);text-align:center;margin-top:.35rem}
.profile-hero-info{flex:1;position:relative;z-index:1;min-width:180px}
.profile-hero-name{font-family:var(--font-display);font-size:clamp(1.2rem,3vw,1.6rem);font-weight:800;color:#fff;margin-bottom:.25rem}
.profile-hero-role{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.15);color:#fff;font-size:.75rem;font-weight:700;padding:.25rem .75rem;border-radius:50px;letter-spacing:.4px}
.profile-hero-joined{font-size:.75rem;color:rgba(255,255,255,.55);margin-top:.5rem}
.profile-hero-stats{display:flex;gap:clamp(1rem,3vw,1.5rem);margin-top:1rem;flex-wrap:wrap}
.hero-stat .hs-num{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:#fff;line-height:1}
.hero-stat .hs-lbl{font-size:.65rem;color:rgba(255,255,255,.55);margin-top:.1rem}

.profile-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
.card{background:#fff;border-radius:16px;border:1.5px solid var(--gray-200);padding:1.5rem;margin-bottom:1.5rem}
.card:last-child{margin-bottom:0}
.card-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:1.2rem;display:flex;align-items:center;gap:.5rem}

.card2{background:#fff;border-radius:16px;border:1.5px solid var(--gray-200);padding:1.5rem;margin-bottom:1.5rem}
.card2:last-child{margin-bottom:0}
.card2-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:1.2rem;display:flex;align-items:center;gap:.5rem}
.ct-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem}

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

.class-item{display:flex;align-items:center;justify-content:space-between;padding:.75rem;background:var(--gray-50);border-radius:10px;margin-bottom:.5rem}
.class-item-left .ci-name{font-size:.88rem;font-weight:600;color:var(--gray-900)}
.class-item-left .ci-grade{font-size:.72rem;color:var(--gray-500);margin-top:.1rem}
.ci-count{font-size:.75rem;font-weight:700;background:var(--blue-light);color:var(--blue);padding:.2rem .6rem;border-radius:50px}

.stat-row{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1rem}
.mini-stat{background:var(--gray-50);border-radius:12px;padding:1rem;text-align:center}
.mini-stat .ms-num{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--gray-900);line-height:1}
.mini-stat .ms-lbl{font-size:.7rem;color:var(--gray-500);margin-top:.15rem}

.tag{display:inline-flex;align-items:center;gap:.35rem;font-size:.75rem;font-weight:700;padding:.3rem .8rem;border-radius:50px}
.tag-blue{background:var(--blue-light);color:var(--blue-dark)}
.tag-green{background:var(--green-light);color:var(--green)}

.divider{height:1px;background:var(--gray-100);margin:1.2rem 0}

.alert-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:var(--green);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1rem}
.alert-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:var(--red);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1rem}

@media(max-width:900px){ .profile-grid{grid-template-columns:1fr} }
@media(max-width:768px){
  .main{margin-left:0}
  .topbar-time{display:none}
}
@media(max-width:480px){
  .page{padding:1rem}
  .profile-hero{flex-direction:column;align-items:flex-start}
}
</style>
</head>
<body>

@include('teacher.partials.sidebar')

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">My Profile</div>
    </div>
    <div class="topbar-time" id="clock"></div>
  </div>

  <div class="page">
    @if(session('success'))
      <div class="alert-success"><x-icon name="check" /> {{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <div class="profile-hero">
      <div class="avatar-picker-wrap">
        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none">
        <form id="photoUploadForm" enctype="multipart/form-data" style="display:contents">@csrf</form>
        <div class="profile-avatar-large" id="heroAvatar">
          @php $heroAvatar = session('user')['avatar'] ?? '' @endphp
          @if(!empty($heroAvatar) && (str_contains($heroAvatar, 'storage') || str_contains($heroAvatar, 'avatars/')))
            <img src="{{ asset('storage/' . $heroAvatar) }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block;">
          @else
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:32px;height:32px;color:rgba(255,255,255,.6)">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
          @endif
        </div>
        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(0,0,0,.5);color:#fff;padding:4px 12px;border-radius:20px;font-size:.65rem;font-weight:600;opacity:0;transition:opacity .2s;pointer-events:none" id="uploadHint"><x-icon name="camera" /> Upload</div>
        <div class="avatar-change-hint">Click to change</div>
      </div>
      <div class="profile-hero-info">
        <div class="profile-hero-name">{{ $user['name'] }}</div>
        <div class="profile-hero-role"><x-icon name="check" /> Verified Educator</div>
        <div class="profile-hero-joined">Member since {{ \Carbon\Carbon::parse($user['created_at'])->format('F Y') }}</div>
        <div class="profile-hero-stats">
          <div class="hero-stat"><div class="hs-num">{{ count($classes) }}</div><div class="hs-lbl">Classes</div></div>
          <div class="hero-stat"><div class="hs-num">{{ $totalStudents }}</div><div class="hs-lbl">Students</div></div>
          <div class="hero-stat"><div class="hs-num" style="color:#FCA5A5">{{ $atRisk }}</div><div class="hs-lbl">At Risk</div></div>
        </div>
      </div>
    </div>

    <div class="profile-grid">
      <div>
        <div class="card">
          <div class="card-title"><div class="ct-icon" style="background:var(--blue-light)"><x-icon name="user" /></div> Account Details</div>
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
      </div>

      <div>
        <div class="card2">
          <div class="card-title"><div class="ct-icon" style="background:#FEF2F2"><x-icon name="lock" /></div> Security Settings</div>
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
            <button class="btn btn-danger" onclick="confirmDelete()"><x-icon name="trash" /> Delete Account</button>
          </div>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('teacher.profile.delete') }}" id="deleteForm">
      @csrf @method('DELETE')
    </form>
  </div>
</div>

<script>
function updateClock() {
  const el = document.getElementById('clock');
  if (el) el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateClock();
setInterval(updateClock, 1000);

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
      heroAvatar.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block;">`;
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
          heroAvatar.innerHTML = `<img src="${data.avatar}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block;">`;
          Swal.fire({ icon:'success', title:'Photo Updated!', timer:2000, showConfirmButton:false });
        } else { throw new Error(data.error || 'Upload failed'); }
      })
      .catch(() => Swal.fire({ icon:'error', title:'Upload Failed', text:'Please try again.' }));
    };
    reader.readAsDataURL(file);
  });
});

function confirmDelete() {
  Swal.fire({
    title:'Delete your account?',
    text:'This will permanently delete your account and all your data.',
    icon:'error', showCancelButton:true,
    confirmButtonColor:'#DC2626', cancelButtonColor:'#6B7280',
    confirmButtonText:'Yes, delete it',
    input:'password', inputPlaceholder:'Enter your password to confirm'
  }).then(r => { if(r.isConfirmed) document.getElementById('deleteForm').submit(); });
}

@if(session('success'))
Swal.fire({ title:'Updated!', text:'{{ session("success") }}', icon:'success', timer:2500, timerProgressBar:true, showConfirmButton:false });
@endif
</script>
</body>
</html>