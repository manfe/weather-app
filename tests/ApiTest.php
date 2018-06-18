<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Mocks\Server\PartnerAPI;

final class ApiTest extends TestCase
{
    public function testIfAPIMockServerIsRespondingCorrectJSON(): void
    {
        $response_body = PartnerAPI::temperatures();
        
        $jsonMock = file_get_contents(__DIR__ . '/mocks/responses/temps.json');

        $this->assertEquals($jsonMock, $response_body);
    }




}