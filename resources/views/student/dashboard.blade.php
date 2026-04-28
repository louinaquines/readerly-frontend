<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Readerly</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --yellow:#F59E0B;--yellow-light:#FEF3C7;--yellow-mid:#FDE68A;--yellow-dark:#92400E;
  --orange:#F97316;--orange-light:#FFF7ED;--orange-dark:#C2410C;
  --amber:#D97706;
  --blue:#1E40AF;--blue-light:#EFF6FF;--blue-dark:#1E3A5F;
  --green:#059669;--green-light:#ECFDF5;--green-mid:#D1FAE5;
  --red:#DC2626;--red-light:#FEF2F2;
  --purple:#7C3AED;--purple-light:#F5F3FF;
  --white:#fff;
  --gray-50:#F9FAFB;--gray-100:#F3F4F6;--gray-200:#E5E7EB;
  --gray-300:#D1D5DB;--gray-400:#9CA3AF;--gray-500:#6B7280;
  --gray-700:#374151;--gray-900:#111827;
  --font-display:'Baloo 2',cursive;--font-body:'DM Sans',sans-serif;
  --radius:14px;--radius-lg:20px;--radius-xl:28px;
}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);background:linear-gradient(160deg,#FFFBEB 0%,#FFF7ED 40%,#FEF3C7 100%);min-height:100vh;color:var(--gray-900)}

/* ── TOPBAR ── */
.topbar{
  position:sticky;top:0;z-index:100;
  background:rgba(255,255,255,.95);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);
  border-bottom:1px solid rgba(245,158,11,.18);
  padding:0 clamp(1rem,4vw,2rem);height:64px;
  display:flex;align-items:center;justify-content:space-between;gap:1rem
}
.topbar-logo{
  font-family:var(--font-display);font-size:1.4rem;font-weight:800;
  color:var(--blue);text-decoration:none;
  display:flex;align-items:center;letter-spacing:-.3px
}
.topbar-logo span{color:var(--yellow);margin-left:-1px}
.topbar-right{display:flex;align-items:center;gap:.65rem}
.topbar-avatar{
  width:36px;height:36px;border-radius:50%;
  background:linear-gradient(135deg,var(--orange),var(--yellow));
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.85rem;font-weight:800;
  color:#fff;flex-shrink:0;cursor:pointer;
  text-decoration:none;overflow:hidden;border:2px solid rgba(249,115,22,.3)
}
.topbar-name{
  font-size:.85rem;font-weight:600;color:var(--gray-700);
  max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap
}
.logout-btn{
  display:inline-flex;align-items:center;gap:.35rem;
  font-family:var(--font-body);font-size:.78rem;font-weight:600;
  color:var(--gray-500);background:transparent;
  border:1.5px solid var(--gray-200);border-radius:50px;
  padding:.38rem .85rem;cursor:pointer;transition:all .2s;text-decoration:none
}
.logout-btn:hover{border-color:var(--orange);color:var(--orange-dark);background:var(--orange-light)}

/* ── PAGE ── */
.page{max-width:960px;margin:0 auto;padding:clamp(1.25rem,4vw,2.5rem) clamp(1rem,4vw,1.5rem)}

