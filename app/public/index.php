<?php

require_once('../vendor/autoload.php');

use App\Service\LineByLineFileReader;
use App\Service\UnixNewlineDecorator;
use App\Service\InternetResourceProxy;
use App\Service\FileReader;

$pathToLocalFile = __DIR__ . '/../bin/file.txt';
$pathToLocalFileWhichIsNotExists = __DIR__ . '/../bin/dummy_file.txt';
$pathToRemoteFile = 'https://digilife.com.pl/test.txt';

$reader = new LineByLineFileReader($pathToLocalFile);
$unixReader = new UnixNewlineDecorator($reader);
$proxyReader = new InternetResourceProxy($pathToLocalFileWhichIsNotExists, $pathToRemoteFile);

$reader->loadFile();

//foreach ($reader->getLines() as $line) {
//    echo $line;
//}

//echo 'Unix reader';
//echo '<br>';
//
//foreach ($unixReader->getLines() as $line) {
//    echo $line;
//}

echo 'Proxy reader';
echo '<br>';

$proxyReader->loadFile();

foreach ($proxyReader->getLines() as $line) {
    echo $line;
}

$fileReader = new FileReader();

// for any size of file
foreach ($fileReader->getLines($pathToLocalFile) as $line) {
    echo $line;
}