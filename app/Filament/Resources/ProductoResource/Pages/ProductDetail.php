<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ProductDetail extends ViewRecord
{
    protected static string $resource = ProductoResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            // Agrega aquí los widgets que quieras mostrar
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(), // Permite la edición desde la página de detalles si lo necesitas
        ];
    }

    protected function getImageGallery(): array
    {
        $product = $this->getRecord(); // Obtener el producto
        return [
            'main_image' => asset('storage/' . $product->imagen), // Imagen principal
            'gallery' => $product->galeria ?? [], // Suponiendo que tienes un campo de galería (o ajusta esto según tu estructura de base de datos)
        ];
    }
}
