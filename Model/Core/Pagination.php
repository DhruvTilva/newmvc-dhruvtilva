<?php 

class Model_Core_Pagination{


	public $totalRecords = null;
	public $currentPage = null;
    public $recordPerPage = 10;
	public $numberOfPage  = null;
	public $start = 1;
	public $previous  = null;
	public $next  = null;
	public $end = null;	
	public $startLimit =null;




	//setter-getter all getpager or ser pager
	//pagination k baju me dropdown
	//block banse pagination


	// pela fetch all records from total records
	public function __construct($totalRecords, $currentPage)
	{
		$this->setTotalRecords($totalRecords);
		$this->setCurrentPage($currentPage);
	}

	public function calculate()
	{
		$this->numberOfPage = ceil($this->getTotalRecords()/10);
		$this->end = $this->getNumberOfPage();
		$this->previous = $this->currentPage-1;
		$this->next = ($this->currentPage >= $this->numberOfPage) ? 0 : $this->currentPage+1;
		$this->start = ($this->start == $this->currentPage) ? 0 : 1;
		$this->end = ($this->end == $this->currentPage) ? 0 : $this->numberOfPage;
		$this->startLimit = ($this->currentPage-1)*$this->getRecordPerPage();
	}


	public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function setTotalRecords($totalRecords)
    {
        $this->totalRecords = $totalRecords;

        return $this;
    }
    
    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    public function setRecordPerPage($recordPerPage)
    {
        $this->recordPerPage = $recordPerPage;

        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function getNumberOfPage()
    {
        return $this->numberOfPage;
    }

    public function setNumberOfPage($numberOfPage)
    {
        $this->numberOfPage = $numberOfPage;

        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setPrevious($previous)
    {
        $this->previous = $previous;

        return $this;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next = $next;

        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    public function getStartLimit()
    {
        return $this->startLimit;
    }

    public function setStartLimit($startLimit)
    {
        $this->startLimit = $startLimit;
        return $this;
    }


}
?>