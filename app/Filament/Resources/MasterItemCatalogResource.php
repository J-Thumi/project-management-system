<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterItemCatalogResource\Pages;
use App\Models\MasterItemCatalog;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MasterItemCatalogResource extends Resource
{
    protected static ?string $model = MasterItemCatalog::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Catalog Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category')
                    ->options([
                        'hardscape' => 'Hardscape',
                        'trees' => 'Trees',
                        'shrubs' => 'Shrubs',
                        'groundcovers' => 'Groundcovers',
                        'pots' => 'Pots',
                        'irrigation' => 'Irrigation',
                        'lawn' => 'Lawn',
                        'gravel' => 'Gravel',
                        'mulch' => 'Mulch',
                        'lighting' => 'Lighting',
                        'labour' => 'Labour'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('common_name')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('Supplier_name')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('botanical_name')
                    ->maxLength(150),
                Forms\Components\TextInput::make('sun_requirements')
                    ->maxLength(100)
                    ->placeholder('e.g., Full Sun, Partial Shade'),
                Forms\Components\TextInput::make('water_needs')
                    ->maxLength(100)
                    ->placeholder('e.g., Low, Moderate, High'),
                Forms\Components\TextInput::make('mature_size')
                    ->maxLength(100)
                    ->placeholder('e.g., 3m x 2m'),
                Forms\Components\TextInput::make('unit_of_measure')
                    ->default('pcs')
                    ->required(),
                Forms\Components\TextInput::make('default_unit_price')
                    ->numeric()
                    ->prefix('Ksh')
                    ->default(0.00)
                    ->required(),
                FileUpload::make('images')
                                    ->label('Unit Gallery')
                                    ->image() // Ensures only image files
                                    ->multiple() // This allows selecting more than one file
                                    ->disk('public')
                                    ->reorderable() // Scouts can drag to set the "main" photo
                                    ->appendFiles() // Keeps existing images when adding new ones
                                    ->directory('master-item-catalog') // Saved in storage/app/public/house-units
                                    ->visibility('public')
                                    ->imageEditor() // Helpful for scouts to crop on the fly
                                    ->panelLayout('grid') // Shows photos in a grid instead of a long list
                                    ->maxFiles(10) // Prevents scouts from uploading too many
                                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('common_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('botanical_name')->searchable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('unit_of_measure'),
                Tables\Columns\TextColumn::make('default_unit_price')->money('Ksh')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options([
                    'plant' => 'Plant',
                    'hardscape' => 'Hardscape',
                    'irrigation' => 'Irrigation',
                    'lighting' => 'Lighting',
                    'soil_mulch' => 'Soil / Mulch',
                    'labor' => 'Labor',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMasterItemCatalogs::route('/'),
            'create' => Pages\CreateMasterItemCatalog::route('/create'),
            'edit' => Pages\EditMasterItemCatalog::route('/{record}/edit'),
        ];
    }
}