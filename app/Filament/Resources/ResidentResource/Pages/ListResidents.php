<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use App\Models\Resident;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
            ->uniqueField('nik')
            ->fields([
                ImportField::make('nik')
                ->required(),
                ImportField::make('name')
                ->required(),
                ImportField::make('gender')
                ->label('Jenis Kelamin'),
                ImportField::make('religion')
                ->label('Agama'),
                ImportField::make('job')
                ->label('Pekerjaan'),
                ImportField::make('pob')
                ->label('Tempat Lahir'),
                ImportField::make('dob')
                ->label('Tanggal Lahir')
                ->mutateBeforeCreate(fn($value) => date('Y-m-d', strtotime($value))),
                ImportField::make('address')
                ->label('Alamat')
            ])
        ];
    }
}
