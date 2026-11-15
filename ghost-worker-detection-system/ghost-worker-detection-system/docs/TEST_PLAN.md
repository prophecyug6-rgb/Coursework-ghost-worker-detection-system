# Basic test plan

| Test | Action | Expected result |
|---|---|---|
| Login | Sign in with a valid demo account | Dashboard opens |
| Invalid login | Enter an incorrect password | Access is denied |
| Employee entry | Add a unique employee number | Employee appears in register |
| Duplicate employee | Add an existing employee number | Save is rejected or handled as update by CSV import |
| Payroll entry | Add payroll for a registered employee | Payroll row is saved |
| Unknown employee | Add payroll for an unregistered number and run detection | A flag is created |
| Inactive employee | Add payroll for an inactive/terminated employee and run detection | A flag is created |
| Investigation | Change a flag status and add notes | Review is saved |
| CSV import | Import a correctly formatted CSV | Valid rows are imported |
| Report | Download investigation report | CSV file is generated |

Record actual results, date, tester and any defects when executing these tests. Do not mark tests as passed until they have been run.
