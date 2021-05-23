<?php

namespace App\Providers;

use App\Adapters\EventSenderAdapter;
use App\Factories\KafkaFactory;
use Arquivei\Events\Sender\Sender;
use Arquivei\LogAdapter\Log;
use Core\Dependencies\EventSenderInterface;
use Core\Dependencies\LogInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LogInterface::class, Log::class);

        $this->app->bind(
            EventSenderInterface::class,
            fn () => new EventSenderAdapter(new Sender(KafkaFactory::create()))
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);
    }
}
