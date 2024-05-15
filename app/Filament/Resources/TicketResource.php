<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\TicketResource\RelationManagers;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ticket_number')
                ->required()
                ->label('Ticket Number'),

            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->label('Product'),

            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->required()
                ->label('Quantity'),

            Forms\Components\TextInput::make('total_amount')
                ->numeric()
                ->required()
                ->label('Total Amount'),

                Forms\Components\FileUpload::make('image')
                    ->label('Ticket Image')
                    ->image()
                    ->disk('public') // Asegúrate de que este disco esté configurado en config/filesystems.php
                    ->directory('ticket_images') // Directorio donde se guardarán las imágenes
                    ->maxSize(10240), // Tamaño máximo del archivo en kilobytes

            Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),
                Forms\Components\Hidden::make('distribuitor_id')
                ->default(function () {
                    // Asegúrate de que el usuario está autenticado para evitar errores
                    if (Auth::check()) {
                        return Auth::user()->distribuitor_id;
                    }
                    return null; // Devuelve null o un valor por defecto si el usuario no está autenticado
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return $table

            ->modifyQueryUsing(function (Builder $query) use ($user) {
                if (!$user->hasRole('Administrador')) {
                    // Si el usuario NO es un administrador, filtrar por su distribuitor_id
                    $query->where('distribuitor_id', $user->distribuitor_id);
                }
                // No se hace ninguna modificación si el usuario es Administrador
            })

            ->columns([
                Tables\Columns\TextColumn::make('user2.name')
                ->label('Usuario'),
                Tables\Columns\TextColumn::make('ticket_number'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->url(fn ($record) => Storage::disk('public')->url($record->image)),
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('user.name')->visible(false),
                Tables\Columns\TextColumn::make('distribuitor.name')
                    ->label('Distribuidor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('total_amount'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
