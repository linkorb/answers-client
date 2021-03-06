<?php 

namespace Linkorb\AnswersClient;
use Linkorb\AnswersClient\Client as Client;


class Question {

	const PATH = 'questions/';
    
    private $id;

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    private $topic_id;

    public function getTopicId()
    {
        return $this->topic_id;
    }

    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;

        return $this;
    }

    private $question;

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    private $description;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

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

    private $error;

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = $error;

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


    public function getAnswers()
    {
        try {
            $response  = $this->client->get()->request('GET', self::PATH  . $this->getId() . '/answers');
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
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
            'question' => $this->getQuestion(),
            'description' => $this->getDescription(),
            'topic_id' => $this->getTopicId(),
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
            'question' => $this->getQuestion(),
            'description' => $this->getDescription(),
            'id' => $this->getId()
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
            'parent_type' => 'question',
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
            'parent_type' => 'question',
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

    public function arrayToObject( $array ) {

        $this->setId( isset ( $array['id'] ) ? $array['id'] : 'null' )
            ->setQuestion( isset ( $array['question'] ) ? $array['question'] : 'null' )
            ->setUsername( isset ( $array['username'] ) ? $array['username'] : 'null' )
            ->setDescription( isset ( $array['description'] ) ? $array['description'] : 'null' )
            ->setTopicId( isset ( $array['topic_id'] ) ? $array['topic_id'] : 'null' )
            ->setCreatedAt( isset ( $array['created_at'] ) ? $array['created_at'] : 'null' )
            ->setIsDeleted( isset ( $array['is_deleted'] ) ? $array['is_deleted'] : 'null' )
            ->setUpdatedAt( isset ( $array['updated_at'] ) ? $array['updated_at'] : 'null' );
    }

}

?>