/* ── GREETING HERO ── */
.greeting-hero{
  background:linear-gradient(135deg,var(--orange) 0%,var(--amber) 55%,var(--yellow) 100%);
  border-radius:var(--radius-xl);padding:clamp(1.4rem,4vw,2.2rem) clamp(1.5rem,4vw,2.5rem);
  margin-bottom:1.5rem;position:relative;overflow:hidden;
  display:flex;align-items:center;justify-content:space-between;gap:1rem
}
.greeting-hero::before{content:'';position:absolute;top:-50px;right:-50px;width:220px;height:220px;background:rgba(255,255,255,.1);border-radius:50%;pointer-events:none}
.greeting-hero::after{content:'';position:absolute;bottom:-30px;left:35%;width:160px;height:160px;background:rgba(255,255,255,.06);border-radius:50%;pointer-events:none}
.greeting-left{position:relative;z-index:1;flex:1;min-width:0}
.greeting-tag{display:inline-flex;align-items:center;gap:.4rem;background:rgba(255,255,255,.22);color:#fff;font-size:.72rem;font-weight:700;padding:.28rem .75rem;border-radius:50px;margin-bottom:.6rem;letter-spacing:.4px}
.tag-dot{width:6px;height:6px;background:#fff;border-radius:50%;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.5)}}
.greeting-name{font-family:var(--font-display);font-size:clamp(1.4rem,4vw,2rem);font-weight:800;color:#fff;line-height:1.2;letter-spacing:-.5px;margin-bottom:.3rem}
.greeting-sub{font-size:.88rem;color:rgba(255,255,255,.82);line-height:1.65}
.greeting-right{position:relative;z-index:1;flex-shrink:0}
.level-badge{
  background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.35);
  border-radius:16px;padding:.85rem 1.2rem;text-align:center;
  min-width:85px;backdrop-filter:blur(4px)
}
.level-num{font-family:var(--font-display);font-size:1.9rem;font-weight:800;color:#fff;line-height:1}
.level-label{font-size:.62rem;font-weight:700;color:rgba(255,255,255,.72);text-transform:uppercase;letter-spacing:.5px;margin-top:.15rem}

/* ── STATS ROW ── */
.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:clamp(.65rem,2vw,1rem);margin-bottom:1.5rem}
.stat-card{
  background:#fff;border-radius:var(--radius);
  padding:clamp(.9rem,2.5vw,1.2rem);
  border:1.5px solid rgba(0,0,0,.05);
  transition:transform .2s,box-shadow .2s
}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.07)}
.stat-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:.6rem}
.stat-num{font-family:var(--font-display);font-size:1.55rem;font-weight:800;line-height:1;color:var(--gray-900)}
.stat-label{font-size:.7rem;color:var(--gray-500);margin-top:.2rem;font-weight:500}

/* ── PROGRESS ── */
.progress-section{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px solid rgba(0,0,0,.06);
  padding:clamp(.9rem,3vw,1.35rem);margin-bottom:1.5rem
}
.progress-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:.85rem}
.progress-title{font-family:var(--font-display);font-size:.93rem;font-weight:700;color:var(--gray-900)}
.progress-pct{font-family:var(--font-display);font-size:1rem;font-weight:800;color:var(--orange)}
.progress-track{background:var(--gray-100);border-radius:50px;height:10px;overflow:hidden;margin-bottom:.45rem}
.progress-fill{height:100%;border-radius:50px;background:linear-gradient(90deg,var(--yellow),var(--orange));transition:width 1.2s cubic-bezier(.4,0,.2,1)}
.progress-labels{display:flex;justify-content:space-between;font-size:.68rem;color:var(--gray-400)}
.level-steps{display:flex;gap:.5rem;margin-top:.85rem}
.level-step{flex:1;height:6px;border-radius:3px;background:var(--gray-100);transition:background .4s}
.level-step.done{background:linear-gradient(90deg,var(--yellow),var(--orange))}
.level-step.current{background:var(--yellow-mid)}

/* ── SECTION HEAD ── */
.section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:.9rem;gap:.5rem;flex-wrap:wrap}
.section-title{font-family:var(--font-display);font-size:1.05rem;font-weight:800;color:var(--gray-900);display:flex;align-items:center;gap:.5rem}
.s-icon{width:27px;height:27px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.82rem}
.section-count{font-size:.72rem;font-weight:700;background:var(--yellow-light);color:var(--yellow-dark);padding:.18rem .55rem;border-radius:50px}

