<?php
/**
  * This file is part of snono/pdf-report.
  *
  * (c) Yaser Ghanawi <yaser@snono-systems.com>
  *
  * For the full copyright and license information, please view the LICENSE
  * file that was distributed with this source code.
  */

namespace Snono\PDFBuilder\Builder;

use Illuminate\Support\ServiceProvider;

/**
 * This is the PDFBuilderServiceProvider class.
 *
 * @author Yaser Ghanawi <yaser@snono-systems.com>
 */
class PDFBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'pdf-builder');

        $this->publishes([
            __DIR__ . '/Templates' => resource_path('views/pdf-builder'),
            __DIR__ . '/Config/pdf.php' => config_path('pdf.php'),
        ], 'pdf-builder');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/pdf.php', 'pdf-builder'
        );
    }
}
