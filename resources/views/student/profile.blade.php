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
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;--orange-dark:#C2410C;
  --amber:#D97706;
  --blue:#1E40AF;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --purple:#7C3AED;--purple-light:#F5F3FF;
  --red:#DC2626;--red-light:#FEF2F2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;--gray-300:#D1D5DB;
  --gray-400:#9CA3AF;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:linear-gradient(160deg,#FFFBEB 0%,#FFF7ED 40%,#FEF3C7 100%);min-height:100vh;color:var(--gray-900)}
.readerly-icon{width:1em;height:1em;display:inline-block;vertical-align:-.125em;flex-shrink:0}

/* ── TOPBAR ── */
.topbar{position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(18px);border-bottom:1px solid rgba(245,158,11,.18);padding:0 clamp(1rem,4vw,2rem);height:64px;display:flex;align-items:center;justify-content:space-between;gap:1rem}
.topbar-logo{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--blue);text-decoration:none;display:flex;align-items:center;letter-spacing:-.3px}
.topbar-logo span{color:var(--yellow);margin-left:-1px}
.topbar-right{display:flex;align-items:center;gap:.65rem}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--orange),var(--yellow));display:flex;align-items:center;justify-content:center;font-size:1.1rem;cursor:pointer;overflow:hidden;border:2px solid rgba(249,115,22,.3)}
.back-link{display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;font-weight:600;color:var(--gray-500);text-decoration:none;transition:color .2s}
.back-link:hover{color:var(--orange)}
.logout-btn{display:inline-flex;align-items:center;gap:.35rem;font-family:var(--font-body);font-size:.78rem;font-weight:600;color:var(--gray-500);background:transparent;border:1.5px solid var(--gray-200);border-radius:50px;padding:.38rem .85rem;cursor:pointer;transition:all .2s}
.logout-btn:hover{border-color:var(--orange);color:var(--orange-dark);background:var(--orange-light)}

/* ── PAGE ── */
.page{max-width:800px;margin:0 auto;padding:clamp(1.25rem,4vw,2.5rem) clamp(1rem,4vw,1.5rem)}

