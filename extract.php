<?php 
$zip = new ZipArchive;
$res = $zip->open('source1.4.0.zip');
if ($res === TRUE) {
  $zip->extractTo('files');
  $zip->close();
  echo 'woot!';
} else {
  echo 'doh!';
}