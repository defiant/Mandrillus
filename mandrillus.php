<?php

class Mandrillus {

	private $apiKey = '';
	private $apiUrl = 'https://mandrillapp.com/api/1.0';
    private $version = '0.1';

    public $outputType = 'json';
    public $debug = false; 


	public function __construct()
	{

	}

	public function validApiCalls()
	{
		$validCallsList = array(
			'users' => array(
				'info'    	=> array('key'),
				'ping'   	=> array('key'),
				'senders'	=> array('key'),
				'disable-sender' => array('key', 'domain'),
				'verify-sender'  => array('key', 'email')
			),
			'messages' => array(
				'send' 	=> array('key', 'message'),
				'send-template' => array('key', 'template_name', 'template_content', 'message'),
				'search'=> array('key', 'query', 'date_from', 'date_to', 'tags', 'senders', 'limit'),
			),
			'tags' => array(
				'list' => array('key'),
				'info' => array('key', 'tag'),
				'time-series' => array('key', 'tag'),
				'all-time-series' => array('key'),
			),
			'senders' => array(
				'list' => array('key'),
				'info' => array('key', 'address'),
				'time-series' => array('key', 'address'),
			),
			'urls' => array(
				'list'   => array('key'),
				'search' => array('key', 'q'),
				'time-series' => array('key', 'url')
			),
			'templates'  => array(
				'add'  	 => array('key', 'name', 'code'),
				'info' 	 => array('key', 'name'),
				'update' => array('key', 'name', 'code'),
				'delete' => array('key', 'name'),
				'list' 	 => array('key')
			),
			'webhooks'   => array(
				'list' 	 => array('key'),
				'add'  	 => array('key', 'url', 'events'),
				'info' 	 => array('key', 'id'),
				'update' => array('key', 'id', 'url', 'events'),
				'delete' => array('key', 'id')
			)
		);
	}

	public function setApiKey ($key)
	{
		$this->apiKey = $key;
		return $this->apiKey;
	}

	public function api($callCategory, $call, $params = array())
	{

		// verify call category

		// verify call 

		$url = $this->apiUrl . '/' . $callCategory . '/' . $call . '.' . $this->outputType;

		$params['key'] = $this->apiKey;

		$encodedParams = json_encode($params);		

		$ch = curl_init($parsed_url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mandrillus-PHP');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($encodedParams))
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedParams);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

        $result = curl_exec($ch);

        var_dump($result);
	}
}