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
//View Composer
use App\Http\ViewComposers\NavigationTopBarComposer;
use App\Http\ViewComposers\SubMenuOptionsComposer;
//RRepositories
use MyCode\Repositories\Program\ProgramRepository;
use MyCode\Repositories\Role\RoleRepository;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepository;
use MyCode\Repositories\TransactionAction\TransactionActionRepository;
use MyCode\Repositories\User\UserRepository;
use MyCode\Repositories\Task\TaskRepository;
use MyCode\Repositories\Institute\InstituteRepository;
use MyCode\Repositories\Configuration\ConfigurationRepository;
use MyCode\Repositories\Fee\FeeRepository;
use MyCode\Repositories\Product\ProductRepository;
use MyCode\Repositories\Building\BuildingRepository;
use MyCode\Repositories\Campus\CampusRepository;
use MyCode\Repositories\Country\CountryRepository;
use MyCode\Repositories\State\StateRepository;
use MyCode\Repositories\City\CityRepository;
use MyCode\Repositories\Language\LanguageRepository;
use MyCode\Repositories\Plan\PlanRepository;
use MyCode\Repositories\Company\CompanyRepository;
use MyCode\Repositories\Module\ModuleRepository;
//AppUseRepository_Template Don´t Delete This Line

use Program, Role, RoleTransaction, Task, TaskLog, Institute, TransactionAction, User;
use Configuration, Campus, Country, State, City, Language;
use Plan;
use Company;
use Module;
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
		
		$this->app->bind('MyCode\Repositories\Configuration\ConfigurationRepositoryInterface', function($app) 
		{
			return new ConfigurationRepository(new Configuration, new GraphService);
		});
		
		$this->app->bind('MyCode\Repositories\Campus\CampusRepositoryInterface', function($app) 
		{
			return new CampusRepository(new Campus, new GraphService);
		});
		
		$this->app->bind('MyCode\Repositories\Country\CountryRepositoryInterface', function($app) 
		{
			return new CountryRepository(new Country, new GraphService);
		});
	
		$this->app->bind('MyCode\Repositories\State\StateRepositoryInterface', function($app) 
		{
			return new StateRepository(new State, new GraphService);
		});
	
		$this->app->bind('MyCode\Repositories\City\CityRepositoryInterface', function($app) 
		{
			return new CityRepository(new City, new GraphService);
		});
	
		$this->app->bind('MyCode\Repositories\Language\LanguageRepositoryInterface', function($app) 
		{
			return new LanguageRepository(new Language, new GraphService);
		});
	
		$this->app->bind('MyCode\Repositories\Plan\PlanRepositoryInterface', function($app) 
		{
			return new PlanRepository(new Plan, new GraphService);
		});
	
		$this->app->bind('MyCode\Repositories\Company\CompanyRepositoryInterface', function($app) 
		{
			return new CompanyRepository(new Company, new GraphService);
		});
		
		$this->app->bind('MyCode\Repositories\Module\ModuleRepositoryInterface', function($app) 
		{
			return new ModuleRepository(new Module, new GraphService);
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
