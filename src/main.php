#!`which php`
<?php

/**
 * General purpose CSV-file processor
 *
 * Duplicate TemplateTask.php and modify to handle processing for your CSV file.
 *
 *
 * Usage:
 * Invoke with path to a subclass of CSV_Task
 *  and path to input csv file.
 *  output written to STDOUT
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 *
 * @TODO multiple tasks
 * @TODO optional json config file (to simplify cmd-line arguments)
 */


/**
 * @var constant MIN_ARGS - minimum required arguments
 */
define('MIN_ARGS', 3);


if ($argc < MIN_ARGS ) {
  usage(); // no return
}


/*
 * base Driver and Task classes
 */
require_once  dirname(__FILE__) . '/Driver.php';



$task_args = array_slice($argv, MIN_ARGS);

$args = array(
  'max_rows'        => 0,   // 0 =  unlimited
  'opt_args'        => $task_args,
  'csv_in'          => $argv[2],
  # using array to allow for future pipelining of Task processors
  'tasks'           => array(basename($argv[1], '.php'))
);


$driver = new Driver($args);
# Load task class
require $argv[1];
$driver->run($args);

exit(0);


/**
 * Print usage
 */
function usage () {

  global $argv;

  echo "Usage: php {$argv[0]} task_class-filepath input-file.csv [optional args for task]\n";
  die(1);

}
