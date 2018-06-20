<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class PredictionManager
{
    private $logger;
    public $predictions;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getPredictions()
    {
        
    }
}