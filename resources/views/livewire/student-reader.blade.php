<div class="max-w-2xl mx-auto p-6">
    {{-- Passage Display --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Basahin ang sumusunod:</h2>
        <div id="passage-display" class="text-2xl leading-relaxed text-gray-800 font-medium">
            @foreach(explode(' ', $passage) as $index => $word)
                <span
                    id="word-{{ $index }}"
                    class="passage-word transition-colors duration-200 px-1 rounded"
                >{{ $word }}</span>
            @endforeach
        </div>
    </div>

    {{-- Controls --}}
    <div class="flex gap-4 mb-6">
        <button
            id="startBtn"
            onclick="startListening()"
            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition"
        >
            🎤 Simulan ang Pagbabasa
        </button>
        <button
            id="stopBtn"
            onclick="stopListening()"
            class="flex-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition hidden"
        >
            ⏹ Itigil
        </button>
    </div>

    {{-- Status --}}
    <div id="statusText" class="text-center text-gray-500 mb-4"></div>

    {{-- Transcript --}}
    @if($transcript)
        <div class="bg-gray-50 rounded-xl p-4 mb-4">
            <p class="text-sm text-gray-500 mb-1">Narinig:</p>
            <p class="text-gray-800">{{ $transcript }}</p>
        </div>
    @endif

    {{-- Results --}}
    @if($accuracyScore !== null)
        <div class="rounded-xl p-6 text-center {{ $accuracyScore >= 80 ? 'bg-green-100' : ($accuracyScore >= 60 ? 'bg-yellow-100' : 'bg-red-100') }}">
            <p class="text-4xl font-bold mb-2">{{ $accuracyScore }}%</p>
            <p class="text-gray-600">Katumpakan</p>
            @if(count($errorPatterns) > 0)
                <p class="mt-3 text-sm text-gray-500">
                    Mga salitang napalaktaw: <strong>{{ implode(', ', $errorPatterns) }}</strong>
                </p>
            @endif
        </div>
    @endif
</div>

<script>
    let recognition;
    let finalTranscript = '';

    function startListening() {
        if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
            alert('Ang iyong browser ay hindi sumusuporta sa speech recognition. Gumamit ng Chrome.');
            return;
        }

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.lang = 'fil-PH';
        recognition.continuous = true;
        recognition.interimResults = true;

        finalTranscript = '';

        recognition.onstart = () => {
            document.getElementById('startBtn').classList.add('hidden');
            document.getElementById('stopBtn').classList.remove('hidden');
            document.getElementById('statusText').textContent = '🔴 Nakikinig...';
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
            document.getElementById('statusText').textContent = '🔴 Nakikinig: ' + interim;
            highlightWords(finalTranscript + interim);
        };

        recognition.onerror = (event) => {
            document.getElementById('statusText').textContent = 'Error: ' + event.error;
        };

        recognition.start();
    }

    function stopListening() {
        if (recognition) {
            recognition.stop();
            document.getElementById('startBtn').classList.remove('hidden');
            document.getElementById('stopBtn').classList.add('hidden');
            document.getElementById('statusText').textContent = '✅ Tapos na. Isinusumite...';
            @this.submitReading(finalTranscript.trim());
        }
    }

    function highlightWords(spokenText) {
        const passageWords = document.querySelectorAll('.passage-word');
        const spokenWords  = spokenText.toLowerCase().split(/\s+/);

        passageWords.forEach((el, index) => {
            const word = el.textContent.toLowerCase().replace(/[^a-z0-9]/g, '');
            if (spokenWords.includes(word)) {
                el.classList.add('bg-green-200');
                el.classList.remove('bg-red-200');
            }
        });
    }
</script>