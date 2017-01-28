<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use MyCode\Services\Graph\GraphService;
use MyCode\Services\Mail\MailService;
use MyCode\Services\Notification\NotificationService;
use MyCode\Services\Notification\NotificationServiceInterface;
use MyCode\Services\Login\LoginService;
use MyCode\Services\Validation\ValidationService;
use MyCode\Services\Document\DocumentService;
use MyCode\Services\Log\LogRepository;

use MyCode\Repositories\Module\ModuleRepository;
use MyCode\Repositories\Program\ProgramRepository;
use MyCode\Repositories\Role\RoleRepository;
use MyCode\Repositories\Transaction\TransactionRepository;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepository;
use MyCode\Repositories\TransactionAction\TransactionActionRepository;
use MyCode\Repositories\User\UserRepository;
use MyCode\Repositories\Task\TaskRepository;
use MyCode\Repositories\Institute\InstituteRepository;
//AppUseModel_Template Don´t Delete This Line



use Module, Program, Role, RoleTransaction, Task, TaskLog, Institute, TransactionAction, Transaction, User;
//AppUseRepository_Template Don´t Delete This Line


class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// MyCode/Storage

		/*$this->app->bind('\User', function($app)
		{
			return new User(new UserRepository, new loginService);
		});*/


		$this->app->bind('MyCode\Repositories\User\UserRepositoryInterface', function($app) 
		{
			return new UserRepository(new User, new Role, new MailService, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Program\ProgramRepositoryInterface', function($app)
		{
			return new ProgramRepository(new Program);
		});

		$this->app->bind('MyCode\Repositories\Role\RoleRepositoryInterface', function($app) 
		{
			return new RoleRepository(new Role);
		});

		$this->app->bind('MyCode\Repositories\Module\ModuleRepositoryInterface', function($app) 
		{
			return new ModuleRepository(new Module, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Transaction\TransactionRepositoryInterface', function($app) 
		{
			return new TransactionRepository(new Transaction, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\RoleTransaction\RoleTransactionRepositoryInterface', function($app) 
		{
			return new RoleTransactionRepository(new RoleTransaction);
		});

		$this->app->bind('MyCode\Repositories\TransactionAction\TransactionActionRepositoryInterface', function($app) 
		{
			return new TransactionActionRepository(new TransactionAction, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Task\TaskRepositoryInterface', function($app) 
		{
			return new TaskRepository(new Task, new TaskLog);
		});

		$this->app->bind('MyCode\Repositories\Institute\InstituteRepositoryInterface', function($app) 
		{
			return new InstituteRepository(new Institute, new GraphService);
		});
		//AppBind_Template Don´t Delete This Line


		

		$this->app->bind('MyCode\Services\Login\LoginServiceInterface','MyCode\Services\Login\LoginService');
		$this->app->bind('MyCode\Services\Mail\MailServiceInterface','MyCode\Services\Mail\MailService');
		$this->app->bind('MyCode\Services\Notification\NotificationServiceInterface','MyCode\Services\Notification\NotificationService');
		$this->app->bind('MyCode\Services\Url\UrlServiceInterface','MyCode\Services\Url\UrlService');	
		$this->app->bind('MyCode\Services\Validation\ValidationServiceInterface','MyCode\Services\Validation\ValidationService');
		$this->app->bind('MyCode\Services\Document\DocumentServiceInterface','MyCode\Services\Document\DocumentService');
		$this->app->bind('MyCode\Services\Login\LoginServiceInterface','MyCode\Services\Login\LoginService');
		$this->app->bind('MyCode\Services\Graph\GraphServiceInterface','MyCode\Services\Graph\GraphService');
		$this->app->bind('MyCode\Services\Log\LogServiceInterface','MyCode\Services\Log\LogService');

	}

}
