<?php

/**
 * Example CSV Task for data set Towed_Vehicles.csv which returns subset of available columns
 *
 * Usage:
 *  inside `examples` directory, run:
 *  `php ../src/main.php tasks/ColumnsSubset.php data/Towed_Vehicles.csv`
 *
 *  Will output a subset of available CSV columns
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 *
 */

class ColumnsSubset extends CSVTask
{

  /**
   * @var array headers hash
   */
  private $headerHash = null;



 /**
  * Subclasses do not need to override the cosntructor, but
  * if they do, they must call the parent constructor first.
  *
  * @param string $input_file - source CSV file name/path
  * @return object - new instance of class
  */
  public function __construct ($input_file=null, $argv=array()) {

    parent::__construct($input_file, $argv);

    return this;

  }

  /**
   * Extract a subset of the rows but prepend a row with the current row number.
   *
   * @param array $row - current csv line
   * @param int $idx zero-based index of current line
   * @return mixed - data array to write back out to csv, or null to write nothing out.
   */
  public function processRow ($row, $idx) {

    static $max_rows = 20;
    $cols = array(0,1,7);

    # for demo purposes, only return first 20 rows
    if($idx >= $max_rows)
      return null;


    # headers row, prepend index column
    if ($idx === 0) {
      # modify header row to prepend an index column
      $this->setHeaders($row);
      return array_merge( array("Index"), $this->_extractColumns($row, $idx, $cols));
    }


    $out = array_merge( array($idx+1), $this->_extractColumns($row, $idx, $cols));
    //return array_intersect($row, $cols);
    return $out;

  }

  private function _extractColumns($row, $idx, $cols) {

    $out = array();
    foreach($cols as $col) {
      $out[] = $row[$col];
    }
    return $out;

  }

  /**
   * Optional setup method
   *
   * @param array $argv - optional arguments passed to script invokation beyond
   *                    what is consumed by the file processor.
   * @param int $argc length of $argv array
   */
  protected function setup ($argv, $argc) {

    // subclasses do your work here
  }


  /**
   * Invoked when file processing finished
   *
   * @return mixed - returning an array will write to output. Return null otherwise
   */
  public function done () {
    return null;
  }


  /**
   * Override parent method
   *
   * @param array $headers - header row
   * @see getHeaders
   */
  public function setHeaders ($headers) {

    parent::setHeaders ($headers);

    # column titles become keys for lookup against ::$columnName
    $this->headerHash = array_flip($this->getHeaders());

  }


}
