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
  --orange:#F97316;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --blue-50:#EFF6FF;--blue-100:#DBEAFE;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;--red-mid:#FEE2E2;
  --white:#fff;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;
  --radius:12px;--radius-lg:18px;--radius-xl:24px;
}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-right{display:flex;align-items:center;gap:.75rem}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.75rem;flex-wrap:wrap;gap:.75rem}
.page-title{font-family:var(--font-display);font-size:clamp(1.65rem,4vw,2.1rem);font-weight:800;color:var(--gray-900);line-height:1.1}

.class-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem}
.class-card{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);text-decoration:none;display:block;transition:all .25s;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.class-card:hover{transform:translateY(-4px);border-color:var(--blue-mid);box-shadow:0 16px 40px rgba(0,0,0,.1)}

.class-card-header{padding:1.5rem 1.75rem 1.25rem;background:linear-gradient(135deg,var(--blue-light) 0%,var(--blue-50) 100%);border-bottom:1px solid var(--blue-100);position:relative;overflow:hidden}
.class-card-header::before{content:'';position:absolute;right:-60px;top:-40px;width:100px;height:100px;background:var(--blue);opacity:.07;border-radius:50%}
.class-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1rem;position:relative;z-index:1}
.class-name{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:var(--gray-900);line-height:1.25;margin-bottom:.4rem}
.class-meta{font-size:.82rem;color:var(--gray-500);display:flex;align-items:center;gap:.4rem;flex-wrap:wrap}
.class-grade{background:var(--gray-100);color:var(--gray-700);font-size:.75rem;font-weight:600;padding:.2rem .6rem;border-radius:50px}

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
.class-link{font-size:.82rem;font-weight:600;color:var(--blue)}
.view-btn{display:inline-flex;align-items:center;gap:.4rem;background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;font-weight:600;font-size:.85rem;padding:.55rem 1.1rem;border-radius:10px;border:none;cursor:pointer;font-family:var(--font-body);text-decoration:none;transition:all .2s}
.view-btn:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(30,64,175,.3)}

.empty-state{background:#fff;border-radius:var(--radius-xl);border:2px dashed var(--gray-200);padding:4rem 2rem;text-align:center;grid-column:1/-1}
.empty-icon{font-size:4rem;margin-bottom:1rem}
.empty-title{font-family:var(--font-display);font-size:1.6rem;font-weight:700;color:var(--gray-700);margin-bottom:.75rem}
.empty-subtitle{font-size:.95rem;color:var(--gray-500);line-height:1.6;max-width:400px;margin:0 auto}

@media(max-width:768px){
  .main{margin-left:0}
  .class-grid{grid-template-columns:1fr}
  .class-stats{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:480px){
  .content{padding:1rem}
  .class-footer{flex-direction:column;gap:.75rem}
}
</style>
</head>
<body>

@include('teacher.partials.sidebar')

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">My Classes</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
    </div>
  </div>

  <div class="content">
    <div class="page-header">
      <h1 class="page-title">My Classes</h1>
    </div>

    @if(session('success'))
      <div style="background:var(--green-light);border:1px solid var(--green-mid);border-radius:var(--radius);padding:1rem;margin-bottom:1.5rem;color:var(--green);font-weight:500">
        {{ session('success') }}
      </div>
    @endif

    <div class="class-grid">
      @forelse($classes as $class)
        @php
          $students      = collect($class['students'] ?? []);
          $totalStudents = $students->count();
          $greenCount    = $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 80)->count();
          $yellowCount   = $students->filter(fn($s) => ($s['latest_score'] ?? 0) >= 60 && ($s['latest_score'] ?? 0) < 80)->count();
          $redCount      = $students->filter(fn($s) => isset($s['latest_score']) && ($s['latest_score'] ?? 0) < 60)->count();
          $avgScore      = $students->whereNotNull('latest_score')->avg('latest_score') ?? 0;
          $classColors   = ['#3B82F6','#8B5CF6','#EC4899','#14B8A6','#F97316','#059669'];
          $classBg       = $classColors[array_sum(array_map('ord', str_split($class['name']))) % count($classColors)];
        @endphp
        <a href="{{ route('teacher.class', $class['id']) }}" class="class-card">
          <div class="class-card-header">
            <div class="class-icon" style="background:{{ $classBg }}22;color:{{ $classBg }}">🏫</div>
            <div class="class-name">{{ $class['name'] }}</div>
            <div class="class-meta">
              <span style="font-weight:600">{{ $totalStudents }} student{{ $totalStudents !== 1 ? 's' : '' }}</span>
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
                <div class="stat-label">Passing</div>
              </div>
              <div class="stat-item stat-yellow">
                <div class="stat-icon">⚠️</div>
                <div class="stat-number">{{ $yellowCount }}</div>
                <div class="stat-label">At Risk</div>
              </div>
              <div class="stat-item stat-red">
                <div class="stat-icon">❌</div>
                <div class="stat-number">{{ $redCount }}</div>
                <div class="stat-label">Struggling</div>
              </div>
            </div>
            <div style="font-size:.82rem;color:var(--gray-500);margin-bottom:1rem">
              📊 Avg accuracy: <span style="font-family:var(--font-display);font-weight:700;font-size:1rem;color:var(--gray-900)">{{ round($avgScore) }}%</span>
            </div>
            <div class="class-footer">
              <div class="class-link">View class details →</div>
              <span class="view-btn">👁 View Class</span>
            </div>
          </div>
        </a>
      @empty
        <div class="empty-state">
          <div class="empty-icon">🏫</div>
          <div class="empty-title">No Classes Yet</div>
          <div class="empty-subtitle">Classes are created in the backend. Contact your administrator if you expect to see classes here.</div>
          <div style="margin-top:2rem">
            <a href="{{ route('teacher.dashboard') }}" style="background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;font-weight:600;font-size:.95rem;padding:1rem 2rem;border-radius:14px;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem">← Back to Dashboard</a>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</div>

<script>
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