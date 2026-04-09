<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $student['name'] }} — Sulong Basa</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@livewireStyles
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;--red-mid:#FEE2E2;
  --purple:#7C3AED;--purple-light:#F5F3FF;
  --white:#fff;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;
  --radius:12px;--radius-lg:18px;
}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

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
.sidebar-logout{display:flex;align-items:center;justify-content:center;gap:.4rem;width:100%;padding:.55rem;border-radius:9px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.6);font-size:.8rem;font-weight:500;font-family:var(--font-body);cursor:pointer;transition:all .2s}
.sidebar-logout:hover{background:rgba(255,255,255,.15);color:#fff}
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:199}
.sidebar-overlay.open{display:block}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

/* ── TOPBAR ── */
.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.hamburger{display:none;flex-direction:column;gap:4px;cursor:pointer;padding:.35rem;border:none;background:transparent}
.hamburger span{display:block;width:20px;height:2px;background:var(--gray-700);border-radius:2px}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-size:.875rem;flex-wrap:wrap}
.breadcrumb a{color:var(--blue);text-decoration:none;font-weight:500}
.breadcrumb a:hover{color:var(--blue-dark);text-decoration:underline}
.breadcrumb-sep{color:var(--gray-300)}
.breadcrumb-current{color:var(--gray-700);font-weight:600}
.topbar-actions{display:flex;align-items:center;gap:.6rem}
.export-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:50px;border:1.5px solid var(--blue);color:var(--blue);background:#fff;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;font-family:var(--font-body)}
.export-btn:hover{background:var(--blue);color:#fff}

/* ── CONTENT ── */
.content{padding:clamp(1.25rem,3vw,2rem);flex:1}
.two-col{display:grid;grid-template-columns:1fr 1.2fr;gap:1.25rem;margin-bottom:1.25rem}
.full-col{margin-bottom:1.25rem}

/* ── STUDENT PROFILE CARD ── */
.profile-card{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);padding:1.5rem;display:flex;align-items:flex-start;gap:1.25rem;flex-wrap:wrap}
.profile-avatar{width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:#fff;flex-shrink:0}
.profile-info{flex:1;min-width:180px}
.profile-name{font-family:var(--font-display);font-size:1.4rem;font-weight:800;color:var(--gray-900);line-height:1.2;letter-spacing:-.3px;margin-bottom:.25rem}
.profile-sub{font-size:.85rem;color:var(--gray-500);margin-bottom:.85rem}
.profile-pills{display:flex;gap:.5rem;flex-wrap:wrap}
.profile-pill{font-size:.73rem;font-weight:700;padding:.25rem .7rem;border-radius:50px}
.profile-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-top:1.25rem;width:100%}
.p-stat{background:var(--gray-50);border-radius:10px;padding:.85rem;text-align:center}
.p-stat-num{font-family:var(--font-display);font-size:1.3rem;font-weight:800;color:var(--gray-900);line-height:1}
.p-stat-label{font-size:.68rem;color:var(--gray-500);margin-top:.15rem;font-weight:500}

/* ── PANEL ── */
.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200)}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid var(--gray-100);gap:.5rem;flex-wrap:wrap}
.panel-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:.5rem}
.p-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:.8rem}
.panel-body{padding:1.1rem 1.25rem}

