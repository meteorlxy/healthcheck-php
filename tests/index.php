<?php
require __DIR__ . '/../vendor/autoload.php';

use Xjtuana\HealthCheck\{CheckKms, CheckJetbrains, CheckShadowsocks};

$config = require __DIR__ . '/config.php';

$check_kms = new CheckKms();

var_dump($check_kms->check($config['kms']['addr'], $config['kms']['port']));
echo "\n";

$check_jet = new CheckJetbrains();

var_dump($check_jet->check($config['jet']['addr'], $config['jet']['port']));
echo "\n";

$check_ss = new CheckShadowsocks();
var_dump($check_ss->check($config['ss']['addr'], $config['ss']['port']));
echo "\n";
