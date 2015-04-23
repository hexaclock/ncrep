<?php

require_once 'File.php';

class Statistics extends File
{
	private $FileObj;
	private $colformat;
	
	/* constructor */
	public function __construct($csvfname)
	{
		$this->FileObj = new File($csvfname);
		if ($this->FileObj->parseFile() == NULL)
			die("Failed to parse packet capture CSV file\n");
		$this->colformat = $this->FileObj->getColumnFormat();
	}
	
	public function getCredentials()
	{
		$pcaparr    = $this->FileObj->getPCAPArray();
		$ftpresults = $this->getFTPResults($pcaparr);
		return $ftpresults;
	}
	
	public function getFTPResults($pcaparr)
	{
		$numrows  = sizeof($pcaparr);
		$prtclcol = 4;
		$infocol  = 6;
		$src      = "";
		$dst      = "";
		$proto    = "FTP";
		$user     = "";
		$pass     = "";
		$results  = array();
		for ($i=1; $i<$numrows; $i++)
		{
			if ( $pcaparr[$i][$prtclcol] == "FTP" and strpos($pcaparr[$i][$infocol],"USER") )
			{
				$src  = $pcaparr[$i][2];
				$dst  = $pcaparr[$i][3];
				$user = substr($pcaparr[$i][$infocol],14);
				for ($j=$i; $j<$numrows and $pass == ""; $j++)
				{
					if ($pcaparr[$j][2] == $src and $pcaparr[$j][3] == $dst and 
					$pcaparr[$j][$prtclcol] == $proto and strpos($pcaparr[$j][$infocol],"PASS"))
					{
						$pass = substr($pcaparr[$j][$infocol],14);
						$results[] = array("src"=>$src,"dst"=>$dst,"proto"=>$proto,"user"=>$user,"pass"=>$pass);
					}
				}
			}
		}
		return $results;
	}
}

?>
