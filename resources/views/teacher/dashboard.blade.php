<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Dashboard — Readerly</title>
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
  padding:1rem 1.4rem;border-top:1px solid rgba(255,255,255,.08)
}
.sidebar-user{display:flex;align-items:center;gap:.7rem;margin-bottom:.75rem}
.sidebar-avatar{
  width:34px;height:34px;border-radius:50%;
  background:transparent;border:2px solid white;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.78rem;font-weight:700;color:#fff;flex-shrink:0;overflow:hidden;aspect-ratio:1/1
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
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-right{display:flex;align-items:center;gap:.75rem}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

/* Alert bell */
.alert-bell{
  position:relative;width:36px;height:36px;border-radius:10px;
  border:1.5px solid var(--gray-200);background:#fff;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:all .2s;font-size:1rem
}
.alert-bell:hover{border-color:var(--blue-mid);background:var(--blue-50)}
.alert-bell .bell-dot{
  position:absolute;top:5px;right:5px;width:8px;height:8px;
  background:var(--orange);border-radius:50%;border:2px solid #fff;
  animation:bellPulse 2s infinite
}
@keyframes bellPulse{0%,100%{transform:scale(1)}50%{transform:scale(1.3)}}

/* ── PAGE CONTENT ── */
.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

/* ── STATS ROW ── */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:clamp(.75rem,2vw,1.1rem);margin-bottom:1.75rem}
.stat-card{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px solid var(--gray-200);
  padding:clamp(1rem,2.5vw,1.35rem);
  transition:transform .2s,box-shadow .2s
}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.06)}
.stat-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem}
.stat-icon-wrap{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:1.1rem}
.stat-trend{font-size:.72rem;font-weight:700;padding:.18rem .5rem;border-radius:50px}
.trend-up{background:#D1FAE5;color:#065F46}
.trend-neutral{background:var(--gray-100);color:var(--gray-500)}
.stat-num{font-family:var(--font-display);font-size:1.85rem;font-weight:800;color:var(--gray-900);line-height:1;margin-bottom:.2rem}
.stat-label{font-size:.75rem;color:var(--gray-500);font-weight:500}

/* ── TWO-COL GRID ── */
.two-col{display:grid;grid-template-columns:1.6fr 1fr;gap:clamp(.75rem,2vw,1.25rem);margin-bottom:1.75rem}

/* ── PANEL ── */
.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200)}
.panel-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:1rem 1.25rem;border-bottom:1px solid var(--gray-100);gap:.5rem;flex-wrap:wrap
}
.panel-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:.5rem}
.panel-title .p-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:.8rem}
.panel-link{font-size:.78rem;color:var(--blue);text-decoration:none;font-weight:600;transition:color .2s}
.panel-link:hover{color:var(--blue-dark)}
.panel-body{padding:1rem 1.25rem}

/* ── STUDENT LIST (traffic light) ── */
.student-list{list-style:none}
.student-item{
  display:flex;align-items:center;gap:.85rem;
  padding:.75rem 0;border-bottom:1px solid var(--gray-100)
}
.student-item:last-child{border-bottom:none}
.traffic-dot{width:11px;height:11px;border-radius:50%;flex-shrink:0}
.dot-green{background:#10B981;box-shadow:0 0 0 3px rgba(16,185,129,.15)}
.dot-yellow{background:var(--yellow);box-shadow:0 0 0 3px rgba(245,158,11,.15)}
.dot-red{background:var(--red);box-shadow:0 0 0 3px rgba(220,38,38,.15)}
.dot-gray{background:var(--gray-300)}
.student-avatar{
  width:34px;height:34px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.78rem;font-weight:700;color:#fff
}
.student-info{flex:1;min-width:0}
.student-name{font-size:.85rem;font-weight:600;color:var(--gray-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.student-meta{font-size:.72rem;color:var(--gray-400)}
.student-score{
  font-family:var(--font-display);font-size:.88rem;font-weight:700;
  min-width:36px;text-align:right;flex-shrink:0
}
.student-actions{display:flex;gap:.35rem;flex-shrink:0}
.action-btn{
  width:28px;height:28px;border-radius:7px;border:1.5px solid var(--gray-200);
  background:#fff;display:flex;align-items:center;justify-content:center;
  font-size:.75rem;cursor:pointer;transition:all .2s;text-decoration:none
}
.action-btn:hover{border-color:var(--blue-mid);background:var(--blue-50)}

/* ── CLASS CARDS ── */
.class-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.85rem;padding:1rem 1.25rem}
.class-card{
  border:1.5px solid var(--gray-200);border-radius:var(--radius);
  padding:1.1rem;text-decoration:none;transition:all .2s;display:block
}
.class-card:hover{border-color:var(--blue-mid);transform:translateY(-2px);box-shadow:0 8px 20px rgba(30,64,175,.08)}
.class-card-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:.75rem}
.class-card-name{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--gray-900);margin-bottom:.2rem}
.class-card-meta{font-size:.75rem;color:var(--gray-500)}
.class-card-footer{display:flex;align-items:center;justify-content:space-between;margin-top:.75rem}
.traffic-mini{display:flex;gap:.3rem}
.traffic-pip{width:8px;height:8px;border-radius:50%}

