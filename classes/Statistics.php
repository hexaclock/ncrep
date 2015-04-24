<?php

require_once 'File.php';

class Statistics extends File
{
	private $FileObj;
	private $numrows;
	private $pcaparr;
	private $protocounts;
	private $srcipcounts;
	private $dstipcounts;
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
	public function displayCredentialsTable()
	{
		if(isset($this->results))
                {
			foreach($this->results as $key => $arr2)
                        {
                        	foreach($arr2 as $key => $arr1)
                                {
                                	echo "<tr>";
                                        echo "<td>".$arr1['proto']."</td>";
                                        echo "<td>".$arr1['src']."</td>";
                                        echo "<td>".$arr1['dst']."</td>";
                                        echo "<td>".$arr1['user']."</td>";
                                        echo "<td>".$arr1['pass']."</td>";
                                        echo "</tr>";
                                }
                         }
                 }
	}
	/*
	 *pre: takes an IP address as a string
	 *post: returns the number of times the IP address appeared as the source
	*/
	public function getSrcCountForIP($ipaddr)
	{
		return $this->srcipcounts[$ipaddr];
	}

	/*
	 *pre: takes an IP address as a string
	 *post: returns the number of times the IP address appeared the destination
	*/
	public function getDstCountForIP($ipaddr)
	{
		return $this->dstipcounts[$ipaddr];
	}

	/*
	 *pre: takes an IP address as a string
	 *post: returns number of times the IP address appeared as src or dst
	*/
	public function getTotalCountForIP($ipaddr)
	{
		return $this->getSrcCountForIP($ipaddr) + $this->getDstCountForIP($ipaddr);
	}

	/*
	 *returns the number of packet dissections read in from the CSV file
	*/
	public function getTotalPacketsCount()
	{
		return $this->numrows - 1;
	}

	/*
	 *returns an array of protocols mapped to percents of the total number of packets read
	*/
	public function getProtocolsPercent()
	{
		$pcts = array();
		foreach ($this->protocounts as $proto => $protocnt)
		{
			$pcts[$proto] = round(($protocnt / ($this->numrows - 1))*100,2);
		}
		return $pcts;
	}

	/*
	 *returns an array of protocols mapped to times we saw the protocol
	*/
	public function getProtocolsCount()
	{
		return $this->protocounts;
	}

	/*
	 *returns a 3D array of credentials found for each protocol
	*/
	public function getCredentials()
	{
		return $this->results;
	}

	/*
	 *this function is called from the constructor.
	 *it automatically populates the appropriate data members with stats on pcap data.
	*/
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

			if (!empty($this->srcipcounts) and array_key_exists($this->pcaparr[$i][2],$this->srcipcounts))
				$this->srcipcounts[$this->pcaparr[$i][2]]++;
			else
				$this->srcipcounts[$this->pcaparr[$i][2]] = 1;

			if (!empty($this->dstipcounts) and array_key_exists($this->pcaparr[$i][3],$this->dstipcounts))
				$this->dstipcounts[$this->pcaparr[$i][3]]++;
			else
				$this->dstipcounts[$this->pcaparr[$i][3]] = 1;

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
