<?php namespace Omnipay\Beanstream;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testAuthorize()
    {
        $request = $this->gateway->authorize(
            array(
                'amount' => '10.00',
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\AuthorizeRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(
            array(
                'amount' => '10.00',
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\PurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testCreateProfileWithCard()
    {
        $request = $this->gateway->createProfile(
            array(
                'language' => 'test-language',
                'comment' => 'test-comment',
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\CreateProfileRequest', $request);
        $this->assertSame('test-language', $request->getLanguage());
        $this->assertSame('test-comment', $request->getComment();
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testCreateProfileWithToken()
    {
        $request = $this->gateway->createProfile(
            array(
                'language' => 'test-language',
                'comment' => 'test-comment',
                'billing' => array(
                    'name' => 'test mann',
                    'email_address' => 'testmann@email.com',
                    'street_address1' => '123 Test St',
                    'street_address2' => '',
                    'city' => 'vancouver',
                    'province' => 'bc',
                    'postal_code' => 'H0H0H0',
                    'phone_number' => '1 (555) 555-5555'
                )
                'token' => array(
                    'name' => 'token-test-name',
                    'code' => 'token->test->code'
                )
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\CreateProfileRequest', $request);
        $this->assertSame('test-language', $request->getLanguage());
        $this->assertSame('test-comment', $request->getComment());
        // $this->assertSame(array(
        //     'name' => 'test mann',
        //     'email_address' => 'testmann@email.com',
        //     'street_address1' => '123 Test St',
        //     'street_address2' => '',
        //     'city' => 'vancouver',
        //     'province' => 'bc',
        //     'postal_code' => 'H0H0H0',
        //     'phone_number' => '1 (555) 555-5555'
        // ), $request->getBilling());
        // $this->assertSame('token' => array(
        //     'name' => 'token-test-name',
        //     'code' => 'token->test->code'
        // ), $request->getToken());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testFetchProfile()
    {
        $request = $this->gateway->fetchProfile(
            array(
                'profileId' => 1
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\FetchProfileRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('GET', $request->getHttpMethod());
    }

    public function testUpdateProfile()
    {
        $request = $this->gateway->updateProfile(
            array(
                'profileId' => 1,
                'language' => 'test-language',
                'comment' => 'test-comment',
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\UpdateProfileRequest', $request);
        $this->assertSame('test-language', $request->getLanguage());
        $this->assertSame('test-comment', $request->getComment());
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('PUT', $request->getHttpMethod());
    }

    public function testDeleteProfile()
    {
        $request = $this->gateway->deleteProfile(
            array(
                'profileId' => 1,
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\DeleteProfileRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('DELETE', $request->getHttpMethod());
    }

    public function testCreateProfileCard()
    {
        $request = $this->gateway->createProfileCard(
            array(
                'profileId' => 1,
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\CreateProfileCardRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testCreateProfileCard()
    {
        $request = $this->gateway->createProfileCard(
            array(
                'profileId' => 1,
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\CreateProfileCardRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testFetchProfileCards()
    {
        $request = $this->gateway->createProfileCard(
            array(
                'profileId' => 1
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\FetchProfileCardsRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame('GET', $request->getHttpMethod());
    }

    public function testUpdateProfileCard()
    {
        $request = $this->gateway->createProfileCard(
            array(
                'profileId' => 1,
                'cardId' => 2,
                'card' => $this->getValidCard()
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\UpdateProfileCardRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame(2, $request->getCardId());
        $this->assertSame('PUT', $request->getHttpMethod());
    }

    public function testUpdateProfileCard()
    {
        $request = $this->gateway->createProfileCard(
            array(
                'profileId' => 1,
                'cardId' => 2
            )
        );
        $this->assertInstanceOf('Omnipay\Beanstream\Message\DeleteProfileCardRequest', $request);
        $this->assertSame(1, $request->getProfileId());
        $this->assertSame(2, $request->getCardId());
        $this->assertSame('DELETE', $request->getHttpMethod());
    }
}
