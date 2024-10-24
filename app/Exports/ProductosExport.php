<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * Get the collection of products.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Eager load subcategory and category relations
        return Producto::with('subCategoria.categoria')->get();
    }

    /**
     * Map the data for each row.
     *
     * @param mixed $producto
     * @return array
     */
    public function map($producto): array
    {
         
        return [
            $producto->id,
            $producto->nombre,
            $producto->descripcion,
            $producto->slug,
            $producto->precio_compra,
            $producto->precio_venta,
            $producto->aplica_iva ? 'Sí' : 'No', // Convert boolean to Yes/No
            $producto->cantidad,
            $producto->subCategoria->nombre ?? 'N/A', // Subcategory name
            $producto->subCategoria->categoria->nombre ?? 'N/A', // Category name
            $producto->disponible ? 'Available' : 'Unavailable', // Convert to readable format
            $producto->created_at,
            $producto->updated_at
        ];
    }

    /**
     * Define the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Descripción',
            'Slug',
            'Precio Compra',
            'Precio Venta',
            'Aplica IVA',
            'Cantidad',
            'Sub Categoría',
            'Categoría',
            'Disponible',
            'Fecha Creación',
            'Fecha Actualización',
        ];
    }
}
