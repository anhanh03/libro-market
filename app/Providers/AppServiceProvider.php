<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
        Schema::defaultStringLength(191);

        Blueprint::macro('dropForeignKeyIfExists', function ($name) {
            // Thay đổi từ $this->getTable() thành $this->getConnection()->getSchemaBuilder()
            if ($this->getConnection()->getSchemaBuilder()->hasTable($this->getTable())) {
                $table = $this->getConnection()->getSchemaBuilder()->getConnection()->getDoctrineSchemaManager()->listTableDetails($this->getTable());
                if ($table->hasForeignKey($name)) {
                    $this->dropForeign($name);
                }
            }
        });
    }
}
