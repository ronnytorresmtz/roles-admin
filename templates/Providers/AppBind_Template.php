$this->app->bind('Megacampus\Repositories\ucfirstModelTemplate\ucfirstModelTemplateRepositoryInterface', function($app) 
		{
			return new ucfirstModelTemplateRepository(new ucfirstModelTemplate, new GraphService);
		});
		//AppBind_Template Don´t Delete This Line
