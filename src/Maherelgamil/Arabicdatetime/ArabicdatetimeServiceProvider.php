<?php namespace Maherelgamil\Arabicdatetime;

use Illuminate\Support\ServiceProvider;

/**
 * @author Maher El Gamil <maherbusnes@gmail.com>
 * Class ArabicdatetimeServiceProvider
 * @package Maherelgamil\Arabicdatetime
 */
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
	public function boot(){

		//load & publish langs
		$this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'arabicdatetime');

		$this->publishes([
			__DIR__.'/../../resources/lang' => base_path('resources/lang/vendor/arabicdatetime'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(){
		$this->app->bind('arabicdatetime', function ()
		{
			return new Arabicdatetime();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides(){
		return ['arabicdatetime'];
	}

}
