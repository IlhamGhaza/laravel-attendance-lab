<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsenceResource\Pages;
use App\Filament\Resources\AbsenceResource\RelationManagers;
use App\Models\Absence;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class AbsenceResource extends Resource
{
    protected static ?string $model = Absence::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-minus';
    protected static? string $navigationGroup = 'Attendance Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name'),
                Forms\Components\DatePicker::make('date_permission')
                    ->required(),
                Forms\Components\Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('permissions'),
                Forms\Components\Toggle::make('is_approved')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_permission')
                    ->date()
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason'),
                Tables\Columns\ImageColumn::make('image')
                    //disk = 'public/permissions'
                    ->disk('permissions')
                    ->getStateUsing(fn ($record) => $record->image ? asset('storage/permissions/'.ltrim($record->image, '/')) : null)
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('created_at')
                    ->label('Date Permission')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make()
                    // ->visible(fn ($record) => auth()->role=== 'admin'),
                Action::make('approve')
                    ->label('Approve')
                    ->action(function ($record) {
                        // Ubah status permission menjadi approved
                        $record->is_approved = 1;
                        $record->save();

                        // Kirim notifikasi ke user
                        self::sendNotificationToUser($record->user_id, 'Permission Anda telah disetujui.');
                    })
                    ->requiresConfirmation()
                    ->color('primary')
                   //if succes create notification success change
                    ->successNotificationTitle('Permission approved successfully'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make('restore'),
                Tables\Actions\ForceDeleteAction::make('forceDelete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListAbsences::route('/'),
            'create' => Pages\CreateAbsence::route('/create'),
            'view' => Pages\ViewAbsence::route('/{record}'),
            'edit' => Pages\EditAbsence::route('/{record}/edit'),
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
