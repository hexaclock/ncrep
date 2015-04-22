<?php

class File
{
	var $csvfname;
	var $twodarr;

	/* constructor */
	public function __construct($csvfname)
	{
		$this->csvfname = $csvfname;
		$this->twodarr  = array();
	}
	
	/*
	 *pre: takes a filename of a CSV packet capture from $this->csvfname
	 *post: returns a 2d array of the parsed file if success, NULL if any failure
	*/
	public function parseFile()
	{
		if ( ($fh = fopen($this->csvfname,'r')) )
		{
			while ( ($dat = fgetcsv($fh, 1000, ',')) )
				$this->twodarr[] = $dat;
			fclose($fh);
			if (!$this->validateArray())
			{
				$this->twodarr = array();
				return NULL;
			}
			else
				return $this->twodarr;
		}
		return NULL;
	}
	
	public function printPCAP()
	{
		if (!empty($this->twodarr))
		{
			foreach ($this->twodarr as $row)
			{
				foreach ($row as $field)
				{
					echo "$field ";
				}
				echo "\n";
			}
		}
	}

	/*
	 *pre: requires a populated $this->twodarr
	 *post: returns TRUE if the array meets file format reqs, FALSE if not
	*/
	private function validateArray()
	{
		$colnames = array();

		foreach ($this->twodarr[0] as $colname)
		{
			if ($colname == "No." || $colname == "Time" || $colname == "Destination"
				|| $colname == "Protocol" || $colname == "Length" || $colname == "Info")
				{
					if (!in_array($colname,$colnames))
						$colnames[] = $colname;
					else
						return FALSE;
				}
			else
				return FALSE;
		}
		if (sizeof($colnames) != 7)
			return FALSE;
		return TRUE;
	}
}

?>

