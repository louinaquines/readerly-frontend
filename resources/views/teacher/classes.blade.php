<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Classes — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --blue-50:#EFF6FF;--blue-100:#DBEAFE;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;--red-mid:#FEE2E2;
  --amber:#D97706;--amber-light:#FFFBEB;
  --white:#fff;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;
  --radius:12px;--radius-lg:18px;--radius-xl:24px;
}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

/* ── SIDEBAR ── */
.sidebar{
  position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);
  background:linear-gradient(180deg,var(--blue-dark) 0%,#1E40AF 100%);
  z-index:200;display:flex;flex-direction:column;
  transition:transform .3s
}
.sidebar-logo{
  height:var(--topbar-h);display:flex;align-items:center;
  padding:0 1.4rem;border-bottom:1px solid rgba(255,255,255,.08)
}
.sidebar-logo a{
  font-family:var(--font-display);font-size:1.35rem;font-weight:800;
  color:#fff;text-decoration:none;letter-spacing:-.3px;
  display:flex;align-items:center;gap:.4rem;color:var(--white);
}
.sidebar-logo span{
  font-family:var(--font-display);font-size:1.35rem;font-weight:800;
  color:#fff;text-decoration:none;letter-spacing:-.3px;margin-left:-5px; margin-top:2px;
  display:flex;align-items:center;gap:.4rem;color:var(--yellow);
}
.sidebar-nav{flex:1;padding:1.25rem 0;overflow-y:auto}
.nav-section-label{
  font-size:.65rem;font-weight:700;color:rgba(255,255,255,.35);
  text-transform:uppercase;letter-spacing:1px;
  padding:.65rem 1.4rem .35rem
}
.nav-item{
  display:flex;align-items:center;gap:.75rem;
  padding:.65rem 1.4rem;margin:0 .6rem;border-radius:10px;
  color:rgba(255,255,255,.65);font-size:.875rem;font-weight:500;
  text-decoration:none;transition:all .2s;cursor:pointer
}
.nav-item:hover{background:rgba(255,255,255,.1);color:#fff}
.nav-item.active{background:rgba(255,255,255,.15);color:#fff;font-weight:600}
.nav-item .nav-icon{width:18px;text-align:center;font-size:.95rem;flex-shrink:0}
.nav-item .nav-badge{
  margin-left:auto;background:var(--orange);color:#fff;
  font-size:.65rem;font-weight:700;min-width:18px;height:18px;
  border-radius:9px;display:flex;align-items:center;justify-content:center;
  padding:0 .3rem
}
.sidebar-footer{
  padding:1.25rem 1.4rem;border-top:1px solid rgba(255,255,255,.08)
}
.sidebar-user{display:flex;align-items:center;gap:.7rem;margin-bottom:.75rem}
.sidebar-avatar{
  width:34px;height:34px;border-radius:50%;
  background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.2);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.78rem;font-weight:700;color:#fff;flex-shrink:0
}
.sidebar-user-name{font-size:.82rem;font-weight:600;color:#fff;line-height:1.2}
.sidebar-user-role{font-size:.68rem;color:rgba(255,255,255,.45)}
.sidebar-logout{
  display:flex;align-items:center;justify-content:center;gap:.4rem;
  width:100%;padding:.55rem;border-radius:9px;
  background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);
  color:rgba(255,255,255,.6);font-size:.8rem;font-weight:500;font-family:var(--font-body);
  cursor:pointer;transition:all .2s
}
.sidebar-logout:hover{background:rgba(255,255,255,.15);color:#fff}

/* Mobile overlay */
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:199}
.sidebar-overlay.open{display:block}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

/* ── TOPBAR ── */
.topbar{
  height:var(--topbar-h);position:sticky;top:0;z-index:100;
  background:rgba(255,255,255,.95);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid var(--gray-200);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 clamp(1.25rem,3vw,2rem);gap:1rem
}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.hamburger{
  display:none;flex-direction:column;gap:4px;
  cursor:pointer;padding:.35rem;border:none;background:transparent
}
.hamburger span{display:block;width:20px;height:2px;background:var(--gray-700);border-radius:2px;transition:all .25s}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900);margin-left: 10px;}
.topbar-right{display:flex;align-items:center;gap:.75rem}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

