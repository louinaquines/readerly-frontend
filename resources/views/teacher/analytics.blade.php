<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Analytics — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --sidebar-w:240px;--topbar-h:64px;--radius:12px;--radius-lg:18px;
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --blue:#1E40AF;--blue-dark:#1E3A5F;--blue-light:#EFF6FF;--blue-mid:#3B82F6;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-mid:#FEE2E2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-400:#9CA3AF;--gray-500:#6B7280;--gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-time{font-size:.78rem;color:var(--gray-400)}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}
.page-title{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--gray-900);letter-spacing:-.3px;margin-bottom:1.5rem}

.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:clamp(.75rem,2vw,1.1rem);margin-bottom:1.75rem}
.stat-card{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);padding:clamp(1rem,2.5vw,1.35rem);transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.06)}
.stat-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem}
.stat-icon{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:1.1rem}
.stat-num{font-family:var(--font-display);font-size:1.85rem;font-weight:800;color:var(--gray-900);line-height:1;margin-bottom:.2rem}
.stat-label{font-size:.75rem;color:var(--gray-500);font-weight:500}

.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200)}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid var(--gray-100)}
.panel-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:.5rem}
.p-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:.8rem}
.panel-body{padding:1.25rem}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.25rem}
.chart-wrap{position:relative;height:220px}

.class-accuracy-item{display:flex;align-items:center;gap:1rem;padding:.75rem 0;border-bottom:1px solid var(--gray-100)}
.class-accuracy-item:last-child{border-bottom:none}
.ca-name{font-size:.85rem;font-weight:600;color:var(--gray-900);min-width:120px}
.ca-bar-wrap{flex:1;display:flex;align-items:center;gap:.65rem}
.ca-track{flex:1;height:8px;background:var(--gray-100);border-radius:4px;overflow:hidden}
.ca-fill{height:100%;border-radius:4px;transition:width 1s ease}
.ca-pct{font-family:var(--font-display);font-size:.82rem;font-weight:700;min-width:36px;text-align:right}

.coming-soon{text-align:center;padding:3rem 2rem}
.coming-soon .cs-icon{font-size:3rem;margin-bottom:1rem}
.coming-soon .cs-title{font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:var(--gray-700);margin-bottom:.5rem}
.coming-soon .cs-sub{font-size:.85rem;color:var(--gray-400);line-height:1.7;max-width:400px;margin:0 auto}

@media(max-width:768px){
  .main{margin-left:0}
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .two-col{grid-template-columns:1fr}
  .topbar-time{display:none}
}
@media(max-width:420px){
  .stats-row{grid-template-columns:1fr 1fr}
  .content{padding:1rem}
}
</style>
</head>
<body>

