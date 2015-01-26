<?php

class Tag extends Eloquent{

    /**
     * News Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	tag VARCHAR(50)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for news entities
     *
     */
    public static $rules = array(
        'tag' => 'between:1,50'
    );

    /**
     * validation error messages
     *
     */
    public static $messages = array(
        'tag.between' => 'Tag mora imati barem 1 znak i manje od 50.'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * define relationships
     */
    public function news()
    {
        return $this->belongsToMany('News');
    }
}