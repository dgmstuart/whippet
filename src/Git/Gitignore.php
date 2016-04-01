<?php

namespace Dxw\Whippet\Git;

/**
  * This is a basic management class for a .gitignore file.
  *
  * It saves and loads .gitignore and ensures that the saved file is sane.
  *
  */
class Gitignore {
  /**
   * Initialises the class with a .gitignore in a given repository
   *
   * $repo_path Path to a git repo
   */
  function __construct($repo_path) {
    $this->ignore_file = "{$repo_path}/.gitignore";
  }

  /**
   * Loads a .gitignore file into an array, with consistent line endings
   */
  function get_ignores() {
    return $this->ensure_closing_newline(file($this->ignore_file));
  }

  /**
   * Saves the supplied .gitignore lines back to the file
   */
  function save_ignores($ignores) {
    return file_put_contents($this->ignore_file, $ignores);
  }

  /**
   * Ensures that the last line in the ignores has a line return
   *
   * TODO: This class, and its callers, should be refactored to remove the line
   * ending on each element in this array
   */
  private function ensure_closing_newline($ignores) {
    $index_of_last_line = count( $ignores ) - 1;
    $last_line = $ignores[$index_of_last_line];
    $last_character = substr($last_line, -1);

    if ($last_character != "\n") {
      $ignores[$index_of_last_line] =  $last_line . "\n";
    }
    return $ignores;
  }
}