/* ── PAGE CONTENT ── -->
.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.75rem;flex-wrap:wrap;gap:.75rem}
.page-title{font-family:var(--font-display);font-size:clamp(1.65rem,4vw,2.1rem);font-weight:800;color:var(--gray-900);line-height:1.1;margin-left: 2rem;margin-top:2rem;}
.page-actions{display:flex;gap:.5rem;flex-wrap:wrap}

/* ── CLASS CARDS ── */
.class-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem}
.class-card{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px solid var(--gray-200);
  text-decoration:none;display:block;
  transition:all .25s;overflow:hidden;
  box-shadow:0 2px 8px rgba(0,0,0,.04)
}
.class-card:hover{transform:translateY(-4px);border-color:var(--blue-mid);box-shadow:0 16px 40px rgba(0,0,0,.1)}
.class-card-header{
  padding:1.5rem 1.75rem 1.25rem;
  background:linear-gradient(135deg,var(--blue-light) 0%,var(--blue-50) 100%);
  border-bottom:1px solid var(--blue-100);
  position:relative;overflow:hidden
}
.class-card-header::before{
  content:'';position:absolute;right:-60px;top:-40px;
  width:100px;height:100px;background:var(--blue);opacity:.07;
  border-radius:50%
}
.class-icon{
  width:48px;height:48px;border-radius:14px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;background:linear-gradient(135deg,#2563EB,#1D4ED8);
  color:#fff;margin-bottom:1rem;position:relative;z-index:1
}
.class-name{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:var(--gray-900);line-height:1.25;margin-bottom:.4rem}
.class-meta{font-size:.82rem;color:var(--gray-500);display:flex;align-items:center;gap:.4rem}
.class-students{font-weight:600}
.class-grade{display:flex;align-items:center;gap:.2rem;background:var(--gray-100);color:var(--gray-700);font-size:.75rem;font-weight:600;padding:.2rem .6rem;border-radius:50px}
.class-body{padding:1.5rem 1.75rem}
.class-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-bottom:1.25rem}
.stat-item{display:flex;flex-direction:column;align-items:center;text-align:center;padding:.75rem .5rem}
.stat-icon{width:36px;height:36px;border-radius:10px;margin-bottom:.4rem;display:flex;align-items:center;justify-content:center;font-size:.95rem}
.stat-number{font-family:var(--font-display);font-size:1.3rem;font-weight:800;color:var(--gray-900)}
.stat-label{font-size:.7rem;color:var(--gray-500);font-weight:500;text-transform:uppercase;letter-spacing:.3px}
.stat-green .stat-icon{background:var(--green-light);color:var(--green)}
.stat-yellow .stat-icon{background:var(--yellow-light);color:var(--yellow-dark)}
.stat-red .stat-icon{background:var(--red-light);color:var(--red)}
.class-footer{display:flex;align-items:center;justify-content:space-between;padding-top:1rem;border-top:1px solid var(--gray-100)}
.class-link{font-size:.82rem;font-weight:600;color:var(--blue);display:flex;align-items:center;gap:.3rem}
.cta-button{
  display:flex;align-items:center;gap:.5rem;
  background:linear-gradient(135deg,var(--blue),var(--blue-dark));
  color:#fff;font-weight:600;font-size:.88rem;padding:.6rem 1.25rem;
  border-radius:12px;border:none;cursor:pointer;transition:all .2s;font-family:var(--font-body)
}
.cta-button:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(30,64,175,.3)}

/* ── EMPTY STATE ── */
.empty-state{
  background:#fff;border-radius:var(--radius-xl);
  border:2px dashed var(--gray-200);
  padding:4rem 2rem;text-align:center;
  grid-column:1/-1
}
.empty-icon{font-size:4rem;margin-bottom:1rem;color:var(--gray-300)}
.empty-title{font-family:var(--font-display);font-size:1.6rem;font-weight:700;color:var(--gray-700);margin-bottom:.75rem}
.empty-subtitle{font-size:.95rem;color:var(--gray-500);line-height:1.6;max-width:400px;margin:0 auto}
.empty-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2rem}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .class-grid{grid-template-columns:repeat(auto-fill,minmax(280px,1fr))}
}
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .hamburger{display:flex}
  .class-grid{grid-template-columns:1fr}
  .page-header .page-title{font-size:1.6rem}
  .class-stats{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:480px){
  .content{padding:1rem}
  .class-footer{flex-direction:column;gap:.75rem}
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <a href="/teacher/dashboard">Reader<span>ly</span></a>
  </div>
  @include('teacher.partials.sidebar')
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ strtoupper(substr(session('user')['name'] ?? 'T', 0, 2)) }}</div>
      <div>
        <div class="sidebar-user-name">{{ session('user')['name'] ?? 'Teacher' }}</div>
        <div class="sidebar-user-role">Teacher</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="sidebar-logout">↩ Sign Out</button>
    </form>
  </div>
