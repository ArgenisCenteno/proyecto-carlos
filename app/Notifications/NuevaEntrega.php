<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaEntrega extends Notification
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
            'titulo' => "Nueva entrega pendiente.",
            'mensaje' => "La venta #{$this->entrega->venta_id} esta {$this->status} por entregar.",
            'url' => route('entregas.edit', $this->entrega->id),
            'type' => 'Entrega',
        ];
    }
}
