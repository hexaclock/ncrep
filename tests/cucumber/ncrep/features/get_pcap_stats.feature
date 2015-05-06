Feature: Get Credentials and Statistics from Packet Capture CSV File
	Scenario: No File Specified
		  Given no input file
		  When ncrep is run
		  Then ncrep should display "usage: php ncrep-cli <CSV packet capture file>"

	Scenario: Invalid CSV File
		  Given the input file badfile.csv
		  When ncrep is called
		  Then the screen output should be "Invalid CSV file"

	Scenario: Find FTP Credentials
	 	   Given the input file "test.csv"
		   When ncrep is executed
		   Then the screen output should be "User: anonymous Password: anonymous"

	Scenario: Get Statistics
		  Given the input file "test1.csv"
		  When ncrep runs
		  Then the screen output should have "The total number of packets read from the file"