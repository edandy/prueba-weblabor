<?php

namespace App\Livewire\Portfolio;
use App\Models\Portfolio as ModelPortfolio;

use Livewire\Component;

class Home extends Component
{
    public $perPage = 12;

    public function render()
    {
        return view('livewire.portfolio.home', [
        'portfolios' => ModelPortfolio::where('is_published', true)->orderBy('created_at', 'desc')->paginate($this->perPage)
        ])->layout('layouts.public');
    }
}
