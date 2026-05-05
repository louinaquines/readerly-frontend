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
.export-btn{display:inline-flex;align-items:center;gap:.35rem;background:var(--blue);color:#fff;font-size:.78rem;font-weight:600;padding:.5rem .95rem;border-radius:50px;text-decoration:none;white-space:nowrap;transition:all .2s;font-family:var(--font-body)}
.export-btn:hover{background:var(--blue-dark);transform:translateY(-1px)}

@media(max-width:768px){
  .main{margin-left:0}
  .topbar-time{display:none}
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

    <div class="panel">
      <p style="font-size:.88rem;color:var(--gray-500);margin-bottom:1.5rem">
        Select a student to export their complete reading report as a PDF.
      </p>

      @forelse($classes as $class)
        <div class="class-block">
          <div class="class-name">{{ $class['name'] }}@if(isset($class['grade_level'])) — {{ $class['grade_level'] }}@endif</div>
          @php $students = $class['students'] ?? []; @endphp
          @if(empty($students))
            <p style="font-size:.82rem;color:var(--gray-400);font-style:italic;padding:.5rem 0">No students in this class.</p>
          @else
            <div class="students-grid">
              @foreach($students as $student)
                <div class="student-export-card">
                  <div>
                    <div class="s-name">{{ $student['name'] }}</div>
                    <div class="s-meta">
                      {{ $student['grade'] ?? $student['grade_level'] ?? '' }}
                      · Level {{ $student['reading_level'] ?? 1 }}
                    </div>
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
</script>
</body>
</html>