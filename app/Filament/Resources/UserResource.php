<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Users Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    // ->multiple()
                    ->preload()
                    ->searchable(),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->maxDate(now()->subYears(15))
                    ->required(),
                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->required(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->preload()
                    ->native()
                    // ->required()
                    ->searchable(),
                Select::make('lab_id')
                    ->relationship('lab', 'name')
                    ->preload()
                    ->native()
                    // ->required()
                    ->searchable(),
                Select::make('position')
                    ->options([
                        'assistant' => 'Assistant',
                        'tutor' => 'Tutor',
                        'ketua' => 'Ketua',
                        'staff' => 'Staff',
                    ])
                    ->required(),
                // Forms\Components\Textarea::make('face_embedding')
                //     ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->disk('user_images')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Username')
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()->sortable()->toggleable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color(function (User $record) {
                        return match ($record->role) {
                            'super_admin' => 'danger',
                            'admin' => 'danger',
                            'staff' => 'warning',
                            'user' => 'primary',
                        };
                    })
                    ->searchable()->sortable()->toggleable(),
                // Tables\Columns\TextColumn::make('role')
                //     ->badge()
                //     ->color(function (User $record) {
                //         return match ($record->role) {
                //             'admin' => 'danger',
                //             'staff' => 'warning',
                //             'user' => 'primary',
                //         };
                //     })
                //     ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->color(function (User $record) {
                        return match ($record->gender) {
                            'male' => 'success',
                            'female' => 'danger',
                        };
                    })
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('lab.name')
                    ->numeric()
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->badge()
                    ->color(function (User $record) {
                        return match ($record->position) {
                            'assistant' => 'info',
                            'tutor' => 'primary',
                            'ketua' => 'success',
                            'staff' => 'warning',
                        };
                    })
                    ->searchable()->sortable()->toggleable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('user_images'),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        fn () => Notification::make()
                            ->title('Success')
                            ->success()
                            ->body('User has been deleted!')
                    ),
                Tables\Actions\RestoreAction::make('restore')
                    ->color('success')
                    ->successNotification(
                        fn () => Notification::make()
                            ->title('Success')
                            ->success()
                            ->body('User has been restored!')
                    ),
                Tables\Actions\ForceDeleteAction::make('forceDelete')
                    ->successNotification(
                        fn () => Notification::make()
                            ->title('Success')
                            ->success()
                            ->body('User has been force deleted!')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            fn () => Notification::make()
                                ->title('Success')
                                ->success()
                                ->body('User has been deleted!')

                        ),
                    Tables\Actions\ForceDeleteBulkAction::make()
                        ->successNotification(
                            fn () => Notification::make()
                                ->title('Success')
                                ->success()
                                ->body('User has been force deleted!')
                        ),
                    Tables\Actions\RestoreBulkAction::make()
                        ->successNotification(
                            fn () => Notification::make()
                                ->title('Success')
                                ->success()
                                ->body('User has been restored!')

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
