<?php

namespace App\Filament\Resources\MasterItemCatalogResource\Pages;

use App\Filament\Resources\MasterItemCatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterItemCatalog extends EditRecord
{
    protected static string $resource = MasterItemCatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
