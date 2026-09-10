<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationResource\Pages;
use App\Models\MasterItemCatalog;
use App\Models\Quotation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuotationResource extends Resource
{
    protected static ?string $model = Quotation::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Financials & Quotations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Quotation Details')
                    ->schema([
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'title')
                            ->required(),
                        Forms\Components\Select::make('created_by_user_id')
                            ->relationship('creator', 'name')
                            ->default(auth()->id())
                            ->disabled()
                            ->dehydrated() // Ensures the value is still saved to the database despite being disabled
                            ->required(),
                        Forms\Components\TextInput::make('version_number')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'pending_approval' => 'Pending Approval',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'superseded' => 'Superseded',
                            ])
                            ->default('draft')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Line Items')
                ->schema([
                    Forms\Components\Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('catalog_item_id')
                                ->label('Catalog Item')
                                ->options(MasterItemCatalog::pluck('common_name', 'id'))
                                ->searchable()
                                ->reactive()
                                // When the catalog item is selected, automatically populate the item_name, category, and unit_price fields
                                ->dehydrated()
                                ->afterStateUpdated(function ($state, Forms\Set $set) {
                                    if ($item = MasterItemCatalog::find($state)) {
                                        $set('item_name', $item->common_name);
                                        $set('category', $item->category);
                                        $set('unit_price', $item->default_unit_price);
                                        $set('unit_of_measure', $item->unit_of_measure);
                                        $set('supplier_name', $item->Supplier_name); // Assuming you have a supplier_name field in your MasterItemCatalog model
                                    }
                                }),
                            Forms\Components\TextInput::make('item_name')
                                ->disabled()
                                ->dehydrated()
                                ->required(),

                            Forms\Components\TextInput::make('unit_of_measure')
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\TextInput::make('category')
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\TextInput::make('supplier_name')
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                            Forms\Components\TextInput::make('quantity_quoted')
                                ->numeric()
                                ->default(1)
                                ->required(), // Left editable so quantities can be adjusted on existing items
                            Forms\Components\TextInput::make('unit_price')
                                ->numeric()
                                ->prefix('Ksh')
                                ->disabled()
                                ->dehydrated()
                                ->required(),
                        ])->columns(3),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.title')->searchable(),
                Tables\Columns\TextColumn::make('version_number')->label('Version'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('total_amount')->money('Ksh')->sortable(),
                Tables\Columns\TextColumn::make('creator.name')->label('Created By'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotations::route('/'),
            'create' => Pages\CreateQuotation::route('/create'),
            'edit' => Pages\EditQuotation::route('/{record}/edit'),
        ];
    }
}