/* ── MOTI BANNER ── */
.moti-banner{
  background:linear-gradient(135deg,#FEF3C7,#FFF7ED);
  border:1.5px solid rgba(245,158,11,.2);border-radius:var(--radius-lg);
  padding:1rem 1.35rem;display:flex;align-items:center;gap:.85rem;margin-bottom:1.5rem
}
.moti-emoji{font-size:1.85rem;flex-shrink:0}
.moti-text{font-size:.86rem;color:var(--yellow-dark);font-weight:500;line-height:1.6}
.moti-text strong{font-family:var(--font-display);font-size:.92rem}

/* ── PASSAGE CARDS ── */
.passages-section{margin-bottom:1.5rem}
.passage-card{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px solid rgba(0,0,0,.06);overflow:hidden;
  margin-bottom:.85rem;transition:transform .2s,box-shadow .2s
}
.passage-card:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(0,0,0,.08)}
.passage-card-inner{padding:clamp(.9rem,3vw,1.35rem)}
.passage-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.7rem;gap:.75rem}
.passage-meta{display:flex;align-items:center;gap:.4rem;flex-wrap:wrap}
.passage-badge{font-size:.67rem;font-weight:700;padding:.2rem .58rem;border-radius:50px;letter-spacing:.3px}
.badge-new{background:#FEF3C7;color:#92400E}
.badge-grade{background:var(--blue-light);color:var(--blue-dark)}
.passage-num{font-size:.7rem;color:var(--gray-300);font-weight:500}
.passage-text{
  font-size:.92rem;color:var(--gray-700);line-height:1.78;
  margin-bottom:.95rem;font-family:var(--font-display);font-weight:600
}
.passage-footer{display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
.passage-assigned{font-size:.7rem;color:var(--gray-400);display:flex;align-items:center;gap:.3rem}
.read-btn-wrap{position:relative;display:inline-flex}
.pulse-ring{position:absolute;inset:-4px;border-radius:50px;border:2px solid var(--orange);animation:ringPulse 2s ease-out infinite;opacity:0;pointer-events:none}
@keyframes ringPulse{0%{opacity:.6;transform:scale(1)}100%{opacity:0;transform:scale(1.12)}}
.read-btn{
  display:inline-flex;align-items:center;gap:.45rem;
  background:linear-gradient(135deg,var(--orange),var(--amber));
  color:#fff;font-family:var(--font-display);font-size:.92rem;font-weight:700;
  padding:.62rem 1.4rem;border-radius:50px;text-decoration:none;
  border:none;cursor:pointer;transition:all .2s;
  box-shadow:0 4px 14px rgba(249,115,22,.3);white-space:nowrap
}
.read-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(249,115,22,.4)}

/* ── EMPTY STATE ── */
.empty-state{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px dashed var(--gray-200);padding:2.5rem;text-align:center
}
.empty-icon{font-size:2.3rem;margin-bottom:.65rem}
.empty-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--gray-700);margin-bottom:.3rem}
.empty-sub{font-size:.82rem;color:var(--gray-400);line-height:1.65}

/* ── STORY CARDS ── */
.stories-section{margin-bottom:1.5rem}
.story-card{
  background:#fff;border-radius:var(--radius-lg);
  border:1.5px solid rgba(0,0,0,.06);
  padding:clamp(.9rem,3vw,1.35rem);margin-bottom:.85rem;
  position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s
}
.story-card:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(0,0,0,.07)}
.story-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:linear-gradient(180deg,var(--purple),var(--blue))}
.story-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem;gap:.5rem}
.story-tag{display:inline-flex;align-items:center;gap:.35rem;background:var(--purple-light);color:var(--purple);font-size:.7rem;font-weight:700;padding:.18rem .58rem;border-radius:50px}
.story-date{font-size:.7rem;color:var(--gray-300)}
.story-text{font-size:.9rem;color:var(--gray-700);line-height:1.8;font-style:italic}
.story-words{display:flex;flex-wrap:wrap;gap:.35rem;margin-top:.65rem}
.story-word-pill{background:var(--yellow-light);color:var(--yellow-dark);font-size:.68rem;font-weight:700;padding:.16rem .52rem;border-radius:50px}

