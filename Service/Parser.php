<?php

namespace Mikielis\LogReader\Service;

class Parser
{
    protected $logs;

    public function parse($logs)
    {
        $this->logs = $logs;

        if (strlen($logs) > 0) {
            $this->build();
        }

        return $this->logs;
    }

    private function build()
    {
        $logs = explode(" []", $this->logs);
        $this->logs = [];

        if (count($logs) > 0) {
            foreach ($logs as $i => $log) {
                $datetime = trim(str_replace('[', '', explode('] ', $log)[0]));
                $content = trim(str_replace(['[' . $datetime . ']', '[]'], '', $log));

                if (!empty($datetime) && !empty($content)) {
                    $this->logs[$i] = new \stdClass();
                    $this->logs[$i]->datetime = $datetime;
                    $this->logs[$i]->log = $content;
                }
            }
        }

        krsort($this->logs);
    }
}
