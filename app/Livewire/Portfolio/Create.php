<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3|max:100')]
    public string $title;

    #[Validate('required|min:5|max:1000')]
    public string $description;

    public bool $is_published = false;

    #[Validate('required|image|max:5000')]
    public $thumbnail;

    public $quillId;

    public function mount($value = ''){
        $this->description = $value;
        $this->quillId = 'quill-'.uniqid();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function save()
    {
        $this->validate();

        $name = md5($this->thumbnail . microtime()).'.'.$this->thumbnail->extension();

        $this->thumbnail = $this->thumbnail->storeAs('thumbnails', $name, 'public');

        Portfolio::create($this->only('title', 'description', 'is_published', 'thumbnail'));

        session()->flash('status', 'El portafolio se creo correctamente');

        return $this->redirect('/portfolios');
    }

    public function cleanImage(): void
    {
        $this->thumbnail = '';
    }

    public function enabledPublished(): void
    {
        $this->is_published = !$this->is_published;
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.portfolio.create')->layout('layouts.main');
    }
}
