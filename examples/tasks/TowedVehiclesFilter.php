<?php

/**
 * Example CSV Task for data set Towed_Vehicles.csv which outputs rows matching a filter
 *
 * Usage:
 *  inside `examples` directory, run:
 *  `php ../src/main.php tasks/TowedVehiclesFilter.php data/Towed_Vehicles.csv Make=CHEV`
 *
 *  Will output rows where column headere 'Make' contains the value 'CHEV'
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 *
 */

class TowedVehiclesFilter extends CSVTask
{

  /**
   * @var array headers hash
   */
  private $headerHash = null;

  /**
   * @var string $columnName - column header title
   */
  private $columnName = null;

  /**
   * @var string $matchText - query string to filter by
   */
  private $matchText = null;


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
   * Subclasses must override this.
   *
   * @param array $row - current csv line
   * @param int $idx zero-based index of current line
   * @return mixed - data array to write back out to csv, or null to write nothing out.
   */
  public function processRow ($row, $idx) {

    if ($idx === 0) {
      $this->setHeaders($row);
      return $row;
    }

    $col = $this->columnIndex($this->columnName);
    $match = $this->matchText;

    if( $row[$col] == $match)
      return $row;

    return null;

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
    if ( $argc > 0 ) {
      $tokens = explode('=', $argv[0]);
      list($this->columnName, $this->matchText) = $tokens;
    }
    else {
      throw new Exception("No query provided. Try using \"Make=CHEV\"");
    }
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
    //$this->headerHash = array_flip($this->getHeaders());

  }


}
