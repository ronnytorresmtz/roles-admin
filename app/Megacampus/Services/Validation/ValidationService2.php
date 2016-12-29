<?php namespace Megacampus\Services\Validation;


use Lang, URL, Session, Validator;

class ValidationService2 implements ValidationServiceInterface {


	public function validateInputs($model, $request, $form, $messages) {
		//validate the input request with the rules and messages define
		$validator=Validator::make($request, $model->getInputRules($form, $request), $model->getInputMessages($messages));
		//return the validations result
		return $validator;
	}

	public function getIdChecked($request, $message){

		//get all items checked
		$checked_items= $request->input('checked_items');
		//get the first item checked 
		if (isset($checked_items)){	

			$checked_item=array_shift($checked_items);

		} else{
			
			if ($message) Session::flash('error', Lang::get('messages.error_checked_item'));

			$checked_item=0;
		}

		return $checked_item;

	}

	public function getAllIdChecked($request, $message){

		//get the item checked
		$checked_items= $request->input('checked_items');
		//if the an item is checked return the id
		if (! isset($checked_items)){	

			if ($message) Session::flash('error', Lang::get('messages.error_checked_item'));

			$checked_items=0;
		}

		return $checked_items;

	}

	public function getFile($request, $message){

		$file= $request->file('fileToImport');
		//validate the request if file is missing send an error to user
		if (empty($file)) {
				
			if ($message) Session::flash('error', Lang::get('messages.error_file_missing'));
		}

		return $file;

	}


}