Feature: Error checking
	Scenario: No File Specified
		  Given no input file
		  When ncrep is run
		  Then ncrep should display "usage: php ncrep-cli <CSV packet capture file>"

	Scenario: Invalid CSV File
		  Given the input file badfile.csv
		  When ncrep is called
		  Then the screen output should be "Invalid CSV file"