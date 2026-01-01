<?php

require("listview.render.php");

/**
 * Listview
 *
 * Listview class can generate a list of a given array
 *
 * @package Elements
 * @version 1.0
 * @author Tom Reitsma <treitsma@rse.nl>
 */

Class Listview
{
	private $data 				= array();
	private $columns    		= array();
	private $dataParsed;
	private $sortDirection;
	private $newSortDirection;
	private $sortKey;
	private $dataPrepared;
	private $finalParts;
	private $render;
	
	/**
	 * class constructor
	 */
	
	public function __construct()
	{
		if(isset($_GET["sortDirection"]))
		{
			$this->sortDirection = $_GET["sortDirection"];
		}
		else 
		{
			$this->sortDirection = "ASC";
		}
		
		if($this->sortDirection == "ASC")
		{
			$this->newSortDirection = "DESC";
		}
		else if($this->sortDirection == "DESC")
		{
			$this->newSortDirection = "ASC";
		}
		
		if (isset($_GET["sortKey"]))
		{
			$this->sortKey = $_GET["sortKey"];
		}
		else
		{
		    $this->sortKey = 0;
		}
	}
	
	/**
	 * addData()
	 * adds data
	 */
	
	public function addData($data)
	{
		foreach($data as $dat)
		{
			$this->setData($dat);
		}
	}
	/**
	 * getData()
	 * gets a given data entry
	 */
	public function getData($entry)
	{
		return $this->data[$entry];
	}
	
	/**
	 * setData()
	 * sets a given data entry
	 */
	
	public function setData($data)
	{
		$this->data[count($this->data)+1] = $data;
	}
	
	/**
	 * addColumn()
	 * adds a collumn
	 */
	
	public function addColumn($column_name, $column_width = "100px", $column_outline = "left")
	{
		$this->columns[] = array($column_name, $column_width, $column_outline);
	}
	
	/**
	 * getColumnCount()
	 * returns the number of existing columns
	 */
	
	public function getColumnCount()
	{
		return count($this->columns);
	}
	
	/**
	 * columnExists()
	 * checks wether a column is created or not
	 */
	
	public function columnExists($columnId)
	{
		if($this->columns[$columnId])
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/**
	 * sortData()
	 * sorts the data by the given values in the URL
	 */
	
	public function sortData()
	{   
	    // Make a [col][row] data variable.
	    $reverseData = array();
	    
	    foreach ($this->data as $row=>$colArray)
	    {
	    	if(is_array($colArray))
	    	{
	        	foreach ($colArray as $col=>$value)
	        	{
	        	   	$reverseData[$col][$row] = $value;
	        	}
	    	}
	    	else 
	    	{
	    		$reverseData[$colArray[0]][$row] = $colArray[1];
	    	}
	    }
	    
	    $columnToSort = $reverseData[$this->sortKey];
	    $sortedColumn =  $columnToSort;
	    
	    if($this->sortDirection == "DESC" && is_array($sortedColumn))
	    {
	    	rsort($sortedColumn);
	    }
	    else if(is_array($sortedColumn))
	    {
	    	sort($sortedColumn);
	    }
	    
        foreach($sortedColumn as $key=>$value)
        {
            foreach ($columnToSort as $key2=>$value2)
            {
                if ($value == $value2)
                {
                    $referenceHash[$key2] = $key;
                    $columnToSort[$key2] = false;
                    break;
                }
            }
        }
        
        foreach ($referenceHash as $key=>$keyTo)
        {
            $newData[$keyTo] = $this->data[$key];
        }
        
        $this->data = $newData;
	}
	
	/**
	 * parseData()
	 * checks if the data is valid and prepares it for output
	 */
	public function parseData()
	{
		foreach ($this->data as $id => $data_content)
		{
			$return_data .= $this->getData($id);
		}
		
		$this->dataParsed = true;
		return $return_data;
	}
	
	/**
	 * drawList()
	 * outputs the table
	 */
	
	public function drawList()
	{
		$this->sortData();

		$this->render = new ListviewGui($this->data, $this->columns);
		
			 $this->render->renderPre();
			 $this->render->render();
		echo $this->render->renderFinal();
	}	 
}

?>