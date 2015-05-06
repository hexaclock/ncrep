Given /^no input file$/ do
  `php ncrep-cli.php`
end

When /^ncrep is run$/ do
  `php ncrep-cli.php`
end

Then (/^ncrep should display "usage(.*?)"$/) do |arg1|
  `php ncrep-cli.php`
end
