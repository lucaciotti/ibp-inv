<?php

namespace App\Http\Livewire\Layouts;

use Arr;
use Auth;
use Livewire\Component;
use Str;

class NotificationBell extends Component
{
    public $item;
    public $notifyLabel =
    [
        'label'       => 0,
        'label_color' => 'danger',
        'icon_color'  => 'dark',
    ];
    public $openedSlideOver = false;
    public $previousCount;
    public $notificationList = [];

    protected $listeners = [
        'notification-slide-over-open' => 'toogleSlideOverOpened',
        'slide-over.close' => 'toogleSlideOverClosed',
    ];
    
    public function mount($menuItem) {
        $this->item = $menuItem;
        $this->previousCount = 0;
        $this->getNotifications();
    }

    public function render()
    {
        // dd($this->openedSlideOver);
        return view('livewire.layouts.notification-bell');
    }

    public function getNotifications($force=false){
        $notificationsCount = count(Auth::user()->unreadNotifications);
        if ($this->previousCount != $notificationsCount or $force) {
            // dd($this->previousCount != $notificationsCount);
            $this->previousCount = $notificationsCount;
            $this->notifyLabel = [
                'label'       => $notificationsCount,
                'label_color' => 'danger',
                'icon_color'  => 'dark',
            ];
            $this->emit('notifyUpdated');
            $this->handleTableRefresh();
        }
    }

    public function toogleSlideOverOpened(){
        $this->openedSlideOver = true;
    }
    public function toogleSlideOverClosed(){
        $this->openedSlideOver = false;
        $this->getNotifications(true);
    }
    public function openSlideOver(){
        $this->emit('slide-over.open', 'layouts.notification-slide-over');
        $this->openedSlideOver = true;
    }
    public function closeSlideOver()
    {
        $this->emit('slide-over.close', 'layouts.notification-slide-over');
        $this->openedSlideOver = false;
        $this->getNotifications(true);
    }

    private function handleTableRefresh(){
        $notifications = Auth::user()->unreadNotifications;
        if (!empty($notifications) and count($notifications) > 0 and $notifications != null) {
            foreach ($notifications as $notification) {
                if (!in_array($notification->id, $this->notificationList)){
                    $item['title'] = Arr::has($notification->data, 'title') ? $notification->data['title'] : '';
                    if (Str::startsWith($item['title'], 'Nuove Pianificazioni')) {
                        $this->emit('refreshNewPlannedTask');
                    } else {
                        $this->emit('refreshImportFile');
                    }
                    array_push($this->notificationList, $notification->id);
                }
            }
        }
    }
}
