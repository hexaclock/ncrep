Given /^the input file badfile.csv$/ do
  `php ncrep-cli.php`
end

When /^ncrep is called$/ do
  `php ncrep-cli.php`
end

Then /^the screen output should be "Invalid CSV file"$/ do
  `php ncrep-cli.php badfile.csv`
end
