<?php 

namespace Linkorb\AnswersClient;

class Question {

	const PATH = 'questions/';
    
    
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

    private function toJSONString( $client ) {

    	$data = [
            'question' => $this->getQuestion(),
            'description' => $this->getDescription(),
            'topic_id' => $this->getTopicId(),
            'username' => $client->getUsername()
        ];
        
    	return json_encode($data);
    }

    public function create( $client ) {
    
	    $response  = $client->get()->request('POST', self::PATH, [
	    	'body' => $this->toJSONString( $client )
	    ] );

        $jsonDecode = json_decode( $response->getBody(), true );

        if ( isset ( $jsonDecode['error'] ) ) {
            $this->setError ( $jsonDecode['error']['message'] );
        } else {
	       $this->arrayToObject( $jsonDecode );
       }
		
    }
}

?>