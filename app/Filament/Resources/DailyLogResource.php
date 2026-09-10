<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyLogResource\Pages;
use App\Models\DailyLog;
use App\Models\Project;
use App\Models\QuotationItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DailyLogResource extends Resource
{
    protected static ?string $model = DailyLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Site Progress';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Log Summary')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'title')
                            ->required()
                            ->dehydrated()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($item = Project::find($state)) {
                                    $set('supervisor_id', $item->supervisor_id);
                                    }
                                }),
                        Forms\Components\Select::make('supervisor_id')
                            ->relationship('supervisor', 'name')
                            ->required()
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\DatePicker::make('log_date')
                            ->default(now())
                            ->required(),
                        Forms\Components\Textarea::make('summary_notes')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Progress Logged')
                    ->schema([
                        Forms\Components\Repeater::make('itemProgressLogs')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('quotation_item_id')
                                    ->label('Quoted Item')
                                    ->options(function (Forms\Get $get) {
                                        $projectId = $get('../../project_id');
                                        if (!$projectId) return [];
                                        return QuotationItem::whereHas('quotation', fn($q) => $q->where('project_id', $projectId))
                                            ->pluck('item_name', 'id');
                                    })
                                    ->required(),
                                Forms\Components\TextInput::make('quantity_added')
                                    ->numeric()
                                    ->required(),
                            ])->columns(2),
                    ]),

                Forms\Components\Section::make('Media Uploads')
                ->schema([
                    Forms\Components\Repeater::make('media')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('media_type')
                                ->options([
                                    'render' => 'Render',
                                    'site_photo' => 'Site Photo',
                                    'site_video' => 'Site Video',
                                    'document' => 'Document',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('file_url')
                                ->url()
                                ->required(),
                            Forms\Components\Toggle::make('is_render_comparison_source')
                                ->label('Use for 3D/Site Comparison Slider'),
                        ])->columns(3),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('log_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('project.title')->searchable(),
                Tables\Columns\TextColumn::make('supervisor.name')->label('Supervisor'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyLogs::route('/'),
            'create' => Pages\CreateDailyLog::route('/create'),
            'edit' => Pages\EditDailyLog::route('/{record}/edit'),
        ];
    }
}