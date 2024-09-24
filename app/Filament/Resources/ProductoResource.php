<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nombre')
                ->required(),
            Forms\Components\TextInput::make('precio')
                ->required(),

            // Repeater para subir múltiples imágenes
            Forms\Components\Repeater::make('images')
                ->relationship('images')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('Imagen')
                        ->required(),
                ])
                ->createItemButtonLabel('Agregar Imagen'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public')
                    ->url(fn($record) => route('filament.resources.producto.detail', $record)), // Genera el enlace a la página de detalles

                TextColumn::make('nombre')->sortable()->searchable(),
                TextColumn::make('precio')->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make('detail')
                    ->url(fn($record) => route('filament.resources.producto.detail', $record)), // Enlace directo a la página de detalles
            ])
            ->filters([
                //
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
