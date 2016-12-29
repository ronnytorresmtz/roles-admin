<?php namespace Megacampus\Repositories\Language;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface LanguageRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllLanguages();
	public function getLanguageNameByID($id);
	public function getLanguageIdByLanguageName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}