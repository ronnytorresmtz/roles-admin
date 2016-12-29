<?php namespace Megacampus\Services\Graph;

use Lang;

class GraphService implements GraphServiceInterface {

	
	public function makeGraph($type, $xAxisArray, $xAxisName, $yAxisName, $values, $renderTo)
	{
		$chartArray['chart']    = array('type'=> $type, 'renderTo' => $renderTo); 
		$chartArray['credits']  = array('enabled'=> false); 
		$chartArray['title']    = array('text'=> '', 'x'=> -20); //-20 center
		$chartArray['subtitle'] = array('text'=> '', 'x'=> -20); //-20 center
		
		$chartArray['xAxis']   = array(
			'title'      => array('text' => $xAxisName), 
			'categories' => $xAxisArray
		); 
		
		$chartArray['yAxis']    = array(
			'title'     => array('text' => $yAxisName), 
			'plotLines' => array(array('value'=>0, 'width' => 1, 'color' => '#808080'))
		); 
		    
		$chartArray['series'][]  = array(
			'showInLegend' => false, 
			'name'         => $yAxisName, 
			'data'         => $values,
	     ); 

		$chartArray['exporting']  = array(
			'enabled' => false, 
		);


	     return	$chartArray;
	}



	public function makeDailyGraph($type, $yAxisName, $values, $renderTo)
	{
		//$chartArray['chart']    = array('type'=> $type, 'renderTo' => $renderTo); 
		$chartArray['chart']    = array('type'=> $type); 
		$chartArray['credits']  = array('enabled'=> false); 
		$chartArray['title']    = array('text'=> '', 'x'=> -20); //-20 center
		$chartArray['subtitle'] = array('text'=> '', 'x'=> -20); //-20 center
		$chartArray['renderTo'] = array('type'=> $renderTo); 
		
		$chartArray['xAxis']   = array(
			'title'      => array('text' => Lang::get('calendar.days')), 
			'categories' => Lang::get('calendar.'. date('t'))
		); 
		
		$chartArray['yAxis']    = array(
			'title'     => array('text' => $yAxisName), 
			'plotLines' => array(array('value'=>0, 'width' => 1, 'color' => '#808080')),
			'min'		=> 0
		); 
		    
		$chartArray['series'][]  = array(
			'showInLegend' => false, 
			'name'         => $yAxisName, 
			'data'         => $values,
	     ); 

		$chartArray['exporting']  = array(
			'enabled' => false, 
		);

		$chartArray['tooltip']  = array( 
			'useHTML'       => true,
			'headerFormat'  => '<small style="color: {series.color}">' . Lang::get('calendar.day') . ': {point.key}</small> <br>',
			);


	    return $chartArray;

	}

	public function makeMonthlyGraph($type, $yAxisName, $values, $MonthlyFormat, $renderTo)
	{
		$chartArray['chart']    = array('type'=> $type, 'renderTo' => $renderTo); 
		$chartArray['credits']  = array('enabled'=> false); 
		$chartArray['title']    = array('text'=> '', 'x'=> -20); //-20 center
		$chartArray['subtitle'] = array('text'=> '', 'x'=> -20); //-20 center
		
		$chartArray['xAxis']   = array(
			'title'      => array('text' => Lang::get('calendar.months')), 
			'categories' => Lang::get('calendar.' . $MonthlyFormat)  //shortMonths, longMonths, numericMonths
		); 
		
		$chartArray['yAxis']    = array(
			'title'     => array('text' => $yAxisName), 
			'plotLines' => array(array('value'=>0, 'width' => 1, 'color' => '#808080'))
		); 
		    
		$chartArray['series'][]  = array(
			'showInLegend' => false, 
			'name'         => $yAxisName, 
			'data'         => $values,
	     ); 

		$chartArray['exporting']  = array(
			'enabled' => false, 
		);

		$chartArray['tooltip']  = array( 
			'useHTML'       => true,
			'headerFormat'  => '<small style="color: {series.color}">{point.key}</small> <br>',
			);

	     return	$chartArray;
	}


}