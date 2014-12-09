<?php namespace Maherelgamil\Arabicdatetime;

use Illuminate\Support\ServiceProvider;

class ArabicdatetimeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('maherelgamil/arabicdatetime');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['arabicdatetime'] = $this->app->share(function($app)
        {
            return new Arabicdatetime;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
