<?php

namespace App\Livewire;

use App\Models\Portfolio;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePortfolio extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3|max:100')]
    public string $title;

    #[Validate('required|min:5|max:1000')]
    public string $description;

    public bool $published = false;

    #[Validate('required|image|max:5000')]
    public $image;

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

        $name = md5($this->image . microtime()).'.'.$this->image->extension();

        $this->image = $this->image->storeAs('photos', $name, 'public');

        Portfolio::create($this->only('title', 'description', 'published', 'image'));

        session()->flash('status', 'El portafolio de guardo correctamente');

        return $this->redirect('/portfolios');
    }

    public function cleanImage(): void
    {
        $this->image = '';
    }

    public function enabledPublished()
    {
        $this->published = !$this->published;
    }

    public function render()
    {
        return view('livewire.create-portfolio')->layout('layouts.main');
    }
}
