<?php
namespace cnp\sdk\Test\functional;

use cnp\sdk\CnpOnlineRequest;
use cnp\sdk\CommManager;
use cnp\sdk\XmlParser;

class FastAccessFundingFunctionalTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        CommManager::reset();
    }

    public function test_fastAccessFunding()
    {
        $hash_in = array('id' => 'id',
            'fundingSubmerchantId' => '2111',
            'submerchantName' => '001',
            'fundsTransferId' => '1234567891111111',
            'amount' => '13',
            'card' => array(
                'type' => 'VI',
                'number' => '4100000000000000',
                'expDate' => '1210'
            )
        );
        $initialize = new CnpOnlineRequest();
        $fastAccessFundingResponse = $initialize->fastAccessFunding($hash_in);
        $response = XmlParser::getNode($fastAccessFundingResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($fastAccessFundingResponse, 'location');
        $this->assertEquals('sandbox', $location);
    }

    public function test_fastAccessFunding_with_cardholderAddress()
    {
        $hash_in = array('id' => 'id',
            'fundingSubmerchantId' => '2111',
            'submerchantName' => '001',
            'fundsTransferId' => '1234567891111111',
            'amount' => '13',
            'card' => array(
                'type' => 'VI',
                'number' => '4100000000000000',
                'expDate' => '1210'
            ),
            'cardholderAddress' => array(
                'addressLine1' => '2 Main St.',
                'addressLine2' => 'Apt. 222',
                'addressLine3' => 'NA',
                'city' => 'Riverside',
                'state' => 'RI',
                'zip' => '02915',
                'country' => 'US')
        );
        $initialize = new CnpOnlineRequest();
        $fastAccessFundingResponse = $initialize->fastAccessFunding($hash_in);
        $response = XmlParser::getNode($fastAccessFundingResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($fastAccessFundingResponse, 'location');
        $this->assertEquals('sandbox', $location);
    }

    public function test_fastAccessFunding_Direct_Merchant()
    {
        $hash_in = array('id' => 'id',
            'fundingCustomerId' => '3111',
            'customerName' => 'Merchant',
            'fundsTransferId' => '1234567891111222',
            'amount' => '13',
            'disbursementType' => 'VFD',
            'cardholderAddress' => array(
                'addressLine1' => '2 Main St.',
                'addressLine2' => 'Apt. 222',
                'addressLine3' => 'NA',
                'city' => 'Riverside',
                'state' => 'RI',
                'zip' => '02915',
                'country' => 'US'),
            'card' => array(
                'type' => 'VI',
                'number' => '4100000000000000',
                'expDate' => '1210'
            )
        );
        $initialize = new CnpOnlineRequest();
        $fastAccessFundingResponse = $initialize->fastAccessFunding($hash_in);
        $response = XmlParser::getNode($fastAccessFundingResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($fastAccessFundingResponse, 'location');
        $this->assertEquals('sandbox', $location);
    }

    public function test_encrypted_fastAccessFunding()
    {
        $hash_in = array('id' => 'id',
            'fundingSubmerchantId' => '2111',
            'submerchantName' => '001',
            'fundsTransferId' => '1234567891111111',
            'amount' => '13',
            'card' => array(
                'type' => 'VI',
                'number' => '4100000000000000',
                'expDate' => '1210'
            ),
            'oltpEncryptionPayload' => true
        );
        $initialize = new CnpOnlineRequest();
        $fastAccessFundingResponse = $initialize->fastAccessFunding($hash_in);
        $response = XmlParser::getNode($fastAccessFundingResponse, 'response');
        $this->assertEquals('000', $response);
        $location = XmlParser::getNode($fastAccessFundingResponse, 'location');
        $this->assertEquals('sandbox', $location);
    }
}