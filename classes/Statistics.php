<?php

require_once 'File.php';

class Statistics extends File
{
	private $FileObj;
	private $numrows;
	private $colformat;

	/* constructor */
	public function __construct($csvfname)
	{
		$this->FileObj = new File($csvfname);
		if ($this->FileObj->parseFile() == NULL)
			die("Failed to parse packet capture CSV file\n");
		$this->colformat = $this->FileObj->getColumnFormat();
		$this->numrows = sizeof($this->FileObj->getPCAPArray());
	}

	public function getProtocolsCount()
	{
		$protocounts = array();
		$prtclcol = 4;
		$pcaparr = $this->FileObj->getPCAPArray();
		for ($i=1; $i<$this->numrows; $i++)
		{
			$proto = $pcaparr[$i][$prtclcol];
			if (array_key_exists($proto,$protocounts))
				$protocounts[$proto]++;
			else
				$protocounts[$proto] = 1;
		}
		return $protocounts;
	}

	public function getCredentials()
	{
		$pcaparr    = $this->FileObj->getPCAPArray();
		$ftpres     = $this->getFTPResults($pcaparr);
		return array("ftpresults"=>$ftpres);
	}

	public function getFTPResults($pcaparr)
	{
		$prtclcol = 4;
		$infocol  = 6;
		$src      = "";
		$dst      = "";
		$proto    = "FTP";
		$user     = "";
		$pass     = "";
		$results  = array();
		for ($i=1; $i<$this->numrows; $i++)
		{
			if ( $pcaparr[$i][$prtclcol] == "FTP" and strpos($pcaparr[$i][$infocol],"USER") )
			{
				$src  = $pcaparr[$i][2];
				$dst  = $pcaparr[$i][3];
				$user = substr($pcaparr[$i][$infocol],14);
				for ($j=$i; $j<$this->numrows and $pass == ""; $j++)
				{
					if ($pcaparr[$j][2] == $src and $pcaparr[$j][3] == $dst and
					$pcaparr[$j][$prtclcol] == $proto and strpos($pcaparr[$j][$infocol],"PASS"))
					{
						$pass = substr($pcaparr[$j][$infocol],14);
						$results[] = array("src"=>$src,"dst"=>$dst,"proto"=>$proto,"user"=>$user,"pass"=>$pass);
					}
				}
			}
			$user = "";
			$pass = "";
		}
		return $results;
	}
}

?>
