<?php

namespace Mikielis\LogReader\Block;

use Magento\Framework\View\Element\Template;
use Mikielis\LogReader\Helper\Data as DataHelper;
use Mikielis\LogReader\Model\Logs;
use Mikielis\LogReader\Service\Parser;

class Index extends Template
{
    protected $logs;

    protected $parser;

    protected $dataHelper;

    protected $limit;

    protected $limitConfigPath = 'mikielis_logreader/functional/limit';

    public function __construct(
        Template\Context $context,
        array $data = [],
        Logs $logs,
        Parser $parser,
        DataHelper $dataHelper
    ) {
        parent::__construct($context, $data);
        $this->logs = $logs;
        $this->parser = $parser;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Get exceptions
     *
     * @return array|null
     */
    public function getExceptions()
    {
        return $this->slice($this->parser->parse($this->logs->getExceptions()));
    }

    /**
     * Get debug logs
     *
     * @return array|null
     */
    public function getDebug()
    {
        return $this->slice($this->parser->parse($this->logs->getDebug()));
    }

    /**
     * Get system logs
     *
     * @return array|null
     */
    public function getSystem()
    {
        return $this->slice($this->parser->parse($this->logs->getSystem()));
    }

    /**
     * Slice array
     *
     * @param $logs
     * @return array|null
     */
    private function slice($logs)
    {
        if (is_array($logs)) {
            $logs = array_slice($logs, 0, $this->getLimit());
        }

        return $logs;
    }

    /**
     * @return mixed
     */
    private function getLimit()
    {
        return $this->dataHelper->getConfig($this->limitConfigPath);
    }
}
