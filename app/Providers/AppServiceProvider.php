<?php

namespace App\Providers;

use App\Http\Resources\ProdiCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ProdiCollection::withoutWrapping();
        // if(!\App::environment('local')){
        //     \URL::forceSchema('https');
        // }

        // Validator::extend('iunique', function ($attribute, $value, $parameters, $validator) {
        //     $query = DB::table($parameters[0]);
        //     $column = $query->getGrammar()->wrap($parameters[1]);
        //     return ! $query->whereRaw("lower({$column}) = lower(?)", [$value])->count();
        // });

        Paginator::useBootstrap();
        
    }
}