@include('teacher.partials.sidebar')

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">Analytics</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
    </div>
  </div>

  <div class="content">
    <div class="page-title">📊 Analytics</div>

    @php
      $allStudents = collect($classes)->flatMap(fn($c) => $c['students'] ?? []);
      $totalStudents = $allStudents->count();
      $allSessions   = collect($recentSessions ?? []);
      $avgAccuracy   = $allSessions->where('score', '>', 0)->avg('score') ?? 0;
      $passing       = $allStudents->filter(fn($s) => ($s['latest_score'] ?? 0) >= 80)->count();
    @endphp

    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon" style="background:#DBEAFE">👥</div></div>
        <div class="stat-num">{{ $totalStudents }}</div>
        <div class="stat-label">Total Students</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon" style="background:#D1FAE5">✅</div></div>
        <div class="stat-num">{{ $passing }}</div>
        <div class="stat-label">Passing (≥80%)</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon" style="background:#FEF3C7">📋</div></div>
        <div class="stat-num">{{ $allSessions->count() }}</div>
        <div class="stat-label">Total Sessions</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-top"><div class="stat-icon" style="background:#EDE9FE">📈</div></div>
        <div class="stat-num">{{ $avgAccuracy > 0 ? round($avgAccuracy) . '%' : '—' }}</div>
        <div class="stat-label">Avg Accuracy</div>
      </div>
    </div>

    @if($allSessions->count() > 0)
      <div class="two-col">
        <div class="panel">
          <div class="panel-head">
            <div class="panel-title"><div class="p-icon" style="background:#DBEAFE">📈</div>Score Distribution</div>
          </div>
          <div class="panel-body">
            <div class="chart-wrap"><canvas id="distChart"></canvas></div>
          </div>
        </div>
        <div class="panel">
          <div class="panel-head">
            <div class="panel-title"><div class="p-icon" style="background:#D1FAE5">🏫</div>Class Avg Accuracy</div>
          </div>
          <div class="panel-body" style="padding:.75rem 1.25rem">
            @foreach($classes as $class)
              @php
                $classStudents = collect($class['students'] ?? []);
                $classScores   = $classStudents->pluck('latest_score')->filter()->values();
                $classAvg      = $classScores->count() ? round($classScores->avg()) : 0;
                $barColor      = $classAvg >= 80 ? 'var(--green)' : ($classAvg >= 60 ? 'var(--yellow)' : 'var(--red)');
              @endphp
              <div class="class-accuracy-item">
                <div class="ca-name">{{ Str::limit($class['name'], 18) }}</div>
                <div class="ca-bar-wrap">
                  <div class="ca-track">
                    <div class="ca-fill" style="width:{{ $classAvg }}%;background:{{ $barColor }}"></div>
                  </div>
                  <span class="ca-pct" style="color:{{ $barColor }}">{{ $classAvg > 0 ? $classAvg . '%' : '—' }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-head">
          <div class="panel-title"><div class="p-icon" style="background:#FEF3C7">📅</div>Sessions Over Time</div>
        </div>
        <div class="panel-body">
          <div class="chart-wrap" style="height:200px"><canvas id="timeChart"></canvas></div>
        </div>
      </div>
    @else
      <div class="panel">
        <div class="coming-soon">
          <div class="cs-icon">📊</div>
          <div class="cs-title">Analytics will appear here</div>
          <div class="cs-sub">Assign passages and complete reading sessions to start seeing data, charts, and class performance insights.</div>
        </div>
      </div>
    @endif

  </div>
</div>

<script>
function updateTime() {
  const el = document.getElementById('topbarTime');
  if (el) el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateTime();
setInterval(updateTime, 60000);

const sessions = @json($recentSessions ?? []);
if (sessions.length > 0) {
  const withScores = sessions.filter(s => s.score > 0);
  const high = withScores.filter(s => s.score >= 80).length;
  const mid  = withScores.filter(s => s.score >= 60 && s.score < 80).length;
  const low  = withScores.filter(s => s.score < 60).length;

  if (document.getElementById('distChart')) {
    new Chart(document.getElementById('distChart'), {
      type: 'doughnut',
      data: {
        labels: ['Passing (≥80%)', 'At Risk (60–79%)', 'Struggling (<60%)'],
        datasets: [{ data: [high, mid, low], backgroundColor: ['#059669','#F59E0B','#DC2626'], borderWidth: 0, hoverOffset: 6 }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { font: { family: 'DM Sans', size: 12 }, padding: 16 } } },
        cutout: '65%'
      }
    });
  }

  if (document.getElementById('timeChart')) {
    const byDate = {};
    sessions.forEach(s => {
      const d = (s.updated_at || '').slice(0, 10);
      if (d) byDate[d] = (byDate[d] || 0) + 1;
    });
    const sortedDates = Object.keys(byDate).sort();
    new Chart(document.getElementById('timeChart'), {
      type: 'bar',
      data: {
        labels: sortedDates.map(d => new Date(d).toLocaleDateString('en-PH', {month:'short',day:'numeric'})),
        datasets: [{ label: 'Sessions', data: sortedDates.map(d => byDate[d]), backgroundColor: 'rgba(30,64,175,.15)', borderColor: '#1E40AF', borderWidth: 2, borderRadius: 6 }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1, font: { family: 'DM Sans' } }, grid: { color: 'rgba(0,0,0,.05)' } },
          x: { ticks: { font: { family: 'DM Sans', size: 11 } }, grid: { display: false } }
        }
      }
    });
  }
}
</script>
</body>
</html>