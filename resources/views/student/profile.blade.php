<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile — Readerly</title>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;--orange-dark:#C2410C;
  --amber:#D97706;
  --blue:#1E40AF;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;
  --purple:#7C3AED;--purple-light:#F5F3FF;
  --red:#DC2626;--red-light:#FEF2F2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;--gray-300:#D1D5DB;
  --gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;--white:#fff;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
body{font-family:var(--font-body);background:linear-gradient(160deg,#FFFBEB 0%,#FFF7ED 40%,#FEF3C7 100%);min-height:100vh;color:var(--gray-900)}

/* TOPBAR */
.topbar{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.92);backdrop-filter:blur(16px);border-bottom:1px solid rgba(245,158,11,.15);padding:0 clamp(1rem,4vw,2rem);height:64px;display:flex;align-items:center;justify-content:space-between;gap:1rem}
.topbar-logo{font-family:var(--font-display);font-size:1.35rem;font-weight:800;color:var(--blue);text-decoration:none;display:flex;align-items:center;gap:.35rem;letter-spacing:-.3px;margin-left: 2rem;}
.topbar-logo span{color:var(--yellow);margin-left:-5px}
.topbar-right{display:flex;align-items:center;gap:.75rem}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--orange),var(--yellow));display:flex;align-items:center;justify-content:center;font-size:1.2rem;cursor:pointer}
.logout-btn{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-body);font-size:.8rem;font-weight:600;color:var(--gray-500);background:transparent;border:1.5px solid var(--gray-200);border-radius:50px;padding:.4rem .9rem;cursor:pointer;transition:all .2s;text-decoration:none}
.logout-btn:hover{border-color:var(--orange);color:var(--orange-dark);background:var(--orange-light)}
.back-link{display:inline-flex;align-items:center;gap:.4rem;font-size:.82rem;color:var(--gray-500);text-decoration:none;transition:color .2s}
.back-link:hover{color:var(--orange)}

/* PAGE */
.page{max-width:800px;margin:0 auto;padding:clamp(1.5rem,4vw,2.5rem) clamp(1rem,4vw,1.5rem)}

