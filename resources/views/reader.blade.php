<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Basahin — Sulong Basa</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
@livewireStyles
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;--orange-dark:#C2410C;
  --blue:#1E40AF;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;
  --white:#fff;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
html,body{height:100%}
body{
  font-family:var(--font-body);
  background:linear-gradient(160deg,#FFFBEB 0%,#FFF7ED 50%,#FEF3C7 100%);
  min-height:100vh;color:var(--gray-900);
  display:flex;flex-direction:column
}

/* ── TOPBAR ── */
.reader-topbar{
  height:60px;display:flex;align-items:center;justify-content:space-between;
  padding:0 clamp(1rem,4vw,2rem);
  background:rgba(255,255,255,.88);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(245,158,11,.15);flex-shrink:0
}
.reader-logo{font-family:var(--font-display);font-size:1.2rem;font-weight:800;color:var(--yellow-dark);text-decoration:none;display:flex;align-items:center;gap:.3rem}
.reader-logo .dot{width:7px;height:7px;background:var(--orange);border-radius:50%}
.topbar-center{display:flex;align-items:center;gap:.6rem}
.session-pill{display:inline-flex;align-items:center;gap:.35rem;background:var(--yellow-light);color:var(--yellow-dark);font-size:.72rem;font-weight:700;padding:.25rem .7rem;border-radius:50px;border:1px solid rgba(245,158,11,.25);letter-spacing:.3px}
.session-pill .s-dot{width:6px;height:6px;background:var(--orange);border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.5)}}
.back-link{display:inline-flex;align-items:center;gap:.35rem;font-size:.8rem;font-weight:600;color:var(--gray-500);text-decoration:none;transition:color .2s}
.back-link:hover{color:var(--orange-dark)}

/* ── MAIN READER AREA ── */
.reader-body{flex:1;display:flex;align-items:center;justify-content:center;padding:clamp(1rem,4vw,2rem);overflow-y:auto}
.reader-card{
  background:#fff;border-radius:28px;
  box-shadow:0 24px 64px rgba(0,0,0,.1),0 4px 12px rgba(0,0,0,.06);
  width:100%;max-width:680px;
  overflow:hidden
}

