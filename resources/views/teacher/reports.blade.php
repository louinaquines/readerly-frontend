<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PDF Reports — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --sidebar-w:240px;--topbar-h:64px;--radius:12px;--radius-lg:18px;
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --blue:#1E40AF;--blue-dark:#1E3A5F;--blue-light:#EFF6FF;--blue-mid:#3B82F6;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-400:#9CA3AF;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
*{font-family:var(--font-body)}
body{background:var(--gray-50);color:var(--gray-900);min-height:100vh}

/* ── SIDEBAR ── */
.sidebar{position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);background:linear-gradient(180deg,var(--blue-dark) 0%,#1E40AF 100%);z-index:200;display:flex;flex-direction:column;transition:transform .3s}
.sidebar-logo{height:var(--topbar-h);display:flex;align-items:center;padding:0 1.4rem;border-bottom:1px solid rgba(255,255,255,.08)}
.sidebar-logo a{font-family:var(--font-display);font-size:1.35rem;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-.3px;display:flex;align-items:center;gap:.4rem}
.s-pill{background:var(--yellow);color:var(--yellow-dark);font-size:.58rem;font-weight:800;padding:.12rem .4rem;border-radius:50px;letter-spacing:.4px}
.sidebar-nav{flex:1;padding:1.25rem 0;overflow-y:auto}
.nav-section-label{font-size:.65rem;font-weight:700;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:1px;padding:.65rem 1.4rem .35rem}
.nav-item{display:flex;align-items:center;gap:.75rem;padding:.65rem 1.4rem;margin:0 .6rem;border-radius:10px;color:rgba(255,255,255,.65);font-size:.875rem;font-weight:500;text-decoration:none;transition:all .2s}
.nav-item:hover{background:rgba(255,255,255,.1);color:#fff}
.nav-item.active{background:rgba(255,255,255,.15);color:#fff;font-weight:600}
.nav-icon{width:18px;text-align:center;font-size:.95rem;flex-shrink:0}
.sidebar-footer{padding:1rem 1.4rem;border-top:1px solid rgba(255,255,255,.08)}
.sidebar-user{display:flex;align-items:center;gap:.7rem;margin-bottom:.75rem}
.sidebar-avatar{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:.78rem;font-weight:700;color:#fff;flex-shrink:0}
.sidebar-user-name{font-size:.82rem;font-weight:600;color:#fff;line-height:1.2}
.sidebar-user-role{font-size:.68rem;color:rgba(255,255,255,.45)}
.sidebar-logout{display:flex;align-items:center;justify-content:center;gap:.4rem;width:100%;padding:.55rem;border-radius:9px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.6);font-size:.8rem;font-weight:500;cursor:pointer;transition:all .2s}
.sidebar-logout:hover{background:rgba(255,255,255,.15);color:#fff}
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:199}
.sidebar-overlay.open{display:block}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

/* ── TOPBAR ── */
.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.hamburger{display:none;flex-direction:column;gap:4px;cursor:pointer;padding:.35rem;border:none;background:transparent}
.hamburger span{display:block;width:20px;height:2px;background:var(--gray-700);border-radius:2px;transition:all .25s}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

/* ── CONTENT ── */
.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

/* ── PAGE STYLES ── */
.page-title{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--gray-900);letter-spacing:-.3px;margin-bottom:1.5rem}
.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);padding:clamp(1.25rem,3vw,1.75rem)}
.class-block{margin-bottom:1.75rem}
.class-block:last-child{margin-bottom:0}
.class-name{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:.85rem;display:flex;align-items:center;gap:.5rem}
.class-name::before{content:'';width:4px;height:18px;background:var(--blue);border-radius:2px;display:inline-block}
.students-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:.85rem}
.student-export-card{display:flex;align-items:center;justify-content:space-between;gap:1rem;border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:.9rem 1.1rem;background:var(--gray-50);transition:border-color .2s,background .2s}
.student-export-card:hover{border-color:var(--blue-mid);background:var(--blue-light)}
.student-export-info .s-name{font-size:.9rem;font-weight:600;color:var(--gray-900)}
.student-export-info .s-meta{font-size:.72rem;color:var(--gray-500);margin-top:.1rem}
.export-btn{display:inline-flex;align-items:center;gap:.35rem;background:var(--blue);color:#fff;font-size:.78rem;font-weight:600;padding:.5rem .95rem;border-radius:50px;text-decoration:none;white-space:nowrap;transition:all .2s;font-family:var(--font-body)}
.export-btn:hover{background:var(--blue-dark);transform:translateY(-1px)}
.no-students{font-size:.82rem;color:var(--gray-400);font-style:italic;padding:.5rem 0}

/* ── RESPONSIVE ── */
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)!important}
  .sidebar.open{transform:translateX(0)!important}
  .main{margin-left:0}
  .hamburger{display:flex}
  .topbar-time{display:none}
}
@media(max-width:480px){
  .students-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<aside id="sidebar" class="sidebar">
@include('teacher.partials.sidebar')
</aside>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
      <div class="topbar-title">PDF Reports</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="page-title">📄 PDF Reports</div>

    <div class="panel">
      <p style="font-size:.88rem;color:var(--gray-500);margin-bottom:1.5rem">
        Select a student to export their complete reading report as a PDF.
      </p>

      @forelse($classes as $class)
        <div class="class-block">
          <div class="class-name">
            {{ $class['name'] }} — {{ $class['grade_level'] ?? '' }}
          </div>
          @php $students = $class['students'] ?? []; @endphp
          @if(empty($students))
            <p class="no-students">No students in this class.</p>
          @else
            <div class="students-grid">
              @foreach($students as $student)
                <div class="student-export-card">
                  <div class="student-export-info">
                    <div class="s-name">{{ $student['name'] }}</div>
                    <div class="s-meta">
                      {{ $student['grade'] ?? $student['grade_level'] ?? '' }}
                      · Level {{ $student['reading_level'] ?? 1 }}
                    </div>
                  </div>
                  <a href="{{ route('teacher.export', [$class['id'], $student['id']]) }}"
                     class="export-btn">
                    📄 Export
                  </a>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      @empty
        <div style="text-align:center;padding:2.5rem;color:var(--gray-400)">
          <div style="font-size:2rem;margin-bottom:.75rem">📄</div>
          <div style="font-family:var(--font-display);font-weight:700;color:var(--gray-700);margin-bottom:.35rem">No classes yet</div>
          <div style="font-size:.83rem">Add classes and students to generate PDF reports.</div>
        </div>
      @endforelse
    </div>
  </div>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const hamburger = document.getElementById('hamburger');
hamburger?.addEventListener('click', () => {
  sidebar.classList.toggle('open');
  overlay.classList.toggle('open');
});
overlay?.addEventListener('click', () => {
  sidebar.classList.remove('open');
  overlay.classList.remove('open');
});
function updateTime() {
  const el = document.getElementById('topbarTime');
  if (!el) return;
  el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateTime();
setInterval(updateTime, 60000);
</script>
</body>
</html>