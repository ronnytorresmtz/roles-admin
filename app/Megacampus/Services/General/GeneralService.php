<?php namespace Megacampus\Services\General;

use Lang, File;

class GeneralService implements GeneralServiceInterface {

	
	public function setKeyAndNameToArray($collection, $itemField)
	{
		foreach ($collection as $item) {
			$array[$item->id] = $item->$itemField;
		}

		return $array;
	}

}