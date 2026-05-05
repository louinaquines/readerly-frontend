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
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;z-index:100;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}
.page-title{font-family:var(--font-display);font-size:1.5rem;font-weight:800;color:var(--gray-900);letter-spacing:-.3px;margin-bottom:1.5rem}

.summary-row{display:grid;grid-template-columns:repeat(3,1fr);gap:.85rem;margin-bottom:1.25rem}
.summary-card{background:#fff;border:1.5px solid var(--gray-200);border-radius:var(--radius-lg);padding:1rem 1.15rem}
.summary-num{font-family:var(--font-display);font-size:1.55rem;font-weight:800;color:var(--gray-900);line-height:1}
.summary-label{font-size:.72rem;color:var(--gray-500);font-weight:600;margin-top:.2rem}
.report-tools{display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;margin-bottom:1.25rem}
.report-search,.report-select{height:40px;border:1.5px solid var(--gray-200);border-radius:10px;background:#fff;color:var(--gray-900);font-family:var(--font-body);font-size:.84rem;outline:none;transition:border-color .2s,box-shadow .2s}
.report-search{flex:1;min-width:220px;padding:0 .9rem}
.report-select{min-width:190px;padding:0 .8rem}
.report-search:focus,.report-select:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.empty-results{display:none;text-align:center;padding:2rem;color:var(--gray-400);font-size:.85rem;border:1.5px dashed var(--gray-200);border-radius:var(--radius);background:var(--gray-50)}
.panel{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);padding:clamp(1.25rem,3vw,1.75rem)}
.class-block{margin-bottom:1.75rem}
.class-block:last-child{margin-bottom:0}
.class-name{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-900);margin-bottom:.85rem;display:flex;align-items:center;gap:.5rem}
.class-name::before{content:'';width:4px;height:18px;background:var(--blue);border-radius:2px;display:inline-block}

