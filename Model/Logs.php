<?php

namespace Mikielis\LogReader\Model;

use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem\File\Read;

class Logs
{
    protected $exception = '/var/log/exception.log';

    protected $debug = '/var/log/debug.log';

    protected $system = '/var/log/system.log';

    public function getExceptions()
    {
        return $this->read($this->exception);
    }

    public function getDebug()
    {
        return $this->read($this->debug);
    }

    public function getSystem()
    {
        return $this->read($this->system);
    }

    private function read($path)
    {
        $reader = new Read(BP . $path, new File());
        return $reader->readAll();
    }
}