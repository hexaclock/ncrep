# ncrep
Sean Loveall & Daniel Vinakovsky

**How to run ncrep:**

* Click [here] (http://dev.gnurds.com/ncrep)

* Upload a valid CSV file of packet dissections from Wireshark/other.
 * An example is available at tests/unit-tests/lots_of_ftp.csv

* Click Submit, and observe the output.

**How to run ncrep-cli:**

* Run "php ncrep-cli.php <list of CSV packet capture files>"

* Observe the output.

**How to run the unit tests:**

* Clone this repository into a directory on the Stevens Linux Lab cluster/any Linux box with PHP5 installed.

* cd to tests/unit-tests

* Enter the following command: "php filetest.php"

* Observe the output from the unit tests.
