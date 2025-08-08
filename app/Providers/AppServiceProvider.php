<?php
declare(strict_types = 1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider {
    #[Override]
    public function register(): void {}
    
    /**
     * @SuppressWarnings(PHPMD)
     */
    public function boot(): void {
        Date::use(CarbonImmutable::class);
        $should_be_strict = app()->isProduction() === false;
        Model::preventSilentlyDiscardingAttributes($should_be_strict);
        Model::preventLazyLoading($should_be_strict);
        Model::preventAccessingMissingAttributes($should_be_strict);
    }
}
