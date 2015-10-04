<?php

/**
 * Base class for CSV Tasks
 *
 * Subclasse names must exactly match their Filename, including capitalization
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 */

class CSVTask
{

  /**
   * @var string $VERSION - determines which file processor class is used to execute Tasks (not implemented)
   */
  public static $VERSION = "01";

  /**
   * @var array $headers - set to first row of file if header row present
   */
  public $headers = null;

  /**
   * @var string $inputFile - csv filename or path
   */
  public $inputFile = null;

  /**
   * @var array headers hash
   */
  private $headerHash = null;



 /**
  * CSVTask constructor.
  * Calls subclass setup() method, saves the source csv file path.
  *
  * @param string $input_file - source CSV file name/path
  * @return object - new instance of class
  */
  public function __construct ($input_file=null, $opt_args=array()) {

    $this->inputFile = $input_file;

    $this->setup($opt_args, count($opt_args));

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

    return $line;

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
   * Return the header row.
   *
   * @return array - output headers, or null.
   * @see setHeaders
   */
  public function getHeaders () {

    return $this->headers;

  }

  /**
   * Save header row.
   * Also sets class property headerHash which allows getting a column
   * index based on column title
   *
   * @param array $headers - header row
   * @see getHeaders
   * @see columnIndex
   */
  protected function setHeaders ($headers) {

    $this->headers = $headers;

    # column titles become keys for lookup against ::$columnName
    $this->headerHash = array_flip($headers);

  }

  /**
   * Lookup column index based on a column title.
   * Requires the CSV file contain a header row.
   *
   * @param string $columnTitle - exact title of the CSV column
   * @return mixed - zero-based indexed for column matching arg,
   *                 otherwise NULL if no headers or title not found
   */
  protected function columnIndex ($columnTitle) {

    $hash = $this->headerHash;
    $idx = null;

    if ($hash) {
      $idx = $hash[$columnTitle];
    }

    return $idx;

  }

}
