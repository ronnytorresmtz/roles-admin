<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//Services
use Megacampus\Services\Graph\GraphService;
use Megacampus\Services\Mail\MailService;
use Megacampus\Services\Notification\NotificationService;
use Megacampus\Services\Login\LoginService;
use Megacampus\Services\Validation\ValidationService;
use Megacampus\Services\Document\DocumentService;
use Megacampus\Services\AccessRights\AccessRightsService;
//View Composer
use App\Http\ViewComposers\NavigationTopBarComposer;
use App\Http\ViewComposers\SubMenuOptionsComposer;
//RRepositories
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
use Megacampus\Repositories\Country\CountryRepository;
use Megacampus\Repositories\State\StateRepository;
use Megacampus\Repositories\City\CityRepository;
use Megacampus\Repositories\Language\LanguageRepository;
use Megacampus\Repositories\Plan\PlanRepository;
use Megacampus\Repositories\Company\CompanyRepository;
//AppUseRepository_Template Don´t Delete This Line

use Module, Program, Role, RoleTransaction, Task, TaskLog, Institute, TransactionAction, Transaction, User;
use Configuration, Campus, Country, State, City, Language;
use Plan;
use Company;
//AppUseModel_Template Don´t Delete This Line








class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// define the view composer for the menu in the top bar
		view()->composer(array('php.navigation_topbar'), 'App\Http\ViewComposers\NavigationTopBarComposer');

		// define the view composer for the menu in the left bar
		view()->composer(
			array(
				'php.display_left_submenus',
				'php.action_buttons',
				'php.display_submenus',
				'settings.maintenance_tasks.list'), 

				'App\Http\ViewComposers\SubMenuOptionsComposer'
		);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

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
		
		$this->app->bind('Megacampus\Repositories\Country\CountryRepositoryInterface', function($app) 
		{
			return new CountryRepository(new Country, new GraphService);
		});
		$this->app->bind('Megacampus\Repositories\State\StateRepositoryInterface', function($app) 
		{
			return new StateRepository(new State, new GraphService);
		});
		$this->app->bind('Megacampus\Repositories\City\CityRepositoryInterface', function($app) 
		{
			return new CityRepository(new City, new GraphService);
		});
		$this->app->bind('Megacampus\Repositories\Language\LanguageRepositoryInterface', function($app) 
		{
			return new LanguageRepository(new Language, new GraphService);
		});
		$this->app->bind('Megacampus\Repositories\Plan\PlanRepositoryInterface', function($app) 
		{
			return new PlanRepository(new Plan, new GraphService);
		});
		$this->app->bind('Megacampus\Repositories\Company\CompanyRepositoryInterface', function($app) 
		{
			return new CompanyRepository(new Company, new GraphService);
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
		$this->app->bind('Megacampus\Services\General\GeneralServiceInterface','Megacampus\Services\General\GeneralService');
		$this->app->bind('Megacampus\Services\AccessRights\AccessRightsServiceInterface','Megacampus\Services\AccessRights\AccessRightsService');


	}

}
