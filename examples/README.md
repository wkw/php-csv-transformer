# PHP CSV Transformer - Examples

Comments inside each example task provide additional information for the example.


### TowedVehiclesFilter

Uses sample Chicago, IL government data file (publicly available) to filter output using a simple query string. The last argument is of the form `ColumnTitle=MatchString`.

```
$ php ../src/main.php tasks/TowedVehiclesFilter.php data/Towed_Vehicles.csv Make=JEEP
$ php ../src/main.php tasks/TowedVehiclesFilter.php data/Towed_Vehicles.csv Color=GRN
```

### ColumnsSubset

Illustrates removing columns from output while adding a new column with the row number.

```
$ php ../src/main.php tasks/ColumnsSubset.php data/Towed_Vehicles.csv
```
