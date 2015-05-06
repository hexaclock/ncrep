Feature: Get Statistics
	Scenario: Get Statistics
		  Given the input file "test1.csv"
		  When ncrep runs
		  Then the screen output should have "The total number of packets read from the file"