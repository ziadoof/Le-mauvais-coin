<?php
namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class RegistrationControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(0, $crawler->filter('html:contains("Hello World")')->count());
    }
    public function testCheckPassword()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'GET',
            '/register'
        );
        $form = $crawler->selectButton('S\'inscrire')->form();
        $form['user[email]'] = 'toto@email.com';
        $form['user[username]'] = 'usernametest';
        $form['user[firstame]'] = 'John Doe';
        $form['user[lastame]'] = 'John Doe';
        $form['user[password][first]'] = 'pass1';
        $form['user[password][second]'] = 'pass2';
        $form['user[telephone]'] = 1235467;
        $form['user[photo]'] = 'John Doe';
        $crawler = $client->submit($form);
        //echo $client->getResponse()->getContent();
        $this->assertEquals(1,
            $crawler->filter('li:contains("This value is not valid.")')->count()
        );
    }
}
