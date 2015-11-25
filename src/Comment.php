<?php

namespace Linkorb\AnswersClient;
 
use GuzzleHttp\Client as GuzzleClient;

class Comment
{
    const PATH = 'comments/';

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

    private $parent_id;

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    private $comment;

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    private $parent_type;

    public function getParentType()
    {
        return $this->parent_type;
    }

    public function setParentType($parent_type)
    {
        $this->parent_type = $parent_type;

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

    public function vote( ) {
        $data = [
            'parent_id' => $this->getId(),
            'parent_type' => 'comment',
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

    public function update() {
        
         $data = [
            'comment' => $this->getComment(),
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

    public function arrayToObject( $array ) {
        $this->setId( isset( $array['id'] ) ? $array['id'] : 'null')
            ->setComment( isset( $array['comment'] ) ? $array['comment'] : 'null')
            ->setUsername( isset( $array['username'] ) ? $array['username'] : 'null')
            ->setParentId( isset( $array['parent_id'] ) ? $array['parent_id'] : 'null')
            ->setParentType( isset( $array['parent_type'] ) ? $array['parent_type'] : 'null')
            ->setCreatedAt( isset( $array['created_at'] ) ? $array['created_at'] : 'null')
            ->setIsDeleted( isset( $array['is_deleted'] ) ? $array['is_deleted'] : 'null')
            ->setUpdatedAt( isset( $array['updated_at'] ) ? $array['updated_at'] : 'null');
    }
}