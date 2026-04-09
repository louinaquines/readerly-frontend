<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('build/assets/Readerly logo.png') }}">
<title>Create Account — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --amber-dark:#78350F;--amber:#D97706;--amber-mid:#B45309;
  --white:#fff;--gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
html,body{height:100%}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

/* Skeleton Loading */
.skeleton-loader{position:fixed;inset:0;background:var(--gray-50);z-index:9999;display:grid;grid-template-columns:1fr 1fr;transition:opacity .4s ease,visibility .4s ease}
.skeleton-loader.hidden{opacity:0;visibility:hidden;pointer-events:none}
.skeleton-left{background:linear-gradient(160deg,#78350F 0%,#92400E 30%,#B45309 65%,#D97706 100%);padding:clamp(2.5rem,5vw,4rem) clamp(2rem,4vw,3.5rem)}
.skeleton-left-logo{width:140px;height:28px;background:rgba(255,255,255,0.2);border-radius:6px;margin-bottom:2.5rem}
.skeleton-left-h1{width:80%;height:40px;background:rgba(255,255,255,0.2);border-radius:6px;margin-bottom:.85rem}
.skeleton-left-p{width:100%;height:18px;background:rgba(255,255,255,0.15);border-radius:4px;margin-bottom:2rem}
.skeleton-steps{display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem}
.skeleton-step{display:flex;align-items:flex-start;gap:.85rem}
.skeleton-step-num{width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,0.18)}
.skeleton-step-text{flex:1}
.skeleton-step-title{width:120px;height:14px;background:rgba(255,255,255,0.2);border-radius:4px;margin-bottom:.12rem}
.skeleton-step-desc{width:180px;height:12px;background:rgba(255,255,255,0.12);border-radius:4px}
.skeleton-role-cards{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
.skeleton-role-card{background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.18);border-radius:14px;padding:1rem}
.skeleton-right{display:flex;align-items:flex-start;justify-content:center;padding:clamp(2rem,4vw,3.5rem) clamp(1.25rem,4vw,2.5rem);background:var(--white)}
.skeleton-form{width:100%;max-width:440px}
.skeleton-form-title{width:160px;height:32px;background:var(--gray-200);border-radius:6px;margin-bottom:1.6rem}
.skeleton-role-selector{display:grid;grid-template-columns:1fr 1fr;gap:.7rem;margin-bottom:1.1rem}
.skeleton-role-opt{height:100px;background:var(--gray-100);border-radius:14px}
.skeleton-input{width:100%;height:48px;background:var(--gray-100);border-radius:12px;margin-bottom:1rem}
.skeleton-input-row{display:grid;grid-template-columns:1fr 1fr;gap:.85rem;margin-bottom:1rem}
.skeleton-btn{width:100%;height:48px;background:var(--orange);border-radius:12px}
@media(max-width:860px){.skeleton-loader{grid-template-columns:1fr}.skeleton-left{display:none}}

/* ── LAYOUT ── */
.auth-layout{display:grid;grid-template-columns:1fr 1fr;min-height:100vh}

/* ── LEFT PANEL ── */
.auth-left{
  background:linear-gradient(160deg,#78350F 0%,#92400E 30%,var(--amber-mid) 65%,var(--amber) 100%);
  position:relative;overflow:hidden;
  display:flex;flex-direction:column;justify-content:center;
  padding:clamp(2.5rem,5vw,4rem) clamp(2rem,4vw,3.5rem)
}
.auth-left::before{content:'';position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:rgba(30,64,175,.15);border-radius:50%;pointer-events:none}
.auth-left::after{content:'';position:absolute;bottom:-60px;left:-60px;width:240px;height:240px;background:rgba(255,255,255,.06);border-radius:50%;pointer-events:none}

/* Decorative wave bottom */
.auth-left .wave{position:absolute;bottom:0;left:0;right:0;height:120px;background:rgba(255,255,255,.04);clip-path:ellipse(60% 100% at 50% 100%);pointer-events:none}

.left-content{position:relative;z-index:1}
.left-logo{font-family:var(--font-display);font-size:1.65rem;font-weight:800;color:#fff;text-decoration:none;margin-bottom:2.5rem;display:flex;align-items:center;gap:.4rem;letter-spacing:-.3px}
.left-logo .logo-pill{background:rgba(255,255,255,.25);color:#fff;font-size:.6rem;font-weight:800;padding:.15rem .45rem;border-radius:50px;letter-spacing:.5px}
.left-headline{font-family:var(--font-display);font-size:clamp(1.6rem,2.8vw,2.3rem);font-weight:800;color:#fff;line-height:1.22;margin-bottom:.85rem;letter-spacing:-.5px}
.left-headline span{color:#FEF9C3}
.left-sub{font-size:.88rem;color:rgba(255,255,255,.68);line-height:1.75;margin-bottom:2rem}

/* Steps */
.steps{display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem}
.step{display:flex;align-items:flex-start;gap:.85rem}
.step-num{
  width:28px;height:28px;border-radius:50%;flex-shrink:0;
  background:rgba(255,255,255,.18);border:2px solid rgba(255,255,255,.3);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.8rem;font-weight:800;color:#fff;
  margin-top:.1rem
}
.step-title{font-size:.85rem;font-weight:700;color:#fff;margin-bottom:.12rem}
.step-desc{font-size:.75rem;color:rgba(255,255,255,.58);line-height:1.5}

/* Role mini cards */
.role-cards{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
.role-mini{
  background:rgba(255,255,255,.12);
  border:1px solid rgba(255,255,255,.18);
  border-radius:14px;padding:1rem;text-align:center;
  backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);
  transition:background .2s
}
.role-mini:hover{background:rgba(255,255,255,.18)}
.rmicon{font-size:1.5rem;margin-bottom:.35rem}
.rmtitle{font-family:var(--font-display);font-size:.88rem;font-weight:700;color:#fff}
.rmsub{font-size:.7rem;color:rgba(255,255,255,.52);margin-top:.15rem}

/* ── RIGHT PANEL ── */
.auth-right{
  display:flex;align-items:flex-start;justify-content:center;
  padding:clamp(2rem,4vw,3.5rem) clamp(1.25rem,4vw,2.5rem);
  background:var(--white);
  overflow-y:auto
}
.auth-form-wrap{width:100%;max-width:440px;padding-top:.5rem}

/* Mobile-only logo */
.mobile-logo{display:none;font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--blue-dark);text-decoration:none;margin-bottom:1.8rem;align-items:center;gap:.4rem}
.mobile-logo span{color:var(--orange)}

.back-link{display:inline-flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--gray-500);text-decoration:none;margin-bottom:1.8rem;transition:color .2s}
.back-link:hover{color:var(--blue)}
.form-title{font-family:var(--font-display);font-size:clamp(1.7rem,3vw,2.1rem);font-weight:800;color:var(--gray-900);margin-bottom:.35rem;letter-spacing:-.5px}
.form-subtitle{font-size:.86rem;color:var(--gray-500);margin-bottom:1.6rem;line-height:1.6}
.form-subtitle a{color:var(--blue);text-decoration:none;font-weight:600}
.form-subtitle a:hover{text-decoration:underline}

.alert-error{background:#FEF2F2;border:1.5px solid #FCA5A5;color:#991B1B;border-radius:12px;padding:.8rem 1rem;font-size:.83rem;margin-bottom:1rem;display:flex;align-items:flex-start;gap:.5rem}

/* ── ROLE SELECTOR ── */
.role-label-text{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.5rem}
.role-selector{display:grid;grid-template-columns:1fr 1fr;gap:.7rem;margin-bottom:1.1rem}
.role-option{position:relative}
.role-option input[type=radio]{position:absolute;opacity:0;width:0;height:0}
.role-label{
  display:flex;flex-direction:column;align-items:center;gap:.35rem;
  padding:.9rem;border:1.5px solid var(--gray-200);border-radius:14px;
  cursor:pointer;transition:all .2s;background:#fff
}
.r-icon{font-size:1.4rem;line-height:1}
.r-title{font-family:var(--font-display);font-size:.85rem;font-weight:700;color:var(--gray-700)}
.r-sub{font-size:.68rem;color:var(--gray-500);text-align:center;line-height:1.4}
.role-option input:checked + .role-label{border-color:var(--blue);background:var(--blue-light);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.role-option input:checked + .role-label .r-title{color:var(--blue-dark)}
.role-option.student input:checked + .role-label{border-color:var(--orange);background:var(--orange-light);box-shadow:0 0 0 3px rgba(249,115,22,.1)}
.role-option.student input:checked + .role-label .r-title{color:#9A3412}

/* ── FORM ── */
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:.85rem;margin-bottom:1rem}
.form-group{margin-bottom:1rem}
.form-group label{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.38rem}
.input-wrap{position:relative}
.input-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);font-size:.88rem;pointer-events:none;line-height:1}
.form-group input{
  width:100%;padding:.75rem 1rem .75rem 2.6rem;
  border:1.5px solid var(--gray-200);border-radius:12px;
  font-family:var(--font-body);font-size:.88rem;color:var(--gray-900);
  background:#fff;transition:border-color .2s,box-shadow .2s;outline:none;
  -webkit-appearance:none;appearance:none
}
.form-group input:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.form-group input::placeholder{color:var(--gray-300)}

/* Password strength bar */
.pw-strength{margin-top:.4rem;height:4px;background:var(--gray-100);border-radius:4px;overflow:hidden}
.pw-strength-fill{height:100%;width:0;border-radius:4px;transition:width .4s,background .4s}

/* Terms */
.terms{font-size:.76rem;color:var(--gray-500);margin:.25rem 0 1.2rem;line-height:1.6}
.terms a{color:var(--blue);text-decoration:none}
.terms a:hover{text-decoration:underline}

.submit-btn{
  width:100%;padding:.85rem;
  background:linear-gradient(135deg,var(--orange),#EA580C);color:#fff;
  border:none;border-radius:12px;
  font-family:var(--font-display);font-size:1rem;font-weight:700;
  cursor:pointer;transition:all .2s;
  letter-spacing:.2px
}
.submit-btn:hover{transform:translateY(-1px);box-shadow:0 8px 24px rgba(249,115,22,.35)}
.submit-btn:active{transform:translateY(0)}

/* ── RESPONSIVE ── */
@media(max-width:860px){
  .auth-layout{grid-template-columns:1fr}
  .auth-left{display:none}
  .mobile-logo{display:flex}
  .auth-right{min-height:100vh}
}
@media(max-width:480px){
  .auth-right{padding:2rem 1.25rem}
  .form-row{grid-template-columns:1fr}
  .form-title{font-size:1.7rem}
  .role-selector{grid-template-columns:1fr 1fr}
}
@media(max-width:360px){
  .role-selector{grid-template-columns:1fr}
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
    <div class="skeleton-steps">
      <div class="skeleton-step"><div class="skeleton-step-num"></div><div class="skeleton-step-text"><div class="skeleton-step-title"></div><div class="skeleton-step-desc"></div></div></div>
      <div class="skeleton-step"><div class="skeleton-step-num"></div><div class="skeleton-step-text"><div class="skeleton-step-title"></div><div class="skeleton-step-desc"></div></div></div>
      <div class="skeleton-step"><div class="skeleton-step-num"></div><div class="skeleton-step-text"><div class="skeleton-step-title"></div><div class="skeleton-step-desc"></div></div></div>
    </div>
    <div class="skeleton-role-cards">
      <div class="skeleton-role-card"></div>
      <div class="skeleton-role-card"></div>
    </div>
  </div>
  <div class="skeleton-right">
    <div class="skeleton-form">
      <div class="skeleton-form-title"></div>
      <div class="skeleton-role-selector">
        <div class="skeleton-role-opt"></div>
        <div class="skeleton-role-opt"></div>
      </div>
      <div class="skeleton-input"></div>
      <div class="skeleton-input"></div>
      <div class="skeleton-input-row">
        <div class="skeleton-input" style="margin-bottom:0"></div>
        <div class="skeleton-input" style="margin-bottom:0"></div>
      </div>
      <div class="skeleton-btn"></div>
    </div>
  </div>
</div>

<div class="auth-layout">

  <!-- LEFT PANEL -->
  <div class="auth-left">
    <div class="wave"></div>
    <div class="left-content">
      <a href="/" class="left-logo">Readerly <span class="logo-pill">PH</span></a>
      <div class="left-headline">Start your <span>reading journey</span> today!</div>
      <div class="left-sub">Create a free account and join Filipino students and teachers using Readerly across the Philippines.</div>
      <div class="steps">
        <div class="step">
          <div class="step-num">1</div>
          <div class="step-info">
            <div class="step-title">Create your account</div>
            <div class="step-desc">Fill in your details and choose your role — teacher or student.</div>
          </div>
        </div>
        <div class="step">
          <div class="step-num">2</div>
          <div class="step-info">
            <div class="step-title">Set up your classroom</div>
            <div class="step-desc">Teachers add classes and students. Students get assigned passages.</div>
          </div>
        </div>
        <div class="step">
          <div class="step-num">3</div>
          <div class="step-info">
            <div class="step-title">Start reading and growing</div>
            <div class="step-desc">Read aloud, get scored, and receive personalized AI stories.</div>
          </div>
        </div>
      </div>
      <div class="role-cards">
        <div class="role-mini"><div class="rmicon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg></div><div class="rmtitle">Teachers</div><div class="rmsub">Manage classes & track progress</div></div>
        <div class="role-mini"><div class="rmicon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div><div class="rmtitle">Students</div><div class="rmsub">Read, practice & level up</div></div>
      </div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="auth-right">
    <div class="auth-form-wrap">
      <!-- Mobile-only logo -->
      <a href="/" class="mobile-logo">Readerly</a>

      <a href="/" class="back-link">← Back to home</a>
      <div class="form-title">Create Account</div>
      <div class="form-subtitle">Already have an account? <a href="{{ route('login') }}">Sign in →</a></div>

      @if($errors->any())
        <div class="alert-error"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#991B1B" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> {{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role selector -->
        <span class="role-label-text">I am a…</span>
        <div class="role-selector">
          <div class="role-option">
            <input type="radio" name="role" id="role-teacher" value="teacher" {{ old('role','teacher')==='teacher'?'checked':'' }}>
            <label class="role-label" for="role-teacher">
              <span class="r-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg></span>
              <span class="r-title">Teacher</span>
              <span class="r-sub">I manage a classroom</span>
            </label>
          </div>
          <div class="role-option student">
            <input type="radio" name="role" id="role-student" value="student" {{ old('role')==='student'?'checked':'' }}>
            <label class="role-label" for="role-student">
              <span class="r-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#374151" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></span>
              <span class="r-title">Student</span>
              <span class="r-sub">I want to read & improve</span>
            </label>
          </div>
        </div>

        <!-- Full name -->
        <div class="form-group">
          <label for="name">Full Name</label>
          <div class="input-wrap">
            <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
            <input type="text" id="name" name="name" placeholder="Juan Dela Cruz" value="{{ old('name') }}" required autofocus>
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email">Email Address</label>
          <div class="input-wrap">
            <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
            <input type="email" id="email" name="email" placeholder="juan@school.ph" value="{{ old('email') }}" required>
          </div>
        </div>

        <!-- Password row -->
        <div class="form-row">
          <div class="form-group" style="margin-bottom:0">
            <label for="password">Password</label>
            <div class="input-wrap">
              <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
              <input type="password" id="password" name="password" placeholder="Min. 6 characters" required oninput="checkStrength(this.value)">
            </div>
            <div class="pw-strength"><div class="pw-strength-fill" id="pwBar"></div></div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-wrap">
              <span class="input-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></span>
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required>
            </div>
          </div>
        </div>

        <div class="terms" style="margin-top:1rem">
          By creating an account, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
        </div>

        <button type="submit" class="submit-btn">Create Account →</button>
      </form>
    </div>
  </div>
</div>

<script>
function checkStrength(val) {
  const bar = document.getElementById('pwBar');
  if (!bar) return;
  let score = 0;
  if(val.length >= 6) score++;
  if(val.length >= 10) score++;
  if(/[A-Z]/.test(val)) score++;
  if(/[0-9]/.test(val)) score++;
  if(/[^A-Za-z0-9]/.test(val)) score++;
  const widths = ['0%','25%','45%','65%','85%','100%'];
  const colors = ['','#EF4444','#F97316','#F59E0B','#3B82F6','#10B981'];
  bar.style.width = widths[score];
  bar.style.background = colors[score];
}

// Hide skeleton loader (min 2 seconds)
window.addEventListener('load', () => {
  setTimeout(() => {
    const skeleton = document.getElementById('skeleton');
    if(skeleton) skeleton.classList.add('hidden');
    setTimeout(() => { if(skeleton) skeleton.style.display = 'none'; }, 400);
  }, 2000);
});
</script>
</body>
</html>