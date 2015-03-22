<?php

class Gallery extends Eloquent{

    /**
     * Gallery Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	file_name VARCHAR(255) / UNIQUE
     *  -   file_size DOUBLE
     *  -   caption VARCHAR(255)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for news image entities
     *
     */
    public static $rules = array(
        'caption' => 'between:1,255',
        'image' => 'image|max:6000'
    );

    /**
     * validation error messages
     *
     */
    public static $messages = array(
        'caption.between' => 'Tekst slike mora biti kraći od 255 znakova.',
        'image.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif.',
        'image.max' => 'Maksimalna veličina slike je 6MB.'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gallery_images';
}