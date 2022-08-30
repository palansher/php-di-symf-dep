<?php

declare(strict_types=1);

namespace Gt;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/** Превращает dump объекта/переменной в строку */
function mydump(mixed $var): string
{
    $cloner = new VarCloner();
    $dumper = new CliDumper();
    // $output = fopen('php://memory', 'r+b');
    $output = $dumper->dump($cloner->cloneVar($var), true);
    return $output ?? '';
}
