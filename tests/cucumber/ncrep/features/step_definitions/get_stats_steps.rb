Given /^the input file test1.csv$/ do
  `php ncrep-cli.php`
end

When /^ncrep runs$/ do
  `php ncrep-cli.php`
end

Then /^the screen output should have "(The total number of packets read from the file)"$/ do |arg1|
  `php ncrep-cli.php test1.csv`
end
