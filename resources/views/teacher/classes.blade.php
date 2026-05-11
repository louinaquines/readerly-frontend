<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Classes — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/png" href="{{ asset('readerly-logo.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-dark:#92400E;
  --orange:#F97316;
  --blue:#1E40AF;--blue-mid:#3B82F6;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --blue-50:#EFF6FF;--blue-100:#DBEAFE;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --sidebar-w:240px;--topbar-h:64px;--radius:12px;--radius-lg:18px;--radius-xl:24px;
}
body{font-family:var(--font-body);background:var(--gray-50);color:var(--gray-900);min-height:100vh}

.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}

.topbar{height:var(--topbar-h);position:sticky;top:0;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between;padding:0 clamp(1.25rem,3vw,2rem);gap:1rem}
.topbar-left{display:flex;align-items:center;gap:.75rem}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--gray-900)}
.topbar-right{display:flex;align-items:center;gap:.75rem}
.topbar-time{font-size:.78rem;color:var(--gray-400);font-weight:500}

.content{padding:clamp(1.25rem,3vw,2rem);flex:1}

.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.75rem;flex-wrap:wrap;gap:.75rem}
.page-title{font-family:var(--font-display);font-size:clamp(1.65rem,4vw,2.1rem);font-weight:800;color:var(--gray-900);line-height:1.1}

.create-btn{display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;font-family:var(--font-display);font-size:.9rem;font-weight:700;padding:.7rem 1.4rem;border-radius:50px;border:none;cursor:pointer;transition:all .2s;text-decoration:none}
.create-btn:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(30,64,175,.3)}

