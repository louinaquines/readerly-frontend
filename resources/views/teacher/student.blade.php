<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $student['name'] }} — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
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
  --amber:#D97706;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;--radius:12px;--radius-lg:18px;
}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-size:.875rem;flex-wrap:wrap}
.breadcrumb a{color:var(--blue);text-decoration:none;font-weight:500}
.breadcrumb a:hover{color:var(--blue-dark);text-decoration:underline}
.breadcrumb-sep{color:var(--gray-300)}
.breadcrumb-current{color:var(--gray-700);font-weight:600}
.topbar-actions{display:flex;align-items:center;gap:.6rem}
.export-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:50px;border:1.5px solid var(--blue);color:var(--blue);background:#fff;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;font-family:var(--font-body)}
.export-btn:hover{background:var(--blue);color:#fff}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}
.two-col{display:grid;grid-template-columns:1fr 1.2fr;gap:1.25rem;margin-bottom:1.25rem}
.full-col{margin-bottom:1.25rem}

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

.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200)}
.panel-head{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid var(--gray-100);gap:.5rem;flex-wrap:wrap}
.panel-title{font-family:var(--font-display);font-size:.95rem;font-weight:700;color:var(--gray-900);display:flex;align-items:center;gap:.5rem}
.p-icon{width:26px;height:26px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:.8rem}
.panel-body{padding:1.1rem 1.25rem}

