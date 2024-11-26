@component('mail::message')
# Buongiorno, {{ $user->name }}

l'account a lei riservato per accedere a McSlide-Wms è stato creato.  

Può accedere utilizzando il suo indirizzo email:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; **{{ $user->email }}**

Come primo accesso la preghiamo di cliccare sul link qui sotto per impostare la prima password di siurezza e cominciare a navigare da subito nel portale:  
@component('mail::button', ['url' => $url])
Accedi Qui
@endcomponent
<center>
    <small>
        <i>
            Il link di accesso rimane valido per 48 ore, poi dovrà richiedere un nuovo invito
        </i>
    </small>
</center>
<br>

Ringraziando per l'attenzione, auguriamo un buon lavoro.  

Staff McSlide.  
@endcomponent
