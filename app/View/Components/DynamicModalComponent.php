<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicModalComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $options, public $modal_id, public $action, public $item, public $columns)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dynamic-modal-component');
    }
}
