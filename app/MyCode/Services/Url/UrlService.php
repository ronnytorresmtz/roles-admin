<?php namespace MyCode\Services\Url;

use Session, URL;

class UrlService implements UrlServiceInterface {


	public function setUrlPrevious() {

		Session::put('UrlPrevious',URL::previous());
	}


	public function getUrlPrevious($option){

		//Define the URL to Go Back to the Same Page of the Program List
		if (strpos(URL::previous(),'search_value=')!==false){
			$UrlPrevious= $option .'/search?' . strstr(URL::previous(), 'search_value=');
		}else{
			if (strpos(Session::get('UrlPrevious'),'page=')!==false){
				$UrlPrevious= $option .'?' . strstr(Session::get('UrlPrevious'), 'page=');
			}else{
				if (strpos(URL::previous(),'page=')!==false){
					$UrlPrevious= $option .'?' . strstr(URL::previous(), 'page=');
				}else{
					$UrlPrevious= $option .'/';
				}
			}
		}
		
		//store in the session object the previous URL
		Session::put('UrlPrevious',$UrlPrevious);
		
	}

	public function forgetUrlPrevious(){

		Session::forget('UrlPrevious');
	}


}