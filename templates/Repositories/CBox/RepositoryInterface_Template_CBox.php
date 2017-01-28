<?php namespace MyCode\Repositories\ucfirstModelTemplate;

use MyCode\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ucfirstModelTemplateRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllucfirstModelTemplatesByPage($itemsByPage);
	public function getAllucfirstModelTemplates();
	public function getucfirstModelTemplateNameByID($id);
	public function getucfirstModelTemplateIdByucfirstModelTemplateName($moduleName);
	public function finducfirstModelTemplate($request);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file, $selectTemplateID);
	
}