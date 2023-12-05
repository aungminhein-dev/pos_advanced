<?php

namespace App\View\Components;

use Closure;
use App\Models\Notification;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class NotificationBell extends Component
{
    public $notifications;
    public function __construct()
    {
        $this->notifications = Notification::orderBy('created_at','desc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->notifications->toArray());

        return view('components.notification-bell');
    }
}
