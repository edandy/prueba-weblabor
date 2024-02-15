<?php

namespace App\Livewire\Portfolio;

use App\Models\Portfolio;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public string $title;

    public string $description;

    public bool $is_published = false;

    public $thumbnail;
    #[Validate('required|image|max:5000')]
    public $image_prev;
    public $quillId;

    public $portfolio;

    public function mount(Portfolio $portfolio, $value = ''){
        $this->portfolio = $portfolio;
        $this->title = $portfolio->title;
        $this->description = $portfolio->description;
        $this->published = $portfolio->published;
        $this->thumbnail = $portfolio->thumbnail;
        $this->image_prev = $portfolio->image_prev;
        $this->quillId = 'quill-'.uniqid();
    }

    public function cleanImage(): void
    {
        $this->thumbnail = '';
    }

    public function enabledPublished(): void
    {
        $this->is_published = !$this->is_published;
    }


    public function save()
    {
        $rules = [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:5|max:1000',
        ];

        if(!$this->thumbnail) {
            $rules['image_prev'] = 'required|image|max:5000';
        }

        $validated = $this->validate($rules);

        if($this->image_prev) {
            $name = md5($this->thumbnail . microtime()).'.'.$this->image_prev->extension();

            $this->thumbnail = $this->image_prev->storeAs('thumbnails', $name, 'public');
        }

        $this->portfolio->update($this->only('title', 'description', 'is_published', 'thumbnail'));

        session()->flash('status', 'El portafolio de actualizo correctamente');

        return $this->redirect('/portfolios');
    }

    public function render()
    {
        return view('livewire.portfolio.edit')->layout('layouts.main');
    }
}
