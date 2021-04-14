<?php
$test = "Hello";

$length = strlen($test) - 1;

$toChange = $length - 2;

$oldLetter = $test[$toChange];

echo strpos($test, 'l');

$test[$toChange] = $test[$length];
$test[$length] = $oldLetter;

echo $test;