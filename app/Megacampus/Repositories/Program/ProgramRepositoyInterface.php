<?php namespace Megacampus\Repositories\Program;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ProgramRepositoryInterface extends MyEloquentRepositoryInterface
{
	
	public function getModel();
	public function getAllPrograms();
	public function getAllProgramsByPage($itemsByPage);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	public function importFile($file);
	
}