Feature: Allow user to select portion of output as false positive
	Scenario: User wishes to report a false positive
		  Given that ncrep has run
		  When ncrep asks "Is there a false-positive?"
		  And the user enters "Yes"
		  Then ncrep should ask "What line number?"
		  And next ask "What's wrong with it? (specify as a match)"
		  And print "Saved false-positive rule to preferences"

	Scenario: User does not wish to report a false positive
		  Given that ncrep has run
		  When ncrep asks "Is there a false-positive?"
		  And the user enters "No"
		  Then ncrep should just exit
