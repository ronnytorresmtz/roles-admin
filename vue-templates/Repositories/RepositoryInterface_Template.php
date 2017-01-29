<?php namespace MyCode\Repositories\ucfirstModelTemplate;

use MyCode\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ucfirstModelTemplateRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllucfirstModelTemplates($itemsByPage);
	public function getAllucfirstModelTemplatesActive($itemsByPage = null);
	public function getucfirstModelTemplateByID($id);
	public function getucfirstModelTemplateIDByucfirstModelTemplateName($roleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	//public function import($file);
	public function importFile($file);
	
}