/* ── SESSIONS ── */
.completed-section{margin-bottom:1.5rem}
.session-row{
  background:#fff;border-radius:var(--radius);
  border:1.5px solid rgba(0,0,0,.05);
  padding:.85rem 1rem;margin-bottom:.55rem;
  display:flex;align-items:center;gap:.9rem;transition:background .2s
}
.session-row:hover{background:var(--gray-50)}
.session-score-ring{
  width:42px;height:42px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:.82rem;font-weight:800
}
.score-high{background:var(--green-mid);color:#065F46}
.score-mid{background:var(--yellow-light);color:var(--yellow-dark)}
.score-low{background:#FEE2E2;color:#991B1B}
.session-info{flex:1;min-width:0}
.session-passage{font-size:.82rem;font-weight:600;color:var(--gray-700);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:.12rem}
.session-date{font-size:.68rem;color:var(--gray-400)}
.session-status{font-size:.68rem;font-weight:700;padding:.18rem .52rem;border-radius:50px;flex-shrink:0}
.status-approved{background:var(--green-mid);color:#065F46}
.status-completed{background:var(--yellow-light);color:var(--yellow-dark)}

/* ── RESPONSIVE ── */
@media(max-width:600px){
  .greeting-right{display:none}
  .passage-footer{flex-direction:column;align-items:flex-start}
  .read-btn{width:100%;justify-content:center}
  .topbar-name{display:none}
}
@media(max-width:400px){
  .stats-row{grid-template-columns:1fr 1fr}
  .stats-row .stat-card:last-child{grid-column:span 2}
}
</style>
</head>
<body>

<!-- TOPBAR -->
<nav class="topbar">
  <a href="/student/dashboard" class="topbar-logo">Reader<span>ly</span></a>
  <div class="topbar-right">
    {{-- FIX: link to profile using $user['id'], not $student --}}
    <a href="{{ route('student.profile') }}" class="topbar-avatar" title="{{ $user['name'] }}">
      @if(!empty($user['avatar']) && (str_contains($user['avatar'], 'storage') || str_contains($user['avatar'], 'avatars/')))
        <img src="{{ Storage::url($user['avatar']) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
      @else
        {{ strtoupper(substr($user['name'], 0, 2)) }}
      @endif
    </a>
    <span class="topbar-name">{{ explode(' ', $user['name'])[0] }}</span>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">↩ Logout</button>
    </form>
  </div>
</nav>

<div class="page">

  {{-- GREETING HERO --}}
  @php
    $pendingCount = collect($sessions)->where('status','pending')->count();
  @endphp
  <div class="greeting-hero">
    <div class="greeting-left">
      <div class="greeting-tag"><div class="tag-dot"></div>Welcome back!</div>
      <div class="greeting-name">Hello, {{ explode(' ', $user['name'])[0] }}! 👋</div>
      <div class="greeting-sub">
        @if($pendingCount > 0)
          You have <strong>{{ $pendingCount }} passage{{ $pendingCount > 1 ? 's' : '' }}</strong> waiting. You've got this!
        @else
          Great job! You've completed all passages today. 🎉
        @endif
      </div>
    </div>
    <div class="greeting-right">
      <div class="level-badge">
        {{-- FIX: reading_level lives on $user from the API session --}}
        <div class="level-num">{{ $user['reading_level'] ?? 1 }}</div>
        <div class="level-label">Level</div>
      </div>
    </div>
  </div>

  {{-- QUICK STATS --}}
  @php
    $allSessions = collect($sessions);
    $completed   = $allSessions->whereNotIn('status',['pending'])->count();

    $avgScore = $allSessions->whereNotIn('status',['pending'])->map(function($s){
      return $s['accuracy_score'] ?? $s['score'] ?? null;
    })->filter()->avg() ?? 0;
  @endphp
  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-icon" style="background:#FEF3C7">📖</div>
      <div class="stat-num">{{ $pendingCount }}</div>
      <div class="stat-label">Pending</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon" style="background:#D1FAE5">✅</div>
      <div class="stat-num">{{ $completed }}</div>
      <div class="stat-label">Completed</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon" style="background:#EDE9FE">⭐</div>
      <div class="stat-num">{{ $avgScore > 0 ? round($avgScore).'%' : '—' }}</div>
      <div class="stat-label">Avg Score</div>
    </div>
  </div>

  {{-- LEVEL PROGRESS --}}
  @php
    $sessionsNeeded    = 3;
    $approved          = $allSessions->where('status','approved')->count();
    $consecutivePassing = $approved % $sessionsNeeded;
    $progressPct       = ($consecutivePassing / $sessionsNeeded) * 100;
  @endphp
  <div class="progress-section">
    <div class="progress-header">
      <div class="progress-title">🏆 Progress to Level {{ ($user['reading_level'] ?? 1) + 1 }}</div>
      <div class="progress-pct">{{ $consecutivePassing }}/{{ $sessionsNeeded }}</div>
    </div>
    <div class="progress-track">
      <div class="progress-fill" style="width:{{ $progressPct }}%"></div>
    </div>
    <div class="progress-labels">
      <span>Level {{ $user['reading_level'] ?? 1 }}</span>
      <span>{{ $sessionsNeeded - $consecutivePassing }} more to Level Up!</span>
    </div>
    <div class="level-steps">
      @for($i = 0; $i < $sessionsNeeded; $i++)
        <div class="level-step {{ $i < $consecutivePassing ? 'done' : ($i === $consecutivePassing ? 'current' : '') }}"></div>
      @endfor
    </div>
  </div>

  {{-- MOTIVATIONAL BANNER --}}
  @if($pendingCount > 0)
  <div class="moti-banner">
    <div class="moti-emoji">💪</div>
    <div class="moti-text">
      <strong>You've got this!</strong><br>
      Tap "Read" to begin. Read aloud clearly to get a high score!
    </div>
  </div>
  @endif

  {{-- PASSAGES --}}
  <div class="passages-section">
    <div class="section-head">
      <div class="section-title">
        <div class="s-icon" style="background:#FEF3C7">🎤</div>
        Passages to Read
      </div>
      @if($pendingCount > 0)
        <span class="section-count">{{ $pendingCount }} remaining</span>
      @endif
    </div>

    @php $pendingSessions = $allSessions->where('status','pending'); @endphp
    @forelse($pendingSessions as $i => $session)
      <div class="passage-card">
        <div class="passage-card-inner">
          <div class="passage-header">
            <div class="passage-meta">
              <span class="passage-badge badge-new">New Passage</span>
              @if(isset($session['grade_level']))
                <span class="passage-badge badge-grade">Grade {{ $session['grade_level'] }}</span>
              @endif
            </div>
            <span class="passage-num">#{{ $loop->iteration }}</span>
          </div>
          <div class="passage-text">
            "{{ Str::limit($session['passage'] ?? 'No passage content.', 160) }}"
          </div>
          <div class="passage-footer">
            <div class="passage-assigned">
              📅 {{ isset($session['created_at']) ? \Carbon\Carbon::parse($session['created_at'])->diffForHumans() : 'Recently assigned' }}
            </div>
            <div class="read-btn-wrap">
              <div class="pulse-ring"></div>
              <a href="{{ route('reader', [$student['id'], $session['id']]) }}" class="read-btn">
                🎤 Read Now
              </a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="empty-state">
        <div class="empty-icon">🎉</div>
        <div class="empty-title">No pending passages!</div>
        <div class="empty-sub">You've completed all assigned passages.<br>Check back later for new ones from your teacher.</div>
      </div>
    @endforelse
  </div>

  {{-- AI STORIES --}}
  <div class="stories-section">
    <div class="section-head">
      <div class="section-title">
        <div class="s-icon" style="background:#EDE9FE">🤖</div>
        My Practice Stories
      </div>
      @if(count($stories) > 0)
        <span class="section-count">{{ count($stories) }} stories</span>
      @endif
    </div>

    @forelse(($stories ?? []) as $story)
      <div class="story-card">
        <div class="story-header">
          <span class="story-tag">🤖 AI-Generated</span>
          @if(isset($story['created_at']))
            <span class="story-date">{{ \Carbon\Carbon::parse($story['created_at'])->format('M d, Y') }}</span>
          @endif
        </div>
        <div class="story-text">{{ $story['story'] }}</div>
        {{-- FIX: handle both target_words string and target_patterns array --}}
        @php
            $storyText = is_array($story) ? ($story['story'] ?? $story['content'] ?? '') : (string)$story;
            $storyDate = is_array($story) ? ($story['created_at'] ?? null) : null;
            $storyId   = is_array($story) ? ($story['id'] ?? $loop->index) : $loop->index;
        @endphp
        @if(!empty($targetWords))
          <div class="story-words">
            @foreach($targetWords as $word)
              <span class="story-word-pill">{{ trim($word) }}</span>
            @endforeach
          </div>
        @endif
      </div>
    @empty
      <div class="empty-state">
        <div class="empty-icon">📝</div>
        <div class="empty-title">No practice stories yet</div>
        <div class="empty-sub">After reading a passage, an AI story will be generated targeting your specific error patterns.</div>
      </div>
    @endforelse
  </div>

  {{-- PAST SESSIONS --}}
  @php
    $doneSessions = $allSessions->whereNotIn('status',['pending'])->sortByDesc('updated_at')->take(6);
  @endphp
  @if($doneSessions->count() > 0)
  <div class="completed-section">
    <div class="section-head">
      <div class="section-title">
        <div class="s-icon" style="background:#D1FAE5">📊</div>
        Past Sessions
      </div>
    </div>
    @foreach($doneSessions as $session)
      @php

        $score = $session['accuracy_score'] ?? $session['score'] ?? 0;
        $ringClass = $score >= 80 ? 'score-high' : ($score >= 60 ? 'score-mid' : 'score-low');
      @endphp
      <div class="session-row">
        <div class="session-score-ring {{ $ringClass }}">
          {{ $score > 0 ? $score.'%' : '—' }}
        </div>
        <div class="session-info">
          <div class="session-passage">{{ Str::limit($session['passage'] ?? 'Session', 55) }}</div>
          <div class="session-date">{{ isset($session['updated_at']) ? \Carbon\Carbon::parse($session['updated_at'])->format('M d, Y') : '' }}</div>
        </div>
        <span class="session-status {{ ($session['status'] ?? '') === 'approved' ? 'status-approved' : 'status-completed' }}">
          {{ ($session['status'] ?? '') === 'approved' ? '✓ Approved' : '● Done' }}
        </span>
      </div>
    @endforeach
  </div>
  @endif

</div>
</body>
</html>