.assign-textarea{width:100%;padding:.75rem .9rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.88rem;color:var(--gray-900);resize:vertical;min-height:120px;outline:none;transition:border-color .2s;line-height:1.65}
.assign-textarea:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.assign-btn{display:inline-flex;align-items:center;gap:.4rem;margin-top:.85rem;padding:.65rem 1.35rem;background:linear-gradient(135deg,var(--blue),#1D4ED8);color:#fff;border:none;border-radius:50px;font-family:var(--font-display);font-size:.9rem;font-weight:700;cursor:pointer;transition:all .2s}
.assign-btn:hover{transform:translateY(-1px);box-shadow:0 6px 18px rgba(30,64,175,.3)}

.flash-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:#065F46;border-radius:10px;padding:.7rem .9rem;font-size:.83rem;margin-bottom:.9rem;display:flex;align-items:center;gap:.4rem}
.flash-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:#991B1B;border-radius:10px;padding:.7rem .9rem;font-size:.83rem;margin-bottom:.9rem}

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
.session-passage-preview{font-size:.82rem;color:#4B5563;line-height:1.6;margin-bottom:.6rem;font-style:italic}
.error-words{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.6rem}
.error-word{font-size:.7rem;font-weight:700;padding:.18rem .55rem;border-radius:50px;background:var(--red-light);color:var(--red)}
.session-meta{font-size:.72rem;color:var(--gray-400);margin-bottom:.65rem}
.approve-form-btn{display:inline-flex;align-items:center;gap:.35rem;padding:.5rem 1rem;background:var(--green-light);color:var(--green);border:1.5px solid rgba(5,150,105,.25);border-radius:50px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:var(--font-body);transition:all .2s}
.approve-form-btn:hover{background:var(--green);color:#fff;border-color:var(--green)}

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

.chart-wrap{position:relative;padding:1.1rem 1.25rem;height:220px}
.empty-small{text-align:center;padding:1.5rem;color:var(--gray-400);font-size:.85rem}
.empty-small .e-icon{font-size:1.8rem;margin-bottom:.4rem}

@media(max-width:900px){.two-col{grid-template-columns:1fr}}
@media(max-width:768px){
  .main{margin-left:0}
  .breadcrumb{display:none}
  .profile-stats{grid-template-columns:1fr 1fr}
}
@media(max-width:480px){
  .content{padding:1rem}
  .topbar-actions .export-btn span{display:none}
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
        <a href="{{ route('teacher.class', $classId) }}">{{ $class['name'] ?? 'Class' }}</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">{{ $student['name'] }}</span>
      </div>
    </div>
    <div class="topbar-actions">
      <a href="{{ route('teacher.export', [$classId, $student['id']]) }}" class="export-btn">
        <x-icon name="file-text" /> <span>Export PDF</span>
      </a>
    </div>
  </div>

  <div class="content">

    {{-- PROFILE CARD --}}
    @php
      $allScores   = array_filter(array_column($sessions, 'accuracy_score'));
      $avgScore    = count($allScores) ? round(array_sum($allScores) / count($allScores)) : null;
      $totalSess   = count($sessions);
      $approved    = collect($sessions)->where('status','approved')->count();
      $latestScore = collect($sessions)->whereNotNull('accuracy_score')->sortByDesc('id')->first()['accuracy_score'] ?? null;
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
            {{ $avgScore ? $avgScore.'%' : '—' }}
          </div>
          <div class="p-stat-label">Avg Accuracy</div>
        </div>
        <div class="p-stat">
          <div class="p-stat-num" style="color:var(--orange)">{{ count($stories) }}</div>
          <div class="p-stat-label">AI Stories</div>
        </div>
      </div>
    </div>

    {{-- CHART + ASSIGN --}}
    <div class="two-col">

      <div class="panel">
        <div class="panel-head">
          <div class="panel-title"><div class="p-icon" style="background:#EDE9FE"><x-icon name="trending-up" /></div> Accuracy Trend</div>
        </div>
        @if(count($allScores) > 0)
          <div class="chart-wrap">
            <canvas id="accuracyChart"></canvas>
          </div>
        @else
          <div class="empty-small">
            <div class="e-icon"><x-icon name="bar-chart" /></div>
            No scores yet. Chart will appear after the first session.
          </div>
        @endif
      </div>

      <div class="panel">
        <div class="panel-head">
          <div class="panel-title"><div class="p-icon" style="background:#DBEAFE"><x-icon name="pencil" /></div> Assign Passage</div>
        </div>
        <div class="panel-body">
          @if(session('success'))
            <div class="flash-success"><x-icon name="check" /> {{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="flash-error">{{ session('error') }}</div>
          @endif
          <form method="POST" action="{{ route('teacher.assign', $student['id']) }}">
            @csrf
            <label style="font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.4rem">Passage Text</label>
            <textarea
              name="passage"
              class="assign-textarea"
              placeholder="Type or paste the reading passage here for the student…"
              required
            ></textarea>
            <button type="submit" class="assign-btn"><x-icon name="clipboard" /> Assign Passage</button>
          </form>
        </div>
      </div>
    </div>

    {{-- SESSIONS + STORIES --}}
    <div class="two-col">

      <div class="panel">
        <div class="panel-head">
          <div class="panel-title"><div class="p-icon" style="background:#D1FAE5"><x-icon name="mic" /></div> Reading Sessions</div>
          <span style="font-size:.75rem;color:var(--gray-400)">{{ $totalSess }} total</span>
        </div>
        <div class="panel-body" style="padding:.75rem 1.25rem;max-height:520px;overflow-y:auto">
          @if(session('approve_success'))
            <div class="flash-success"><x-icon name="check" /> {{ session('approve_success') }}</div>
          @endif
          @if(session('approve_error'))
            <div class="flash-error">{{ session('approve_error') }}</div>
          @endif
          @forelse($sessions as $session)
            @php
              $sc = $session['accuracy_score'] ?? null;
              $stClass = match($session['status'] ?? '') {
                'approved'  => 'st-approved',
                'completed' => 'st-completed',
                default     => 'st-pending'
              };
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
                  <button type="submit" class="approve-form-btn"><x-icon name="arrow-up" /> Approve Level Up</button>
                </form>
              @endif
            </div>
          @empty
            <div class="empty-small">
              <div class="e-icon"><x-icon name="mic" /></div>
              Wala pang sessions. Mag-assign ng passage para magsimula.
            </div>
          @endforelse
        </div>
      </div>

      <div class="panel">
        <div class="panel-head">
          <div class="panel-title">
            <div class="p-icon" style="background:var(--purple-light)"><x-icon name="brain" /></div>
            AI Progress Summary
          </div>
          <button onclick="generateSummary()" id="summaryBtn"
            style="display:inline-flex;align-items:center;gap:.35rem;padding:.4rem .9rem;background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;border:none;border-radius:50px;font-size:.78rem;font-weight:700;cursor:pointer;font-family:var(--font-body);transition:all .2s">
            <x-icon name="sparkles" /> Generate
          </button>
        </div>
        <div class="panel-body" style="padding:.75rem 1.25rem">

          <div id="summaryLoading" style="display:none;text-align:center;padding:1.5rem">
            <div style="width:36px;height:36px;border:3px solid var(--gray-200);border-top-color:var(--blue);border-radius:50%;animation:spin .8s linear infinite;margin:0 auto .75rem"></div>
            <div style="font-size:.82rem;color:var(--gray-500)">Analyzing student data…</div>
          </div>

          <div id="summaryContent" style="display:none">
            <div id="summaryText"
              style="font-size:.88rem;color:var(--gray-700);line-height:1.8;background:var(--gray-50);border-radius:12px;padding:1rem;border:1.5px solid var(--gray-200);margin-bottom:.75rem">
            </div>
            <div id="summarySource"
              style="font-size:.68rem;color:var(--gray-400);text-align:right">
            </div>
          </div>

          <div id="summaryEmpty" style="text-align:center;padding:1.5rem;color:var(--gray-400)">
            <div style="font-size:2rem;margin-bottom:.5rem"><x-icon name="brain" /></div>
            <div style="font-size:.82rem;font-weight:600;color:var(--gray-600);margin-bottom:.25rem">AI Progress Summary</div>
            <div style="font-size:.78rem;line-height:1.6">Click "Generate" to get an AI-powered analysis of this student's reading progress and personalized recommendations.</div>
          </div>

          <div id="summaryError" style="display:none;background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);border-radius:10px;padding:.75rem;font-size:.82rem;color:var(--red)">
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<script>
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
          callbacks: { label: ctx => '  Accuracy: ' + ctx.parsed.y + '%' }
        }
      }
    }
  });
}
const summaryIcons = {
  clock: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1em;height:1em;vertical-align:-.125em"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>',
  sparkles: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1em;height:1em;vertical-align:-.125em"><path d="m12 3 1.7 4.3L18 9l-4.3 1.7L12 15l-1.7-4.3L6 9l4.3-1.7z"></path><path d="m19 15 .8 2.2L22 18l-2.2.8L19 21l-.8-2.2L16 18l2.2-.8z"></path><path d="m5 4 .8 2.2L8 7l-2.2.8L5 10l-.8-2.2L2 7l2.2-.8z"></path></svg>',
  barChart: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1em;height:1em;vertical-align:-.125em"><path d="M3 3v18h18"></path><path d="M7 16v-5"></path><path d="M12 16V7"></path><path d="M17 16v-8"></path></svg>'
};
function generateSummary() {
  const btn      = document.getElementById('summaryBtn');
  const loading  = document.getElementById('summaryLoading');
  const content  = document.getElementById('summaryContent');
  const empty    = document.getElementById('summaryEmpty');
  const error    = document.getElementById('summaryError');
  const text     = document.getElementById('summaryText');
  const source   = document.getElementById('summarySource');

  btn.disabled   = true;
  btn.innerHTML = summaryIcons.clock + ' Generating...';
  loading.style.display  = 'block';
  content.style.display  = 'none';
  empty.style.display    = 'none';
  error.style.display    = 'none';

  fetch('{{ route("teacher.summary", [$classId, $student["id"]]) }}', {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(r => r.json())
  .then(data => {
    loading.style.display = 'none';
    if (data.summary) {
      text.textContent    = data.summary;
      source.innerHTML  = data.source === 'ai'
        ? summaryIcons.sparkles + ' Generated by Claude AI'
        : summaryIcons.barChart + ' Generated from session data';
      content.style.display = 'block';
    } else {
      throw new Error('No summary returned');
    }
  })
  .catch(err => {
    loading.style.display = 'none';
    error.textContent     = 'Could not generate summary. Please try again.';
    error.style.display   = 'block';
    empty.style.display   = 'block';
  })
  .finally(() => {
    btn.disabled    = false;
    btn.innerHTML = summaryIcons.sparkles + ' Generate';
  });
}
</script>
@livewireScripts
</body>
</html>
