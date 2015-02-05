<?php

class NewsImage extends Eloquent{

    /**
     * NewsImage Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	file_name_title VARCHAR(255) / UNIQUE
     *  - 	file_location VARCHAR(255)
     *  -   file_size DOUBLE
     *  -   news_id INT UNSIGNED / FOREIGN KEY@news
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for news image entities
     *
     */
    public static $rules = array(
        'images' => 'image|max:6000'
    );

    /**
     * validation error messages
     *
     */
    public static $messages = array(
        'images.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif.',
        'images.max' => 'Maksimalna veličina slike je 6MB.'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_images';

    /**
     * define relationships
     */
    public function news()
    {
        return $this->belongsTo('News', 'news_id');
    }
}