<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class OrderBadge extends Component
{
    public $status;

    public function render()
    {
        // Placeholder logic within each condition
        $badgeClass = '';
        $badgeText = '';
        if ($this->status == 0) {
            $badgeClass = 'badge-warning';
            $badgeText = 'Sent';
        } else if ($this->status == 1) {
            $badgeClass = 'badge-warning';
            $badgeText = 'Pending';
        } else if($this->status == 2) {
            $badgeClass = 'badge-success';
            $badgeText = 'Accepted';
        }else{
            $badgeClass = 'badge-success';
            $badgeText = 'Accepted';
        }

        return view('livewire.admin.order-badge', [
            'badgeClass' => $badgeClass,
            'badgeText' => $badgeText
        ]);
    }
}
