<?php

use EmailCleaner\EmailCleaner;

require '../vendor/autoload.php';


$emailCleaner = new EmailCleaner();

foreach(glob(dirname(__FILE__)."/html/*.html") as $filename){
    $basename = basename($filename);
    $emailCleaner->setHTML(file_get_contents($filename));
    $result = $emailCleaner->parse();
    file_put_contents(dirname(__FILE__)."/result/{$basename}", $result);
}

echo "done";

