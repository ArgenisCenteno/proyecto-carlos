<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SaleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $venta;

    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    public function via($notifiable)
    {
        return ['database']; // Solo enviará la notificación al canal de base de datos
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => 'Nueva Venta Registrada', // Título de la notificación
            'mensaje' => 'Se ha realizado una nueva venta por un monto de ' . $this->venta->monto_total, // Mensaje de la notificación
            'venta_id' => $this->venta->id,
            'monto_total' => $this->venta->monto_total,
            'type' => 'Venta Online', // Tipo de notificación
            'url' => url('/ventas/' . $this->venta->id), // Enlace para ver la venta
            'created_at' => now(),
        ];
    }
}