/* ── PROFILE HERO ── */
.profile-hero{
  background:linear-gradient(135deg,var(--orange) 0%,var(--amber) 55%,var(--yellow) 100%);
  border-radius:24px;padding:clamp(1.4rem,4vw,2rem);margin-bottom:1.5rem;
  display:flex;align-items:center;gap:clamp(1rem,3vw,1.5rem);
  position:relative;overflow:hidden;flex-wrap:wrap
}
.profile-hero::before{content:'';position:absolute;top:-40px;right:-40px;width:180px;height:180px;background:rgba(255,255,255,.1);border-radius:50%;pointer-events:none}
.hero-avatar-wrap{position:relative;z-index:1;text-align:center;flex-shrink:0}
.hero-avatar{
  width:78px;height:78px;border-radius:50%;
  border:3px solid rgba(255,255,255,.4);
  display:flex;align-items:center;justify-content:center;
  font-size:2.3rem;cursor:pointer;
  background:rgba(255,255,255,.15);
  transition:transform .2s;overflow:hidden;position:relative
}
.hero-avatar:hover{transform:scale(1.05)}
.avatar-hint{font-size:.62rem;color:rgba(255,255,255,.65);margin-top:.3rem}
.hero-info{flex:1;position:relative;z-index:1;min-width:160px}
.hero-name{font-family:var(--font-display);font-size:clamp(1.25rem,3vw,1.65rem);font-weight:800;color:#fff;margin-bottom:.2rem;letter-spacing:-.3px}
.hero-joined{font-size:.73rem;color:rgba(255,255,255,.65);margin-bottom:.7rem}
.hero-stats{display:flex;gap:1.1rem;flex-wrap:wrap}
.hs{text-align:center}
.hs-num{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:#fff;line-height:1}
.hs-lbl{font-size:.62rem;color:rgba(255,255,255,.65);margin-top:.1rem}
.level-badge-hero{
  background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.35);
  border-radius:16px;padding:.75rem 1.1rem;text-align:center;
  position:relative;z-index:1;flex-shrink:0
}
.lb-num{font-family:var(--font-display);font-size:1.7rem;font-weight:800;color:#fff;line-height:1}
.lb-lbl{font-size:.6rem;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.4px;margin-top:.1rem}
.lb-title{font-size:.68rem;color:rgba(255,255,255,.65);margin-top:.15rem}

/* ── CARDS ── */
.card{background:#fff;border-radius:18px;border:1.5px solid rgba(0,0,0,.06);padding:clamp(1.1rem,3vw,1.35rem);margin-bottom:1.2rem}
.card-title{font-family:var(--font-display);font-size:.98rem;font-weight:700;color:var(--gray-900);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
.ct-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.85rem}
.metric-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.65rem;margin-bottom:1.2rem}
.metric-card{background:#fff;border:1.5px solid rgba(0,0,0,.06);border-radius:16px;padding:.9rem;text-align:center}
.metric-num{font-family:var(--font-display);font-size:1.35rem;font-weight:800;color:var(--gray-900);line-height:1}
.metric-label{font-size:.66rem;color:var(--gray-500);font-weight:600;margin-top:.18rem}

/* ── READING LEVEL ── */
.level-display{display:flex;align-items:center;gap:1.1rem;padding:.95rem;background:var(--gray-50);border-radius:14px}
.level-circle{width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.55rem;font-weight:800;color:#fff;flex-shrink:0}
.level-name{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:var(--gray-900)}
.level-meta{font-size:.75rem;color:var(--gray-500);margin-top:.18rem}
.level-progress-track{margin-top:.5rem;background:var(--gray-200);border-radius:50px;height:6px;overflow:hidden;width:min(200px,100%)}
.level-progress-fill{height:100%;border-radius:50px;transition:width .8s ease}
.level-next{font-size:.68rem;color:var(--gray-400);margin-top:.22rem}

/* ── MASTERY ── */
.mastery-item{display:flex;align-items:center;justify-content:space-between;padding:.55rem .7rem;background:var(--gray-50);border-radius:10px;margin-bottom:.4rem}
.mastery-sound{font-family:var(--font-display);font-size:.88rem;font-weight:700;color:var(--gray-900);min-width:64px}
.mastery-bar-wrap{flex:1;margin:0 .7rem;background:var(--gray-200);border-radius:50px;height:7px;overflow:hidden}
.mastery-bar{height:100%;border-radius:50px;background:linear-gradient(90deg,var(--yellow),var(--orange))}
.mastery-pct{font-size:.73rem;font-weight:700;color:var(--orange);min-width:34px;text-align:right}

/* ── STREAK ── */
.streak-row{display:flex;gap:.4rem;margin-bottom:.75rem;flex-wrap:wrap}
.streak-day{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;font-family:var(--font-display)}
.streak-day.active{background:linear-gradient(135deg,var(--yellow),var(--orange));color:#fff;box-shadow:0 3px 8px rgba(249,115,22,.3)}
.streak-day.inactive{background:var(--gray-100);color:var(--gray-300)}

/* ── GOAL ── */
.goal-card{background:linear-gradient(135deg,var(--purple-light),#EDE9FE);border:1.5px solid rgba(124,58,237,.15);border-radius:14px;padding:1rem;display:flex;align-items:center;gap:.85rem}
.goal-icon{width:42px;height:42px;border-radius:12px;background:#fff;border:1.5px solid rgba(124,58,237,.2);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.goal-title{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--purple)}
.goal-desc{font-size:.73rem;color:rgba(124,58,237,.7);margin-top:.12rem;line-height:1.5}

/* ── FORM ── */
.form-group{margin-bottom:.9rem}
.form-group label{font-size:.73rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.32rem}
.form-group input{width:100%;padding:.68rem .9rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.87rem;color:var(--gray-900);outline:none;transition:border-color .2s}
.form-group input:focus{border-color:var(--orange);box-shadow:0 0 0 3px rgba(249,115,22,.1)}
.form-group input[readonly]{background:var(--gray-50);color:var(--gray-500)}
.btn{font-family:var(--font-body);font-weight:600;font-size:.85rem;padding:.62rem 1.2rem;border-radius:10px;border:none;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:.4rem}
.btn-orange{background:var(--orange);color:#fff}
.btn-orange:hover{background:var(--orange-dark);transform:translateY(-1px)}
.btn-danger{background:var(--red-light);color:var(--red);border:1.5px solid rgba(220,38,38,.15)}
.btn-danger:hover{background:var(--red);color:#fff}

/* ── ALERTS ── */
.alert-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:var(--green);border-radius:10px;padding:.7rem .9rem;font-size:.82rem;margin-bottom:1rem}
.alert-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:var(--red);border-radius:10px;padding:.7rem .9rem;font-size:.82rem;margin-bottom:1rem}

/* ── DIVIDER ── */
.divider{height:1px;background:var(--gray-100);margin:1.1rem 0}

@media(max-width:500px){
  .hero-stats{gap:.75rem}
  .profile-hero{flex-direction:column;text-align:center}
  .level-badge-hero{display:none}
  .topbar-logo{font-size:1.2rem}
  .topbar{height:auto;min-height:64px;padding:.7rem 1rem}
  .back-link span,.logout-btn span{display:none}
  .metric-grid{grid-template-columns:1fr}
  .level-display,.goal-card{align-items:flex-start}
  .btn{width:100%;justify-content:center}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<nav class="topbar">
  <a href="{{ route('student.dashboard') }}" class="topbar-logo">Reader<span>ly</span></a>
  <div class="topbar-right">
    <a href="{{ route('student.dashboard') }}" class="back-link"><x-icon name="home" /> <span>Dashboard</span></a>
    <div class="topbar-avatar">
      @if(!empty($user['avatar']) && (str_contains($user['avatar'], 'storage') || str_contains($user['avatar'], 'avatars/')))
        <img src="{{ Storage::url($user['avatar']) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
      @else
        <x-icon name="user" />
      @endif
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn"><x-icon name="log-out" /> <span>Logout</span></button>
    </form>
  </div>
</nav>

<div class="page">

  @if(session('success'))
    <div class="alert-success"><x-icon name="check" /> {{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert-error">{{ $errors->first() }}</div>
  @endif

  {{-- HERO --}}
  @php

    $studentData    = $student ?? [];
    $readingLevel   = $studentData['reading_level'] ?? $user['reading_level'] ?? 1;
    $levelNames     = [1=>'Beginner',2=>'Developing',3=>'Proficient',4=>'Advanced'];
    $levelColors    = [1=>'#F97316',2=>'#F59E0B',3=>'#3B82F6',4=>'#059669'];
    $allSess        = collect($sessions ?? []);
    $totalRead      = $allSess->whereNotIn('status',['pending'])->count();
    $avgAccuracy    = $allSess->whereNotIn('status',['pending'])->map(fn($s)=>$s['accuracy_score']??$s['score']??null)->filter()->avg() ?? 0;
    $approvedCount  = $allSess->where('status', 'approved')->count();
  @endphp
  <div class="profile-hero">
    <div class="hero-avatar-wrap">
      <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display:none">
      <form id="photoUploadForm" enctype="multipart/form-data" style="display:contents">@csrf</form>
      <div class="hero-avatar" id="heroAvatar">
        @if(!empty($user['avatar']) && (str_contains($user['avatar'], 'storage') || str_contains($user['avatar'], 'avatars/')))
          <img src="{{ Storage::url($user['avatar']) }}" alt="Profile" style="width:100%;height:100%;object-fit:cover">
        @else
          <span><x-icon name="user" /></span>
        @endif
        <div style="position:absolute;bottom:0;right:0;width:22px;height:22px;background:var(--orange);border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid #fff">
          <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        </div>
      </div>
      <div class="avatar-hint">Tap to change</div>
    </div>

    <div class="hero-info">
      <div class="hero-name">{{ $user['name'] }}</div>
      <div class="hero-joined">
        @if(!empty($user['created_at']))
          Joined {{ \Carbon\Carbon::parse($user['created_at'])->format('F Y') }}
        @else
          Student
        @endif
      </div>
      <div class="hero-stats">
        <div class="hs"><div class="hs-num">{{ $totalRead }}</div><div class="hs-lbl">Sessions</div></div>
        <div class="hs"><div class="hs-num">{{ count($stories ?? []) }}</div><div class="hs-lbl">Stories</div></div>
        <div class="hs"><div class="hs-num">{{ $avgAccuracy > 0 ? round($avgAccuracy).'%' : '—' }}</div><div class="hs-lbl">Avg Score</div></div>
      </div>
    </div>

    <div class="level-badge-hero">
      <div class="lb-num">{{ $readingLevel }}</div>
      <div class="lb-lbl">Level</div>
      <div class="lb-title">{{ $levelNames[$readingLevel] ?? 'Beginner' }}</div>
    </div>
  </div>

  <div class="metric-grid">
    <div class="metric-card">
      <div class="metric-num">{{ $totalRead }}</div>
      <div class="metric-label">Completed</div>
    </div>
    <div class="metric-card">
      <div class="metric-num">{{ $avgAccuracy > 0 ? round($avgAccuracy) . '%' : '—' }}</div>
      <div class="metric-label">Average Score</div>
    </div>
    <div class="metric-card">
      <div class="metric-num">{{ $approvedCount }}</div>
      <div class="metric-label">Approved</div>
    </div>
  </div>

  {{-- READING LEVEL --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--yellow-light)"><x-icon name="trophy" /></div> Reading Level</div>
    @php
      $progressModulo = $totalRead % 3;
      $progress = $totalRead > 0 ? min(100, ($progressModulo / 3) * 100) : 0;
      $sessionsToNext = $progressModulo === 0 ? 3 : 3 - $progressModulo;
    @endphp
    <div class="level-display">
      <div class="level-circle" style="background:{{ $levelColors[$readingLevel] ?? '#F97316' }}">{{ $readingLevel }}</div>
      <div style="flex:1;min-width:0">
        <div class="level-name">{{ $levelNames[$readingLevel] ?? 'Beginner' }}</div>
        <div class="level-meta">{{ $totalRead }} sessions completed</div>
        <div class="level-progress-track">
          <div class="level-progress-fill" style="width:{{ $progress }}%;background:{{ $levelColors[$readingLevel] ?? '#F97316' }}"></div>
        </div>
        <div class="level-next">{{ $sessionsToNext }} {{ $sessionsToNext === 1 ? 'session' : 'sessions' }} to next level</div>
      </div>
    </div>
  </div>

  {{-- SOUND MASTERY --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--purple-light)"><x-icon name="volume" /></div> Sound Mastery</div>
    @php
      $allErrors = [];
      foreach ($allSess as $session) {
        $patterns = $session['error_patterns'] ?? [];
        if (is_string($patterns)) {
          $decoded = json_decode($patterns, true);
          $patterns = is_array($decoded) ? $decoded : preg_split('/,\s*/', $patterns, -1, PREG_SPLIT_NO_EMPTY);
        }
        if (is_array($patterns)) {
          foreach ($patterns as $pattern) {
            if (is_string($pattern) && trim($pattern) !== '') $allErrors[] = strtolower(trim($pattern));
          }
        }
      }
      $errorCounts = collect($allErrors)->countBy();
      $sounds = ['Ma/Me/Mi' => 'ma', 'Ng/Mga' => 'ng', 'Ba/Be/Bi' => 'ba', 'Pa/Pe/Pi' => 'pa', 'Sa/Se/Si' => 'sa', 'La/Le/Li' => 'la'];
    @endphp
    @if($allSess->count() === 0)
      <p style="font-size:.83rem;color:var(--gray-400)">Start reading sessions to see your mastery progress.</p>
    @else
      @foreach($sounds as $label => $key)
        @php
          $errCount = $errorCounts->get($key, 0);
          $pct = max(0, 100 - ($errCount * 15));
        @endphp
        <div class="mastery-item">
          <div class="mastery-sound">{{ $label }}</div>
          <div class="mastery-bar-wrap"><div class="mastery-bar" style="width:{{ $pct }}%"></div></div>
          <div class="mastery-pct">{{ $pct }}%</div>
        </div>
      @endforeach
    @endif
  </div>

  {{-- WEEKLY STREAK --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:#FEF3C7"><x-icon name="flame" /></div> Weekly Streak</div>
    @php
      $days = ['M','T','W','T','F','S','S'];
      $sessionDays = $allSess->pluck('created_at')
        ->filter()
        ->map(fn($d) => \Carbon\Carbon::parse($d)->isoWeekday() - 1)
        ->unique()->toArray();
    @endphp
    <div class="streak-row">
      @foreach($days as $i => $day)
        <div class="streak-day {{ in_array($i, $sessionDays) ? 'active' : 'inactive' }}">{{ $day }}</div>
      @endforeach
    </div>
    <p style="font-size:.78rem;color:var(--gray-500)">Keep reading every day to build your streak! <x-icon name="zap" /></p>
  </div>

  {{-- NEXT GOAL --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--purple-light)"><x-icon name="target" /></div> Next Goal</div>
    @php
      $nextLevel = $readingLevel + 1;
      $nextLevelName = $levelNames[$nextLevel] ?? 'Master';
      $sessionsLeft = $sessionsToNext;
    @endphp
    <div class="goal-card">
      <div class="goal-icon"><x-icon name="arrow-up" /></div>
      <div>
        <div class="goal-title">Level {{ $nextLevel }} — {{ $nextLevelName }}</div>
        <div class="goal-desc">{{ $sessionsLeft }} more passing {{ $sessionsLeft === 1 ? 'session' : 'sessions' }} needed to level up!</div>
      </div>
    </div>
  </div>

  {{-- ACCOUNT DETAILS --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:var(--blue-light)"><x-icon name="user" /></div> Account Details</div>
    <form method="POST" action="{{ route('student.profile.update') }}">
      @csrf
      <div class="form-group"><label>Full Name</label><input type="text" name="name" value="{{ $user['name'] }}" required></div>
      <div class="form-group"><label>Email</label><input type="email" value="{{ $user['email'] }}" readonly></div>
      <div class="form-group">
        <label>Student ID</label>
        <input type="text" value="{{ $user['member_id'] ?? ('stu-' . str_pad($studentData['id'] ?? $user['id'] ?? 1, 4, '0', STR_PAD_LEFT)) }}" readonly>
      </div>
      <div class="form-group">
        <label>Grade</label>
        <input type="text" value="{{ $studentData['grade'] ?? $studentData['grade_level'] ?? '—' }}" readonly>
      </div>
      <button type="submit" class="btn btn-orange">Update Profile</button>
    </form>
  </div>

  {{-- SECURITY --}}
  <div class="card">
    <div class="card-title"><div class="ct-icon" style="background:#FEF2F2"><x-icon name="lock" /></div> Security</div>
    <form method="POST" action="{{ route('student.profile.password') }}">
      @csrf
      <div class="form-group"><label>Current Password</label><input type="password" name="current_password" placeholder="Enter current password" required></div>
      <div class="form-group"><label>New Password</label><input type="password" name="password" placeholder="Min. 6 characters" required></div>
      <div class="form-group"><label>Confirm New Password</label><input type="password" name="password_confirmation" placeholder="Confirm new password" required></div>
      <div style="display:flex;gap:.75rem;flex-wrap:wrap">
        <button type="submit" class="btn btn-orange">Update Password</button>
        <button type="button" class="btn btn-danger" onclick="confirmDelete()"><x-icon name="trash" /> Delete Account</button>
      </div>
    </form>
    <div class="divider"></div>
    <p style="font-size:.75rem;color:var(--gray-400);line-height:1.6">Your reading data and AI stories are saved securely. Deleting your account removes all data permanently.</p>
  </div>

  {{-- DELETE FORM --}}
  <form method="POST" action="{{ route('student.profile.delete') }}" id="deleteForm" style="display:none">
    @csrf
    @method('DELETE')
  </form>

</div>

<script>
// ── Photo upload ──
document.addEventListener('DOMContentLoaded', function() {
  const heroAvatar = document.getElementById('heroAvatar');
  const fileInput  = document.getElementById('profile_photo');
  if (!heroAvatar || !fileInput) return;

  heroAvatar.addEventListener('click', () => fileInput.click());

  fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
      // Preview immediately
      heroAvatar.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';

      const formData = new FormData(document.getElementById('photoUploadForm'));
      formData.append('profile_photo', file);

      fetch('{{ route("student.profile.photo") }}', {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          // FIX: no Blade interpolation inside JS string — use data.avatar directly
          heroAvatar.innerHTML = '<img src="' + data.avatar + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';
          const navAvatar = document.querySelector('.topbar-avatar');
          if (navAvatar) navAvatar.innerHTML = '<img src="' + data.avatar + '" style="width:100%;height:100%;object-fit:cover;border-radius:50%">';
          Swal.fire({ icon: 'success', title: 'Photo updated!', timer: 2000, showConfirmButton: false });
        } else {
          throw new Error(data.error || 'Upload failed');
        }
      })
      .catch(err => {
        Swal.fire({ icon: 'error', title: 'Upload failed', text: err.message });
      });
    };
    reader.readAsDataURL(file);
  });
});

// ── Delete account ──
function confirmDelete() {
  Swal.fire({
    title: 'Delete Account?',
    text: 'This will permanently delete all your data. This cannot be undone.',
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#DC2626',
    cancelButtonColor: '#6B7280',
    confirmButtonText: 'Yes, delete',
    cancelButtonText: 'Cancel'
  }).then(r => { if (r.isConfirmed) document.getElementById('deleteForm').submit(); });
}

// ── Success toast ──
@if(session('success'))
Swal.fire({
  title: 'Updated!',
  text: '{{ addslashes(session("success")) }}',
  icon: 'success',
  timer: 2500,
  timerProgressBar: true,
  showConfirmButton: false
});
@endif
</script>
</body>
</html>
