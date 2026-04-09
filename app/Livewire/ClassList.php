<?php

namespace App\Livewire;

use App\Services\ApiService;
use Livewire\Component;

class ClassList extends Component
{
    public array $classes = [];
    public string $name = '';
    public string $grade_level = '';
    public bool $showForm = false;
    public string $error = '';

    public function mount()
    {
        $this->loadClasses();
    }

    public function loadClasses()
    {
        $api = app(ApiService::class);
        $token = session('api_token');
        $response = $api->withToken($token)->get('api/classes');
        $this->classes = is_array($response) ? $response : [];
    }

    public function createClass()
    {
        $this->validate([
            'name'        => 'required|string',
            'grade_level' => 'required|string',
        ]);

        $api = app(ApiService::class);
        $token = session('api_token');
        $response = $api->withToken($token)->post('api/classes', [
            'name'        => $this->name,
            'grade_level' => $this->grade_level,
        ]);

        if (isset($response['id'])) {
            $this->name = '';
            $this->grade_level = '';
            $this->showForm = false;
            $this->loadClasses();
        } else {
            $this->error = $response['message'] ?? 'Failed to create class.';
        }
    }

    public function render()
    {
        return view('livewire.class-list');
    }
}