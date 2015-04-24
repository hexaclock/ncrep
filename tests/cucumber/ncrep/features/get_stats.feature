Feature: Get Statistics on Packet Capture Files
	Scenario: One Capture File
		  Given the input file "allcap1.csv"
		  When ncrep is run with just stats requested
		  Then the screen output should show the the number of packets captured and # packets per protocol

	Scenario: No Files Given
		  Given no input file
		  When ncrep is run with just stats requested
		  Then the screen output should be "usage: php ncrep-cli <list of CSV files>"			     

	Scenario: Invalid CSV File
		  Given the input file "badfile.csv"
		  When ncrep is run with just stats requested
		  Then the screen output should be "Invalid CSV file"
