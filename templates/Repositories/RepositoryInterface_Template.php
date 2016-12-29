<?php namespace Megacampus\Repositories\ucfirstModelTemplate;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ucfirstModelTemplateRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllucfirstModelTemplates();
	public function getucfirstModelTemplateNameByID($id);
	public function getucfirstModelTemplateIdByucfirstModelTemplateName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}