<?php

namespace App\Filament\Resources\RecurringInvoiceResource\Pages;

use App\Filament\Resources\RecurringInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecurringInvoice extends EditRecord
{
    protected static string $resource = RecurringInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