/* ── ASSIGN FORM ── */
.assign-textarea{width:100%;padding:.75rem .9rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.88rem;color:var(--gray-900);resize:vertical;min-height:100px;outline:none;transition:border-color .2s;line-height:1.65}
.assign-textarea:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.assign-btn{display:inline-flex;align-items:center;gap:.4rem;margin-top:.85rem;padding:.65rem 1.35rem;background:linear-gradient(135deg,var(--blue),#1D4ED8);color:#fff;border:none;border-radius:50px;font-family:var(--font-display);font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s}
.assign-btn:hover{transform:translateY(-1px);box-shadow:0 6px 18px rgba(30,64,175,.3)}
.flash-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:#065F46;border-radius:10px;padding:.7rem .9rem;font-size:.83rem;margin-bottom:.9rem;display:flex;align-items:center;gap:.4rem}
.flash-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:#991B1B;border-radius:10px;padding:.7rem .9rem;font-size:.83rem;margin-bottom:.9rem}

/* ── SESSION CARDS ── */
.session-card{border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:1rem;margin-bottom:.75rem;transition:border-color .2s}
.session-card:last-child{margin-bottom:0}
.session-card:hover{border-color:var(--blue-mid)}
.session-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem;gap:.5rem;flex-wrap:wrap}
.session-id{font-family:var(--font-display);font-size:.85rem;font-weight:700;color:var(--gray-700)}
.session-status{font-size:.7rem;font-weight:700;padding:.2rem .55rem;border-radius:50px}
.st-approved{background:var(--green-mid);color:#065F46}
.st-completed{background:var(--yellow-light);color:var(--yellow-dark)}
.st-pending{background:var(--gray-100);color:var(--gray-500)}
.score-big{font-family:var(--font-display);font-size:1.1rem;font-weight:800}
.session-passage-preview{font-size:.82rem;color:var(--gray-600,#4B5563);line-height:1.6;margin-bottom:.6rem;font-style:italic}
.error-words{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.6rem}
.error-word{font-size:.7rem;font-weight:700;padding:.18rem .55rem;border-radius:50px;background:var(--red-light);color:var(--red)}
.session-meta{font-size:.72rem;color:var(--gray-400);margin-bottom:.65rem}
.approve-form-btn{display:inline-flex;align-items:center;gap:.35rem;padding:.5rem 1rem;background:var(--green-light);color:var(--green);border:1.5px solid rgba(5,150,105,.25);border-radius:50px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:var(--font-body);transition:all .2s}
.approve-form-btn:hover{background:var(--green);color:#fff;border-color:var(--green)}

/* ── STORY CARDS ── */
.story-card{border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:1rem;margin-bottom:.75rem;position:relative;overflow:hidden}
.story-card:last-child{margin-bottom:0}
.story-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,var(--purple),var(--blue))}
.story-card-body{padding-left:.25rem}
.story-tag-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem;gap:.5rem}
.story-ai-tag{display:inline-flex;align-items:center;gap:.35rem;background:var(--purple-light);color:var(--purple);font-size:.7rem;font-weight:700;padding:.2rem .6rem;border-radius:50px}
.story-date{font-size:.7rem;color:var(--gray-400)}
.story-text{font-size:.87rem;color:var(--gray-700);line-height:1.8;font-style:italic;margin-bottom:.65rem}
.target-words{display:flex;flex-wrap:wrap;gap:.35rem}
.target-word{font-size:.7rem;font-weight:700;padding:.18rem .55rem;border-radius:50px;background:var(--yellow-light);color:var(--yellow-dark)}

/* ── CHART ── */
.chart-wrap{position:relative;padding:1.1rem 1.25rem;height:220px}

/* ── EMPTY ── */
.empty-small{text-align:center;padding:1.5rem;color:var(--gray-400);font-size:.85rem}
.empty-small .e-icon{font-size:1.8rem;margin-bottom:.4rem}

/* ── RESPONSIVE ── */
@media(max-width:900px){.two-col{grid-template-columns:1fr}}
@media(max-width:768px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .hamburger{display:flex}
  .profile-stats{grid-template-columns:repeat(3,1fr)}
  .breadcrumb{display:none}
}
@media(max-width:480px){
  .content{padding:1rem}
  .profile-stats{grid-template-columns:1fr 1fr}
  .topbar-actions .export-btn span{display:none}
}
</style>
</head>
<body>

  <!-- SIDEBAR -->
  @include('teacher.partials.sidebar')
  <div style="margin-left:240px">
      {{-- existing page content here --}}
  </div>
  
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ strtoupper(substr(session('user.name','T'), 0, 2)) }}</div>
      <div>
        <div class="sidebar-user-name">{{ session('user.name','Teacher') }}</div>
        <div class="sidebar-user-role">Teacher</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="sidebar-logout">↩ Sign Out</button>
    </form>
  </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- MAIN -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="topbar-left">
      <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
      <div class="breadcrumb">
        <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('teacher.class', $classId) }}">{{ $class['name'] ?? 'Class' }}</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">{{ $student['name'] }}</span>
      </div>
    </div>
    <div class="topbar-actions">
      <a href="{{ route('teacher.export', [$classId, $student['id']]) }}" class="export-btn">
        📄 <span>Export PDF</span>
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" style="display:inline-flex;align-items:center;gap:.35rem;font-size:.8rem;font-weight:600;color:var(--gray-500);background:transparent;border:1.5px solid var(--gray-200);border-radius:50px;padding:.4rem .9rem;cursor:pointer;font-family:var(--font-body)">↩ Logout</button>
      </form>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    {{-- ── PROFILE CARD ── --}}
    @php
      $allScores  = array_filter(array_column($sessions, 'accuracy_score'));
      $avgScore   = count($allScores) ? round(array_sum($allScores) / count($allScores)) : null;
      $totalSess  = count($sessions);
      $approved   = collect($sessions)->where('status','approved')->count();
      $latestScore= collect($sessions)->whereNotNull('accuracy_score')->sortByDesc('id')->first()['accuracy_score'] ?? null;
      $avatarColors = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316','#059669'];
      $avatarBg = $avatarColors[crc32($student['name']) % count($avatarColors)];
      $statusLabel = 'No data'; $statusBg = 'var(--gray-100)'; $statusColor = 'var(--gray-500)';
      if($latestScore !== null) {
        if($latestScore >= 80)     { $statusLabel='Passing';    $statusBg='var(--green-mid)'; $statusColor='#065F46'; }
        elseif($latestScore >= 60) { $statusLabel='At Risk';    $statusBg='var(--yellow-light)'; $statusColor='var(--yellow-dark)'; }
        else                       { $statusLabel='Struggling'; $statusBg='var(--red-mid)'; $statusColor='#991B1B'; }
      }
    @endphp
    <div class="profile-card full-col">
      <div class="profile-avatar" style="background:{{ $avatarBg }}">
        {{ strtoupper(substr($student['name'], 0, 2)) }}
      </div>
      <div class="profile-info">
        <div class="profile-name">{{ $student['name'] }}</div>
        <div class="profile-sub">{{ $student['grade'] ?? $student['grade_level'] ?? '' }} · Reading Level {{ $student['reading_level'] ?? 1 }}</div>
        <div class="profile-pills">
          <span class="profile-pill" style="background:{{ $statusBg }};color:{{ $statusColor }}">{{ $statusLabel }}</span>
          <span class="profile-pill" style="background:var(--blue-light);color:var(--blue)">Level {{ $student['reading_level'] ?? 1 }}</span>
          @if($approved > 0)
            <span class="profile-pill" style="background:var(--green-mid);color:#065F46">{{ $approved }} Approved</span>
          @endif
        </div>
      </div>
      <div class="profile-stats">
        <div class="p-stat">
          <div class="p-stat-num">{{ $totalSess }}</div>
          <div class="p-stat-label">Total Sessions</div>
        </div>
        <div class="p-stat">
          <div class="p-stat-num" style="{{ $avgScore ? 'color:'.($avgScore>=80?'var(--green)':($avgScore>=60?'var(--amber)':'var(--red)')) : '' }}">
            {{ $avgScore ? $avgScore . '%' : '—' }}
          </div>
          <div class="p-stat-label">Avg Accuracy</div>
        </div>
        <div class="p-stat">
          <div class="p-stat-num" style="color:var(--orange)">{{ count($stories) }}</div>
          <div class="p-stat-label">AI Stories</div>
        </div>
      </div>
    </div>

    {{-- ── ROW: CHART + ASSIGN ── --}}
    <div class="two-col">

      {{-- Accuracy chart --}}
      <div class="panel">
        <div class="panel-head">
