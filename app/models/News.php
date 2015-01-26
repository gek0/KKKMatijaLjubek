<?php

class News extends Eloquent{

    /**
     * News Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	news_title VARCHAR(255) / UNIQUE
     *  - 	news_body TEXT
     *  -   news_author INT UNSIGNED / FOREIGN KEY@users
     *  -   num_visited INT UNSIGNED
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for news entities
     *
     */
    public static $rules = array(
        'news_title' => 'required|between:1,255|unique:news',
        'news_body' => 'required'
    );

    /**
     * validation error messages
     *
     */
    public static $messages = array(
        'news_title.required' => 'Naslov vijesti je obavezan.',
        'news_title.between' => 'Naslov mora biti kraći od 255 znakova.',
        'news_title.unique' => 'Vijest s istim naslovom već postoji.',
        'news_body' => 'Tekst vijesti je obavezan.'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * define relationships
     */
    public function author()
    {
        return $this->belongsTo('User', 'news_author');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
}