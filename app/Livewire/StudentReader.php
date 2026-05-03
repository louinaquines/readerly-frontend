<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class StudentReader extends Component
{
    public int    $sessionId;
    public int    $studentId;
    public string $passage      = '';
    public string $transcript   = '';
    public array  $errorPatterns = [];
    public mixed $accuracyScore = null;
    public string $status        = 'idle'; // idle | submitting | done

    public function mount(int $sessionId, int $studentId, string $passage): void
    {
        $this->sessionId = $sessionId;
        $this->studentId = $studentId;
        $this->passage   = $passage;
    }

    public function submitReading(string $transcript): void
    {
        $this->status        = 'submitting';
        $this->transcript    = $transcript;
        $this->errorPatterns = $this->detectErrors($transcript);

        $token = session('api_token');

        if (!$token) {
            $this->status = 'idle';
            return;
        }

        $response = Http::withToken($token)
            ->post(
                config('services.api.base_url')
                . "/api/students/{$this->studentId}/sessions/{$this->sessionId}/submit",
                [
                    'transcript'     => $this->transcript,
                    'error_patterns' => array_values($this->errorPatterns),
                ]
            );

        $data = $response->json();

        $this->accuracyScore = isset($data['accuracy_score'])
            ? (int) $data['accuracy_score']
            : (isset($data['score'])
                ? (int) $data['score']
                : $this->calculateLocalScore($this->errorPatterns));

        $this->status = 'done';
    }

    /**
     * Fallback score calculation if the API doesn't return one.
     * Percentage of passage words that were read correctly.
     */
    private function calculateLocalScore(array $errors): int
    {
        $passageWords = preg_split('/\s+/', strtolower(trim($this->passage)));
        $total        = count(array_filter($passageWords));

        if ($total === 0) return 0;

        $missed  = count($errors);
        $correct = max(0, $total - $missed);

        return (int) round(($correct / $total) * 100);
    }

    private function detectErrors(string $transcript): array
    {
        $passageWords    = preg_split('/\s+/', strtolower(trim($this->passage)));
        $transcriptWords = preg_split('/\s+/', strtolower(trim($transcript)));

        $cleanTranscript = array_map(
            fn($w) => preg_replace('/[^a-z0-9\x{00C0}-\x{024F}]/u', '', $w),
            $transcriptWords
        );

        $errors = [];
        foreach ($passageWords as $word) {
            $clean = preg_replace('/[^a-z0-9\x{00C0}-\x{024F}]/u', '', $word);
            if ($clean && !in_array($clean, $cleanTranscript)) {
                $errors[] = $clean;
            }
        }

        return array_values(array_unique($errors));
    }

    public function render()
    {
        return view('livewire.student-reader');
    }
}