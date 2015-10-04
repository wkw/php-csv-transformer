<?php
/**
 * CSV file processor for version 1.0 ("10").
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 */


/*
 * base Task class
 */
require_once  dirname(__FILE__) . '/CSVTask.php';


class Driver
{


  /**
   * @var array $args - Arguments passed to constructor
   */
  public $args = null;



  /**
   * Constructor. Process config settings
   *
   * @param array $args - runtime arguments
   * @return object $this
   */
  public function __construct ($args=array()) {

    $this->args = $args;

    return $this;

  }


  public function run () {

    $task_class = $this->args['tasks'][0];
    $handle     = NULL;
    $row_cnt    = 0;
    $csv_file   = $this->args['csv_in'];

    $processor = new $task_class($csv_file, $this->args['opt_args']);

    try {

      if (($handle = fopen($csv_file, "r")) !== FALSE ) {

        while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

          $row = $processor->processRow($data, $row_cnt);
          if ($row) {

            $this->send_row($row);

          }

          $row_cnt++;

        }

      }
      else {
        throw new Exception("Failed to open file '{$csv_file}'");
      }

    }
    catch (Exception $ex) {
      throw $ex;
    }
    finally {

      if ($handle) fclose($handle);

    }

    return $this;

  }

  /**
   * Output array as CSV row
   *
   * @param array $row
   * @return null
   */
  protected function send_row ($row) {

    fputcsv(STDOUT, $row);

  }

}