</aside>

<!-- MOBILE OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- MAIN -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
      <div class="topbar-title">Classes</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">
    
    <div class="page-header">
<h1 class="page-title" data-lang="page-my-classes" data-lang-en="My Classes" data-lang-fil="Mga Klas Ko">My Classes</h1>
    </div>

    @if(session('success'))
      <div style="background:var(--green-light);border:1px solid var(--green-mid);border-radius:var(--radius);padding:1rem;margin-bottom:1.5rem;color:var(--green);font-weight:500">
        {{ session('success') }}
      </div>
    @endif

    <div class="class-grid">
      @forelse($classes as $class)
        @php
          $students = collect($class['students'] ?? []);
          $totalStudents = $students->count();
          $greenCount = $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 80)->count();
          $yellowCount = $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 60 && ($s['latest_score'] ?? 0) < 80)->count();
          $redCount = $students->filter(fn($s) => isset($s['latest_score']) && ($s['latest_score'] ?? 0) < 60)->count();
          $avgScore = $students->where('latest_score', '!=', null)->avg('latest_score') ?? 0;
          $classColors = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316','#059669'];
          $classBg = $classColors[array_sum(array_map('ord', str_split($class['name']))) % count($classColors)];
        @endphp
        <a href="{{ route('teacher.class', $class['id']) }}" class="class-card">
          <div class="class-card-header">
            <div class="class-icon" style="background:{{ $classBg }}15;color:{{ $classBg }}">🏫</div>
            <div class="class-name">{{ $class['name'] }}</div>
            <div class="class-meta">
              <span class="class-students">{{ $totalStudents }} student{{ $totalStudents !== 1 ? 's' : '' }}</span>
              @if(isset($class['grade_level']))
                <span class="class-grade">Grade {{ $class['grade_level'] }}</span>
              @endif
            </div>
          </div>
          <div class="class-body">
            <div class="class-stats">
              <div class="stat-item stat-green">
                <div class="stat-icon">✅</div>
                <div class="stat-number">{{ $greenCount }}</div>
                <span data-lang="stat-passing" data-lang-en="Passing" data-lang-fil="Naaprubahan">Passing</span>
              </div>
              <div class="stat-item stat-yellow">
                <div class="stat-icon">⚠️</div>
                <div class="stat-number">{{ $yellowCount }}</div>
                <span data-lang="stat-at-risk" data-lang-en="At Risk" data-lang-fil="Nasa Panganib">At Risk</span>
              </div>
              <div class="stat-item stat-red">
                <div class="stat-icon">❌</div>
                <div class="stat-number">{{ $redCount }}</div>
                <span data-lang="stat-struggling" data-lang-en="Struggling" data-lang-fil="Nahihirapan">Struggling</span>
              </div>
            </div>
            <div style="margin-bottom:1rem">
              <div style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--gray-500);margin-bottom:.25rem">
                📊 Avg accuracy: <span style="font-family:var(--font-display);font-weight:700;font-size:1rem;color:var(--gray-900)">{{ round($avgScore) }}%</span>
              </div>
            </div>
            <div class="class-footer">
              <div class="class-link">View class details →</div>
              <button class="cta-button" onclick="window.location.href='{{ route('teacher.class', $class['id']) }}'">
                👁 View Class
              </button>
            </div>
          </div>
        </a>
      @empty
        <div class="empty-state">
          <div class="empty-icon">🏫</div>
          <div class="empty-title" data-lang="empty-classes-title" data-lang-en="No Classes Yet" data-lang-fil="Walang Klas Pa">No Classes Yet</div>
          <div class="empty-subtitle" data-lang="empty-classes-subtitle" data-lang-en="You haven't created any classes. Classes are where you organize your students and track their reading progress." data-lang-fil="Wala pang nilikhang klase. Dito mo inoorganisa ang mga estudyante mo at susubaybayan ang progreso ng pagbabasa nila.">You haven't created any classes. Classes are where you organize your students and track their reading progress.</div>
          <div class="empty-actions">
            <a href="{{ route('teacher.dashboard') }}" style="background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;font-weight:600;font-size:.95rem;padding:1rem 2rem;border-radius:14px;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem;box-shadow:0 4px 12px rgba(30,64,175,.2)">← Back to Dashboard</a>
          </div>
        </div>
      @endforelse
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
// Sidebar toggle
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

// Live clock
function updateTime() {
  const el = document.getElementById('topbarTime');
  if (!el) return;
  const now = new Date();
  el.textContent = now.toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateTime();
setInterval(updateTime, 60000);
</script>

</body>
</html>
