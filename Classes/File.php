<?php

class File
{
	var $twodarr;

	/*
	 *pre: takes a filename of a CSV packet capture as $csvfname
	 *post: returns a 2d array of the parsed file if success, NULL if any failure
	*/
	public function parseFile($csvfname)
	{
		$this->twodarr = array();
		if ( ($fh = fopen($csvfname,'r')) )
		{
			while ( ($dat = fgetcsv($fh, 1000, ',')) )
				$this->twodarr[] = $dat;
			fclose($fh);
			if (!validateArray())
			{
				$this->twodarr = array();
				return null;
			}
			else
				return $this->twodarr;
		}
		return null;
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
					if (!in_array($colname))
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

