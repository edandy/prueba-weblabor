<?php

namespace App\Livewire\Portfolio;

use App\Livewire\Portfolio;
use App\Models\Portfolio as ModelPortfolio;
use Livewire\Component;

class Read extends Component
{
    public $portfolio;
    public $perPage = 10;
    public $search = '';

    public function deletePortfolio(): void
    {
        if($this->portfolio) {
            $this->portfolio->delete();
            $this->dispatch('close-modal');
        }
    }

    public function setPortfolio(ModelPortfolio $portfolio): void
    {
        $this->portfolio = $portfolio;
    }

    public function render()
    {
        return view('livewire.portfolio.read', [
            'portfolios' => ModelPortfolio::search($this->search)->orderBy('created_at', 'desc')->paginate($this->perPage)
        ])->layout('layouts.main');
    }
}
