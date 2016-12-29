<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Megacampus\Services\Graph\GraphService;
use Megacampus\Services\Mail\MailService;
use Megacampus\Services\Notification\NotificationService;
use Megacampus\Services\Notification\NotificationServiceInterface;
use Megacampus\Services\Login\LoginService;
use Megacampus\Services\Validation\ValidationService;
use Megacampus\Services\Document\DocumentService;
use Megacampus\Services\Log\LogRepository;

use Megacampus\Repositories\Module\ModuleRepository;
use Megacampus\Repositories\Program\ProgramRepository;
use Megacampus\Repositories\Role\RoleRepository;
use Megacampus\Repositories\Transaction\TransactionRepository;
use Megacampus\Repositories\RoleTransaction\RoleTransactionRepository;
use Megacampus\Repositories\TransactionAction\TransactionActionRepository;
use Megacampus\Repositories\User\UserRepository;
use Megacampus\Repositories\Task\TaskRepository;
use Megacampus\Repositories\Institute\InstituteRepository;
use Megacampus\Repositories\Configuration\ConfigurationRepository;
use Megacampus\Repositories\Fee\FeeRepository;
use Megacampus\Repositories\Product\ProductRepository;
use Megacampus\Repositories\Building\BuildingRepository;
use Megacampus\Repositories\Campus\CampusRepository;
//AppUseRepository_Template Don´t Delete This Line

use Module, Program, Role, RoleTransaction, Task, TaskLog, Institute, TransactionAction, Transaction, User;
use Configuration;
use Campus;
//AppUseModel_Template Don´t Delete This Line








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
		// Megacampus/Storage

		/*$this->app->bind('\User', function($app)
		{
			return new User(new UserRepository, new loginService);
		});*/


		$this->app->bind('Megacampus\Repositories\User\UserRepositoryInterface', function($app) 
		{
			return new UserRepository(new User, new Role, new MailService, new GraphService);
		});

		$this->app->bind('Megacampus\Repositories\Program\ProgramRepositoryInterface', function($app)
		{
			return new ProgramRepository(new Program);
		});

		$this->app->bind('Megacampus\Repositories\Role\RoleRepositoryInterface', function($app) 
		{
			return new RoleRepository(new Role);
		});

		$this->app->bind('Megacampus\Repositories\Module\ModuleRepositoryInterface', function($app) 
		{
			return new ModuleRepository(new Module, new GraphService);
		});

		$this->app->bind('Megacampus\Repositories\Transaction\TransactionRepositoryInterface', function($app) 
		{
			return new TransactionRepository(new Transaction, new GraphService);
		});

		$this->app->bind('Megacampus\Repositories\RoleTransaction\RoleTransactionRepositoryInterface', function($app) 
		{
			return new RoleTransactionRepository(new RoleTransaction);
		});

		$this->app->bind('Megacampus\Repositories\TransactionAction\TransactionActionRepositoryInterface', function($app) 
		{
			return new TransactionActionRepository(new TransactionAction, new GraphService);
		});

		$this->app->bind('Megacampus\Repositories\Task\TaskRepositoryInterface', function($app) 
		{
			return new TaskRepository(new Task, new TaskLog);
		});

		$this->app->bind('Megacampus\Repositories\Institute\InstituteRepositoryInterface', function($app) 
		{
			return new InstituteRepository(new Institute, new GraphService);
		});
		
		$this->app->bind('Megacampus\Repositories\Configuration\ConfigurationRepositoryInterface', function($app) 
		{
			return new ConfigurationRepository(new Configuration, new GraphService);
		});
		
		$this->app->bind('Megacampus\Repositories\Campus\CampusRepositoryInterface', function($app) 
		{
			return new CampusRepository(new Campus, new GraphService);
		});
		
		//AppBind_Template Don´t Delete This Line




		$this->app->bind('Megacampus\Services\Login\LoginServiceInterface','Megacampus\Services\Login\LoginService');
		$this->app->bind('Megacampus\Services\Mail\MailServiceInterface','Megacampus\Services\Mail\MailService');
		$this->app->bind('Megacampus\Services\Notification\NotificationServiceInterface','Megacampus\Services\Notification\NotificationService');
		$this->app->bind('Megacampus\Services\Url\UrlServiceInterface','Megacampus\Services\Url\UrlService');	
		$this->app->bind('Megacampus\Services\Validation\ValidationServiceInterface','Megacampus\Services\Validation\ValidationService');
		$this->app->bind('Megacampus\Services\Document\DocumentServiceInterface','Megacampus\Services\Document\DocumentService');
		$this->app->bind('Megacampus\Services\Login\LoginServiceInterface','Megacampus\Services\Login\LoginService');
		$this->app->bind('Megacampus\Services\Graph\GraphServiceInterface','Megacampus\Services\Graph\GraphService');
		$this->app->bind('Megacampus\Services\Log\LogServiceInterface','Megacampus\Services\Log\LogService');

	}

}
