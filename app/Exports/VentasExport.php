<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VentasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        // Load related models with the ventas to reduce queries
        return Venta::with(['user', 'vendedor', 'pago'])->get();
    }

    public function headings(): array
    {
        // Define the headers for the Excel file
        return [
            'ID',
            'Cliente',
            'Vendedor',
            'Monto Total',
            'Status',
            'Porcentaje Descuento',
            'Monto de Pago',
            'Created At',
            'Updated At'
        ];
    }

    public function map($venta): array
    {
        // Map the data for each venta
        return [
            $venta->id,
            $venta->user ? $venta->user->name : 'N/A', // Get the user name or 'N/A'
            $venta->vendedor ? $venta->vendedor->name : 'N/A', // Get the vendedor name or 'N/A'
            $venta->monto_total,
            $venta->status,
            $venta->porcentaje_descuento . '%' ?? 0,
            $venta->pago ? $venta->pago->monto_total : 'N/A', // Get the pago amount or 'N/A'
            $venta->created_at,
            $venta->updated_at
        ];
    }
}