/* ── ALERT FEED ── */
.alert-feed{list-style:none}
.alert-item{
  display:flex;align-items:flex-start;gap:.75rem;
  padding:.75rem 0;border-bottom:1px solid var(--gray-100)
}
.alert-item:last-child{border-bottom:none}
.alert-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;margin-top:.35rem}
.alert-info{flex:1;min-width:0}
.alert-msg{font-size:.82rem;color:var(--gray-700);line-height:1.5;margin-bottom:.15rem}
.alert-msg strong{font-weight:600;color:var(--gray-900)}
.alert-time{font-size:.7rem;color:var(--gray-400)}
.alert-score-chip{
  font-size:.7rem;font-weight:700;padding:.18rem .5rem;border-radius:50px;flex-shrink:0
}

/* ── RECENT SESSIONS TABLE ── */
.sessions-table-wrap{overflow-x:auto;border-radius:0 0 var(--radius-lg) var(--radius-lg)}
.sessions-table{width:100%;border-collapse:collapse;min-width:520px}
.sessions-table th{
  font-size:.72rem;font-weight:700;color:var(--gray-400);
  text-transform:uppercase;letter-spacing:.5px;
  padding:.75rem 1.25rem;text-align:left;
  background:var(--gray-50);border-bottom:1px solid var(--gray-200)
}
.sessions-table td{
  padding:.8rem 1.25rem;font-size:.84rem;
  border-bottom:1px solid var(--gray-100);color:var(--gray-700)
}
.sessions-table tr:last-child td{border-bottom:none}
.sessions-table tr:hover td{background:var(--gray-50)}
.score-chip{font-family:var(--font-display);font-size:.82rem;font-weight:700;padding:.2rem .6rem;border-radius:50px}
.chip-green{background:var(--green-mid);color:#065F46}
.chip-yellow{background:var(--yellow-light);color:var(--yellow-dark)}
.chip-red{background:var(--red-mid);color:#991B1B}
.status-pill{font-size:.7rem;font-weight:700;padding:.2rem .55rem;border-radius:50px}
.pill-approved{background:var(--green-mid);color:#065F46}
.pill-completed{background:var(--yellow-light);color:var(--yellow-dark)}
.pill-pending{background:var(--gray-100);color:var(--gray-500)}

/* ── APPROVE BUTTON ── */
.approve-btn{
  display:inline-flex;align-items:center;gap:.3rem;
  font-size:.75rem;font-weight:600;
  background:var(--green-light);color:var(--green);
  border:1.5px solid rgba(5,150,105,.2);border-radius:7px;
  padding:.3rem .7rem;cursor:pointer;transition:all .2s;font-family:var(--font-body);
  text-decoration:none
}
.approve-btn:hover{background:var(--green);color:#fff}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .two-col{grid-template-columns:1fr}
}
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .hamburger{display:flex}
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .topbar-time{display:none}
}
@media(max-width:480px){
  .stats-row{grid-template-columns:1fr 1fr}
  .content{padding:1rem}
  .class-grid{grid-template-columns:1fr 1fr}
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
  <div style="margin-left:240px">
      {{-- existing page content here --}}
  </div>

  <div class="sidebar-footer">
    <div class="sidebar-user">
<div class="sidebar-avatar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;color:rgba(255,255,255,.6);">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
            <circle cx="12" cy="13" r="4"/>
          </svg>
      </div>
      <div>
        <div class="sidebar-user-name">{{ $user['name'] }}</div>
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
      <div class="topbar-title" data-lang="title-dashboard" data-lang-en="Dashboard" data-lang-fil="Dashboard">Dashboard</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
      <a href="{{ route('teacher.dashboard') }}">🔔</a>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    {{-- ── STATS ROW ── --}}
    @php
      $allStudents   = collect($classes)->flatMap(fn($c) => $c['students'] ?? []);
      $totalStudents = $allStudents->count();
      $totalClasses  = count($classes);
      $allSessions   = collect($recentSessions ?? []);
      $pendingAlert  = $allSessions->where('status','completed')->count();
      $avgAccuracy   = $allSessions->where('score','>',0)->avg('score') ?? 0;
    @endphp
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap" style="background:#DBEAFE">👥</div>
          <span class="stat-trend trend-up">Active</span>
        </div>
        <div class="stat-num">{{ $totalStudents }}</div>
        <div class="stat-label">Total Students</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap" style="background:#D1FAE5">🏫</div>
          <span class="stat-trend trend-neutral">Classes</span>
        </div>
        <div class="stat-num">{{ $totalClasses }}</div>
        <div class="stat-label">Active Classes</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap" style="background:#FEF3C7">⚡</div>
          @if($pendingAlert > 0)
            <span class="stat-trend" style="background:#FEE2E2;color:#991B1B">{{ $pendingAlert }} new</span>
          @else
            <span class="stat-trend trend-neutral">Clear</span>
          @endif
        </div>
        <div class="stat-num">{{ $pendingAlert }}</div>
        <div class="stat-label">Needs Review</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top">
          <div class="stat-icon-wrap" style="background:#EDE9FE">📈</div>
          <span class="stat-trend trend-up">↑</span>
        </div>
        <div class="stat-num">{{ $avgAccuracy > 0 ? round($avgAccuracy) . '%' : '—' }}</div>
        <div class="stat-label">Avg Accuracy</div>
      </div>
    </div>

    {{-- ── TWO-COL: STUDENT STATUS + ALERTS ── --}}
    <div class="two-col">

      {{-- Student traffic-light list --}}
      <div class="panel">
        <div class="panel-head">
          <div class="panel-title">
            <div class="p-icon" style="background:#DBEAFE">👥</div>
            <span data-lang="panel-student-status" data-lang-en="Student Status" data-lang-fil="Kalagayan ng Estudyante">Student Status</span>
          </div>
          <a href="{{ route('teacher.classes') }}" class="panel-link">View all →</a>
        </div>
        <div class="panel-body" style="padding:0 1.25rem">
          <ul class="student-list">
            @forelse($allStudents->take(8) as $student)
              @php
                $score = $student['latest_score'] ?? null;
                $dotClass = 'dot-gray';
                $scoreColor = 'color:var(--gray-400)';
                if($score !== null) {
                  if($score >= 80) { $dotClass = 'dot-green'; $scoreColor = 'color:var(--green)'; }
                  elseif($score >= 60) { $dotClass = 'dot-yellow'; $scoreColor = 'color:var(--amber)'; }
                  else { $dotClass = 'dot-red'; $scoreColor = 'color:var(--red)'; }
                }
                $avatarColors = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316','#059669'];
                $avatarBg = $avatarColors[crc32($student['name'] ?? '') % count($avatarColors)];
              @endphp
              <li class="student-item">
                <div class="traffic-dot {{ $dotClass }}"></div>
                <div class="student-avatar" style="background:{{ $avatarBg }}">
                  {{ strtoupper(substr($student['name'] ?? '?', 0, 2)) }}
                </div>
                <div class="student-info">
                  <div class="student-name">{{ $student['name'] ?? 'Unknown' }}</div>
                  <div class="student-meta">
                    Grade {{ $student['grade_level'] ?? '—' }}
                    @if($student['pending_sessions'] ?? 0)
                      · {{ $student['pending_sessions'] }} pending
                    @endif
                  </div>
                </div>
                <div class="student-score" style="{{ $scoreColor }}">
                  {{ $score !== null ? $score . '%' : '—' }}
                </div>
                <div class="student-actions">
                  @if(isset($student['class_id']))
                    <a href="{{ route('teacher.student', [$student['class_id'], $student['id']]) }}"
                       class="action-btn" title="View profile">👁</a>
                  @endif
                </div>
              </li>
            @empty
              <li style="padding:1.5rem 0;text-align:center;color:var(--gray-400);font-size:.85rem">
                No students yet. Add students to your classes.
              </li>
            @endforelse
          </ul>
        </div>
      </div>

      {{-- Live alert feed --}}
      <div class="panel">
        <div class="panel-head">
          <div class="panel-title">
            <div class="p-icon" style="background:#FEF3C7">⚡</div>
            <span data-lang="panel-live-alerts" data-lang-en="Live Alerts" data-lang-fil="Mga Live Alert">Live Alerts</span>
          </div>
          @if($pendingAlert > 0)
            <span style="font-size:.72rem;font-weight:700;background:#FEE2E2;color:#991B1B;padding:.18rem .55rem;border-radius:50px">{{ $pendingAlert }} new</span>
          @endif
        </div>
        <div class="panel-body" style="padding:0 1.25rem">
          <ul class="alert-feed" id="alertFeed">
            @forelse($allSessions->sortByDesc('updated_at')->take(8) as $session)
              @php
                $sc = $session['score'] ?? 0;
                $alertDot = $sc >= 80 ? 'dot-green' : ($sc >= 60 ? 'dot-yellow' : 'dot-red');
                $chipClass = $sc >= 80 ? 'chip-green' : ($sc >= 60 ? 'chip-yellow' : 'chip-red');
              @endphp
              <li class="alert-item">
                <div class="alert-dot {{ $alertDot }}"></div>
                <div class="alert-info">
                  <div class="alert-msg">
                    <strong>{{ $session['student_name'] ?? 'A student' }}</strong>
                    {{ $session['status'] === 'completed' ? 'finished a reading session.' : 'session ' . $session['status'] . '.' }}
                  </div>
                  <div class="alert-time">{{ isset($session['updated_at']) ? \Carbon\Carbon::parse($session['updated_at'])->diffForHumans() : '' }}</div>
                </div>
                @if($sc > 0)
                  <span class="alert-score-chip {{ $chipClass }}">{{ $sc }}%</span>
                @endif
              </li>
            @empty
              <li style="padding:1.5rem 0;text-align:center;color:var(--gray-400);font-size:.85rem">
                No recent activity. Alerts will appear here in real time.
              </li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>

    {{-- ── MY CLASSES ── --}}
    <div class="panel" style="margin-bottom:1.75rem">
      <div class="panel-head">
        <div class="panel-title">
          <div class="p-icon" style="background:#D1FAE5">🏫</div>
          <span data-lang="panel-my-classes" data-lang-en="My Classes" data-lang-fil="Mga Klas Ko">My Classes</span>
        </div>
      </div>
      <div class="class-grid">
        @forelse($classes as $class)
          @php
            $students   = collect($class['students'] ?? []);
            $greenCount = $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 80)->count();
            $yellowCount= $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 60 && ($s['latest_score'] ?? 0) < 80)->count();
            $redCount   = $students->filter(fn($s) => ($s['latest_score'] ?? null) !== null && ($s['latest_score'] ?? 0) < 60)->count();
            $classColors = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316'];
            $classBg = $classColors[crc32($class['name']) % count($classColors)];
          @endphp
          <a href="{{ route('teacher.class', $class['id']) }}" class="class-card">
            <div class="class-card-icon" style="background:{{ $classBg }}22;color:{{ $classBg }}">🏫</div>
            <div class="class-card-name">{{ $class['name'] }}</div>
            <div class="class-card-meta">{{ $students->count() }} students</div>
            <div class="class-card-footer">
              <div class="traffic-mini">
                @for($i=0;$i<min($greenCount,4);$i++)<div class="traffic-pip" style="background:#10B981"></div>@endfor
                @for($i=0;$i<min($yellowCount,4);$i++)<div class="traffic-pip" style="background:var(--yellow)"></div>@endfor
                @for($i=0;$i<min($redCount,4);$i++)<div class="traffic-pip" style="background:var(--red)"></div>@endfor
              </div>
              <span style="font-size:.72rem;color:var(--gray-400)">View →</span>
            </div>
          </a>
        @empty
          <div style="grid-column:1/-1;padding:1.5rem;text-align:center;color:var(--gray-400);font-size:.85rem">
            No classes yet.
          </div>
        @endforelse
      </div>
    </div>

    {{-- ── RECENT SESSIONS TABLE ── --}}
    <div class="panel">
      <div class="panel-head">
        <div class="panel-title">
          <div class="p-icon" style="background:#EDE9FE">📋</div>
          <span data-lang="panel-recent-sessions" data-lang-en="Recent Sessions" data-lang-fil="Mga Kamakailang Session">Recent Sessions</span>
        </div>
      </div>
      <div class="sessions-table-wrap">
        <table class="sessions-table">
          <thead>
            <tr>
              <th data-lang="table-student" data-lang-en="Student" data-lang-fil="Estudyante">Student</th>
              <th data-lang="table-passage" data-lang-en="Passage" data-lang-fil="Basa">Passage</th>
              <th data-lang="table-score" data-lang-en="Score" data-lang-fil="Score">Score</th>
              <th data-lang="table-status" data-lang-en="Status" data-lang-fil="Katayuan">Status</th>
              <th data-lang="table-time" data-lang-en="Time" data-lang-fil="Oras">Time</th>
              <th data-lang="table-action" data-lang-en="Action" data-lang-fil="Aksyon">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($allSessions->sortByDesc('updated_at')->take(10) as $session)
              @php
                $sc = $session['score'] ?? 0;
                $chipClass = $sc >= 80 ? 'chip-green' : ($sc >= 60 ? 'chip-yellow' : 'chip-red');
              @endphp
              <tr>
                <td style="font-weight:600;color:var(--gray-900)">{{ $session['student_name'] ?? '—' }}</td>
                <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                  {{ Str::limit($session['passage'] ?? '—', 40) }}
                </td>
                <td>
                  @if($sc > 0)
                    <span class="score-chip {{ $chipClass }}">{{ $sc }}%</span>
                  @else
                    <span style="color:var(--gray-300)">—</span>
                  @endif
                </td>
                <td>
                  @php $st = $session['status'] ?? 'pending'; @endphp
                  <span class="status-pill {{ $st === 'approved' ? 'pill-approved' : ($st === 'completed' ? 'pill-completed' : 'pill-pending') }}">
                    {{ ucfirst($st) }}
                  </span>
                </td>
                <td style="color:var(--gray-400);font-size:.78rem">
                  {{ isset($session['updated_at']) ? \Carbon\Carbon::parse($session['updated_at'])->diffForHumans() : '—' }}
                </td>
                <td>
                  @if(($session['status'] ?? '') === 'completed' && isset($session['student_id'], $session['class_id']))
                    <form method="POST" action="{{ route('teacher.approve', [$session['student_id'], $session['id']]) }}" style="display:inline">
                      @csrf
                      <button class="approve-btn" type="submit">✓ Approve</button>
                    </form>
                  @elseif(isset($session['student_id'], $session['class_id']))
                    <a href="{{ route('teacher.student', [$session['class_id'], $session['student_id']]) }}" class="approve-btn" style="background:var(--blue-50);color:var(--blue);border-color:rgba(30,64,175,.15)">View</a>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" style="text-align:center;color:var(--gray-400);padding:2rem">
                  No sessions yet. Students will appear here after their first reading.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
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

// Real-time alerts via Echo/Reverb
if (typeof window.Echo !== 'undefined') {
  const userId = {{ $user['id'] ?? 'null' }};
  if (userId) {
    window.Echo.private(`teacher.${userId}`)
      .listen('SessionCompleted', (e) => {
        const feed = document.getElementById('alertFeed');
        if (!feed) return;
        const score = e.score ?? 0;
        const dotColor = score >= 80 ? '#10B981' : (score >= 60 ? '#F59E0B' : '#DC2626');
        const chipBg   = score >= 80 ? '#D1FAE5' : (score >= 60 ? '#FEF3C7' : '#FEE2E2');
        const chipClr  = score >= 80 ? '#065F46' : (score >= 60 ? '#92400E' : '#991B1B');
        const li = document.createElement('li');
        li.className = 'alert-item';
        li.style.animation = 'fadeIn .4s ease';
        li.innerHTML = `
          <div class="alert-dot" style="background:${dotColor};box-shadow:0 0 0 3px ${dotColor}22"></div>
          <div class="alert-info">
            <div class="alert-msg"><strong>${e.student_name || 'A student'}</strong> just finished a reading session.</div>
            <div class="alert-time">Just now</div>
          </div>
          ${score > 0 ? `<span class="alert-score-chip" style="background:${chipBg};color:${chipClr}">${score}%</span>` : ''}
        `;
        feed.prepend(li);
        // Remove oldest if more than 10
        while (feed.children.length > 10) feed.removeChild(feed.lastChild);
      });
  }
}
</script>

</body>
</html>