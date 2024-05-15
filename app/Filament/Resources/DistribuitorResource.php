<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistribuitorResource\Pages;
use App\Filament\Resources\DistribuitorResource\RelationManagers;
use App\Models\Distribuitor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistribuitorResource extends Resource
{
    protected static ?string $model = Distribuitor::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Distribuidores';
    protected static ?string $modelLabel = 'Distribuidores';

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Administrador');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('fiscal_name')
                    ->label('Nombre Fiscal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rfc')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->label('Calle y Número')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('colonia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label('Ciudad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->label('Estado')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->label('País')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('post_code')
                    ->label('Código Postal')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fiscal_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rfc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('colonia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListDistribuitors::route('/'),
            'create' => Pages\CreateDistribuitor::route('/create'),
            'edit' => Pages\EditDistribuitor::route('/{record}/edit'),
        ];
    }
}
