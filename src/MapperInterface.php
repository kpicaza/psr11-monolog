<?php
declare(strict_types=1);

namespace WShafer\PSR11MonoLog;

interface MapperInterface
{
    public function get(string $type, array $options);
    public function has(string $type);
    public function getFactoryClassName(string $type);
}
