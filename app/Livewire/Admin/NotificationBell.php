<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;

class NotificationBell extends Component
{
    public $notifications;

    // protected $listeners = ['contactFormSubmitted' => 'showNotificationToast'];

    #[On('OrderArrived')]
    public function success()
    {
       toastr()->success('An order has arrived',"Hi there!");
    }

    public function mount()
    {
        $this->notifications = Notification::orderBy('created_at', 'desc')->get();
    }



    public function render()
    {
        return view('livewire.admin.notification-bell');
    }
}
