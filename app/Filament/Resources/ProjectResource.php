<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Project Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Overview')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(150),
                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'name')
                            ->searchable()
                            ->required()
                            ->preload(),
                        Forms\Components\Select::make('designer_id')
                            ->relationship(
                                name: 'designer',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query->where('role', 'designer')
                            )
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('supervisor_id')
                            ->relationship(
                                name: 'supervisor',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query->where('role', 'supervisor')
                            )
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('property_address')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('property_size_sqm')
                            ->numeric()
                            ->suffix('sqm'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'inquiry' => 'Inquiry',
                                'active' => 'Active',
                                'on_hold' => 'On Hold',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('inquiry')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client.name')->label('Client')->searchable(),
                Tables\Columns\TextColumn::make('designer.name')->label('Designer'),
                Tables\Columns\TextColumn::make('supervisor.name')->label('Supervisor'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'inquiry' => 'info',
                        'active' => 'success',
                        'on_hold' => 'warning',
                        'completed' => 'gray',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'inquiry' => 'Inquiry',
                    'active' => 'Active',
                    'on_hold' => 'On Hold',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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