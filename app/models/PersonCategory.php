<?php

class PersonCategory extends Eloquent{

    /**
     * PersonCategory Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	category_name VARCHAR(100) / UNIQUE
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'person_category';

    /**
     * define relationships
     */
    public function persons()
    {
        return $this->belongsToMany('Person');
    }

}