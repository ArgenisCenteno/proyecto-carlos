<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PagoStatusUpdated extends Notification
{
    use Queueable;

    protected $pago;
    protected $status;

    public function __construct($pago, $status)
    {
        $this->pago = $pago;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // Guarda la notificación en la base de datos
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => "Venta procesada.",
            'mensaje' => "El estado del pago #{$this->pago->id} ha cambiado a {$this->status}.",
            'url' => route('pagos.edit', $this->pago->id),
            'type' => 'Pago',
        ];
    }
}