.students-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:.85rem}
.student-export-card{display:flex;align-items:center;justify-content:space-between;gap:1rem;border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:.9rem 1.1rem;background:var(--gray-50);transition:border-color .2s,background .2s}
.student-export-card:hover{border-color:var(--blue-mid);background:var(--blue-light)}
.s-name{font-size:.9rem;font-weight:600;color:var(--gray-900)}
.s-meta{font-size:.72rem;color:var(--gray-500);margin-top:.1rem}
.score-pill{display:inline-flex;align-items:center;justify-content:center;min-width:46px;margin-top:.35rem;border-radius:50px;padding:.14rem .5rem;font-size:.68rem;font-weight:800;background:var(--gray-100);color:var(--gray-500)}
.export-btn{display:inline-flex;align-items:center;gap:.35rem;background:var(--blue);color:#fff;font-size:.78rem;font-weight:600;padding:.5rem .95rem;border-radius:50px;text-decoration:none;white-space:nowrap;transition:all .2s;font-family:var(--font-body)}
.export-btn:hover{background:var(--blue-dark);transform:translateY(-1px)}

@media(max-width:768px){
  .main{margin-left:0}
  .topbar-time{display:none}
  .summary-row{grid-template-columns:1fr}
}
@media(max-width:480px){
  .students-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

@include('teacher.partials.sidebar')

<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">PDF Reports</div>
    </div>
    <div class="topbar-right">
      <span class="topbar-time" id="topbarTime"></span>
    </div>
  </div>

  <div class="content">
    <div class="page-title" style="display:flex;align-items:center;gap:.5rem"><x-icon name="file-text" /> PDF Reports</div>

    @php
      $totalClasses = count($classes);
      $totalStudents = collect($classes)->sum(fn($class) => count($class['students'] ?? []));
      $totalSessions = collect($classes)
        ->flatMap(fn($class) => $class['students'] ?? [])
        ->sum(fn($student) => $student['sessions_count'] ?? 0);
    @endphp

    <div class="summary-row">
      <div class="summary-card">
        <div class="summary-num">{{ $totalClasses }}</div>
        <div class="summary-label">Classes</div>
      </div>
      <div class="summary-card">
        <div class="summary-num">{{ $totalStudents }}</div>
        <div class="summary-label">Students</div>
      </div>
      <div class="summary-card">
        <div class="summary-num">{{ $totalSessions }}</div>
        <div class="summary-label">Reading Sessions</div>
      </div>
    </div>

    <div class="panel">
      <p style="font-size:.88rem;color:var(--gray-500);margin-bottom:1.5rem">
        Select a student to export their complete reading report as a PDF.
      </p>

      <div class="report-tools">
        <input type="search" id="reportSearch" class="report-search" placeholder="Search student name, grade, or class">
        <select id="classFilter" class="report-select">
          <option value="all">All classes</option>
          @foreach($classes as $class)
            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
          @endforeach
        </select>
      </div>

      <div class="empty-results" id="emptyResults">
        No matching students found.
      </div>

      @forelse($classes as $class)
        <div class="class-block" data-class-block data-class-id="{{ $class['id'] }}">
          <div class="class-name">{{ $class['name'] }}@if(isset($class['grade_level'])) — {{ $class['grade_level'] }}@endif</div>
          @php $students = $class['students'] ?? []; @endphp
          @if(empty($students))
            <p style="font-size:.82rem;color:var(--gray-400);font-style:italic;padding:.5rem 0">No students in this class.</p>
          @else
            <div class="students-grid">
              @foreach($students as $student)
                @php
                  $latestScore = $student['latest_score'] ?? null;
                  $scoreColor = $latestScore === null
                    ? 'background:var(--gray-100);color:var(--gray-500)'
                    : ($latestScore >= 80
                        ? 'background:#D1FAE5;color:#065F46'
                        : ($latestScore >= 60
                            ? 'background:#FEF3C7;color:#92400E'
                            : 'background:#FEE2E2;color:#991B1B'));
                @endphp
                <div
                  class="student-export-card"
                  data-report-card
                  data-class-id="{{ $class['id'] }}"
                  data-search="{{ strtolower(($student['name'] ?? '') . ' ' . ($student['grade'] ?? $student['grade_level'] ?? '') . ' ' . ($class['name'] ?? '')) }}"
                >
                  <div>
                    <div class="s-name">{{ $student['name'] }}</div>
                    <div class="s-meta">
                      {{ $student['grade'] ?? $student['grade_level'] ?? '' }}
                      · Level {{ $student['reading_level'] ?? 1 }}
                      · {{ $student['sessions_count'] ?? 0 }} sessions
                    </div>
                    <span class="score-pill" style="{{ $scoreColor }}">
                      {{ $latestScore !== null ? round($latestScore) . '%' : 'No score' }}
                    </span>
                  </div>
                  <a href="{{ route('teacher.export', [$class['id'], $student['id']]) }}" class="export-btn">
                    <x-icon name="file-text" /> Export
                  </a>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      @empty
        <div style="text-align:center;padding:2.5rem;color:var(--gray-400)">
          <div style="font-size:2rem;margin-bottom:.75rem"><x-icon name="file-text" /></div>
          <div style="font-family:var(--font-display);font-weight:700;color:var(--gray-700);margin-bottom:.35rem">No classes yet</div>
          <div style="font-size:.83rem">Add classes and students to generate PDF reports.</div>
        </div>
      @endforelse
    </div>
  </div>
</div>

<script>
function updateTime() {
  const el = document.getElementById('topbarTime');
  if (el) el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateTime();
setInterval(updateTime, 60000);

const reportSearch = document.getElementById('reportSearch');
const classFilter = document.getElementById('classFilter');
const emptyResults = document.getElementById('emptyResults');

function applyReportFilters() {
  const query = (reportSearch?.value || '').trim().toLowerCase();
  const selectedClass = classFilter?.value || 'all';
  let visibleCards = 0;

  document.querySelectorAll('[data-report-card]').forEach(card => {
    const matchesClass = selectedClass === 'all' || card.dataset.classId === selectedClass;
    const matchesSearch = !query || (card.dataset.search || '').includes(query);
    const isVisible = matchesClass && matchesSearch;
    card.style.display = isVisible ? '' : 'none';
    if (isVisible) visibleCards++;
  });

  document.querySelectorAll('[data-class-block]').forEach(block => {
    const hasVisibleStudents = Array.from(block.querySelectorAll('[data-report-card]'))
      .some(card => card.style.display !== 'none');
    const classMatches = selectedClass === 'all' || block.dataset.classId === selectedClass;
    block.style.display = hasVisibleStudents || (classMatches && !block.querySelector('[data-report-card]')) ? '' : 'none';
  });

  if (emptyResults) emptyResults.style.display = visibleCards === 0 ? 'block' : 'none';
}

reportSearch?.addEventListener('input', applyReportFilters);
classFilter?.addEventListener('change', applyReportFilters);
</script>
</body>
</html>
