<style>
.reader-wrap{width:100%}
.readerly-icon{width:1em;height:1em;display:inline-block;vertical-align:-.125em;flex-shrink:0}

/* ── PASSAGE ── */
.passage-box{
  background:linear-gradient(135deg,#EFF6FF,#F0F9FF);
  border-radius:16px;padding:clamp(1rem,3vw,1.5rem);
  margin-bottom:1.25rem;border:1px solid rgba(59,130,246,.12)
}
.passage-header{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:.85rem
}
.passage-label{
  font-size:.65rem;font-weight:700;color:#1E40AF;
  text-transform:uppercase;letter-spacing:.7px;
  font-family:'DM Sans',sans-serif
}
.word-counter{
  font-size:.68rem;font-weight:700;color:#F97316;
  background:rgba(249,115,22,.1);padding:.15rem .55rem;border-radius:50px;
  font-family:'DM Sans',sans-serif
}
.passage-words{display:flex;flex-wrap:wrap;gap:8px;line-height:2.6}
.pword{
  font-family:'Baloo 2',cursive;
  font-size:clamp(1.1rem,2.5vw,1.35rem);
  font-weight:700;padding:5px 13px;border-radius:10px;
  background:#fff;color:#6B7280;
  border:1.5px solid rgba(0,0,0,.07);
  transition:all .25s;cursor:default
}
.pword.read{background:#D1FAE5;color:#065F46;border-color:rgba(6,95,70,.2)}
.pword.current{
  background:#F59E0B;color:#92400E;
  transform:scale(1.14);
  box-shadow:0 4px 16px rgba(245,158,11,.5);
  border-color:transparent
}
.pword.missed{background:#FEE2E2;color:#991B1B;border-color:rgba(220,38,38,.25)}

/* ── PROGRESS BAR ── */
.reading-progress{margin-bottom:1.25rem}
.progress-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:.35rem}
.progress-label{font-size:.72rem;font-weight:600;color:#6B7280;font-family:'DM Sans',sans-serif}
.progress-pct{font-family:'Baloo 2',cursive;font-size:.85rem;font-weight:700;color:#F97316}
.progress-track{background:#F3F4F6;border-radius:50px;height:8px;overflow:hidden}
.progress-fill{height:100%;border-radius:50px;background:linear-gradient(90deg,#FBBF24,#F97316);transition:width .5s ease}

/* ── WAVEFORM ── */
.waveform-row{
  display:flex;align-items:center;gap:.85rem;
  background:#F9FAFB;border-radius:14px;
  padding:.9rem 1.1rem;margin-bottom:1.25rem;
  border:1.5px solid #F3F4F6
}
.waveform{display:flex;align-items:center;gap:3px;height:36px;flex-shrink:0}
.wbar{width:3px;border-radius:3px;background:#F97316;transition:all .3s}
.wbar.active{animation:wave 1.2s ease-in-out infinite}
.wbar.idle{transform:scaleY(.25);opacity:.25}
.wbar:nth-child(1){height:8px;animation-delay:0s}
.wbar:nth-child(2){height:22px;animation-delay:.1s}
.wbar:nth-child(3){height:30px;animation-delay:.2s}
.wbar:nth-child(4){height:16px;animation-delay:.3s}
.wbar:nth-child(5){height:26px;animation-delay:.15s}
.wbar:nth-child(6){height:12px;animation-delay:.25s}
.wbar:nth-child(7){height:24px;animation-delay:.05s}
.wbar:nth-child(8){height:18px;animation-delay:.35s}
.wbar:nth-child(9){height:32px;animation-delay:.1s}
.wbar:nth-child(10){height:14px;animation-delay:.2s}
@keyframes wave{0%,100%{transform:scaleY(.3);opacity:.4}50%{transform:scaleY(1);opacity:1}}
.waveform-info{flex:1;min-width:0}
.waveform-main{font-size:.85rem;font-weight:600;color:#374151;font-family:'DM Sans',sans-serif;margin-bottom:.15rem}
.waveform-sub{font-size:.7rem;color:#9CA3AF;font-family:'DM Sans',sans-serif;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

/* ── CONTROLS ── */
.reader-controls{display:flex;gap:.75rem;margin-bottom:1rem;flex-wrap:wrap}
.ctrl-btn{
  flex:1;min-width:140px;
  display:inline-flex;align-items:center;justify-content:center;gap:.5rem;
  font-family:'Baloo 2',cursive;font-size:1rem;font-weight:700;
  padding:.82rem 1.5rem;border-radius:50px;cursor:pointer;
  border:none;transition:all .2s;letter-spacing:.2px
}
.ctrl-start{
  background:linear-gradient(135deg,#F97316,#FBBF24);color:#fff;
  box-shadow:0 6px 20px rgba(249,115,22,.35)
}
.ctrl-start:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(249,115,22,.45)}
.ctrl-stop{
  background:linear-gradient(135deg,#DC2626,#EF4444);color:#fff;
  box-shadow:0 6px 20px rgba(220,38,38,.3)
}
.ctrl-stop:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(220,38,38,.4)}
.ctrl-btn:disabled{opacity:.45;cursor:not-allowed;transform:none!important;box-shadow:none!important}

/* ── TRANSCRIPT ── */
.transcript-box{
  background:#F9FAFB;border-radius:12px;
  padding:.9rem 1.1rem;margin-bottom:1.25rem;
  border:1.5px solid #E5E7EB
}
.transcript-label{
  font-size:.65rem;font-weight:700;color:#9CA3AF;
  text-transform:uppercase;letter-spacing:.6px;
  margin-bottom:.4rem;font-family:'DM Sans',sans-serif
}
.transcript-text{font-size:.9rem;color:#374151;line-height:1.7;font-family:'DM Sans',sans-serif}

/* ── SCORE CARD ── */
.score-card{
  border-radius:20px;padding:2rem 1.5rem;text-align:center;
  margin-bottom:1.25rem;position:relative;overflow:hidden
}
.score-card.high{background:linear-gradient(135deg,#D1FAE5,#ECFDF5);border:2px solid rgba(5,150,105,.2)}
.score-card.mid{background:linear-gradient(135deg,#FEF3C7,#FFFBEB);border:2px solid rgba(245,158,11,.2)}
.score-card.low{background:linear-gradient(135deg,#FEE2E2,#FEF2F2);border:2px solid rgba(220,38,38,.2)}
.score-icon{
  width:58px;height:58px;border-radius:18px;margin:0 auto .85rem;
  display:flex;align-items:center;justify-content:center;font-size:2rem;
  background:rgba(255,255,255,.65);border:1.5px solid rgba(255,255,255,.8)
}
.score-circle{
  width:100px;height:100px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  margin:0 auto .75rem;
  font-family:'Baloo 2',cursive;font-size:1.9rem;font-weight:800
}
.score-card.high .score-circle{background:rgba(5,150,105,.12);color:#059669}
.score-card.mid  .score-circle{background:rgba(245,158,11,.12);color:#D97706}
.score-card.low  .score-circle{background:rgba(220,38,38,.12);color:#DC2626}
.score-label{font-size:.8rem;color:#6B7280;font-family:'DM Sans',sans-serif;margin-bottom:.5rem}
.score-message{
  font-family:'Baloo 2',cursive;font-size:1.1rem;font-weight:700;
  margin-bottom:1rem;line-height:1.4
}
.score-card.high .score-message{color:#065F46}
.score-card.mid  .score-message{color:#92400E}
.score-card.low  .score-message{color:#991B1B}
.score-divider{height:1px;background:rgba(0,0,0,.06);margin:.85rem 0}
.missed-label{font-size:.72rem;font-weight:600;color:#6B7280;margin-bottom:.5rem;font-family:'DM Sans',sans-serif}
.missed-words{display:flex;flex-wrap:wrap;gap:.4rem;justify-content:center;margin-bottom:.5rem}
.missed-word{
  font-size:.75rem;font-weight:700;padding:.22rem .65rem;border-radius:50px;
  background:rgba(220,38,38,.1);color:#991B1B;font-family:'DM Sans',sans-serif
}
.score-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-bottom:1rem}
.score-stat{background:rgba(255,255,255,.6);border-radius:12px;padding:.75rem .5rem;text-align:center}
.ss-num{font-family:'Baloo 2',cursive;font-size:1.2rem;font-weight:800;color:#374151;line-height:1}
.ss-lbl{font-size:.65rem;color:#9CA3AF;margin-top:.15rem;font-weight:500}

/* ── AI FEEDBACK ── */
.ai-feedback{
  background:linear-gradient(135deg,#EDE9FE,#F5F3FF);
  border:1.5px solid rgba(124,58,237,.2);
  border-radius:16px;padding:1.1rem 1.25rem;
  margin-bottom:1.25rem;text-align:left
}
.ai-feedback-header{
  display:flex;align-items:center;gap:.5rem;
  margin-bottom:.65rem
}
.ai-feedback-icon{
  width:28px;height:28px;border-radius:8px;
  background:rgba(124,58,237,.15);
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;flex-shrink:0
}
.ai-feedback-title{
  font-family:'Baloo 2',cursive;font-size:.88rem;
  font-weight:700;color:#5B21B6
}
.ai-feedback-text{
  font-size:.82rem;color:#4C1D95;line-height:1.7;
  font-family:'DM Sans',sans-serif;margin-bottom:.75rem
}
.practice-words{display:flex;flex-wrap:wrap;gap:.4rem}
.practice-word{
  font-size:.75rem;font-weight:700;padding:.22rem .65rem;
  border-radius:50px;background:rgba(124,58,237,.12);
  color:#5B21B6;font-family:'DM Sans',sans-serif
}

/* ── DONE ACTIONS ── */
.done-actions{display:flex;gap:.75rem;flex-wrap:wrap;justify-content:center;margin-top:1rem}
.done-btn{
  display:inline-flex;align-items:center;gap:.45rem;
  font-family:'Baloo 2',cursive;font-size:.9rem;font-weight:700;
  padding:.68rem 1.5rem;border-radius:50px;cursor:pointer;
  border:none;transition:all .2s;text-decoration:none
}
.done-btn-home{
  background:linear-gradient(135deg,#F97316,#FBBF24);color:#fff;
  box-shadow:0 4px 14px rgba(249,115,22,.3)
}
.done-btn-home:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(249,115,22,.4)}
.done-btn-retry{background:#EFF6FF;color:#1E40AF;border:1.5px solid rgba(59,130,246,.25)}
.done-btn-retry:hover{background:#1E40AF;color:#fff}

/* ── MANUAL FALLBACK ── */
.manual-entry{
  display:none;background:#fff;border:1.5px solid #E5E7EB;border-radius:16px;
  padding:1rem 1.1rem;margin-bottom:1rem
}
.manual-entry.open{display:block}
.manual-label{font-size:.72rem;font-weight:700;color:#374151;margin-bottom:.45rem;font-family:'DM Sans',sans-serif}
.manual-textarea{
  width:100%;min-height:120px;resize:vertical;border:1.5px solid #E5E7EB;
  border-radius:12px;padding:.8rem .9rem;font-family:'DM Sans',sans-serif;
  font-size:.9rem;line-height:1.6;color:#374151;outline:none
}
.manual-textarea:focus{border-color:#F97316;box-shadow:0 0 0 3px rgba(249,115,22,.12)}
.reader-alert{
  display:flex;align-items:flex-start;gap:.55rem;background:#FEF2F2;
  color:#991B1B;border:1.5px solid rgba(220,38,38,.18);
  border-radius:12px;padding:.75rem .9rem;margin-bottom:1rem;
  font-size:.82rem;line-height:1.5;font-family:'DM Sans',sans-serif
}

/* ── SUBMITTING ── */
.submitting-state{text-align:center;padding:2.5rem 1.5rem}
.submitting-spinner{
  width:52px;height:52px;border:4px solid #E5E7EB;
  border-top-color:#F97316;border-radius:50%;
  animation:spin .8s linear infinite;margin:0 auto 1.25rem
}
@keyframes spin{to{transform:rotate(360deg)}}
.submitting-title{font-family:'Baloo 2',cursive;font-size:1.1rem;font-weight:700;color:#374151;margin-bottom:.35rem}
.submitting-sub{font-size:.8rem;color:#9CA3AF;font-family:'DM Sans',sans-serif}

@media(max-width:480px){
  .pword{font-size:.98rem;padding:4px 9px}
  .score-stats{grid-template-columns:repeat(3,1fr)}
  .reader-controls{flex-direction:column}
  .ctrl-btn,.done-btn{width:100%}
  .done-actions{flex-direction:column}
  .waveform-row{align-items:flex-start}
}
</style>

<div class="reader-wrap" id="readerWrap">

  {{-- ── SCORE SCREEN ── --}}
  @if($accuracyScore !== null)
    @php
      $tier  = $accuracyScore >= 80 ? 'high' : ($accuracyScore >= 60 ? 'mid' : 'low');
      $msg   = $accuracyScore >= 80
        ? 'Excellent work! Keep it up!'
        : ($accuracyScore >= 60
          ? 'Good effort! A little more practice and you\'ll ace it.'
          : 'Don\'t give up! Every attempt makes you better.');
      $totalWords  = count(explode(' ', trim($passage)));
      $missedCount = count($errorPatterns);
      $readCount   = max(0, $totalWords - $missedCount);

      // ── SMART RULE-BASED FEEDBACK ──
      $feedbackMsg    = '';
      $practiceWords  = [];

      if ($missedCount === 0) {
          $feedbackMsg = 'Perfect reading! You read every word correctly. Try a longer or more challenging passage next time!';
      } else {
          // Analyse phonetic patterns in missed words
          $patterns = [];
          foreach ($errorPatterns as $word) {
              $w = strtolower($word);
              // Short vowel sounds
              if (preg_match('/^[bcdfghjklmnpqrstvwxyz]at$/', $w))      $patterns['short-at'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]it$/', $w))  $patterns['short-it'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]et$/', $w))  $patterns['short-et'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]ot$/', $w))  $patterns['short-ot'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]ut$/', $w))  $patterns['short-ut'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]an$/', $w))  $patterns['short-an'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]in$/', $w))  $patterns['short-in'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]ig$/', $w))  $patterns['short-ig'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]og$/', $w))  $patterns['short-og'][]  = $w;
              elseif (preg_match('/^[bcdfghjklmnpqrstvwxyz]ag$/', $w))  $patterns['short-ag'][]  = $w;
              // Blends
              elseif (preg_match('/^(th|sh|ch|wh)/', $w))               $patterns['digraph'][]   = $w;
              elseif (preg_match('/^(bl|br|cl|cr|dr|fl|fr|gl|gr|pl|pr|sl|sm|sn|sp|st|sw|tr)/', $w)) $patterns['blend'][] = $w;
              // Long words
              elseif (strlen($w) > 6)                                    $patterns['long'][]      = $w;
              // Default
              else                                                        $patterns['general'][]   = $w;
          }

          // Practice word suggestions by pattern
          $suggestions = [
              'short-at' => ['cat','bat','hat','rat','sat','fat','mat','pat'],
              'short-it' => ['bit','hit','sit','kit','lit','pit','fit','wit'],
              'short-et' => ['bet','get','jet','let','met','net','pet','set'],
              'short-ot' => ['bot','dot','got','hot','lot','not','pot','top'],
              'short-ut' => ['but','cut','gut','hut','nut','put','rut','tub'],
              'short-an' => ['ban','can','fan','man','pan','ran','tan','van'],
              'short-in' => ['bin','din','fin','kin','pin','sin','tin','win'],
              'short-ig' => ['big','dig','fig','jig','pig','rig','wig','zig'],
              'short-og' => ['bog','cog','dog','fog','hog','jog','log','tog'],
              'short-ag' => ['bag','gag','lag','nag','rag','sag','tag','wag'],
              'digraph'  => ['the','that','this','them','then','shop','chip','when'],
              'blend'    => ['blue','flag','frog','plan','stop','swim','tree','drip'],
              'long'     => [],
              'general'  => [],
          ];

          // Find dominant pattern
          $dominantPattern = null;
          $maxCount = 0;
          foreach ($patterns as $key => $words) {
              if (count($words) > $maxCount) {
                  $maxCount        = count($words);
                  $dominantPattern = $key;
              }
          }

          if ($dominantPattern === 'digraph') {
              $feedbackMsg   = 'You had trouble with digraphs — letter pairs like "th", "sh", "ch", and "wh" that make a single sound. Practice saying these slowly before reading them in sentences.';
              $practiceWords = $suggestions['digraph'];
          } elseif ($dominantPattern === 'blend') {
              $feedbackMsg   = 'You struggled with consonant blends at the start of words. Try sounding out each letter separately first, then blend them together smoothly.';
              $practiceWords = $suggestions['blend'];
          } elseif ($dominantPattern === 'long') {
              $feedbackMsg   = 'You had difficulty with longer words. Try breaking them into syllables — read one part at a time, then put them together.';
              $practiceWords = array_slice($errorPatterns, 0, 6);
          } elseif (str_starts_with($dominantPattern ?? '', 'short-')) {
              $ending = substr($dominantPattern, 6);
              $feedbackMsg   = "You struggled with words ending in \"-{$ending}\". These words all share the same sound. Practice the list below to build confidence!";
              $practiceWords = array_slice($suggestions[$dominantPattern] ?? [], 0, 6);
          } else {
              // Generic feedback based on score
              if ($missedCount === 1) {
                  $feedbackMsg = "You missed just 1 word — great job! Focus on \"" . ($errorPatterns[0] ?? '') . "\" and try reading it in a sentence.";
              } elseif ($missedCount <= 3) {
                  $feedbackMsg = "You missed " . $missedCount . " words. Review each missed word carefully, sound it out slowly, then try reading the full passage again.";
              } else {
                  $feedbackMsg = "You missed several words in this passage. Try reading it again slowly, one word at a time. It\'s okay to pause and sound out difficult words!";
              }
              $practiceWords = array_slice($errorPatterns, 0, 6);
          }
      }
    @endphp

    <div class="score-card {{ $tier }}">
      <div class="score-icon">
        @if($tier === 'high')
          <x-icon name="trophy" />
        @elseif($tier === 'mid')
          <x-icon name="zap" />
        @else
          <x-icon name="book-open" />
        @endif
      </div>
      <div class="score-circle">{{ $accuracyScore }}%</div>
      <div class="score-label">Reading Accuracy</div>
      <div class="score-message">{{ $msg }}</div>

      <div class="score-stats">
        <div class="score-stat">
          <div class="ss-num">{{ $totalWords }}</div>
          <div class="ss-lbl">Total Words</div>
        </div>
        <div class="score-stat">
          <div class="ss-num" style="color:#059669">{{ $readCount }}</div>
          <div class="ss-lbl">Read Correctly</div>
        </div>
        <div class="score-stat">
          <div class="ss-num" style="color:#DC2626">{{ $missedCount }}</div>
          <div class="ss-lbl">Missed</div>
        </div>
      </div>

      @if($missedCount > 0)
        <div class="score-divider"></div>
        <div class="missed-label">Words that need practice:</div>
        <div class="missed-words">
          @foreach(array_slice($errorPatterns, 0, 10) as $word)
            <span class="missed-word">{{ $word }}</span>
          @endforeach
        </div>
      @endif
    </div>

    {{-- AI FEEDBACK PANEL --}}
    @if($feedbackMsg)
      <div class="ai-feedback">
        <div class="ai-feedback-header">
          <div class="ai-feedback-icon"><x-icon name="sparkles" /></div>
          <div class="ai-feedback-title">Reading Coach Feedback</div>
        </div>
        <div class="ai-feedback-text">{{ $feedbackMsg }}</div>
        @if(count($practiceWords) > 0)
          <div style="font-size:.7rem;font-weight:600;color:#5B21B6;margin-bottom:.4rem;font-family:'DM Sans',sans-serif">
            Try practicing these words:
          </div>
          <div class="practice-words">
            @foreach($practiceWords as $pw)
              <span class="practice-word">{{ $pw }}</span>
            @endforeach
          </div>
        @endif
      </div>
    @endif

    @if($transcript)
      <div class="transcript-box">
        <div class="transcript-label">What the system heard</div>
        <div class="transcript-text">{{ $transcript }}</div>
      </div>
    @endif

    <div class="done-actions">
      <a href="{{ route('student.dashboard') }}" class="done-btn done-btn-home">
        <x-icon name="home" /> Back to Dashboard
      </a>
      <button onclick="window.location.reload()" class="done-btn done-btn-retry">
        <x-icon name="mic" /> Try Again
      </button>
    </div>

  {{-- ── SUBMITTING ── --}}
  @elseif($status === 'submitting')
    <div class="submitting-state">
      <div class="submitting-spinner"></div>
      <div class="submitting-title">Analyzing your reading...</div>
      <div class="submitting-sub">Please keep this page open. This will only take a moment.</div>
    </div>

  {{-- ── READING SCREEN ── --}}
  @else
    @if($submitError)
      <div class="reader-alert">
        <x-icon name="alert-triangle" />
        <span>{{ $submitError }}</span>
      </div>
    @endif

    <div class="passage-box">
      <div class="passage-header">
        <span class="passage-label">Read this passage</span>
        <span class="word-counter" id="wordCounter">
          0 / {{ count(explode(' ', trim($passage))) }} words
        </span>
      </div>
      <div class="passage-words" id="passageWords">
        @foreach(explode(' ', trim($passage)) as $index => $word)
          <span class="pword" id="pword-{{ $index }}"
            data-word="{{ strtolower(preg_replace('/[^a-zA-Z0-9\x{00C0}-\x{024F}]/u', '', $word)) }}">
            {{ $word }}
          </span>
        @endforeach
      </div>
    </div>

    <div class="reading-progress">
      <div class="progress-row">
        <span class="progress-label">Progress</span>
        <span class="progress-pct" id="progressPct">0%</span>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="progressFill" style="width:0%"></div>
      </div>
    </div>

    <div class="waveform-row">
      <div class="waveform" id="waveform">
        @for($i = 0; $i < 10; $i++)
          <div class="wbar idle" id="wbar{{ $i }}"></div>
        @endfor
      </div>
      <div class="waveform-info">
        <div class="waveform-main" id="statusMain">Tap "Start Reading" to begin</div>
        <div class="waveform-sub" id="statusSub">Read each word clearly and at a steady pace</div>
      </div>
    </div>

    <div class="manual-entry" id="manualEntry">
      <div class="manual-label">Manual fallback</div>
      <textarea id="manualTranscript" class="manual-textarea" placeholder="If your microphone is unavailable, type the words you read here, then submit."></textarea>
    </div>

    <div class="reader-controls">
      <button class="ctrl-btn ctrl-start" id="startBtn" onclick="startListening()">
        <x-icon name="mic" /> Start Reading
      </button>
      <button class="ctrl-btn ctrl-stop" id="stopBtn" onclick="stopListening()" style="display:none">
        <x-icon name="check" /> Stop &amp; Submit
      </button>
      <button class="ctrl-btn done-btn-retry" id="manualBtn" onclick="submitManualReading()" style="display:none">
        <x-icon name="clipboard" /> Submit Typed Reading
      </button>
    </div>
  @endif

</div>

<script>
let recognition;
let finalTranscript = '';
let wordEls = [];
let passageClean = [];

document.addEventListener('DOMContentLoaded', () => {
  wordEls      = Array.from(document.querySelectorAll('.pword'));
  passageClean = wordEls.map(el => el.dataset.word);
});

function startListening() {
  if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
    showManualMode('Speech recognition is not available in this browser. You can still type what you read and submit it.');
    return;
  }
  const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
  recognition = new SR();
  recognition.lang = 'en-US';
  recognition.continuous = true;
  recognition.interimResults = true;
  finalTranscript = '';

  recognition.onstart = () => {
    document.getElementById('startBtn').style.display = 'none';
    document.getElementById('stopBtn').style.display  = '';
    document.getElementById('manualBtn').style.display = 'none';
    document.getElementById('statusMain').textContent = 'Listening';
    document.getElementById('statusSub').textContent  = 'Speak clearly and read every word';
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
    document.getElementById('statusSub').textContent = interim || 'Listening for your next words...';
    highlightWords(finalTranscript + interim);
  };

  recognition.onerror = (event) => {
    document.getElementById('statusMain').textContent = 'Microphone error: ' + event.error;
    document.getElementById('statusSub').textContent = 'Use the typed fallback below, then submit.';
    showManualMode();
    resetButtons();
  };

  recognition.onend = () => {
    if (document.getElementById('stopBtn') &&
        document.getElementById('stopBtn').style.display !== 'none') {
      try { recognition.start(); } catch(e) {}
    }
  };

  recognition.start();
}

function stopListening() {
  if (recognition) {
    recognition.onend = null;
    recognition.stop();
  }
  resetButtons();
  if (!finalTranscript.trim()) {
    showManualMode('I could not hear any words. Type what you read below, then submit.');
    return;
  }
  document.getElementById('statusMain').textContent = 'Done. Submitting...';
  document.getElementById('statusSub').textContent  = 'Please wait...';
  document.querySelectorAll('.wbar').forEach(b => {
    b.classList.remove('active');
    b.classList.add('idle');
  });
  highlightFinal(finalTranscript.trim());
  @this.submitReading(finalTranscript.trim());
}

function resetButtons() {
  const start = document.getElementById('startBtn');
  const stop  = document.getElementById('stopBtn');
  if (start) start.style.display = '';
  if (stop)  stop.style.display  = 'none';
}

function showManualMode(message) {
  const manualEntry = document.getElementById('manualEntry');
  const manualBtn = document.getElementById('manualBtn');
  const statusMain = document.getElementById('statusMain');
  const statusSub = document.getElementById('statusSub');
  if (manualEntry) manualEntry.classList.add('open');
  if (manualBtn) manualBtn.style.display = '';
  if (statusMain) statusMain.textContent = 'Typed reading mode';
  if (statusSub && message) statusSub.textContent = message;
}

function submitManualReading() {
  const textarea = document.getElementById('manualTranscript');
  const typed = (textarea?.value || '').trim();
  if (!typed) {
    if (textarea) textarea.focus();
    const statusSub = document.getElementById('statusSub');
    if (statusSub) statusSub.textContent = 'Type the words you read before submitting.';
    return;
  }
  finalTranscript = typed;
  highlightWords(typed);
  highlightFinal(typed);
  document.getElementById('statusMain').textContent = 'Done. Submitting...';
  document.getElementById('statusSub').textContent = 'Please wait...';
  document.getElementById('startBtn').disabled = true;
  document.getElementById('manualBtn').disabled = true;
  @this.submitReading(typed);
}

function highlightWords(spokenText) {
  const spoken = spokenText.toLowerCase()
    .split(/\s+/)
    .map(w => w.replace(/[^a-z0-9\u00C0-\u024F]/gi, ''))
    .filter(Boolean);

  let lastRead = -1;
  wordEls.forEach((el, i) => {
    if (spoken.includes(passageClean[i])) {
      el.classList.add('read');
      el.classList.remove('current', 'missed');
      lastRead = i;
    }
  });

  wordEls.forEach((el, i) => {
    if (i === lastRead + 1 && !el.classList.contains('read')) {
      el.classList.add('current');
    } else if (!el.classList.contains('read')) {
      el.classList.remove('current');
    }
  });

  const readNow = wordEls.filter(el => el.classList.contains('read')).length;
  const total   = wordEls.length;
  const pct     = total > 0 ? Math.round((readNow / total) * 100) : 0;

  const counter = document.getElementById('wordCounter');
  if (counter) counter.textContent = readNow + ' / ' + total + ' words';

  const fill = document.getElementById('progressFill');
  if (fill) fill.style.width = pct + '%';

  const pctEl = document.getElementById('progressPct');
  if (pctEl) pctEl.textContent = pct + '%';
}

function highlightFinal(spokenText) {
  const spoken = spokenText.toLowerCase()
    .split(/\s+/)
    .map(w => w.replace(/[^a-z0-9\u00C0-\u024F]/gi, ''))
    .filter(Boolean);

  wordEls.forEach((el, i) => {
    if (!spoken.includes(passageClean[i])) {
      el.classList.add('missed');
      el.classList.remove('read', 'current');
    }
  });
}

document.addEventListener('livewire:initialized', () => {
  @this.on('reading-submitted', () => {});
});
</script>
