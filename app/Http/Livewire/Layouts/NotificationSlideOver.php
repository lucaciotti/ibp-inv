<?php

namespace App\Http\Livewire\Layouts;

use Auth;
use Arr;
use Livewire\Component;
use WireElements\Pro\Components\SlideOver\SlideOver;

class NotificationSlideOver extends SlideOver
{
    public $unreadNotification = [];
    public $readedNotification = [];

    public function getListeners()
    {
        return ['notifyUpdated' => 'getNotificationsList']; // Refresh the component
    }

    public function mount(){
        $this->emit('notification-slide-over-open');
        $this->getNotificationsList();
    }

    public function render()
    {
        return view('livewire.layouts.notification-slide-over');    
    }


    public function getNotificationsList()
    {
        $this->unreadNotification = [];
        $this->readedNotification = [];

        $notifications = Auth::user()->unreadNotifications;
        if (!empty($notifications) and count($notifications) > 0 and $notifications != null) {
            foreach ($notifications as $notification) {
                array_push($this->unreadNotification, $this->buildNotification($notification));
            }
        }

        $notifications = Auth::user()->notifications->whereNotNull('read_at');
        if (!empty($notifications) and count($notifications) > 0 and $notifications != null) {
            foreach ($notifications as $notification) {
                array_push($this->readedNotification, $this->buildNotification($notification));
            }
        }
    }

    public function markAsRead($id_notification){
        $notification = Auth::user()->notifications->where('id', $id_notification)->first();
        $notification->markAsRead();
        $this->emit('notifyUpdated');
        // $this->close();
    }

    public function markAllAsRead(){
        $notifications = Auth::user()->unreadNotifications;
        if (!empty($notifications) and count($notifications) > 0 and $notifications != null) {
            foreach ($notifications as $notification) {
                $notification->markAsRead();
            }
        }
        $this->emit('notifyUpdated');
    }

    public function delete($id_notification){
        $notification = Auth::user()->notifications->where('id', $id_notification)->first();
        if($notification) $notification->delete();
        $this->emit('notifyUpdated');
    }

    public function deleteAllReaded(){
        // $notifications = Auth::user()->notifications->whereNotNull('read_at');
        $notifications = Auth::user()->unreadNotifications;
        if (!empty($notifications) and count($notifications) > 0 and $notifications != null) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }
        $this->emit('notifyUpdated');
    }

    public function openLink($id_notification)
    {
        $notification = Auth::user()->notifications->where('id', $id_notification)->first();
        $notification->markAsRead();
        $this->emit('notifyUpdated');
        $this->close();
        return redirect()->to($notification->data['link']);
    }
    
    private function buildNotification($notification){
        $item = [];
        $item['id'] = $notification->id;
        $item['title'] = Arr::has($notification->data, 'title') ? $notification->data['title'] : 'Titolo';
        $item['body'] = Arr::has($notification->data, 'body') ? $notification->data['body'] : 'Notifica senza Messaggio';
        $item['link'] = Arr::has($notification->data, 'link') ? $notification->data['link'] : '#';
        $item['level'] = Arr::has($notification->data, 'level') ? $notification->data['level'] : 'info';        
        $item['date'] = $notification->created_at;
        $item['date_readable'] = $notification->created_at->diffForHumans();
        return $item;
    }

}
