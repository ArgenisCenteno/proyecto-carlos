<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ComprasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        // Obtener todas las compras con sus relaciones de proveedor y usuario
        return Compra::with(['proveedor', 'user', 'pago'])->get();
    }

    public function headings(): array
    {
        // Definir los encabezados del archivo Excel
        return [
            'ID',
            'Proveedor (Razón Social)',
            'Usuario',
            'Monto Total',
            'Estado',
            'Porcentaje Descuento',
            'Pago ID',
            'Creado en',
            'Actualizado en'
        ];
    }

    public function map($compra): array
    {
        // Definir cómo se mostrarán los datos de la compra en el Excel
        return [
            $compra->id,
            $compra->proveedor->razon_social ?? 'N/A',  // Razon Social del proveedor
            $compra->user->name ?? 'N/A',               // Nombre del usuario
            $compra->monto_total,
            $compra->status,
            $compra->porcentaje_descuento,
            $compra->pago_id ?? 'N/A',                  // ID del pago si existe
            $compra->created_at,
            $compra->updated_at,
        ];
    }
}
