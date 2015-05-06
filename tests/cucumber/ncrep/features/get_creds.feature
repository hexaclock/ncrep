Feature: Get Credentials from Packet Capture CSV File
	Scenario: Find FTP Credentials
	 	   Given the input file "test.csv"
		   When ncrep is executed
		   Then the screen output should be "User: anonymous Password: anonymous"
