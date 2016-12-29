<?php namespace Megacampus\Services\Graph;


Interface GraphServiceInterface {

	/**
	* Make a Hightlight Graph
	*
	* @param 	$request: 
	*
	* @return 	Boolean: 
	*/
	public function makeGraph($type, $xAxisArray, $xAxisName, $yAxisName, $values, $renderTo);
	public function makeDailyGraph($type, $yAxisName, $values, $renderTo);
	public function makeMonthlyGraph($type, $yAxisName, $values, $MonthlyFormat, $renderTo);

}