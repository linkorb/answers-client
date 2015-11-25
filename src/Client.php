<?php 

namespace Linkorb\AnswersClient;
 
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $apiUrl;
    private $username;
    private $password;
 
    public function __construct($apiUrl, $username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
    }


    public function getUsername() {
        return $this->username; 
    }

    public function get()
    {
        return  new GuzzleClient(['base_uri' => $this->apiUrl, 'auth' => [$this->username, $this->password] ]);
    }
}