/* PROFILE HERO */
.profile-hero{background:linear-gradient(135deg,var(--orange) 0%,var(--amber) 60%,var(--yellow) 100%);border-radius:24px;padding:clamp(1.5rem,4vw,2rem);margin-bottom:1.5rem;display:flex;align-items:center;gap:1.5rem;position:relative;overflow:hidden}
.profile-hero::before{content:'';position:absolute;top:-40px;right:-40px;width:180px;height:180px;background:rgba(255,255,255,.1);border-radius:50%}
.hero-avatar-wrap{position:relative;z-index:1;text-align:center}
.hero-avatar{width:80px;height:80px;border-radius:50%;border:3px solid rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;font-size:2.5rem;cursor:pointer;background:rgba(255,255,255,.15);transition:transform .2s}
.hero-avatar:hover{transform:scale(1.05)}
.avatar-hint{font-size:.62rem;color:rgba(255,255,255,.6);margin-top:.3rem}
.hero-info{flex:1;position:relative;z-index:1}
.hero-name{font-family:var(--font-display);font-size:clamp(1.3rem,3vw,1.7rem);font-weight:800;color:#fff;margin-bottom:.25rem}
.hero-joined{font-size:.75rem;color:rgba(255,255,255,.65);margin-bottom:.75rem}
.hero-stats{display:flex;gap:1.25rem;flex-wrap:wrap}
.hs{text-align:center}
.hs-num{font-family:var(--font-display);font-size:1.3rem;font-weight:800;color:#fff;line-height:1}
.hs-lbl{font-size:.62rem;color:rgba(255,255,255,.6);margin-top:.1rem}

/* LEVEL BADGE */
.level-badge-hero{background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.35);border-radius:16px;padding:.75rem 1.1rem;text-align:center;position:relative;z-index:1;flex-shrink:0}
.lb-num{font-family:var(--font-display);font-size:1.7rem;font-weight:800;color:#fff;line-height:1}
.lb-lbl{font-size:.6rem;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.4px;margin-top:.1rem}
.lb-title{font-size:.68rem;color:rgba(255,255,255,.65);margin-top:.15rem}

/* CARDS */
.card{background:#fff;border-radius:18px;border:1.5px solid rgba(0,0,0,.06);padding:1.35rem;margin-bottom:1.2rem;transition:box-shadow .2s}
.card-title{font-family:var(--font-display);font-size:.98rem;font-weight:700;color:var(--gray-900);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.ct-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem}

/* AVATAR GRID */
.avatar-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:.5rem;margin-bottom:1rem}
.avatar-opt{width:100%;aspect-ratio:1;border-radius:12px;border:2px solid var(--gray-200);display:flex;align-items:center;justify-content:center;font-size:1.4rem;cursor:pointer;transition:all .2s}
.avatar-opt:hover{border-color:var(--orange);transform:scale(1.08)}
.avatar-opt.selected{border-color:var(--orange);background:var(--orange-light);transform:scale(1.08)}

/* MASTERY */
.mastery-item{display:flex;align-items:center;justify-content:space-between;padding:.6rem .75rem;background:var(--gray-50);border-radius:10px;margin-bottom:.4rem}
.mastery-sound{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--gray-900)}
.mastery-bar-wrap{flex:1;margin:0 .75rem;background:var(--gray-200);border-radius:50px;height:7px;overflow:hidden}
.mastery-bar{height:100%;border-radius:50px;background:linear-gradient(90deg,var(--yellow),var(--orange))}
.mastery-pct{font-size:.75rem;font-weight:700;color:var(--orange);min-width:36px;text-align:right}

/* STREAK */
.streak-row{display:flex;gap:.4rem;margin-bottom:.75rem}
.streak-day{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.8rem;font-weight:700;font-family:var(--font-display)}
.streak-day.active{background:linear-gradient(135deg,var(--yellow),var(--orange));color:#fff}
.streak-day.inactive{background:var(--gray-100);color:var(--gray-300)}

/* FORM */
.form-group{margin-bottom:.9rem}
.form-group label{font-size:.73rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.32rem}
.form-group input{width:100%;padding:.68rem .9rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.87rem;color:var(--gray-900);outline:none;transition:border-color .2s}
.form-group input:focus{border-color:var(--orange)}
.form-group input[readonly]{background:var(--gray-50);color:var(--gray-500)}
.btn{font-family:var(--font-body);font-weight:600;font-size:.85rem;padding:.62rem 1.2rem;border-radius:10px;border:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:.4rem}
.btn-orange{background:var(--orange);color:#fff}
.btn-orange:hover{background:var(--orange-dark);transform:translateY(-1px)}
.btn-danger{background:var(--red-light);color:var(--red);border:1.5px solid rgba(220,38,38,.15)}
.btn-danger:hover{background:var(--red);color:#fff}

/* NEXT GOAL */
.goal-card{background:linear-gradient(135deg,var(--purple-light),#EDE9FE);border:1.5px solid rgba(124,58,237,.15);border-radius:14px;padding:1.1rem;display:flex;align-items:center;gap:.9rem}
.goal-icon{width:42px;height:42px;border-radius:12px;background:var(--purple-light);border:1.5px solid rgba(124,58,237,.2);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.goal-title{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--purple)}
.goal-desc{font-size:.75rem;color:rgba(124,58,237,.7);margin-top:.1rem}

/* LANG */
.lang-btn{padding:.6rem 1rem;border-radius:10px;border:1.5px solid var(--gray-200);background:#fff;font-family:var(--font-body);font-size:.82rem;font-weight:600;cursor:pointer;transition:all .2s;flex:1}
.lang-btn.active{background:var(--orange);color:#fff;border-color:var(--orange)}

/* ALERT */
.alert-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:var(--green);border-radius:10px;padding:.7rem .9rem;font-size:.82rem;margin-bottom:1rem}
.alert-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:var(--red);border-radius:10px;padding:.7rem .9rem;font-size:.82rem;margin-bottom:1rem}

@media(max-width:500px){
  .hero-stats{gap:.75rem}
  .avatar-grid{grid-template-columns:repeat(4,1fr)}
  .profile-hero{flex-direction:column;text-align:center}
  .level-badge-hero{display:none}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<nav class="topbar">
  <a href="{{ route('student.dashboard') }}" class="topbar-logo">Reader<span>ly</span></a>
  <div class="topbar-right">
    <a href="{{ route('student.dashboard') }}" class="back-link">← Dashboard</a>
    <div class="topbar-avatar">
      @if (isset($user['avatar']) && strpos($user['avatar'], 'storage') !== false)
        <img src="{{ Storage::url($user['avatar']) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
      @elseif (isset($user['avatar']) && strpos($user['avatar'], 'avatars/') !== false)
        <img src="{{ Storage::url($user['avatar']) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
      @else
        {{ $user['avatar'] ?? '🦉' }}
      @endif
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">↩ Logout</button>
    </form>
  </div>
</nav>

<div class="page">

  @if(session('success'))
    <div class="alert-success">✓ {{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert-error">{{ $errors->first() }}</div>
  @endif

  {{-- HERO --}}
  <div class="profile-hero">
  <div class="hero-avatar-wrap">
      <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none">
      <form id="photoUploadForm" enctype="multipart/form-data" style="display:contents">@csrf</form>
      <div class="hero-avatar" id="heroAvatar" style="position:relative;width:80px;height:80px;">
        <div style="width:100%;height:100%;border-radius:50%;overflow:hidden;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.15);">
          @if (isset($user['avatar']) && strpos($user['avatar'], 'storage') !== false)
            <img src="{{ Storage::url($user['avatar']) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;">
          @elseif (isset($user['avatar']) && strpos($user['avatar'], 'avatars/') !== false)
            <img src="{{ Storage::url($user['avatar']) }}" alt="Profile Photo" style="width:100%;height:100%;object-fit:cover;">
          @else
            <span style="font-size:2.5rem;">{{ $user['avatar'] ?? '🦉' }}</span>
          @endif
        </div>
        <div style="position:absolute;bottom:0;right:0;width:24px;height:24px;background:var(--orange);border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff;cursor:pointer;">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </div>
      </div>
      <div class="avatar-hint">Tap to change photo</div>
    </div>
    <div class="hero-info">
      <div class="hero-name">{{ $user['name'] }}</div>
      <div class="hero-joined">Joined {{ \Carbon\Carbon::parse($user['created_at'])->format('F Y') }}</div>
      <div class="hero-stats">
        <div class="hs"><div class="hs-num">{{ $totalRead }}</div><div class="hs-lbl">Sessions</div></div>
        <div class="hs"><div class="hs-num">{{ count($stories) }}</div><div class="hs-lbl">Stories</div></div>
        <div class="hs"><div class="hs-num">{{ $avgAccuracy > 0 ? round($avgAccuracy) . '%' : '—' }}</div><div class="hs-lbl">Avg Score</div></div>
      </div>
    </div>
    <div class="level-badge-hero">
      <div class="lb-num">{{ $student['reading_level'] ?? 1 }}</div>
      <div class="lb-lbl">Level</div>
      <div class="lb-title">
        @php
          $levels = [1=>'Beginner',2=>'Developing',3=>'Proficient',4=>'Advanced'];
          echo $levels[$student['reading_level'] ?? 1] ?? 'Beginner';
        @endphp
      </div>
    </div>
  </div>


  {{-- READING LEVEL BADGE --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--yellow-light)">🏆</div> Reading Level</div>
    @php
      $level = $student['reading_level'] ?? 1;
      $levelNames = [1=>'Beginner',2=>'Developing',3=>'Proficient',4=>'Advanced'];
      $levelColors = [1=>'#F97316',2=>'#F59E0B',3=>'#3B82F6',4=>'#059669'];
    @endphp
    <div style="display:flex;align-items:center;gap:1.25rem;padding:1rem;background:var(--gray-50);border-radius:14px">
      <div style="width:64px;height:64px;border-radius:50%;background:{{ $levelColors[$level] ?? '#F97316' }};display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:#fff;flex-shrink:0">{{ $level }}</div>
      <div>
        <div style="font-family:var(--font-display);font-size:1.1rem;font-weight:800;color:var(--gray-900)">{{ $levelNames[$level] ?? 'Beginner' }}</div>
        <div style="font-size:.78rem;color:var(--gray-500);margin-top:.2rem">{{ $totalRead }} sessions completed</div>
        <div style="margin-top:.5rem;background:var(--gray-200);border-radius:50px;height:7px;overflow:hidden;width:200px">
          @php $progress = min(100, ($totalRead % 3) / 3 * 100); @endphp
          <div style="height:100%;width:{{ $progress }}%;background:{{ $levelColors[$level] ?? '#F97316' }};border-radius:50px"></div>
        </div>
        <div style="font-size:.68rem;color:var(--gray-400);margin-top:.2rem">{{ 3 - ($totalRead % 3) }} sessions to next level</div>
      </div>
    </div>
  </div>

  {{-- SOUND MASTERY --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--purple-light)">🔊</div> Sound Mastery</div>
    @php
      $allErrors = collect($sessions)->pluck('error_patterns')->flatten()->filter()->countBy()->sortDesc();
      $sounds = ['Ma/Me/Mi','Ng/Mga','Ba/Be/Bi','Pa/Pe/Pi','Sa/Se/Si','La/Le/Li'];
      $masteryScores = [];
      foreach($sounds as $sound) {
        $key = strtolower(explode('/',$sound)[0]);
        $errorCount = $allErrors->get($key, 0);
        $masteryScores[$sound] = max(0, 100 - ($errorCount * 15));
      }
    @endphp
    @if(count($sessions) === 0)
      <p style="font-size:.83rem;color:var(--gray-400)">Start reading sessions to see your mastery progress!</p>
    @else
      @foreach($masteryScores as $sound => $pct)
        <div class="mastery-item">
          <div class="mastery-sound">{{ $sound }}</div>
          <div class="mastery-bar-wrap"><div class="mastery-bar" style="width:{{ $pct }}%"></div></div>
          <div class="mastery-pct">{{ $pct }}%</div>
        </div>
      @endforeach
    @endif
  </div>

  {{-- WEEKLY STREAK --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:#FEF3C7">🔥</div> Weekly Streak</div>
    @php
      $days = ['M','T','W','T','F','S','S'];
      $today = now()->dayOfWeek;
      $sessionDates = collect($sessions)->pluck('created_at')->map(fn($d) => \Carbon\Carbon::parse($d)->dayOfWeek)->unique()->toArray();
    @endphp
    <div class="streak-row">
      @foreach($days as $i => $day)
        <div class="streak-day {{ in_array($i, $sessionDates) ? 'active' : 'inactive' }}">{{ $day }}</div>
      @endforeach
    </div>
    <p style="font-size:.78rem;color:var(--gray-500)">Read every day to keep your streak going! 💪</p>
  </div>

  {{-- NEXT GOAL --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--purple-light)">🎯</div> Next Goal</div>
    <div class="goal-card">
      <div class="goal-icon">⬆️</div>
      <div>
        <div class="goal-title">Level {{ ($student['reading_level'] ?? 1) + 1 }} — {{ ['','Developing','Proficient','Advanced','Master'][($student['reading_level'] ?? 1)] ?? 'Master' }}</div>
        <div class="goal-desc">{{ 3 - ($totalRead % 3) }} more passing sessions needed to level up!</div>
      </div>
    </div>
  </div>

  {{-- ACCOUNT DETAILS --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--blue-light)">👤</div> Account Details</div>
    <form method="POST" action="{{ route('student.profile.update') }}">
      @csrf
      <input type="hidden" name="avatar" value="{{ $user['avatar'] ?? '🦉' }}">
      <div class="form-group"><label>Full Name</label><input type="text" name="name" value="{{ $user['name'] }}" required></div>
      <div class="form-group"><label>Email</label><input type="email" value="{{ $user['email'] }}" readonly></div>
      <div class="form-group"><label>School ID (read-only)</label><input type="text" value="STU-{{ str_pad($student['id'] ?? 0, 4, '0', STR_PAD_LEFT) }}" readonly></div>
      <div class="form-group"><label>Grade</label><input type="text" value="{{ $student['grade'] ?? '—' }}" readonly></div>
      <button type="submit" class="btn btn-orange">Update Profile</button>
    </form>
  </div>

  {{-- PASSWORD --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:#FEF2F2">🔒</div> Security</div>
    <form method="POST" action="{{ route('student.profile.password') }}">
      @csrf
      <div class="form-group"><label>Current Password</label><input type="password" name="current_password" placeholder="Enter current password" required></div>
      <div class="form-group"><label>New Password</label><input type="password" name="password" placeholder="Min. 6 characters" required></div>
      <div class="form-group"><label>Confirm New Password</label><input type="password" name="password_confirmation" placeholder="Confirm new password" required></div>
      <div style="display:flex;gap:.75rem;flex-wrap:wrap">
        <button type="submit" class="btn btn-orange">Update Password</button>
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">🗑 Delete Account</button>
      </div>
    </form>
  </div>

  {{-- DELETE FORM --}}
  <form method="POST" action="{{ route('student.profile.delete') }}" id="deleteForm">
    @csrf
    @method('DELETE')
  </form>

</div>

<script>
function selectAvatar(emoji){
  document.querySelectorAll('.avatar-opt').forEach(el=>el.classList.remove('selected'));
  event.currentTarget.classList.add('selected');
  document.getElementById('avatarInput').value=emoji;
  document.getElementById('heroAvatar').textContent=emoji;
}
function confirmDelete(){
  Swal.fire({title:'Delete Account?',text:'This will permanently delete all your data. This action cannot be undone.',icon:'error',showCancelButton:true,confirmButtonColor:'#DC2626',cancelButtonColor:'#6B7280',confirmButtonText:'Yes, delete',cancelButtonText:'Cancel'}).then(r=>{if(r.isConfirmed)document.getElementById('deleteForm').submit()});
}
// ── Photo upload ──
document.addEventListener('DOMContentLoaded', function() {
  const heroAvatar = document.getElementById('heroAvatar');
  const fileInput  = document.getElementById('profile_photo');
  const uploadHint = document.createElement('div');
  uploadHint.id = 'uploadHint';
  uploadHint.style.cssText = 'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:rgba(0,0,0,.5);color:#fff;padding:4px 12px;border-radius:20px;font-size:.65rem;font-weight:600;opacity:0;transition:opacity .2s;pointer-events:none';
  uploadHint.innerHTML = '📸 Upload';
  heroAvatar.parentNode.appendChild(uploadHint);

  heroAvatar.style.position = 'relative';

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
      fetch('{{ route("student.profile.photo") }}', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
        }
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          heroAvatar.innerHTML = `<img src="${data.avatar}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
          document.querySelector('.topbar-avatar').innerHTML = data.success ? `<img src="${data.avatar}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">` : '{{ $user['avatar'] ?? "🦉" }}';
          Swal.fire({ icon:'success', title:'Photo updated!', timer:2000 });
        } else throw new Error(data.error || 'Upload failed');
      })
      .catch(err => {
        Swal.fire({ icon:'error', title:'Upload failed', text: err.message });
        location.reload();
      });
    };
    reader.readAsDataURL(file);
  });
});

const savedLang=localStorage.getItem('lang')||'fil';
setLang(savedLang);

@if(session('success'))
Swal.fire({title:'Updated!',text:'{{ session("success") }}',icon:'success',timer:2500,timerProgressBar:true,showConfirmButton:false,confirmButtonColor:'#F97316'});
@endif
</script>
</body>
</html>