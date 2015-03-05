Feature: Get Statistics on Packet Capture Files
	Scenario: One Capture File
		  Given the input file "allcap1.csv"
		  When ncrep is run with just stats requested
		  Then the screen output should be "45% HTTP, 30% FTP, 5% SSH, 20% other"

	Scenario: Directory Containing Capture Files
		  Given the input files in the directory "testcaps"
		  When ncrep is run with just stats requested
		  Then the screen output should be "23% HTTP, 2% FTP, 10% SSH, "18% DNS", "57% other"

	Scenario: No Files Given
		  Given no input file
		  When ncrep is run with just stats requested
		  Then the screen output should be "Please specify a packet capture CSV file"			     

	Scenario: Invalid CSV File
		  Given the input file "badfile.csv"
		  When ncrep is run with just stats requested
		  Then the screen output should be "The CSV file must contain at least a Protocol column"
