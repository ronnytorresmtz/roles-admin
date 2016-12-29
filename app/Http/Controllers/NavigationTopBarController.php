<?php 

class NavigationTopBarController extends Controller {

	
	public function getHomeModule(){

		return View::make ('home/home');
	}
	
	public function getDashboardModule(){

		return View::make ('dashboard/dashboard_menu_options');
	}

	public function getFacilitiesModule(){

		return View::make ('facilities/facilities_menu_options');
	}

	public function getAcademicModule(){

		return View::make ('academic/academic_menu_options');	
	}

	public function getResourcesModule(){

		return View::make ('resources/resources_menu_options');
	}

	public function getInventoryModule(){

		return View::make ('inventory/inventory_menu_options');
	}

	public function getFixassetsModule(){

		return View::make ('fixassets/assets_menu_options');
	}

	public function getServicesModule(){

		return View::make ('services/services_menu_options');
	}

	public function getTreasuryModule(){

		return View::make ('treasury/treasury_menu_options');
	}

	public function getSecurityModule(){

		return View::make ('security/security_menu_options');
	}

	public function getSettingsModule(){

		return View::make ('settings/settings_menu_options');
	}

	public function getDataModule(){

		return View::make ('data/data_menu_options');
	}

	
}
