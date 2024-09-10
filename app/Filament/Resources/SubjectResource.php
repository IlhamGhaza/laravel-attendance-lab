<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;


class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Departments Management';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('department_id')
                    ->required()
                    ->relationship('department', 'name')
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->searchable()
                    ->toggleable()
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been deleted!')
                        ->body('Subject has been deleted successfully!'),
                ),
                Tables\Actions\RestoreAction::make('Restore')
                ->color('success')
                ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been restored!')
                        ->body('Subject has been restored successfully!'),
                ),
                Tables\Actions\ForceDeleteAction::make('Force Delete')
                ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been permanently deleted!')
                        ->body('Subject has been permanently deleted successfully!'),
                ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been deleted!')
                        ->body('Subject has been deleted successfully!'),
                    ),
                    Tables\Actions\ForceDeleteBulkAction::make()
                     ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been restored!')
                        ->body('Subject has been restored successfully!'),
                    ),
                    Tables\Actions\RestoreBulkAction::make()
                    ->successNotification(
                    fn () => Notification::make()
                        ->success()
                        ->title('Subject has been permanently deleted!')
                        ->body('Subject has been permanently deleted successfully!'),
                     ),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'view' => Pages\ViewSubject::route('/{record}'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
