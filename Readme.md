# Introduction

  A simple & flexible framework for transforming CSV data with PHP code.

  Create processing tasks as subclasses of `CSVTask`.  Your tasks are presented each line of the CSV file for manipulation or filtering. Additionally a setup method provides the opportunity to process Task-specific cmd-line arguments, or do other setup. When the file is finished processing, another method is called for cleanup or post-processing.

  This is _not_ a parser for CSV. It relies on PHP's CSV parsing.

#### version: 0.1



### Requirements

  * php 5.5+



## Usage:

`php main.php tasks/TemplateTask.php ../examples/data/Towed_Vehicles.csv`

generally:

```
cd src
php main.php tasks/YourTask.php <input-file.csv> [optional task arguments]
```


## QuickStart

- Duplicate `TemplateTask.php` and ensure the task base filename matches your subclass name.
- Write your per-row processing logic in the method `processRow($row, $idx)`.
- To remove rows from the output, return `NULL` from `processRow`.
- To modify the header row (if any), do it in `processRow` when `$idx===0`. see: [ColumnsSubset.php](examples/tasks/ColumnsSubset.php).
- Lookup the column index for any header by column title with base class method `columnIndex($colTitle)`. see: [TowedVehiclesFilter.php](examples/tasks/TowedVehiclesFilter.php).
- Rows can be collected inside the Task instance if required to generate derived data (and/or write to files, send to API, etc.).


## Examples

  See [README.md](examples/README.md) inside `examples` directory.



## Expansion Ideas

  - Multiple tasks (either per-line or per-file).
  - pass rows as objects with the headers as keys.
  - autoload all php files in `tasks` directory.
  - Optional json config file to simplify cmd-line arguments
  - Optionally read from STDIN.
  - PHPUnit tests ...



## License

MIT &copy; [Wayne K. Walrath](http://wkw.github.io/)
