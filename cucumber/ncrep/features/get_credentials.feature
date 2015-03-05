Feature: Get Credentials from Packet Capture CSV File
	Scenario: No File Specified
		  Given no input file
		  When ncrep is run
		  Then the screen output should "Please specify a packet capture CSV file"

	Scenario: Find HTTP Credentials
		  Given the input file "httpcap.csv"
		  When ncrep is run
		  Then the screen output should be "User: webadmin, Password: HTTPpass123"

	Scenario: Find Telnet Credentials
		  Given the input file "telnetcap.csv"
		  When ncrep is run
		  Then the screen output should be "User: admin, Password: cisco"

	Scenario: Invalid CSV File
		  Given the input file "badfile.csv"
		  When ncrep is run
		  Then the screen output should be "The CSV file must contain at least an Info column"

	Scenario Outline: Find FTP Credentials
	 	   Given the input file "<input>"
		   When ncrep is run
		   Then the screen output should be "<output>"

		Examples:
			|     input    |                                    output                                      |
			|  test1.csv   |   User: anonymous, Password: anonymous                                         |
			|  test2.csv   |   User: anonymous, Password: anonymous\nUser: admin, Password: SecurePassword! |

	Scenario Outline: Find All Credentials
		Given the input file "<input>"
		When ncrep is run in file output mode
		Then the SHA1 hash of the output file should be "<sha1output>"

		 Examples:
			|     input    |                 sha1output                   |
			|   all1csv    |   2bb16c3dd0bbdb3243cc70ba67c55f888925def6   |
			|   all2.csv   |   004681c1d36c489b6ea22b4095de584123c8c871   |
			     
