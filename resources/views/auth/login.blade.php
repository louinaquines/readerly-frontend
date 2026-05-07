<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('build/assets/Readerly logo.png') }}">
<title>Sign In — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --white:#fff;--gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
html,body{height:100%}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

/* Skeleton Loading */
.skeleton-loader{position:fixed;inset:0;background:var(--gray-50);z-index:9999;display:grid;grid-template-columns:1fr 1fr;transition:opacity .4s ease,visibility .4s ease}
.skeleton-loader.hidden{opacity:0;visibility:hidden;pointer-events:none}
.skeleton-left{background:linear-gradient(160deg,var(--blue-dark) 0%,#1E40AF 55%,#1D4ED8 100%);padding:clamp(2.5rem,5vw,4rem) clamp(2rem,4vw,3.5rem)}
.skeleton-left-logo{width:140px;height:28px;background:rgba(255,255,255,0.2);border-radius:6px;margin-bottom:2.5rem}
.skeleton-left-h1{width:80%;height:40px;background:rgba(255,255,255,0.2);border-radius:6px;margin-bottom:.85rem}
.skeleton-left-p{width:100%;height:18px;background:rgba(255,255,255,0.15);border-radius:4px;margin-bottom:2.2rem}
.skeleton-left-features{display:flex;flex-direction:column;gap:.75rem;margin-bottom:2.2rem}
.skeleton-feat{display:flex;align-items:center;gap:.7rem}
.skeleton-feat-icon{width:32px;height:32px;border-radius:9px;background:rgba(255,255,255,0.15)}
.skeleton-feat-text{width:180px;height:16px;background:rgba(255,255,255,0.15);border-radius:4px}
.skeleton-left-card{background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:18px;padding:1.35rem}
.skeleton-right{display:flex;align-items:center;justify-content:center;padding:clamp(2rem,5vw,3.5rem) clamp(1.25rem,4vw,2.5rem);background:var(--white)}
.skeleton-form{width:100%;max-width:420px}
.skeleton-form-title{width:120px;height:32px;background:var(--gray-200);border-radius:6px;margin-bottom:2rem}
.skeleton-input{width:100%;height:48px;background:var(--gray-100);border-radius:12px;margin-bottom:1rem}
.skeleton-input2{width:80%;height:48px;background:var(--gray-100);border-radius:12px;margin-bottom:1rem}
.skeleton-btn{width:100%;height:48px;background:var(--blue);border-radius:12px}
@media(max-width:860px){.skeleton-loader{grid-template-columns:1fr}.skeleton-left{display:none}}

/* ── LAYOUT ── */
.auth-layout{display:grid;grid-template-columns:1fr 1fr;min-height:100vh}

/* ── LEFT PANEL ── */
.auth-left{
  background:linear-gradient(160deg,var(--blue-dark) 0%,#1E40AF 55%,#1D4ED8 100%);
  position:relative;overflow:hidden;
  display:flex;flex-direction:column;justify-content:center;
  padding:clamp(2.5rem,5vw,4rem) clamp(2rem,4vw,3.5rem)
}
.auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:320px;height:320px;background:rgba(249,115,22,.18);border-radius:50%;pointer-events:none}
.auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:240px;height:240px;background:rgba(255,255,255,.06);border-radius:50%;pointer-events:none}

/* Decorative dots grid */
.auth-left .dots{position:absolute;top:0;left:0;right:0;bottom:0;background-image:radial-gradient(rgba(255,255,255,.08) 1px,transparent 1px);background-size:28px 28px;pointer-events:none}

.left-content{position:relative;z-index:1}
.left-logo{font-family:var(--font-display);font-size:1.65rem;font-weight:800;color:#fff;text-decoration:none;margin-bottom:2.5rem;display:flex;align-items:center;gap:.4rem;letter-spacing:-.3px}
.left-logo .logo-pill{background:var(--yellow);color:var(--yellow-dark);font-size:.6rem;font-weight:800;padding:.15rem .45rem;border-radius:50px;letter-spacing:.5px}
.left-headline{font-family:var(--font-display);font-size:clamp(1.7rem,2.8vw,2.4rem);font-weight:800;color:#fff;line-height:1.22;margin-bottom:.85rem;letter-spacing:-.5px}
.left-headline span{color:var(--yellow)}
.left-sub{font-size:.9rem;color:rgba(255,255,255,.65);line-height:1.75;margin-bottom:2.2rem}

/* Features list */
.left-features{display:flex;flex-direction:column;gap:.75rem;margin-bottom:2.2rem}
.feat-item{display:flex;align-items:center;gap:.7rem}
.feat-icon{width:32px;height:32px;border-radius:9px;background:rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;font-size:.88rem;flex-shrink:0}
.feat-text{font-size:.83rem;color:rgba(255,255,255,.8);font-weight:500}

/* Live reader card */
.left-card{
  background:rgba(255,255,255,.1);
  border:1px solid rgba(255,255,255,.15);
  border-radius:18px;padding:1.35rem;
  backdrop-filter:blur(8px);-webkit-backdrop-filter:blur(8px)
}
.left-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.85rem}
.left-card-label-main{font-size:.7rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.5px}
.left-live-dot{display:flex;align-items:center;gap:.35rem;font-size:.68rem;font-weight:700;color:#4ADE80}
.left-live-dot::before{content:'';width:6px;height:6px;background:#4ADE80;border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.4)}}

.passage-words{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:.9rem}
.lword{font-family:var(--font-display);font-size:.85rem;font-weight:600;padding:2px 8px;border-radius:6px;background:rgba(255,255,255,.1);color:rgba(255,255,255,.6);transition:all .35s}
.lword.read{background:rgba(16,185,129,.22);color:#6EE7B7}
.lword.current{background:var(--yellow);color:var(--yellow-dark);transform:scale(1.08);box-shadow:0 3px 10px rgba(245,158,11,.4)}

.left-bar{background:rgba(255,255,255,.15);border-radius:50px;height:7px;overflow:hidden;margin-bottom:.45rem}
.left-fill{height:100%;width:0;background:linear-gradient(90deg,var(--yellow),var(--orange));border-radius:50px;animation:lFill 2s 1s ease-out forwards}
@keyframes lFill{from{width:0}to{width:72%}}
.left-card-footer{font-size:.7rem;color:rgba(255,255,255,.45);display:flex;justify-content:space-between}
.left-card-footer strong{color:var(--yellow)}

/* ── RIGHT PANEL ── */
.auth-right{
  display:flex;align-items:center;justify-content:center;
  padding:clamp(2rem,5vw,3.5rem) clamp(1.25rem,4vw,2.5rem);
  background:var(--white);
  overflow-y:auto
}
.auth-form-wrap{width:100%;max-width:420px}

/* Mobile logo (hidden on desktop) */
.mobile-logo{display:none;font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--blue-dark);text-decoration:none;margin-bottom:1.8rem;align-items:center;gap:.4rem}
.mobile-logo span{color:var(--orange)}

.back-link{display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--gray-500);text-decoration:none;margin-bottom:2rem;transition:color .2s}
.back-link:hover{color:var(--blue)}
.form-title{font-family:var(--font-display);font-size:clamp(1.7rem,3vw,2.1rem);font-weight:800;color:var(--gray-900);margin-bottom:.35rem;letter-spacing:-.5px}
.form-subtitle{font-size:.86rem;color:var(--gray-500);margin-bottom:2rem;line-height:1.6}
.form-subtitle a{color:var(--blue);text-decoration:none;font-weight:600}
.form-subtitle a:hover{text-decoration:underline}

.alert-error{background:#FEF2F2;border:1.5px solid #FCA5A5;color:#991B1B;border-radius:12px;padding:.8rem 1rem;font-size:.83rem;margin-bottom:1.1rem;display:flex;align-items:flex-start;gap:.5rem}

.form-group{margin-bottom:1rem}
.form-group label{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.38rem}
.input-wrap{position:relative}
.input-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);font-size:.9rem;pointer-events:none;line-height:1}
.form-group input{
  width:100%;padding:.75rem 1rem .75rem 2.6rem;
  border:1.5px solid var(--gray-200);border-radius:12px;
  font-family:var(--font-body);font-size:.9rem;color:var(--gray-900);
  background:#fff;transition:border-color .2s,box-shadow .2s;outline:none
}
.form-group input:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.form-group input::placeholder{color:var(--gray-300)}

.form-options{display:flex;align-items:center;justify-content:space-between;margin:.4rem 0 1.4rem;flex-wrap:wrap;gap:.5rem}
.remember{display:flex;align-items:center;gap:.45rem;font-size:.8rem;color:var(--gray-700);cursor:pointer}
.remember input[type=checkbox]{width:15px;height:15px;accent-color:var(--blue);cursor:pointer}
.forgot-link{font-size:.8rem;color:var(--blue);text-decoration:none;font-weight:500}
.forgot-link:hover{text-decoration:underline}

.submit-btn{
  width:100%;padding:.85rem;
  background:linear-gradient(135deg,var(--blue),#1D4ED8);color:#fff;
  border:none;border-radius:12px;
  font-family:var(--font-display);font-size:1rem;font-weight:700;
  cursor:pointer;transition:all .2s;margin-bottom:1.2rem;
  letter-spacing:.2px
}
.submit-btn:hover{transform:translateY(-1px);box-shadow:0 8px 24px rgba(30,64,175,.3)}
.submit-btn:active{transform:translateY(0)}

.divider{display:flex;align-items:center;gap:.7rem;margin-bottom:1.1rem}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--gray-100)}
.divider span{font-size:.73rem;color:var(--gray-300);font-weight:500;white-space:nowrap}

.role-btns{display:grid;grid-template-columns:1fr 1fr;gap:.7rem}
.role-btn{
  padding:.75rem .5rem;border-radius:12px;
  border:1.5px solid var(--gray-200);background:#fff;
  font-family:var(--font-body);font-size:.82rem;font-weight:600;
  cursor:pointer;display:flex;align-items:center;justify-content:center;gap:.45rem;
  color:var(--gray-700);transition:all .2s;text-decoration:none
}
.role-btn:hover{border-color:var(--blue);color:var(--blue);background:var(--blue-light);transform:translateY(-1px)}
.role-btn.student:hover{border-color:var(--orange);color:#C2410C;background:var(--orange-light)}

/* ── RESPONSIVE ── */
@media(max-width:860px){
  .auth-layout{grid-template-columns:1fr}
  .auth-left{display:none}
  .mobile-logo{display:flex}
  .auth-right{min-height:100vh;align-items:flex-start;padding-top:3rem}
}
@media(max-width:480px){
  .auth-right{padding:2rem 1.25rem}
  .role-btns{grid-template-columns:1fr 1fr}
  .form-title{font-size:1.7rem}
}
</style>
</head>
<body>

<!-- Skeleton Loader -->
<div class="skeleton-loader" id="skeleton">
  <div class="skeleton-left">
    <div class="skeleton-left-logo"></div>
    <div class="skeleton-left-h1"></div>
    <div class="skeleton-left-p"></div>
    <div class="skeleton-left-features">
      <div class="skeleton-feat"><div class="skeleton-feat-icon"></div><div class="skeleton-feat-text"></div></div>
      <div class="skeleton-feat"><div class="skeleton-feat-icon"></div><div class="skeleton-feat-text"></div></div>
      <div class="skeleton-feat"><div class="skeleton-feat-icon"></div><div class="skeleton-feat-text"></div></div>
      <div class="skeleton-feat"><div class="skeleton-feat-icon"></div><div class="skeleton-feat-text"></div></div>
    </div>
    <div class="skeleton-left-card"></div>
  </div>
  <div class="skeleton-right">
    <div class="skeleton-form">
      <div class="skeleton-form-title"></div>
      <div class="skeleton-input"></div>
      <div class="skeleton-input2"></div>
      <div class="skeleton-btn"></div>
    </div>
  </div>
</div>

<div class="auth-layout">

  <!-- LEFT PANEL -->
  <div class="auth-left">
    <div class="dots"></div>
    <div class="left-content">
      <a href="/" class="left-logo">Readerly</a>
      <div class="left-headline">Welcome <span>back</span> to your classroom!</div>
      <div class="left-sub">Track reading progress, assign passages, and watch every student improve — one session at a time.</div>
      <div class="left-features">
        <div class="feat-item"><div class="feat-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg></div><div class="feat-text">Voice-based reading assessment</div></div>
        <div class="feat-item"><div class="feat-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 9l-5 5-4-4-3 3"/></svg></div><div class="feat-text">Real-time accuracy tracking</div></div>
        <div class="feat-item"><div class="feat-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="16" cy="16" r="2"/></svg></div><div class="feat-text">AI-generated Report Summary</div></div>
        <div class="feat-item"><div class="feat-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><div class="feat-text">Instant teacher alerts</div></div>
      </div>
      <div class="left-card">
        <div class="left-card-top">
          <span class="left-card-label-main">Live Session</span>
          <span class="left-live-dot">Listening</span>
        </div>
        <div class="passage-words" id="loginWords">
          <span class="lword read">Si</span>
          <span class="lword read">Levi</span>
          <span class="lword read">ay</span>
          <span class="lword current">kumakain</span>
          <span class="lword">ng</span>
          <span class="lword">mga</span>
          <span class="lword">prutas.</span>
        </div>
        <div class="left-bar"><div class="left-fill"></div></div>
        <div class="left-card-footer">
          <span>Reading accuracy</span>
          <strong>72%</strong>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="auth-right">
    <div class="auth-form-wrap">
      <!-- Mobile-only logo -->
      <a href="/" class="mobile-logo">Readerly</a>

      <a href="/" class="back-link">← Back to home</a>
      <div class="form-title">Sign In</div>
      <div class="form-subtitle">Don't have an account? <a href="{{ route('register') }}">Create one free →</a></div>

      @if($errors->any())
        <div class="alert-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#991B1B" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> {{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
          <label for="email">Email Address</label>
          <div class="input-wrap">
            <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
            <input type="email" id="email" name="email" placeholder="juan@school.ph" value="{{ old('email') }}" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-wrap">
            <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>
        </div>
        <div class="form-options">
          <label class="remember">
            <input type="checkbox" name="remember"> Remember me
          </label>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>
        <button type="submit" class="submit-btn">Sign In →</button>
      </form>

      <!-- <div class="divider"><span>or continue as</span></div>
      <div class="role-btns">
        <a href="{{ route('login') }}" class="role-btn"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg> Teacher</a>
        <a href="{{ route('login') }}" class="role-btn student"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg> Student</a>
      </div> -->
    </div>
  </div>
</div>

<script>
const words = document.querySelectorAll('#loginWords .lword');
let idx = 3;
setInterval(() => {
  words.forEach((w,i) => {
    w.classList.remove('read','current');
    if(i < idx) w.classList.add('read');
    if(i === idx) w.classList.add('current');
  });
  idx = (idx + 1) % words.length;
  if(idx === 0) idx = 1;
}, 1000);

// Hide skeleton loader (min 2 seconds)
window.addEventListener('load', () => {
  setTimeout(() => {
    const skeleton = document.getElementById('skeleton');
    if(skeleton) skeleton.classList.add('hidden');
    setTimeout(() => { if(skeleton) skeleton.style.display = 'none'; }, 400);
  }, 2000);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('just_registered'))
<script>
Swal.fire({
    title: 'Account Created!',
    text: 'Your account is ready. Please sign in to continue.',
    icon: 'success',
    confirmButtonText: 'Sign In',
    confirmButtonColor: '#1E40AF',
    background: '#fff',
    timer: 4000,
    timerProgressBar: true,
});
</script>
@endif
</body>
</html>