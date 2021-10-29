<?php

namespace App\Providers;

use App\PaymentGateway\CreditCartPayment;
use App\PaymentGateway\PaypalGateway;
use App\PaymentGateway\StripeGateway;
use App\Usecase\ShoppingCartDecrement;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        app()->singleton(CreditCartPayment::class, fn () =>
            new StripeGateway(  config('payment.stripe.secret_key') )
        );

        app()->singleton(PaypalGateway::class, fn () =>
            new PaypalGateway(  config('payment.paypal') )
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();

        $this->app->singleton(Filesystem::class, function () {
            return Storage::disk('digitalocean');
        });


        Collection::macro('retrieveMonths', fn(int $data) =>

            collect(range(1,$data))->map( fn($item) =>
                today()->startOfMonth()->addMonth()->subMonth($item)->format('Y-M')
            )
        );

        Blade::directive('user_name', fn($expression) => '<?php if( auth()->check()) echo auth()->user()->name; ?>'  );

        Blade::if('admin', function () {
            return auth()->user()->isAdmin();
        });
    }
}
