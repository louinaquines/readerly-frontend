<style>
.reader-wrap{width:100%}

/* ── PASSAGE ── */
.passage-box{
  background:linear-gradient(135deg,#EFF6FF,#F0F9FF);
  border-radius:16px;padding:clamp(1.1rem,3vw,1.5rem);
  margin-bottom:1.25rem;border:1px solid rgba(59,130,246,.1)
}
.passage-box-label{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:.85rem
}
.passage-box-label-text{
  font-size:.68rem;font-weight:700;color:#1E40AF;
  text-transform:uppercase;letter-spacing:.6px;
  font-family:'DM Sans',sans-serif
}
.word-counter{
  font-size:.7rem;font-weight:700;color:#F97316;
  background:rgba(249,115,22,.1);padding:.15rem .5rem;border-radius:50px;
  font-family:'DM Sans',sans-serif
}
.passage-words{display:flex;flex-wrap:wrap;gap:7px;line-height:2.4}
.pword{
  font-family:'Baloo 2',cursive;
  font-size:clamp(1.05rem,2.5vw,1.3rem);
  font-weight:700;padding:4px 11px;border-radius:8px;
  background:#fff;color:#6B7280;
  border:1.5px solid rgba(0,0,0,.06);
  transition:all .3s
}
.pword.read   {background:#D1FAE5;color:#065F46;border-color:rgba(6,95,70,.15)}
.pword.current{background:#F59E0B;color:#92400E;transform:scale(1.12);box-shadow:0 4px 14px rgba(245,158,11,.45);border-color:transparent}
.pword.missed {background:#FEE2E2;color:#991B1B;border-color:rgba(220,38,38,.2)}

/* ── WAVEFORM ── */
.waveform-row{
  display:flex;align-items:center;gap:.75rem;
  background:#F9FAFB;border-radius:12px;
  padding:.85rem 1rem;margin-bottom:1.25rem
}
.waveform{display:flex;align-items:center;gap:3px;height:32px}
.wbar{width:3px;border-radius:3px;background:#F97316}
.wbar.active{animation:wave 1.2s ease-in-out infinite}
.wbar.idle{transform:scaleY(.3);opacity:.3;transition:all .3s}
.wbar:nth-child(1){height:8px;animation-delay:0s}
.wbar:nth-child(2){height:20px;animation-delay:.1s}
.wbar:nth-child(3){height:28px;animation-delay:.2s}
.wbar:nth-child(4){height:16px;animation-delay:.3s}
.wbar:nth-child(5){height:24px;animation-delay:.15s}
.wbar:nth-child(6){height:12px;animation-delay:.25s}
.wbar:nth-child(7){height:22px;animation-delay:.05s}
.wbar:nth-child(8){height:18px;animation-delay:.35s}
.wbar:nth-child(9){height:30px;animation-delay:.1s}
.wbar:nth-child(10){height:14px;animation-delay:.2s}
@keyframes wave{0%,100%{transform:scaleY(.35);opacity:.5}50%{transform:scaleY(1);opacity:1}}
.waveform-status-text{font-size:.85rem;font-weight:600;color:#374151;font-family:'DM Sans',sans-serif}
.waveform-status-sub{font-size:.72rem;color:#9CA3AF;font-family:'DM Sans',sans-serif;margin-top:.1rem}

/* ── CONTROLS ── */
.reader-controls{display:flex;gap:.85rem;margin-bottom:1.25rem;flex-wrap:wrap}
.ctrl-btn{
  flex:1;min-width:140px;
  display:inline-flex;align-items:center;justify-content:center;gap:.5rem;
  font-family:'Baloo 2',cursive;font-size:1rem;font-weight:700;
  padding:.8rem 1.5rem;border-radius:50px;cursor:pointer;
  border:none;transition:all .2s
}
.ctrl-start{
  background:linear-gradient(135deg,#F97316,#F59E0B);color:#fff;
  box-shadow:0 6px 20px rgba(249,115,22,.35)
}
.ctrl-start:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(249,115,22,.45)}
.ctrl-stop{
  background:linear-gradient(135deg,#DC2626,#EF4444);color:#fff;
  box-shadow:0 6px 20px rgba(220,38,38,.3)
}
.ctrl-stop:hover{transform:translateY(-2px)}
.ctrl-btn:disabled{opacity:.5;cursor:not-allowed;transform:none !important;box-shadow:none !important}

/* ── TRANSCRIPT ── */
.transcript-box{
  background:#F9FAFB;border-radius:12px;
  padding:1rem 1.1rem;margin-bottom:1.25rem;
  border:1.5px solid #E5E7EB
}
.transcript-label{font-size:.7rem;font-weight:700;color:#9CA3AF;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.4rem;font-family:'DM Sans',sans-serif}
.transcript-text{font-size:.92rem;color:#374151;line-height:1.7;font-family:'DM Sans',sans-serif}

/* ── SCORE CARD ── */
.score-card{
  border-radius:20px;padding:2rem;text-align:center;
  margin-bottom:1.25rem;position:relative;overflow:hidden
}
.score-card.high{background:linear-gradient(135deg,#D1FAE5,#ECFDF5);border:2px solid rgba(5,150,105,.2)}
.score-card.mid {background:linear-gradient(135deg,#FEF3C7,#FFFBEB);border:2px solid rgba(245,158,11,.2)}
.score-card.low {background:linear-gradient(135deg,#FEE2E2,#FEF2F2);border:2px solid rgba(220,38,38,.2)}
.score-emoji{font-size:2.5rem;margin-bottom:.5rem}
.score-num{font-family:'Baloo 2',cursive;font-size:3.5rem;font-weight:800;line-height:1;margin-bottom:.25rem}
.score-card.high .score-num{color:#059669}
.score-card.mid  .score-num{color:#D97706}
.score-card.low  .score-num{color:#DC2626}
.score-label{font-size:.88rem;color:#6B7280;font-family:'DM Sans',sans-serif;margin-bottom:.85rem}
.score-message{font-family:'Baloo 2',cursive;font-size:1.05rem;font-weight:700;margin-bottom:.85rem}
.score-card.high .score-message{color:#065F46}
.score-card.mid  .score-message{color:#92400E}
.score-card.low  .score-message{color:#991B1B}
.missed-words{display:flex;flex-wrap:wrap;gap:.4rem;justify-content:center;margin-bottom:1rem}
.missed-word{font-size:.75rem;font-weight:700;padding:.22rem .65rem;border-radius:50px;background:rgba(220,38,38,.12);color:#991B1B;font-family:'DM Sans',sans-serif}

/* ── DONE ACTIONS ── */
.done-actions{display:flex;gap:.75rem;flex-wrap:wrap;justify-content:center;margin-top:1rem}
.done-btn{
  display:inline-flex;align-items:center;gap:.45rem;
  font-family:'Baloo 2',cursive;font-size:.9rem;font-weight:700;
  padding:.65rem 1.4rem;border-radius:50px;cursor:pointer;
  border:none;transition:all .2s;text-decoration:none
}
.done-btn-home{background:linear-gradient(135deg,#F97316,#F59E0B);color:#fff;box-shadow:0 4px 14px rgba(249,115,22,.3)}
.done-btn-home:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(249,115,22,.4)}
.done-btn-retry{background:#EFF6FF;color:#1E40AF;border:1.5px solid rgba(59,130,246,.25)}
.done-btn-retry:hover{background:#1E40AF;color:#fff}

/* ── LOADING ── */
.submitting-state{text-align:center;padding:2rem}
.submitting-spinner{width:48px;height:48px;border:4px solid #E5E7EB;border-top-color:#F97316;border-radius:50%;animation:spin .8s linear infinite;margin:0 auto 1rem}
@keyframes spin{to{transform:rotate(360deg)}}
.submitting-text{font-family:'Baloo 2',cursive;font-size:1rem;font-weight:700;color:#374151}
.submitting-sub{font-size:.8rem;color:#9CA3AF;margin-top:.3rem;font-family:'DM Sans',sans-serif}
</style>

<div class="reader-wrap" id="readerWrap">

  {{-- ── DONE / SCORE SCREEN ── --}}
  @if($accuracyScore !== null)
    @php
      $tier = $accuracyScore >= 80 ? 'high' : ($accuracyScore >= 60 ? 'mid' : 'low');
      $emoji = $accuracyScore >= 80 ? '🎉' : ($accuracyScore >= 60 ? '💪' : '📖');
      $msg = $accuracyScore >= 80
        ? 'Napakagaling mo! Patuloy lang!'
        : ($accuracyScore >= 60 ? 'Magaling! Kailangan lang ng konting practice pa.' : 'Huwag sumuko! Subukan ulit.');
    @endphp

    <div class="score-card {{ $tier }}">
      <div class="score-emoji">{{ $emoji }}</div>
      <div class="score-num">{{ $accuracyScore }}%</div>
      <div class="score-label">Katumpakan ng Pagbabasa</div>
      <div class="score-message">{{ $msg }}</div>

      @if(count($errorPatterns) > 0)
        <div style="font-size:.75rem;color:#6B7280;margin-bottom:.5rem;font-family:'DM Sans',sans-serif">
          Mga salitang napalaktaw:
        </div>
        <div class="missed-words">
          @foreach(array_slice($errorPatterns, 0, 10) as $word)
            <span class="missed-word">{{ $word }}</span>
          @endforeach
        </div>
      @endif
    </div>

    @if($transcript)
      <div class="transcript-box">
        <div class="transcript-label">Narinig ng system</div>
        <div class="transcript-text">{{ $transcript }}</div>
      </div>
    @endif

    <div class="done-actions">
      <a href="{{ route('student.dashboard') }}" class="done-btn done-btn-home">
        🏠 Bumalik sa Dashboard
      </a>
      <button onclick="retryReading()" class="done-btn done-btn-retry">
        🔄 Subukan Ulit
      </button>
    </div>

  {{-- ── SUBMITTING SCREEN ── --}}
  @elseif($status === 'submitting')
    <div class="submitting-state">
      <div class="submitting-spinner"></div>
      <div class="submitting-text">Sinusuri ang iyong pagbabasa…</div>
      <div class="submitting-sub">Huwag isara ang page na ito.</div>
    </div>

  {{-- ── READING SCREEN ── --}}
  @else
    {{-- Passage display --}}
    <div class="passage-box">
      <div class="passage-box-label">
        <span class="passage-box-label-text">Basahin ang passage</span>
        <span class="word-counter" id="wordCounter">
          0 / {{ count(explode(' ', trim($passage))) }} salita
        </span>
      </div>
      <div class="passage-words" id="passageWords">
        @foreach(explode(' ', trim($passage)) as $index => $word)
          <span class="pword" id="pword-{{ $index }}" data-word="{{ strtolower(preg_replace('/[^a-zA-Z0-9\x{00C0}-\x{024F}]/u', '', $word)) }}">{{ $word }}</span>
        @endforeach
      </div>
    </div>

    {{-- Waveform / status --}}
    <div class="waveform-row">
      <div class="waveform" id="waveform">
        @for($i = 0; $i < 10; $i++)
          <div class="wbar idle" id="wbar{{ $i }}"></div>
        @endfor
      </div>
      <div>
        <div class="waveform-status-text" id="statusMain">I-tap ang "Simulan" para magsimula</div>
        <div class="waveform-status-sub" id="statusSub">Basahin nang malakas at malinaw</div>
      </div>
    </div>

    {{-- Controls --}}
    <div class="reader-controls">
      <button class="ctrl-btn ctrl-start" id="startBtn" onclick="startListening()">
        🎤 Simulan ang Pagbabasa
      </button>
      <button class="ctrl-btn ctrl-stop" id="stopBtn" onclick="stopListening()" style="display:none">
        ⏹ Itigil at I-submit
      </button>
    </div>
  @endif

</div>

<script>
let recognition;
let finalTranscript = '';
let wordEls = [];
let passageClean = [];
let readCount = 0;

document.addEventListener('DOMContentLoaded', () => {
  wordEls    = Array.from(document.querySelectorAll('.pword'));
  passageClean = wordEls.map(el => el.dataset.word);
});

function startListening() {
  if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
    alert('Ang iyong browser ay hindi sumusuporta sa speech recognition. Gumamit ng Chrome.');
    return;
  }

  const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
  recognition = new SR();
  recognition.lang = 'fil-PH';
  recognition.continuous = true;
  recognition.interimResults = true;

  finalTranscript = '';
  readCount = 0;

  recognition.onstart = () => {
    document.getElementById('startBtn').style.display = 'none';
    document.getElementById('stopBtn').style.display  = '';
    document.getElementById('statusMain').textContent = '🔴 Nakikinig…';
    document.getElementById('statusSub').textContent  = 'Basahin nang malakas at malinaw';
    // Activate waveform
    document.querySelectorAll('.wbar').forEach(b => {
      b.classList.remove('idle');
      b.classList.add('active');
    });
  };

  recognition.onresult = (event) => {
    let interim = '';
    for (let i = event.resultIndex; i < event.results.length; i++) {
      if (event.results[i].isFinal) {
        finalTranscript += event.results[i][0].transcript + ' ';
      } else {
        interim += event.results[i][0].transcript;
      }
    }
    const fullText = finalTranscript + interim;
    document.getElementById('statusSub').textContent = interim || '…';
    highlightWords(fullText);
  };

  recognition.onerror = (event) => {
    document.getElementById('statusMain').textContent = 'Error: ' + event.error;
    resetButtons();
  };

  recognition.onend = () => {
    // Auto-restart if still in listening state (browser cuts off after silence)
    if (document.getElementById('stopBtn').style.display !== 'none') {
      try { recognition.start(); } catch(e) {}
    }
  };

  recognition.start();
}

function stopListening() {
  if (recognition) {
    recognition.onend = null; // prevent auto-restart
    recognition.stop();
  }
  resetButtons();
  document.getElementById('statusMain').textContent = '✅ Tapos na. Isinusumite…';
  document.getElementById('statusSub').textContent  = 'Sandali lang…';
  document.querySelectorAll('.wbar').forEach(b => {
    b.classList.remove('active');
    b.classList.add('idle');
  });
  // Mark missed words red before submitting
  highlightFinal(finalTranscript.trim());
  // Submit via Livewire
  @this.submitReading(finalTranscript.trim());
}

function resetButtons() {
  const start = document.getElementById('startBtn');
  const stop  = document.getElementById('stopBtn');
  if (start) start.style.display = '';
  if (stop)  stop.style.display  = 'none';
}

function highlightWords(spokenText) {
  const spoken = spokenText.toLowerCase()
    .split(/\s+/)
    .map(w => w.replace(/[^a-z0-9\u00C0-\u024F]/gi, ''));

  let lastRead = -1;
  wordEls.forEach((el, i) => {
    const w = passageClean[i];
    if (spoken.includes(w)) {
      el.classList.add('read');
      el.classList.remove('current', 'missed');
      lastRead = i;
    }
  });

  // Highlight next unread word as "current"
  wordEls.forEach((el, i) => {
    if (i === lastRead + 1 && !el.classList.contains('read')) {
      el.classList.add('current');
    } else if (!el.classList.contains('read')) {
      el.classList.remove('current');
    }
  });

  // Update word counter
  const readNow = wordEls.filter(el => el.classList.contains('read')).length;
  const counter = document.getElementById('wordCounter');
  if (counter) counter.textContent = readNow + ' / ' + wordEls.length + ' salita';
}

function highlightFinal(spokenText) {
  const spoken = spokenText.toLowerCase()
    .split(/\s+/)
    .map(w => w.replace(/[^a-z0-9\u00C0-\u024F]/gi, ''));

  wordEls.forEach((el) => {
    const w = passageClean[wordEls.indexOf(el)];
    if (!spoken.includes(w)) {
      el.classList.add('missed');
      el.classList.remove('read', 'current');
    }
  });
}

function retryReading() {
  // Reset Livewire state and reload
  window.location.reload();
}

// Listen for Livewire status updates
document.addEventListener('livewire:initialized', () => {
  @this.on('reading-submitted', () => {
    // Livewire will re-render with score automatically
  });
});
</script>