.class-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem}
.class-card{background:#fff;border-radius:var(--radius-lg);border:1.5px solid var(--gray-200);text-decoration:none;display:block;transition:all .25s;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04)}
.class-card:hover{transform:translateY(-4px);border-color:var(--blue-mid);box-shadow:0 16px 40px rgba(0,0,0,.1)}

.class-card-header{padding:1.5rem 1.75rem 1.25rem;background:linear-gradient(135deg,var(--blue-light) 0%,var(--blue-50) 100%);border-bottom:1px solid var(--blue-100);position:relative;overflow:hidden}
.class-card-header::before{content:'';position:absolute;right:-60px;top:-40px;width:100px;height:100px;background:var(--blue);opacity:.07;border-radius:50%}
.class-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1rem;position:relative;z-index:1}
.class-name{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:var(--gray-900);line-height:1.25;margin-bottom:.4rem}
.class-meta{font-size:.82rem;color:var(--gray-500);display:flex;align-items:center;gap:.4rem;flex-wrap:wrap}
.class-grade{background:var(--gray-100);color:var(--gray-700);font-size:.75rem;font-weight:600;padding:.2rem .6rem;border-radius:50px}
.class-id-badge{background:rgba(30,64,175,.1);color:var(--blue);font-size:.72rem;font-weight:700;padding:.2rem .6rem;border-radius:50px;display:inline-flex;align-items:center;gap:.3rem;margin-top:.5rem;cursor:pointer;transition:all .2s}
.class-id-badge:hover{background:var(--blue);color:#fff}

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
.empty-subtitle{font-size:.95rem;color:var(--gray-500);line-height:1.6;max-width:400px;margin:0 auto 2rem}

/* ── MODAL ── */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:300;align-items:center;justify-content:center;padding:1rem}
.modal-overlay.open{display:flex}
.modal{background:#fff;border-radius:20px;padding:2rem;width:100%;max-width:440px;box-shadow:0 24px 64px rgba(0,0,0,.15)}
.modal-title{font-family:var(--font-display);font-size:1.25rem;font-weight:800;color:var(--gray-900);margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem}
.form-group{margin-bottom:1rem}
.form-group label{font-size:.75rem;font-weight:600;color:var(--gray-700);display:block;margin-bottom:.35rem}
.form-group input,.form-group select{width:100%;padding:.7rem .95rem;border:1.5px solid var(--gray-200);border-radius:10px;font-family:var(--font-body);font-size:.88rem;color:var(--gray-900);outline:none;transition:border-color .2s}
.form-group input:focus,.form-group select:focus{border-color:var(--blue-mid);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.modal-actions{display:flex;gap:.75rem;margin-top:1.5rem}
.btn-primary{flex:1;padding:.75rem;background:linear-gradient(135deg,var(--blue),var(--blue-dark));color:#fff;border:none;border-radius:10px;font-family:var(--font-display);font-size:.95rem;font-weight:700;cursor:pointer;transition:all .2s}
.btn-primary:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(30,64,175,.3)}
.btn-cancel{padding:.75rem 1.25rem;background:var(--gray-100);color:var(--gray-700);border:none;border-radius:10px;font-family:var(--font-body);font-size:.88rem;font-weight:600;cursor:pointer;transition:all .2s}
.btn-cancel:hover{background:var(--gray-200)}

.alert-success{background:var(--green-light);border:1.5px solid rgba(5,150,105,.2);color:var(--green);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1.5rem}
.alert-error{background:var(--red-light);border:1.5px solid rgba(220,38,38,.2);color:var(--red);border-radius:10px;padding:.75rem 1rem;font-size:.83rem;margin-bottom:1.5rem}

/* copied badge tooltip */
.copy-toast{position:fixed;bottom:2rem;left:50%;transform:translateX(-50%);background:var(--gray-900);color:#fff;font-size:.82rem;font-weight:600;padding:.6rem 1.25rem;border-radius:50px;opacity:0;transition:opacity .3s;pointer-events:none;z-index:400}
.copy-toast.show{opacity:1}

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
      <button class="create-btn" onclick="openModal()">＋ Create Class</button>
    </div>

    @if(session('success'))
      <div class="alert-success"><x-icon name="check" /> {{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert-error">{{ $errors->first() }}</div>
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
            <div class="class-icon" style="background:{{ $classBg }}22;color:{{ $classBg }}"><x-icon name="school" /></div>
            <div class="class-name">{{ $class['name'] }}</div>
            <div class="class-meta">
              <span style="font-weight:600">{{ $totalStudents }} student{{ $totalStudents !== 1 ? 's' : '' }}</span>
              @if(isset($class['grade_level']))
                <span class="class-grade">Grade {{ $class['grade_level'] }}</span>
              @endif
            </div>
            <div class="class-id-badge"
                onclick="event.preventDefault();copyClassId('{{ $class['class_code'] ?? 'N/A' }}', this)">
              <x-icon name="key" /> Class Code: {{ $class['class_code'] ?? 'N/A' }} — tap to copy
            </div>
          </div>
          <div class="class-body">
            <div class="class-stats">
              <div class="stat-item stat-green">
                <div class="stat-icon"><x-icon name="check" /></div>
                <div class="stat-number">{{ $greenCount }}</div>
                <div class="stat-label">Passing</div>
              </div>
              <div class="stat-item stat-yellow">
                <div class="stat-icon"><x-icon name="alert-triangle" /></div>
                <div class="stat-number">{{ $yellowCount }}</div>
                <div class="stat-label">At Risk</div>
              </div>
              <div class="stat-item stat-red">
                <div class="stat-icon"><x-icon name="x" /></div>
                <div class="stat-number">{{ $redCount }}</div>
                <div class="stat-label">Struggling</div>
              </div>
            </div>
            <div style="font-size:.82rem;color:var(--gray-500);margin-bottom:1rem">
              <x-icon name="bar-chart" /> Avg accuracy: <span style="font-family:var(--font-display);font-weight:700;font-size:1rem;color:var(--gray-900)">{{ round($avgScore) }}%</span>
            </div>
            <div class="class-footer">
              <div class="class-link">View class details →</div>
              <span class="view-btn"><x-icon name="eye" /> View Class</span>
            </div>
          </div>
        </a>
      @empty
        <div class="empty-state">
          <div class="empty-icon"><x-icon name="school" /></div>
          <div class="empty-title">No Classes Yet</div>
          <div class="empty-subtitle">Create your first class and share the Class ID with your students so they can join.</div>
          <button class="create-btn" onclick="openModal()">＋ Create Your First Class</button>
        </div>
      @endforelse
    </div>
  </div>
</div>

{{-- CREATE CLASS MODAL --}}
<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <div class="modal-title"><x-icon name="school" /> Create New Class</div>
    <form method="POST" action="{{ route('teacher.classes.store') }}">
      @csrf
      <div class="form-group">
        <label>Class Name</label>
        <input type="text" name="name" placeholder="e.g. Grade 1 - Section A" required>
      </div>
      <div class="form-group">
        <label>Grade Level</label>
        <select name="grade_level" required>
          <option value="">Select grade…</option>
          @for($g = 1; $g <= 6; $g++)
            <option value="{{ $g }}">Grade {{ $g }}</option>
          @endfor
        </select>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        <button type="submit" class="btn-primary">Create Class</button>
      </div>
    </form>
  </div>
</div>

<div class="copy-toast" id="copyToast"><x-icon name="check" /> Class ID copied!</div>

<script>
function updateTime() {
  const el = document.getElementById('topbarTime');
  if (el) el.textContent = new Date().toLocaleTimeString('en-PH', {hour:'2-digit',minute:'2-digit'});
}
updateTime();
setInterval(updateTime, 60000);

function openModal() {
  document.getElementById('modalOverlay').classList.add('open');
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
}
document.getElementById('modalOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});

function copyClassId(id, el) {
  navigator.clipboard.writeText(String(id)).then(() => {
    el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1em;height:1em;vertical-align:-.125em"><path d="m20 6-11 11-5-5"></path></svg> Copied!';
    const toast = document.getElementById('copyToast');
    toast.classList.add('show');
    setTimeout(() => {
      toast.classList.remove('show');
      el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:1em;height:1em;vertical-align:-.125em"><circle cx="7.5" cy="14.5" r="4.5"></circle><path d="M11 11 21 1"></path><path d="m17 5 2 2"></path><path d="m14 8 2 2"></path></svg> Class ID: ' + id + ' — tap to copy';
    }, 2000);
  });
}

@if(session('success'))
  // Auto-close modal on success
  closeModal();
@endif
</script>
</body>
</html>
