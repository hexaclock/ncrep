<?php

require_once 'File.php';

class Statistics extends File
{
	private $FileObj;
	private $numrows;
	private $pcaparr;
	private $protocounts;
	private $results;
	private $colformat;

	/* constructor */
	public function __construct($csvfname)
	{
		$this->FileObj = new File($csvfname);
		if ($this->FileObj->parseFile() == NULL)
			die("Failed to parse packet capture CSV file\n");
		$this->colformat = $this->FileObj->getColumnFormat();
		$this->pcaparr   = $this->FileObj->getPCAPArray();
		$this->numrows   = $this->FileObj->getNumRows();
		$this->analyze();
	}

	public function getProtocolsPercent()
	{
		$pcts = array();
		foreach ($this->protocounts as $proto => $protocnt)
		{
			$pcts[$proto] = round(($protocnt / ($this->numrows - 1))*100,2);
		}
		return $pcts;
	}

	public function getProtocolsCount()
	{
		return $this->protocounts;
	}

	public function getCredentials()
	{
		return $this->results;
	}

	private function analyze()
	{
		$prtclcol = 4;
		$infocol  = 6;
		$src      = "";
		$dst      = "";
		$proto    = "FTP";
		$user     = "";
		$pass     = "";
		for ($i=1; $i<$this->numrows; $i++)
		{
			if (!empty($this->protocounts) and array_key_exists($this->pcaparr[$i][$prtclcol],$this->protocounts))
				$this->protocounts[$this->pcaparr[$i][$prtclcol]]++;
			else
				$this->protocounts[$this->pcaparr[$i][$prtclcol]] = 1;
			if ( $this->pcaparr[$i][$prtclcol] == "FTP" and strpos($this->pcaparr[$i][$infocol],"USER") )
			{
				$src  = $this->pcaparr[$i][2];
				$dst  = $this->pcaparr[$i][3];
				$user = substr($this->pcaparr[$i][$infocol],14);
				for ($j=$i; $j<$this->numrows and $pass == ""; $j++)
				{
					if ($this->pcaparr[$j][2] == $src and $this->pcaparr[$j][3] == $dst and
					$this->pcaparr[$j][$prtclcol] == $proto and strpos($this->pcaparr[$j][$infocol],"PASS"))
					{
						$pass = substr($this->pcaparr[$j][$infocol],14);
						$this->results["ftpresults"][] = array("src"=>$src,"dst"=>$dst,"proto"=>$proto,"user"=>$user,"pass"=>$pass);
					}
				}
			}
			$user = "";
			$pass = "";
		}
		return $this->results;
	}
}

?>
