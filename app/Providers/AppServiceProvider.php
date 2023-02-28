<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Comment;
use App\Models\Approval;
use App\Notifications\OrderCreated;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Relation::morphMap([
            'comments' => Comment::class,
            'approvals' => Approval::class,
            'justifications' => Justification::class,
            'order' => Order::class,
            'order-created' => OrderCreated::class,
        ]);
    }
}
