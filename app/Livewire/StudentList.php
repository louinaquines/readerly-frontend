<?php

namespace App\Livewire;

use App\Services\ApiService;
use Livewire\Component;

class StudentList extends Component
{
    public int $classId;
    public array $students = [];
    public string $name = '';
    public string $grade = '';
    public bool $showForm = false;
    public string $error = '';
    public string $passage = '';

    public function mount(int $classId)
    {
        $this->classId = $classId;
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $api = app(ApiService::class);
        $token = session('api_token');
        $response = $api->withToken($token)->get("api/classes/{$this->classId}/students");
        $this->students = is_array($response) ? $response : [];
    }

    public function addStudent()
    {
        $this->validate([
            'name'  => 'required|string',
            'grade' => 'required|string',
        ]);

        $api = app(ApiService::class);
        $token = session('api_token');
        $response = $api->withToken($token)->post("api/classes/{$this->classId}/students", [
            'name'  => $this->name,
            'grade' => $this->grade,
        ]);

        if (isset($response['id'])) {
            $this->name = '';
            $this->grade = '';
            $this->showForm = false;
            $this->loadStudents();
        } else {
            $this->error = $response['message'] ?? 'Failed to add student.';
        }
    }

    public function deleteStudent(int $studentId)
    {
        $api = app(ApiService::class);
        $token = session('api_token');
        $api->withToken($token)->delete("api/classes/{$this->classId}/students/{$studentId}");
        $this->loadStudents();
    }

    public function assignReading(int $studentId, string $passageText)
    {
        $this->validate([
            'passageText' => 'required|string|max:5000',
        ], [
            'passageText.required' => 'Passage text is required.',
            'passageText.max' => 'Passage too long.',
        ]);

        $api = app(ApiService::class);
        $token = session('api_token');
        $response = $api->withToken($token)->post("api/students/{$studentId}/sessions", [
            'passage' => $passageText,
        ]);

        if (isset($response['id'])) {
            return $this->redirect(route('reader', [$studentId, $response['id']]));
        }

        $this->error = $response['message'] ?? 'Failed to create reading session.';
        $this->loadStudents();
    }

    public function render()
    {
        return view('livewire.student-list');
    }
}
