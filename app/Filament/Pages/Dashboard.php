<?php

namespace App\Filament\Pages;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use App\Models\Tpu;

class Dashboard extends \Filament\Pages\Dashboard
{

    use HasFiltersForm;

    public function filtersForm(Form $form)
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('tpu_id')
                        ->label('TPU')
                        ->options(Tpu::all()->pluck('nama_tpu', 'id'))
                        ])
                    ->columns(3),
            ]);
    }
}
