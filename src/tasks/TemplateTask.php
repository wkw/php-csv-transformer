<?php

/**
 * Starter template Task. Duplicate and customize.
 * Class name must match filename, including capitalization
 *
 * @author Wayne K. Walrath <wkw@acmetech.com>
 *
 * Copyright (c) 2015 Wayne K. Walrath
 * Licensed under The MIT License (MIT). See LICENSE in project root
 */

class TemplateTask extends CSVTask
{


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

    # Remove this code If CSV does not contains a header row.
    if ($idx === 0) {
      $this->setHeaders($row);
      return $row;
    }

    return $row;

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

}
