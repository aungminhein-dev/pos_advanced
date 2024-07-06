<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderBadge extends Component
{
    public $status;


    public function __construct($status)
    {
        $this->status = $status;

    }


    public function render(): View|Closure|string
    {
        // Placeholder logic within each condition
        $badgeClass = '';
        $badgeText = '';
        if ($this->status == 0) {
            $badgeClass = 'badge-warning';
            $badgeText = 'Pending';
        } else if ($this->status == 1) {
            $badgeClass = 'badge-success';
            $badgeText = 'Accepted';
        } else {
            $badgeClass = 'badge-danger';
            $badgeText = 'Denied';
        }
        return view('components.order-badge', [
            'badgeClass' => $badgeClass,
            'badgeText' => $badgeText
        ]);
    }
}
