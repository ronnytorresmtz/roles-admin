<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Event;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	/*protected $listen = [
		'event.name' => ['EventListener',
		],
	];*/

	protected $listen = [
		'App\Events\RegisterTransactionAccessEvent' => ['App\Listeners\RegisterTransactionAccessListener',
		],
	];

	

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		Event::listen('App\Events\RegisterTransactionAccessEvent',
                    'App\Listeners\RegisterTransactionAccessListener');

		//
	}

}
