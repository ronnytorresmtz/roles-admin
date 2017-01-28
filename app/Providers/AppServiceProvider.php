<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Services
use MyCode\Services\Graph\GraphService;
use MyCode\Services\Mail\MailService;
use MyCode\Services\Notification\NotificationService;
use MyCode\Services\Login\LoginService;
use MyCode\Services\Validation\ValidationService;
use MyCode\Services\Document\DocumentService;
use MyCode\Services\AccessRights\AccessRightsService;
//RRepositories
use MyCode\Repositories\Role\RoleRepository;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepository;
use MyCode\Repositories\TransactionAction\TransactionActionRepository;
use MyCode\Repositories\User\UserRepository;
use MyCode\Repositories\Module\ModuleRepository;
use MyCode\Repositories\Transaction\TransactionRepository;
//AppUseRepository_Template Don´t Delete This Line

use  Module, Role, RoleTransaction, Transaction, TransactionAction, User;
//AppUseModel_Template Don´t Delete This Line



class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app->bind('MyCode\Repositories\User\UserRepositoryInterface', function($app) 
		{
			return new UserRepository(new User, new Role, new MailService, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Role\RoleRepositoryInterface', function($app) 
		{
			return new RoleRepository(new Role);
		});

		$this->app->bind('MyCode\Repositories\RoleTransaction\RoleTransactionRepositoryInterface', function($app) 
		{
			return new RoleTransactionRepository(new RoleTransaction);
		});

		$this->app->bind('MyCode\Repositories\TransactionAction\TransactionActionRepositoryInterface', function($app) 
		{
			return new TransactionActionRepository(new TransactionAction, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Module\ModuleRepositoryInterface', function($app) 
		{
			return new ModuleRepository(new Module, new GraphService);
		});

		$this->app->bind('MyCode\Repositories\Transaction\TransactionRepositoryInterface', function($app) 
		{
			return new TransactionRepository(new Transaction, new GraphService);
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
		$this->app->bind('MyCode\Services\General\GeneralServiceInterface','MyCode\Services\General\GeneralService');
		$this->app->bind('MyCode\Services\AccessRights\AccessRightsServiceInterface','MyCode\Services\AccessRights\AccessRightsService');


	}

}
