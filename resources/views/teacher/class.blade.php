<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $class['name'] }} — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;--red-mid:#FEE2E2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;--radius:12px;--radius-lg:18px;
}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-size:.875rem}
.breadcrumb a{color:var(--blue);text-decoration:none;font-weight:500}
.breadcrumb a:hover{color:var(--blue-dark)}
.breadcrumb-sep{color:var(--gray-300)}
.breadcrumb-current{color:var(--gray-700);font-weight:600}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

.class-hero{background:linear-gradient(135deg,var(--blue-dark) 0%,var(--blue) 60%,#1D4ED8 100%);border-radius:20px;padding:clamp(1.5rem,3vw,2rem) clamp(1.5rem,3vw,2.5rem);margin-bottom:1.75rem;position:relative;overflow:hidden;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.class-hero::before{content:'';position:absolute;top:-60px;right:-60px;width:240px;height:240px;background:rgba(249,115,22,.15);border-radius:50%;pointer-events:none}
.class-hero::after{content:'';position:absolute;bottom:-40px;left:20%;width:180px;height:180px;background:rgba(255,255,255,.05);border-radius:50%;pointer-events:none}
.class-hero-left{position:relative;z-index:1}
.class-hero-tag{display:inline-flex;align-items:center;gap:.35rem;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);font-size:.72rem;font-weight:700;padding:.25rem .7rem;border-radius:50px;margin-bottom:.65rem;letter-spacing:.3px}
.class-hero-name{font-family:var(--font-display);font-size:clamp(1.5rem,3vw,2rem);font-weight:800;color:#fff;line-height:1.2;letter-spacing:-.5px;margin-bottom:.3rem}
.class-hero-grade{font-size:.9rem;color:rgba(255,255,255,.65)}
.class-hero-right{display:flex;gap:1rem;position:relative;z-index:1;flex-wrap:wrap}
.hero-stat{background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:14px;padding:.85rem 1.25rem;text-align:center;min-width:80px}
.hero-stat-num{font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:#fff;line-height:1}
.hero-stat-label{font-size:.65rem;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.4px;margin-top:.15rem}

.filter-bar{display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem;flex-wrap:wrap}
.search-wrap{position:relative;flex:1;min-width:200px;max-width:320px}
.search-icon{position:absolute;left:.85rem;top:50%;transform:translateY(-50%);font-size:.9rem;pointer-events:none}
.search-input{width:100%;padding:.65rem 1rem .65rem 2.5rem;border:1.5px solid var(--gray-200);border-radius:50px;font-family:var(--font-body);font-size:.875rem;color:var(--gray-900);background:#fff;outline:none;transition:border-color .2s}
.search-input:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.filter-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1rem;border-radius:50px;border:1.5px solid var(--gray-200);background:#fff;font-size:.8rem;font-weight:600;color:var(--gray-700);cursor:pointer;transition:all .2s;font-family:var(--font-body)}
.filter-btn:hover,.filter-btn.active{border-color:var(--blue-mid);color:var(--blue);background:var(--blue-light)}
.filter-btn.f-green.active{border-color:var(--green);color:var(--green);background:var(--green-light)}
.filter-btn.f-yellow.active{border-color:var(--yellow);color:var(--yellow-dark);background:var(--yellow-light)}
.filter-btn.f-red.active{border-color:var(--red);color:var(--red);background:var(--red-light)}
.filter-dot{width:8px;height:8px;border-radius:50%}

.students-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1rem}
.student-card{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);text-decoration:none;display:block;transition:all .25s;position:relative;overflow:hidden}
.student-card:hover{transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.08);border-color:var(--blue-mid)}
.student-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;border-radius:4px 0 0 4px}
.student-card.s-green::before{background:var(--green)}
.student-card.s-yellow::before{background:var(--yellow)}
.student-card.s-red::before{background:var(--red)}
.student-card.s-gray::before{background:var(--gray-300)}
.student-card-inner{padding:1.25rem 1.25rem 1.25rem 1.5rem}
.student-card-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.85rem;gap:.5rem}
.student-card-avatar{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:.95rem;font-weight:700;color:#fff;flex-shrink:0}
.student-card-info{flex:1;min-width:0}
.student-card-name{font-family:var(--font-display);font-size:.98rem;font-weight:700;color:var(--gray-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:.15rem}
.student-card-meta{font-size:.75rem;color:var(--gray-500)}
.status-badge{font-size:.68rem;font-weight:700;padding:.2rem .55rem;border-radius:50px;white-space:nowrap;flex-shrink:0}
.badge-green{background:var(--green-mid);color:#065F46}
.badge-yellow{background:var(--yellow-light);color:var(--yellow-dark)}
.badge-red{background:var(--red-mid);color:#991B1B}
.badge-gray{background:var(--gray-100);color:var(--gray-500)}
.mini-bar-row{display:flex;align-items:center;gap:.6rem;margin-bottom:.75rem}
.mini-bar-track{flex:1;height:6px;background:var(--gray-100);border-radius:3px;overflow:hidden}
.mini-bar-fill{height:100%;border-radius:3px;transition:width .8s ease}
.mini-bar-pct{font-family:var(--font-display);font-size:.8rem;font-weight:700;min-width:30px;text-align:right}
.student-card-footer{display:flex;align-items:center;justify-content:space-between;padding:.75rem 1.25rem .75rem 1.5rem;border-top:1px solid var(--gray-100);background:var(--gray-50)}
.level-pip-row{display:flex;gap:.3rem}
.level-pip{width:8px;height:8px;border-radius:2px;background:var(--gray-200)}
.level-pip.done{background:linear-gradient(135deg,var(--yellow),var(--orange))}
.view-link{font-size:.75rem;font-weight:600;color:var(--blue)}

.empty-state{grid-column:1/-1;background:#fff;border-radius:var(--radius-lg);border:1.5px dashed var(--gray-200);padding:3rem;text-align:center}
.empty-icon{font-size:2.5rem;margin-bottom:.75rem}
.empty-title{font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--gray-700);margin-bottom:.35rem}
.empty-sub{font-size:.85rem;color:var(--gray-400);line-height:1.6}

@media(max-width:768px){
  .main{margin-left:0}
  .class-hero-right{display:none}
}
@media(max-width:520px){
  .students-grid{grid-template-columns:1fr}
  .filter-bar{gap:.5rem}
}
</style>
</head>
<body>

@include('teacher.partials.sidebar')

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="breadcrumb">
        <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('teacher.classes') }}">Classes</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">{{ $class['name'] }}</span>
      </div>
    </div>
  </div>

  <div class="content">
    @php
      $students    = $students ?? [];
      $totalCount  = count($students);
      $greenCount  = collect($students)->filter(fn($s) => ($s['latest_score'] ?? 0) >= 80)->count();
      $yellowCount = collect($students)->filter(fn($s) => ($s['latest_score'] ?? 0) >= 60 && ($s['latest_score'] ?? 0) < 80)->count();
      $redCount    = collect($students)->filter(fn($s) => isset($s['latest_score']) && ($s['latest_score'] ?? 0) < 60)->count();
    @endphp

    <div class="class-hero">
      <div class="class-hero-left">
        <div class="class-hero-tag"><x-icon name="school" /> Class</div>
        <div class="class-hero-name">{{ $class['name'] }}</div>
        <div class="class-hero-grade">{{ $class['grade_level'] ?? '' }}</div>
      </div>
      <div class="class-hero-right">
        <div class="hero-stat">
          <div class="hero-stat-num">{{ $totalCount }}</div>
          <div class="hero-stat-label">Students</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-num" style="color:#4ADE80">{{ $greenCount }}</div>
          <div class="hero-stat-label">Passing</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-num" style="color:var(--yellow)">{{ $yellowCount }}</div>
          <div class="hero-stat-label">At Risk</div>
        </div>
        <div class="hero-stat">
          <div class="hero-stat-num" style="color:#F87171">{{ $redCount }}</div>
          <div class="hero-stat-label">Struggling</div>
        </div>
      </div>
    </div>

    <div class="filter-bar">
      <div class="search-wrap">
        <span class="search-icon"><x-icon name="search" /></span>
        <input type="text" class="search-input" id="studentSearch" placeholder="Search students…">
      </div>
      <button class="filter-btn active" data-filter="all">All ({{ $totalCount }})</button>
      <button class="filter-btn f-green" data-filter="green"><span class="filter-dot" style="background:var(--green)"></span>Passing ({{ $greenCount }})</button>
      <button class="filter-btn f-yellow" data-filter="yellow"><span class="filter-dot" style="background:var(--yellow)"></span>At Risk ({{ $yellowCount }})</button>
      <button class="filter-btn f-red" data-filter="red"><span class="filter-dot" style="background:var(--red)"></span>Struggling ({{ $redCount }})</button>
    </div>

    <div class="students-grid" id="studentsGrid">
      @forelse($students as $student)
        @php
          $score = $student['latest_score'] ?? null;
          $statusClass = 's-gray'; $badgeClass = 'badge-gray'; $badgeLabel = 'No data';
          $barColor = 'var(--gray-300)'; $scoreColor = 'var(--gray-400)'; $filterTag = 'gray';
          if($score !== null) {
            if($score >= 80)     { $statusClass='s-green';  $badgeClass='badge-green';  $badgeLabel='Passing';    $barColor='var(--green)';  $scoreColor='var(--green)';      $filterTag='green'; }
            elseif($score >= 60) { $statusClass='s-yellow'; $badgeClass='badge-yellow'; $badgeLabel='At Risk';    $barColor='var(--yellow)'; $scoreColor='var(--yellow-dark)'; $filterTag='yellow'; }
            else                 { $statusClass='s-red';    $badgeClass='badge-red';    $badgeLabel='Struggling'; $barColor='var(--red)';    $scoreColor='var(--red)';         $filterTag='red'; }
          }
          $avatarColors = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316','#059669','#F59E0B'];
          $avatarBg = $avatarColors[crc32($student['name'] ?? '') % count($avatarColors)];
          $level    = $student['reading_level'] ?? 1;
          $sessions = $student['sessions_count'] ?? 0;
          $pending  = $student['pending_sessions'] ?? 0;
        @endphp
        <a href="{{ route('teacher.student', [$class['id'], $student['id']]) }}"
           class="student-card {{ $statusClass }}"
           data-filter="{{ $filterTag }}"
           data-name="{{ strtolower($student['name'] ?? '') }}">
          <div class="student-card-inner">
            <div class="student-card-top">
              <div style="display:flex;align-items:center;gap:.65rem;flex:1;min-width:0">
                <div class="student-card-avatar" style="background:{{ $avatarBg }}">
                  {{ strtoupper(substr($student['name'] ?? '?', 0, 2)) }}
                </div>
                <div class="student-card-info">
                  <div class="student-card-name">{{ $student['name'] }}</div>
                  <div class="student-card-meta">
                    Grade {{ $student['grade_level'] ?? $student['grade'] ?? '—' }}
                    @if($pending > 0) · <span style="color:var(--orange)">{{ $pending }} pending</span>@endif
                  </div>
                </div>
              </div>
              <span class="status-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
            </div>
            <div class="mini-bar-row">
              <div class="mini-bar-track">
                <div class="mini-bar-fill" style="width:{{ $score ?? 0 }}%;background:{{ $barColor }}"></div>
              </div>
              <span class="mini-bar-pct" style="color:{{ $scoreColor }}">{{ $score !== null ? $score . '%' : '—' }}</span>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between">
              <div style="font-size:.72rem;color:var(--gray-500);display:flex;align-items:center;gap:.3rem"><x-icon name="bar-chart" /> {{ $sessions }} session{{ $sessions !== 1 ? 's' : '' }}</div>
              <div style="font-size:.72rem;color:var(--gray-500);display:flex;align-items:center;gap:.3rem"><x-icon name="trophy" /> Lvl {{ $level }}</div>
            </div>
          </div>
          <div class="student-card-footer">
            <div style="font-size:.72rem;color:var(--gray-400);display:flex;align-items:center;gap:.35rem">
              Level progress
              <div class="level-pip-row">
                @for($i = 0; $i < 3; $i++)
                  <div class="level-pip {{ $i < ($sessions % 3) ? 'done' : '' }}"></div>
                @endfor
              </div>
            </div>
            <span class="view-link">View profile →</span>
          </div>
        </a>
      @empty
        <div class="empty-state">
          <div class="empty-icon"><x-icon name="users" /></div>
          <div class="empty-title">Wala pang estudyante</div>
          <div class="empty-sub">Walang estudyante sa klase na ito.</div>
        </div>
      @endforelse
    </div>
  </div>
</div>

<script>
document.getElementById('studentSearch')?.addEventListener('input', function() {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.student-card').forEach(card => {
    card.style.display = card.dataset.name.includes(q) ? '' : 'none';
  });
});

document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    const f = this.dataset.filter;
    document.querySelectorAll('.student-card').forEach(card => {
      card.style.display = (f === 'all' || card.dataset.filter === f) ? '' : 'none';
    });
  });
});
</script>
</body>
</html>