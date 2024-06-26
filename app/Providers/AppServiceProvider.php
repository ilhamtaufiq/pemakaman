<?php

namespace App\Providers;

use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;
use Route;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Table::configureUsing(function (Table $table): void {
            $table
                ->emptyStateHeading('No data yet')
                ->striped()
                ->defaultPaginationPageOption(10)
                ->paginated([10, 25, 50, 100])
                ->extremePaginationLinks()
                ->defaultSort('created_at', 'desc');
        });
        Model::unguard();
	Livewire::setScriptRoute(function ($handle) {
    		return Route::get('/pemakaman/livewire/livewire.js', $handle);
	});
	Livewire::setUpdateRoute(function ($handle) {
    		return Route::post('/pemakaman/livewire/update', $handle);
	});
    }
}
