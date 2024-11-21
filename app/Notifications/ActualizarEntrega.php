<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActualizarEntrega extends Notification
{
    use Queueable;

    protected $entrega;
    protected $status;

    public function __construct($entrega, $status)
    {
        $this->entrega = $entrega;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // Guarda la notificación en la base de datos
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => "Estado de entrega actualizado.",
            'mensaje' => "La entrega #{$this->entrega->id} ha sido actualizada a {$this->status}.",
            'url' => route('entregas.edit', $this->entrega->id),
            'type' => 'Entrega',
        ];
    }
}
