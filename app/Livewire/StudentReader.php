<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class StudentReader extends Component
{
    public int $sessionId;
    public int $studentId;
    public string $passage = '';
    public string $transcript = '';
    public array $errorPatterns = [];
    public ?int $accuracyScore = null;
    public string $status = 'idle'; // idle, listening, done

    public function mount(int $sessionId, int $studentId, string $passage)
    {
        $this->sessionId = $sessionId;
        $this->studentId = $studentId;
        $this->passage   = $passage;
    }

    public function submitReading(string $transcript)
    {
        $this->transcript    = $transcript;
        $this->errorPatterns = $this->detectErrors($transcript);
        $this->status        = 'done';

        $token = session('api_token');

        $response = Http::withToken($token)
            ->post(config('services.api.base_url') . "/api/students/{$this->studentId}/sessions/{$this->sessionId}/submit", [
                'transcript'     => $this->transcript,
                'error_patterns' => $this->errorPatterns,
            ]);

        $this->accuracyScore = $response->json('accuracy_score');
    }

    private function detectErrors(string $transcript): array
    {
        $passageWords    = preg_split('/\s+/', strtolower(trim($this->passage)));
        $transcriptWords = preg_split('/\s+/', strtolower(trim($transcript)));
        $errors          = [];

        foreach ($passageWords as $word) {
            $clean = preg_replace('/[^a-z0-9\x{00C0}-\x{024F}]/u', '', $word);
            if ($clean && !in_array($clean, array_map(fn($w) => preg_replace('/[^a-z0-9\x{00C0}-\x{024F}]/u', '', $w), $transcriptWords))) {
                $errors[] = $clean;
            }
        }

        return array_unique($errors);
    }

    public function render()
    {
        return view('livewire.student-reader');
    }
}