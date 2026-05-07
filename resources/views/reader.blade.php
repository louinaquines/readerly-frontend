<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reading Session — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
@livewireStyles
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;--orange-dark:#C2410C;
  --blue:#1E40AF;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;--blue-mid:#3B82F6;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;--red-mid:#FEE2E2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
html,body{height:100%;scroll-behavior:smooth}
body{
  font-family:var(--font-body);
  background:linear-gradient(160deg,#FFFBEB 0%,#FFF7ED 50%,#FEF3C7 100%);
  min-height:100vh;color:var(--gray-900);
  display:flex;flex-direction:column
}

/* ── TOPBAR ── */
.topbar{
  height:60px;display:flex;align-items:center;justify-content:space-between;
  padding:0 clamp(1rem,4vw,2rem);
  background:rgba(255,255,255,.92);backdrop-filter:blur(20px);
  border-bottom:1px solid rgba(245,158,11,.15);flex-shrink:0;
  position:sticky;top:0;z-index:50
}
.back-link{
  display:inline-flex;align-items:center;gap:.4rem;
  font-size:.82rem;font-weight:600;color:var(--gray-500);
  text-decoration:none;transition:color .2s;
  padding:.4rem .75rem;border-radius:50px;
  border:1.5px solid var(--gray-200);background:#fff
}
.back-link:hover{color:var(--orange-dark);border-color:var(--orange)}
.topbar-center{display:flex;align-items:center;gap:.5rem}
.live-pill{
  display:inline-flex;align-items:center;gap:.4rem;
  background:var(--yellow-light);color:var(--yellow-dark);
  font-size:.72rem;font-weight:700;padding:.28rem .75rem;
  border-radius:50px;border:1px solid rgba(245,158,11,.25);letter-spacing:.3px
}
.live-dot{
  width:7px;height:7px;background:var(--orange);
  border-radius:50%;animation:pulse 2s infinite
}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.6)}}
.topbar-logo{
  font-family:var(--font-display);font-size:1.15rem;font-weight:800;
  color:var(--blue);text-decoration:none;letter-spacing:-.3px
}
.topbar-logo span{color:var(--yellow)}

/* ── BODY ── */
.reader-body{
  flex:1;display:flex;align-items:flex-start;justify-content:center;
  padding:clamp(1rem,3vw,2rem);overflow-y:auto
}
.reader-card{
  background:#fff;border-radius:24px;
  box-shadow:0 20px 60px rgba(0,0,0,.09),0 4px 12px rgba(0,0,0,.05);
  width:100%;max-width:700px;overflow:hidden
}

/* ── CARD HEADER ── */
.card-header{
  background:linear-gradient(135deg,#F97316 0%,#FBBF24 100%);
  padding:1.5rem 2rem;
  display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap
}
.header-left .header-title{
  font-family:var(--font-display);font-size:1.3rem;font-weight:800;
  color:#fff;line-height:1.2;margin-bottom:.2rem;letter-spacing:-.3px
}
.header-left .header-sub{font-size:.8rem;color:rgba(255,255,255,.8)}
.level-badge{
  background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.35);
  border-radius:14px;padding:.65rem 1.1rem;text-align:center;
  backdrop-filter:blur(4px);flex-shrink:0
}
.level-badge .lb-num{
  font-family:var(--font-display);font-size:1.6rem;font-weight:800;
  color:#fff;line-height:1
}
.level-badge .lb-lbl{
  font-size:.58rem;font-weight:700;color:rgba(255,255,255,.7);
  text-transform:uppercase;letter-spacing:.5px;margin-top:.1rem
}

/* ── CARD BODY ── */
.card-body{padding:clamp(1.25rem,3vw,2rem)}

/* Tip banner */
.tip-banner{
  background:linear-gradient(135deg,var(--yellow-light),#FFF7ED);
  border:1px solid rgba(245,158,11,.2);border-radius:14px;
  padding:.9rem 1.1rem;margin-bottom:1.5rem;
  display:flex;align-items:flex-start;gap:.75rem
}
.tip-icon{font-size:1.3rem;flex-shrink:0;margin-top:.05rem}
.tip-title{font-family:var(--font-display);font-size:.88rem;font-weight:700;color:var(--yellow-dark);margin-bottom:.18rem}
.tip-text{font-size:.76rem;color:var(--orange-dark);line-height:1.6}
</style>
</head>
<body>

<div class="topbar">
  <a href="{{ route('student.dashboard') }}" class="back-link">← Dashboard</a>
  <div class="topbar-center">
    <div class="live-pill">
      <div class="live-dot"></div>
      Live Session
    </div>
  </div>
  <a href="{{ route('student.dashboard') }}" class="topbar-logo">Reader<span>ly</span></a>
</div>

<div class="reader-body">
  <div class="reader-card">
    <div class="card-header">
      <div class="header-left">
        <div class="header-title">🎤 Time to Read!</div>
        <div class="header-sub">Read aloud clearly and confidently. You've got this!</div>
      </div>
      <div class="level-badge">
        <div class="lb-num">{{ session('user')['reading_level'] ?? session('user.reading_level', 1) }}</div>
        <div class="lb-lbl">Level</div>
      </div>
    </div>

    <div class="card-body">
      <div class="tip-banner">
        <div class="tip-icon">💡</div>
        <div>
          <div class="tip-title">Before you start</div>
          <div class="tip-text">Make sure your surroundings are quiet. Click "Start Reading", then read each word clearly. Don't worry about mistakes — just try your best!</div>
        </div>
      </div>

      <div class="livewire-reader-wrap">
        <livewire:student-reader
          :sessionId="$sessionId"
          :studentId="$studentId"
          :passage="$passage"
        />
      </div>
    </div>
  </div>
</div>

@livewireScripts
</body>
</html>