<?php

namespace Repat\Weimark;

class Client
{
    /**
     * Weimark API URL
     * @var string
     */
    const URL = 'https://secure.weimark.com/api/post';

    /**
     * Weimark E-Mail
     * @var string
     */
    private $email;

    /**
     * Weimark Password
     * @var string
     */
    private $password;

    /**
     * Email of Agent
     * @var string
     */
    private $agentEmail;

    /**
     * URL, defaults to constant
     * @var string
     */
    private $url;

    /**
     * HTTP CLient
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * Constructor
     *
     * @param string $email
     * @param string $password
     * @param string $agentEmail
     * @param array  $options
     */
    public function __construct(string $email, string $password, string $agentEmail, array $options = [])
    {
        $this->email = $email;
        $this->password = $password;
        $this->agentEmail = $agentEmail;
        $this->url = self::URL;

        $this->httpClient = new \GuzzleHttp\Client($options);
    }

    /*
    |--------------------------------------------------------------------------
    | Public Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Gets an existing application by ID
     * @param  string $applicationId
     * @return array
     */
    public function getApplication(string $applicationId) : array
    {
        $response = $this->httpClient->post(
            $this->url,
            [
                'body' => $this->xmlRequest('GetApplication', ['applicationid' => $applicationId])
            ]
        );
        return []; // TODO
    }

    /**
     * Submits a new application
     *
     * @param  array $attributes
     * @return array
     */
    public function newApplication(array $attributes) : array
    {
        $response = $this->httpClient->post(
            $this->url,
            [
                'body' => $this->xmlRequest('NewApplication', ['applicant' => $attributes])
            ]
        );
        return []; // TODO
    }

    /*
    |--------------------------------------------------------------------------
    | Getters and Setters
    |--------------------------------------------------------------------------
    */

    /**
     * Sets the URL but this shouldn't be used much
     *
     * @param string $url [description]
     */
    public function setUrl(string $url) : void
    {
        $this->url = $url;
    }

    /**
     * These fields have to be filled out for an application
     * @return array
     */
    public function getApplicationTemplate() : array
    {
        return [
            'fname',
            'lname',
            'dob',
            'gender',
            'ssn',
            'streetnumber',
            'streetname',
            'streettype',
            'city',
            'country',
            'suite',
            'zip',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Private Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Assembles the XML request
     *
     * @param  string $action
     * @param  array  $body
     * @return string
     */
    private function xmlRequest(string $action, array $body) : string
    {
        $writer = new \XMLWriter();
        $writer->openMemory();

        $writer->startElement('xml');

        $writer->writeAttribute('action', $action);
        $writer->writeAttribute('email', $this->email);
        $writer->writeAttribute('password', $this->password);
        $writer->writeAttribute('agents_email', $this->agentsEmail);

        $writer->startElement('request');
        $writer->startElement('services');

        $writer->writeAttribute('service', 79); // TODO Magic
        $writer->writeAttribute('service', 82); // TODO Magic
        
        $writer->endElement(); // services
        $writer->startElement('applicant');

        foreach ($body as $key => $value) {
            $writer->writeAttribute($key, $value);
        }

        $writer->endElement(); // applicant
        $writer->endElement(); // request
        $writer->endElement(); // xml

        return $writer->flush();
    }
}
