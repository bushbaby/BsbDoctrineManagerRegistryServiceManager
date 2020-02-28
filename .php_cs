<?php

/**
 * @copyright Copyright (c) 2016 bushbaby multimedia. (https://bushbaby.nl)
 * @author    Bas Kamer <baskamer@gmail.com>
 * @license   MIT
 */

declare(strict_types=1);

$config = new Bsb\CS\Config();
$config->getFinder()->in(__DIR__)->append(['.php_cs']);

$cacheDir = \getenv('TRAVIS') ? \getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