/* ── CARD HEADER ── */
.reader-card-header{
  background:linear-gradient(135deg,var(--orange),var(--yellow));
  padding:clamp(1.25rem,3vw,1.75rem) clamp(1.25rem,3vw,2rem);
  display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap
}
.reader-header-left{}
.reader-title{font-family:var(--font-display);font-size:clamp(1.1rem,2.5vw,1.4rem);font-weight:800;color:#fff;line-height:1.2;margin-bottom:.2rem;letter-spacing:-.3px}
.reader-subtitle{font-size:.8rem;color:rgba(255,255,255,.8)}
.reader-level-badge{background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.35);border-radius:12px;padding:.6rem 1rem;text-align:center;backdrop-filter:blur(4px)}
.level-num{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:#fff;line-height:1}
.level-lbl{font-size:.6rem;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.5px}

/* ── CARD BODY ── */
.reader-card-body{padding:clamp(1.25rem,3vw,2rem)}

/* Passage display */
.passage-box{
  background:linear-gradient(135deg,#EFF6FF,#F0F9FF);
  border-radius:16px;padding:clamp(1.1rem,3vw,1.5rem);
  margin-bottom:1.5rem;border:1px solid rgba(59,130,246,.1)
}
.passage-box-label{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:.85rem
}
.passage-box-label-text{font-size:.68rem;font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.6px}
.word-progress{font-size:.7rem;font-weight:700;color:var(--orange);background:rgba(249,115,22,.1);padding:.15rem .5rem;border-radius:50px}

.passage-words{display:flex;flex-wrap:wrap;gap:6px;line-height:2.2}
.word{
  font-family:var(--font-display);
  font-size:clamp(1rem,2.5vw,1.2rem);
  font-weight:700;padding:4px 10px;border-radius:8px;
  background:#fff;color:var(--gray-500);
  border:1.5px solid rgba(0,0,0,.06);
  transition:all .3s
}
.word.read{background:var(--green-mid);color:#065F46;border-color:rgba(6,95,70,.15)}
.word.current{
  background:var(--yellow);color:var(--yellow-dark);
  transform:scale(1.12);box-shadow:0 4px 14px rgba(245,158,11,.45);
  border-color:transparent
}
.word.error{background:var(--red-light);color:var(--red);border-color:rgba(220,38,38,.2)}

/* Waveform */
.waveform-section{
  display:flex;align-items:center;gap:.75rem;
  background:var(--gray-50);border-radius:12px;
  padding:.85rem 1rem;margin-bottom:1.25rem
}
.waveform{display:flex;align-items:center;gap:3px;height:32px}
.wbar{width:3px;border-radius:3px;background:var(--orange);animation:wave 1.2s ease-in-out infinite}
.wbar:nth-child(1){height:8px;animation-delay:0s}
.wbar:nth-child(2){height:20px;animation-delay:.1s}
.wbar:nth-child(3){height:28px;animation-delay:.2s}
.wbar:nth-child(4){height:16px;animation-delay:.3s}
.wbar:nth-child(5){height:24px;animation-delay:.15s}
.wbar:nth-child(6){height:12px;animation-delay:.25s}
.wbar:nth-child(7){height:22px;animation-delay:.05s}
.wbar:nth-child(8){height:18px;animation-delay:.35s}
.wbar:nth-child(9){height:30px;animation-delay:.1s}
.wbar:nth-child(10){height:14px;animation-delay:.2s}
.wbar.idle{animation:none;transform:scaleY(.3);opacity:.3}
@keyframes wave{0%,100%{transform:scaleY(.35);opacity:.5}50%{transform:scaleY(1);opacity:1}}
.waveform-status{flex:1}
.waveform-status-text{font-size:.82rem;font-weight:600;color:var(--gray-700);margin-bottom:.1rem}
.waveform-status-sub{font-size:.7rem;color:var(--gray-400)}

/* Accuracy bar */
.accuracy-section{margin-bottom:1.5rem}
.accuracy-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:.4rem}
.accuracy-label{font-size:.78rem;font-weight:600;color:var(--gray-700)}
.accuracy-pct{font-family:var(--font-display);font-size:1.1rem;font-weight:800;color:var(--orange)}
.accuracy-track{background:var(--gray-100);border-radius:50px;height:10px;overflow:hidden}
.accuracy-fill{height:100%;border-radius:50px;background:linear-gradient(90deg,#FCD34D,var(--orange));transition:width .8s ease}

/* Controls */
.reader-controls{display:flex;gap:.85rem;justify-content:center;flex-wrap:wrap}
.ctrl-btn{
  display:inline-flex;align-items:center;gap:.5rem;
  font-family:var(--font-display);font-size:1rem;font-weight:700;
  padding:.75rem 1.75rem;border-radius:50px;cursor:pointer;
  border:none;transition:all .2s;white-space:nowrap
}
.ctrl-btn-primary{
  background:linear-gradient(135deg,var(--orange),var(--yellow));color:#fff;
  box-shadow:0 6px 20px rgba(249,115,22,.35)
}
.ctrl-btn-primary:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(249,115,22,.45)}
.ctrl-btn-primary:active{transform:translateY(0)}
.ctrl-btn-secondary{background:var(--gray-100);color:var(--gray-700)}
.ctrl-btn-secondary:hover{background:var(--gray-200)}
.ctrl-btn-success{background:linear-gradient(135deg,var(--green),#10B981);color:#fff;box-shadow:0 6px 20px rgba(5,150,105,.3)}
.ctrl-btn-success:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(5,150,105,.4)}

/* ── TIPS BANNER ── */
.tips-banner{
  background:linear-gradient(135deg,var(--yellow-light),var(--orange-light));
  border-radius:14px;padding:1rem 1.25rem;
  display:flex;align-items:flex-start;gap:.85rem;margin-bottom:1.5rem;
  border:1px solid rgba(245,158,11,.2)
}
.tip-icon{font-size:1.4rem;flex-shrink:0;margin-top:.1rem}
.tip-content{}
.tip-title{font-family:var(--font-display);font-size:.9rem;font-weight:700;color:var(--yellow-dark);margin-bottom:.2rem}
.tip-text{font-size:.78rem;color:var(--orange-dark);line-height:1.6}

/* ── LIVEWIRE WRAPPER ── */
/* The Livewire component renders inside .reader-card-body.
   These styles ensure whatever the component renders looks right
   even without the component being open here. */
.livewire-reader-wrap{width:100%}

/* Success overlay (shown by Livewire after completion) */
.completion-overlay{
  text-align:center;padding:2rem 1.5rem
}
.completion-icon{font-size:4rem;margin-bottom:1rem}
.completion-title{font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gray-900);margin-bottom:.5rem}
.completion-score{font-family:var(--font-display);font-size:2.5rem;font-weight:800;margin:1rem 0}
.completion-sub{font-size:.9rem;color:var(--gray-500);line-height:1.7;margin-bottom:1.5rem}
.back-home-btn{display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,var(--orange),var(--yellow));color:#fff;font-family:var(--font-display);font-size:.95rem;font-weight:700;padding:.75rem 1.75rem;border-radius:50px;text-decoration:none;transition:all .2s;box-shadow:0 6px 20px rgba(249,115,22,.3)}
.back-home-btn:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(249,115,22,.4)}

/* ── RESPONSIVE ── */
@media(max-width:600px){
  .reader-card{border-radius:20px}
  .topbar-center{display:none}
  .reader-controls{flex-direction:column;align-items:stretch}
  .ctrl-btn{justify-content:center}
  .word{font-size:.95rem}
}
@media(max-width:400px){
  .reader-card-body{padding:1rem}
  .reader-card-header{padding:1rem 1.1rem}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="reader-topbar">
  <a href="{{ route('student.dashboard') }}" class="back-link">← Dashboard</a>
  <div class="topbar-center">
    <div class="session-pill">
      <div class="s-dot"></div>
      Live Session
    </div>
  </div>
  <a href="{{ route('student.dashboard') }}" class="reader-logo">
    <div class="dot"></div>
    Sulong Basa
  </a>
</div>

<!-- READER BODY -->
<div class="reader-body">
  <div class="reader-card">

    <!-- Card Header -->
    <div class="reader-card-header">
      <div class="reader-header-left">
        <div class="reader-title">🎤 Oras na para Basahin!</div>
        <div class="reader-subtitle">Basahin nang malakas at malinaw. Kaya mo yan!</div>
      </div>
      <div class="reader-level-badge">
        <div class="level-num">{{ session('user.reading_level', 1) }}</div>
        <div class="level-lbl">Level</div>
      </div>
    </div>

    <!-- Card Body — Livewire component renders here -->
    <div class="reader-card-body">

      <!-- Tips -->
      <div class="tips-banner">
        <div class="tip-icon">💡</div>
        <div class="tip-content">
          <div class="tip-title">Tip bago magsimula</div>
          <div class="tip-text">Siguraduhing tahimik ang iyong paligid. I-click ang "Simulan" at basahin ang bawat salita nang malinaw. Huwag mag-alala kung may mali — subukan lang!</div>
        </div>
      </div>

      <!-- Livewire student reader component -->
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