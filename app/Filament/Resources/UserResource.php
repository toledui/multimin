<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Distribuitor;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Usuarios';

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $modelLabel = 'Usuarios';
    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('Administrador');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre Completo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->label('Password')
                    ->required(false)  // Hace que el campo no sea requerido
                    ->dehydrated(fn ($state) => filled($state))  // Solo guarda si no está vacío
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),  // Asegúrate de usar Hash
                Forms\Components\DatePicker::make('email_verified_at')
                ->label('Correo verificado el')
                ->required(),
                Forms\Components\BelongsToManyMultiSelect::make('roles')
                    ->relationship('roles', 'name') // 'roles' es la relación en el modelo User y 'name' es la columna visible
                    ->required(),
                Forms\Components\BelongsToSelect::make('distribuitor_id')
                ->label('Seleccionar Distribuidor')
                ->options(Distribuitor::pluck('name', 'id'))
                ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


}
