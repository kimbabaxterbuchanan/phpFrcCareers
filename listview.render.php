<?php
/**
* Listview gui
*
* This renders the list
*
*/
Class ListviewGui #implements iRender 
{
	private $data;
	private $columns;
	private $rendered;
	private $sortDirection;
	private $newSortDirection;
	
	/**
	 * Constructor
	 */
    public function __construct($data, $columns)
    {
    	$this->data = $data;
    	$this->columns = $columns;
    	
    	
    	$this->sortDirection = $_GET["sortDirection"];
    	
		if($this->sortDirection == "ASC")
		{
			$this->newSortDirection = "DESC";
		}
		else #if($this->sortDirection == "DESC")
		{
			$this->newSortDirection = "ASC";
		}
    }
    
    /**
     * Destructor
     */
    public function __destruct()
    {
    	// left, once again, intentionally blank
    }
    
    /**
     * Return everything to string
     */
    public function __toString()
    {
    	return $this->data;
    }
    
    /**
     * renderPre
     *
     * Outputs information required before the actual element or child elements
     *
     * @return string
     */
    public function renderPre()
    {
    	$this->rendered .= "<table>";
    	$this->rendered .= "   <tr>\n";
    }
    
    /**
     * render
     *
     * renders the actual element or child elements
     *
     * @return string
     */
    public function render()
    {
		foreach($this->columns as $key => $column)
		{
			if($this->newSortDirection == "")
			{
				$this->newSortDirection = "DESC";
			}
			$this->rendered .= "      <td align=\"$column[2]\" style=\"width:$column[1]\">
				   				  <a href=\"?sortKey=$key&sortDirection=$this->newSortDirection\">$column[0]</a></td>\n";
		}
		$this->rendered .= "   <tr>\n";
		
		foreach($this->data as $data)
		{
			$this->rendered.= "   <tr>\n";
			foreach($data as $data2)
			{
				$this->rendered .= "\t\t<td>$data2</td>\n";
			}
			$this->rendered .= "   </tr>\n";
		}
		$this->rendered .= "</table>";
    }
    
    /**
     * renderPost
     *
     * Render all required data after the element.
     *
     * @return string
     */
    public function renderFinal()
    {
		return $this->rendered;
    }
}

?>