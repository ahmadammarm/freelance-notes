<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers\ExpensesRelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers\TimeLogsRelationManager;
use App\Models\Project;
use App\Services\BillingService;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make('Informasi Umum')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'name')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
                    Section::make('Harga Project')
                    ->schema([
                        Forms\Components\Select::make('billing_type')
                            ->options([
                                'fixed' => 'Fixed Price',
                                'hourly' => 'Hourly Rate',
                            ])
                            ->required()
                            ->reactive(),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('IDR')
                            ->visible(fn ($get) => $get('billing_type') === 'fixed'),
                        Forms\Components\TextInput::make('hourly_rate')
                            ->numeric()
                            ->prefix('IDR')
                            ->visible(fn ($get) => $get('billing_type') === 'hourly'),
                    ]),
                ]),
                Group::make()
                ->schema([
                    Section::make('Tanggal Penting')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->required(),
                    ])
                ])
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('billing_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => 'IDR ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
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
                Action::make('Generate Invoice')
                    ->icon('heroicon-o-document-plus')
                    ->color('success')
                    ->visible(fn (Project $record) => $record->billing_type === 'hourly')
                    ->action(function (Project $record, BillingService $billingService) {
                        $invoice = $billingService->generateInvoiceFromTimeLogs($record);
                        
                        if ($invoice) {
                            Notification::make()
                                ->title('Invoice generated successfully')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('No unbilled time logs found')
                                ->warning()
                                ->send();
                        }
                    }),
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
            ExpensesRelationManager::class,
            TimeLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
