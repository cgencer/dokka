<?php

/**
 * @file
 * Include file for JavaScript libraries
 */

/**
 * Implements hook_libraries_info().
 */
function chesstools_libraries_info() {
  $libraries = array();

  $libraries['chess.js'] = array(
    'name' => 'chess.js library',
    'vendor url' => 'https://github.com/jhlywa/chess.js',
    'download url' => 'https://github.com/jhlywa/chess.js/archive/master.zip',
    'version arguments' => array(
      'file' => 'package.jason',
      'pattern' => '@"version": "([0-9\.]+)"@',
    ),
    'files' => array(
      'js' => array('chess.min.js'),
    ),
  );

  $libraries['chessboard.js'] = array(
    'name' => 'chessboard.js library',
    'vendor url' => 'http://chessboardjs.com/',
    'download url' => 'http://chessboardjs.com/releases/0.3.0/chessboardjs-0.3.0.zip',
    'version arguments' => array(
      'file' => 'js/chessboard-0.3.0.min.js',
      'pattern' => '@chessboard.js v([0-9\.]+)@',
    ),
    'files' => array(
      'js' => array(
        'js/chessboard-0.3.0.min.js',
      ),
      'css' => array(
         'css/chessboard-0.3.0.min.css'
      ),
    ),
    'dependencies' => array(
      'chess.js',
    ),
  );
  return $libraries;
}