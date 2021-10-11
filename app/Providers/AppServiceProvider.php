<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Repositories\DataUserRepository;
use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use App\Repositories\TransactionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Data User
        $this->app->bind(DataUserReposity::class, function ($app){
            return new DataUserRepository($app->make(DataUser::class));
        });

        // Room
        $this->app->bind(RoomReposity::class, function ($app){
            return new RoomRepository($app->make(Room::class));
        });

        // Booking
        $this->app->bind(BookingReposity::class, function ($app){
            return new BookingRepository($app->make(Booking::class));
        });

        // Transaction
        $this->app->bind(TransactionReposity::class, function ($app){
            return new TransactionRepository($app->make(Transaction::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
