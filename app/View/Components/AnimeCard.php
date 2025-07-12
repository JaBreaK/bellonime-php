<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnimeCard extends Component
{
    // 1. Definisikan properti publik untuk menampung data anime
    public array $anime;

    /**
     * Create a new component instance.
     */
    // 2. Terima data anime lewat constructor
    public function __construct(array $anime)
    {
        $this->anime = $anime;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anime-card');
    }
}