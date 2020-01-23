<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    /**
     * Test that we can hit the root endpoint and a 200 response will be returned
     *
     * @return void
     */
    public function testGetEndpoint()
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    /**
     * Post with no data and receive validation errors
     *
     * @return void
     */
    public function testPostEndpointValidationErrors()
    {
        $response = $this->post('/contact');

        $response->assertStatus(302);
    }
    
    /**
     * Post to the root document should be rejected
     *
     * @return void
     */
    public function testPostRootNotAllowedErrors()
    {
        $response = $this->post('/');

        $response->assertStatus(405);
    }  

    /**
     * Get method call on the contact endpoint should be rejected
     *
     * @return void
     */
    public function testGetContactNotAllowedErrors()
    {
        $response = $this->get('/contact');

        $response->assertStatus(405);
    }    
    
    /**
     * Valid post data is sent to the correct endpoint
     *
     * @return void
     */
    public function testPostEndpointPassedValidation()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'email@example.com',
            'phone' => 1231231231,
            'message' => 'this is the first test email body'
        ]);
        
        $response->assertSessionHas('success', 'Your email has been sent!');
        $response->assertStatus(302);
        $response->assertRedirect();

        $this->assertDatabaseHas('contacts', [
            'recipient_email' => 'guy-smiley@example.com',
            'name' => 'John Doe',
            'email' => 'email@example.com',
            'message' => 'this is the first test email body',
            'phone' => 1231231231
        ]);         
    } 

    /**
     * Valid post data sent without optional phone number
     *
     * @return void
     */
    public function testPostEndpointPassedWithoutPhoneNumberValidation()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'email@example.com',
            'message' => 'this is the second email body'
        ]);

        $response->assertSessionHas('success', 'Your email has been sent!');
        $response->assertStatus(302);
        $response->assertRedirect();

        $this->assertDatabaseHas('contacts', [
            'recipient_email' => 'guy-smiley@example.com',
            'name' => 'John Doe',
            'email' => 'email@example.com',
            'message' => 'this is the second email body',
            'phone' => null
        ]);        
    }     
    
    /**
     * Validation error for no name passed 
     *
     * @return void
     */
    public function testPostEndpointNoNameErrorValidation()
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'email@example.com',
            'phone' => 1231231231,
            'message' => 'this is my test email body'
        ]);
        
        $response->assertSessionHasErrors(['name']);
        $response->assertStatus(302);  
        
        $this->assertDatabaseMissing('contacts', ['name' => '']);        
    } 
    
    /**
     * Validation error for no email passed 
     *
     * @return void
     */
    public function testPostEndpointNoEmailErrorValidation()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => '',
            'phone' => 1231231231,
            'message' => 'this is my test email body'
        ]);
        
        $response->assertSessionHasErrors(['email']);
        $response->assertStatus(302);     
        $this->assertDatabaseMissing('contacts', ['email' => '']);   
    } 
    
    /**
     * Validation error for no message passed 
     *
     * @return void
     */
    public function testPostEndpointNoMessageErrorValidation()
    {
        $response = $this->post('/contact', [
            'name' => 'John Doe',
            'email' => 'email@example.com',
            'phone' => 1231231231,
            'message' => ''
        ]);
        
        $response->assertSessionHasErrors(['message']);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('contacts', ['message' => '']);        
    }     
}