<span data-lang="accuracy-trend" data-lang-en="Accuracy Trend" data-lang-fil="Trend ng Katumpakan">Accuracy Trend</span>
        </div>
        @if(count($allScores) > 0)
          <div class="chart-wrap">
            <canvas id="accuracyChart"></canvas>
          </div>
        @else
          <div class="empty-small"><div class="e-icon">📊</div>No scores yet. Chart will appear after the first session.</div>
        @endif
      </div>

      {{-- Assign passage --}}
      <div class="panel">
        <div class="panel-head">
<span data-lang="assign-passage-title" data-lang-en="Assign Passage" data-lang-fil="Mag-assign ng Passage">Mag-assign ng Passage</span>
        </div>
        <div class="panel-body">
          @if(session('success'))
            <div class="flash-success">✓ {{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="flash-error">{{ session('error') }}</div>
          @endif
          <form method="POST" action="{{ route('teacher.assign', $student['id']) }}">
            @csrf
            <label style="font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.4rem">Passage Text</label>
<span data-lang="assign-passage-placeholder" data-lang-en="Type the passage here for the student…" data-lang-fil="I-type ang passage dito para sa estudyante…">I-type ang passage dito para sa estudyante…</span>
<span data-lang="assign-passage-button" data-lang-en="Assign Passage" data-lang-fil="I-assign ang Passage">I-assign ang Passage</span>
          </form>
        </div>
      </div>
    </div>

    {{-- ── ROW: SESSIONS + STORIES ── --}}
    <div class="two-col">

      {{-- Reading sessions --}}
      <div class="panel">
        <div class="panel-head">
<span data-lang="reading-sessions-title" data-lang-en="Reading Sessions" data-lang-fil="Reading Sessions">Reading Sessions</span>
          <span style="font-size:.75rem;color:var(--gray-400)">{{ $totalSess }} total</span>
        </div>
        <div class="panel-body" style="padding:.75rem 1.25rem;max-height:520px;overflow-y:auto">
          @if(session('approve_success'))
            <div class="flash-success">✓ {{ session('approve_success') }}</div>
          @endif
          @if(session('approve_error'))
            <div class="flash-error">{{ session('approve_error') }}</div>
          @endif
          @forelse($sessions as $session)
            @php
              $sc = $session['accuracy_score'] ?? null;
              $stClass = match($session['status'] ?? '') { 'approved' => 'st-approved', 'completed' => 'st-completed', default => 'st-pending' };
              $scColor = $sc ? ($sc >= 80 ? 'var(--green)' : ($sc >= 60 ? 'var(--amber)' : 'var(--red)')) : 'var(--gray-400)';
            @endphp
            <div class="session-card">
              <div class="session-card-top">
                <div style="display:flex;align-items:center;gap:.6rem">
                  <span class="session-id">Session #{{ $session['id'] }}</span>
                  <span class="session-status {{ $stClass }}">{{ ucfirst($session['status'] ?? 'pending') }}</span>
                </div>
                @if($sc)
                  <span class="score-big" style="color:{{ $scColor }}">{{ $sc }}%</span>
                @endif
              </div>

              @if(!empty($session['passage']))
                <div class="session-passage-preview">"{{ Str::limit($session['passage'], 100) }}"</div>
              @endif

              @if(!empty($session['error_patterns']))
                <div style="font-size:.72rem;color:var(--gray-500);margin-bottom:.4rem;font-weight:600">Error patterns:</div>
                <div class="error-words">
                  @foreach((array)$session['error_patterns'] as $word)
                    <span class="error-word">{{ $word }}</span>
                  @endforeach
                </div>
              @endif

              @if(isset($session['updated_at']))
                <div class="session-meta">{{ \Carbon\Carbon::parse($session['updated_at'])->format('M d, Y · g:i A') }}</div>
              @endif

              @if(($session['status'] ?? '') === 'completed')
                <form method="POST" action="{{ route('teacher.approve', [$student['id'], $session['id']]) }}">
                  @csrf
                  <button type="submit" class="approve-form-btn">⬆ Approve Level Up</button>
                </form>
              @endif
            </div>
          @empty
            <div class="empty-small"><div class="e-icon">🎤</div>Wala pang sessions. Mag-assign ng passage para magsimula.</div>
          @endforelse
        </div>
      </div>

      {{-- AI Stories --}}
      <div class="panel">
        <div class="panel-head">
<span data-lang="ai-stories-title" data-lang-en="AI Generated Stories" data-lang-fil="Mga Kwentong Ginawa ng AI">AI Generated Stories</span>
          <span style="font-size:.75rem;color:var(--gray-400)">{{ count($stories) }} stories</span>
        </div>
        <div class="panel-body" style="padding:.75rem 1.25rem;max-height:520px;overflow-y:auto">
          @forelse($stories as $story)
            <div class="story-card">
              <div class="story-card-body">
                <div class="story-tag-row">
                  <span class="story-ai-tag">🤖 AI-Generated</span>
                  @if(isset($story['created_at']))
                    <span class="story-date">{{ \Carbon\Carbon::parse($story['created_at'])->format('M d, Y') }}</span>
                  @endif
                </div>
                <div class="story-text">{{ $story['story'] }}</div>
                @if(!empty($story['target_patterns']))
                  <div class="target-words">
                    @foreach((array)$story['target_patterns'] as $word)
                      <span class="target-word">{{ $word }}</span>
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          @empty
            <div class="empty-small"><div class="e-icon">🤖</div>AI stories will appear here after the student completes their first session.</div>
          @endforelse
        </div>
      </div>
    </div>

  </div>
</div>

<script>
// Sidebar
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
document.getElementById('hamburger')?.addEventListener('click', () => {
  sidebar.classList.toggle('open'); overlay.classList.toggle('open');
});
overlay?.addEventListener('click', () => {
  sidebar.classList.remove('open'); overlay.classList.remove('open');
});

// Chart
const sessions = @json($sessions);
const withScores = sessions.filter(s => s.accuracy_score !== null);
if (withScores.length > 0 && document.getElementById('accuracyChart')) {
  new Chart(document.getElementById('accuracyChart'), {
    type: 'line',
    data: {
      labels: withScores.map((s, i) => 'S#' + (i + 1)),
      datasets: [{
        label: 'Accuracy (%)',
        data: withScores.map(s => s.accuracy_score),
        borderColor: '#1E40AF',
        backgroundColor: 'rgba(30,64,175,.08)',
        borderWidth: 2,
        tension: 0.4,
        fill: true,
        pointBackgroundColor: withScores.map(s =>
          s.accuracy_score >= 80 ? '#059669' :
          s.accuracy_score >= 60 ? '#D97706' : '#DC2626'
        ),
        pointRadius: 5,
        pointHoverRadius: 7,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          min: 0, max: 100,
          ticks: { callback: v => v + '%', font: { family: 'DM Sans', size: 11 } },
          grid: { color: 'rgba(0,0,0,.05)' }
        },
        x: { ticks: { font: { family: 'DM Sans', size: 11 } }, grid: { display: false } }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#1E3A5F',
          titleFont: { family: 'Baloo 2', size: 13 },
          bodyFont: { family: 'DM Sans', size: 12 },
          callbacks: { label: ctx => '  Accuracy: ' + ctx.parsed.y + '%' }
        }
      }
    }
  });
}
</script>
@livewireScripts
</body>
</html>