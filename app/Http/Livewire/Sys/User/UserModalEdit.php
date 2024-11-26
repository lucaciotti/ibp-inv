<?php

namespace App\Http\Livewire\Sys\User;

use App;
use App\Mail\InviteUser;
use App\Models\Role;
use App\Models\User;
use App\Notifications\DefaultMessageNotify;
use Auth;
use Hash;
use Log;
use Mail;
use Notification;
use Password;
use Str;
use WireElements\Pro\Components\Modal\Modal;

class UserModalEdit extends Modal
{
    // use InteractsWithConfirmationModal;

    public $title;
    public $mode;

    public $user_id;
    public $name;
    public $email;
    public $role_name;

    public $user;
    public $roles;

    protected function rules()
    {
        if ($this->mode == 'edit') {
            return [
                'name' => 'required|unique:users,name,' . $this->user_id,
                'email' => 'required|email|unique:users,name,' . $this->user_id,
                'role_name' => 'required',
            ];
        } else {
            return [
                'name' => 'required|unique:users,name',
                'email' => 'required|email|unique:users,name',
                'role_name' => 'required',
            ];
        }
    }

    protected $messages = [
        'name.required' => 'Nome obbligatorio!',
        'name.unique' => 'Nome già registrato per altro utente',
        'email.required' => 'eMail obbligatorio!',
        'email.unique' => 'eMail già registrato per altro utente',
        'role_name.required' => 'Ruolo Utente obbligatoria!',
    ];

    public function mount($user_id=null)
    {
        if (empty($user_id)) {
            $this->mode = 'insert';
            $this->title = 'Nuovo Utente';
        } else {
            $this->mode = 'edit';
            $this->user_id = $user_id;
            $this->user = User::find($user_id);
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role_name = $this->user->roles->first()->name ?? '';

            $this->title = 'Modifica Utente [' . $this->user->name . ']';
        }
        $this->roles = Role::all();
    }

    
    public function render()
    {
        return view('livewire.sys.user.user-modal-edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save() {
        $validatedData = $this->validate();
        if (empty($this->user)) {
            $data = [
                'password' => Hash::make(Str::random(32)),
            ];
            $this->user = User::create(array_merge($validatedData, $data));
            $this->user->roles()->detach();
            $this->user->attachRole($this->role_name);
            $this->user->save();
            
            $token = Password::getRepository()->create($this->user);
            // $mail = (new InviteUser($token, $user->id))->onQueue('emails');
            try{
                if (App::environment(['local', 'staging'])) {
                    // Mail::to('ibpoms@lucaciotti.space')->bcc(['luca.ciotti@gmail.com'])->queue($mail);
                    Mail::to('mcslidewms@lucaciotti.space')->cc(['luca.ciotti@gmail.com'])->send(new InviteUser($token, $this->user->id));
                } else {
                    // Mail::to($this->user->email)->bcc(['luca.ciotti@gmail.com'])->queue($mail);
                    Mail::to($this->user->email)->cc(['luca.ciotti@gmail.com'])->send(new InviteUser($token, $this->user->id));
                }
            } catch (\Exception $e) {
                Log::error("Attenzione! Mail di Invito non inviata a causa di configurazioni SMTP!");
                Notification::send(Auth::user(), new DefaultMessageNotify(
                    $title = 'Creazione Utenti',
                    $body = 'Attenzione Mail non inviata ad Utente a causa di configurazioni SMTP',
                    $link = 'config/users',
                    $level = 'warning'
                ));
            }
        } else {
            $this->user->update($validatedData);
            $this->user->roles()->detach();
            $this->user->attachRole($this->role_name);
            $this->user->save();
        }    

        $this->close(
            andEmit: [
                'refreshDatatable'
            ]
        );
    }

    public static function behavior(): array
    {
        return [
            // Close the modal if the escape key is pressed
            'close-on-escape' => true,
            // Close the modal if someone clicks outside the modal
            'close-on-backdrop-click' => false,
            // Trap the users focus inside the modal (e.g. input autofocus and going back and forth between input fields)
            'trap-focus' => true,
            // Remove all unsaved changes once someone closes the modal
            'remove-state-on-close' => false,
        ];
    }
}
