Given(/^the input file "(.*?)"$/) do |arg1|
  `php ncrep-cli.php`
end

When(/^ncrep is executed$/) do
  `php ncrep-cli.php`
end

Then(/^the screen output should be "(User:\sanonymous\sPassword:\sanonymous)"$/) do |arg1|
  `php ncrep-cli.php test.csv`
end
