<?php

namespace App\Filament\Resources\MasterItemCatalogResource\Pages;

use App\Filament\Resources\MasterItemCatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterItemCatalogs extends ListRecords
{
    protected static string $resource = MasterItemCatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
