<?php 

namespace Linkorb\AnswersClient;
use Linkorb\AnswersClient\Client as Client;


class Answer
{

	const PATH = 'answers/';

	private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    private $question_id;

    public function getQuestionId()
    {
        return $this->question_id;
    }

    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;

        return $this;
    }

    private $answer;

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    private $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    private $is_deleted;

    public function getIsDeleted()
    {
        return $this->is_deleted;
    }

    public function setIsDeleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;

        return $this;
    }

    private $created_at;

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    private $updated;

    public function getUpdatedAt()
    {
        return $this->updated;
    }

    public function setUpdatedAt($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function get( $id )
    {

        try {
            $response  = $this->client->get()->request('GET', self::PATH.$id );
            $this->arrayToObject(json_decode($response->getBody(), true));
        } catch (RequestException $e) {
            echo $e->getRequest();
            if ($e->hasResponse()) {
                echo $e->getResponse();
            }
        }

    }

    public function getComments()
    {
        try {
            $response  = $this->client->get()->request('GET', self::PATH  . $this->getId() . '/comments');
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
        }
    }

    public function getVotes()
    {
        try {
            $response  = $this->client->get()->request('GET', self::PATH  . $this->getId() . '/votes');
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
        }
    }


    public function create() {

        $data = [
            'answer' => $this->getAnswer(),
            'question_id' => $this->getQuestionId(),
            'username' => $this->client->getUsername()
        ];

	    $response  = $this->client->get()->request('POST', self::PATH, [
	    	'body' => json_encode($data)
	    ] );

        $jsonDecode = json_decode( $response->getBody(), true );
        if ( isset ( $jsonDecode['error'] ) ) {
             throw new \Exception( $jsonDecode['error']['message'] );
        } else {
	       $this->arrayToObject( $jsonDecode );
       }
		
    }

    public function update() {
        
        $data = [
            'answer' => $this->getAnswer(),
            'id' => $this->getId(),
            'username' => $this->client->getUsername()
        ];

        $response  = $this->client->get()->request('POST', self::PATH . 'update', [
            'body' => json_encode($data)
        ] );

        $jsonDecode = json_decode( $response->getBody(), true );


        if ( isset ( $jsonDecode['error'] ) ) {
             throw new \Exception( $jsonDecode['error']['message'] );
        } else {
           $this->arrayToObject( $jsonDecode );
       }
        
    }

    public function delete() {
        $data = [
            'id' => $this->getId(),
        ];

        $response  = $this->client->get()->request('POST', self::PATH . 'delete', [
            'body' => json_encode($data)
        ] );

        $jsonDecode = json_decode( $response->getBody(), true );

        if ( isset ( $jsonDecode['error'] ) ) {
             throw new \Exception( $jsonDecode['error']['message'] );
        }
        
    }


    public function comment( $comment ) {
        $data = [
            'comment' => $comment,
            'parent_id' => $this->getId(),
            'parent_type' => 'answer',
            'username' => $this->client->getUsername()
        ];

        $response  = $this->client->get()->request('POST', 'comments/', [
            'body' => json_encode($data)
        ] );


        $jsonDecode = json_decode( $response->getBody(), true );

        if ( isset ( $jsonDecode['error'] ) ) {
             throw new \Exception( $jsonDecode['error']['message'] );
        } else {
           $this->arrayToObject( $jsonDecode );
       }
        
    }

    public function vote( ) {
        $data = [
            'parent_id' => $this->getId(),
            'parent_type' => 'answer',
            'username' => $this->client->getUsername()
        ];

        $response  = $this->client->get()->request('POST', 'votes/', [
            'body' => json_encode($data)
        ] );


        $jsonDecode = json_decode( $response->getBody(), true );

        if ( isset ( $jsonDecode['error'] ) ) {
             throw new \Exception( $jsonDecode['error']['message'] );
        } else {
           $this->arrayToObject( $jsonDecode );
       }
        
    }

    private function arrayToObject($array)
    {
        $this->setId( isset( $array['id'] ) ? $array['id'] : 'null' )
            ->setAnswer( isset( $array['answer'] ) ? $array['answer'] : 'null' )
            ->setUsername( isset( $array['username'] ) ? $array['username'] : 'null' )
            ->setQuestionId( isset( $array['question_id'] ) ? $array['question_id'] : 'null' )
            ->setCreatedAt( isset( $array['created_at'] ) ? $array['created_at'] : 'null' )
            ->setIsDeleted( isset( $array['is_deleted'] ) ? $array['is_deleted'] : 'null' )
            ->setUpdatedAt( isset( $array['updated_at'] ) ? $array['updated_at'] : 'null' ) ;
    }

}