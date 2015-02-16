<?php

class Person extends Eloquent{

    /**
     * Persons Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	person_full_name VARCHAR(255) / UNIQUE
     *  - 	person_description TEXT
     *  -   person_birthday TIMESTAMP
     *  -   category_id INT UNSIGNED / FOREIGN KEY@person_category
     *  -   is_athlete ENUM / DEFAULT 'yes'
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for news entities
     *
     */
    public static $rules = array(
        'person_full_name' => 'required|between:1,255|alpha_spaces|unique:persons',
        'person_description' => 'required',
        'person_category' => 'integer|between:1,7',
        'person_birthday' => 'date'
    );

    public static $rulesLessStrict = array(
        'person_full_name' => 'required|between:1,255|alpha_spaces',
        'person_description' => 'required',
        'person_category' => 'integer|between:1,7',
        'person_birthday' => 'date'
    );

    public static $rulesCategorySort = array(
        'person_category' => 'integer|between:1,7'
    );

    /**
     * validation error messages
     *
     */
    public static $messages = array(
        'person_full_name.required' => 'Ime i prezime osobe je obavezno.',
        'person_full_name.between' => 'Ime i prezime mora biti kraće od 255 znakova.',
        'person_full_name.alpha_spaces' => 'Ime i prezime osobe može sadržavati samo slova, razmak i crticu.',
        'person_full_name.unique' => 'Osoba s istim imenom i prezimenom već postoji.',
        'person_description.required' => 'Opis osobe je obavezan.',
        'person_category.integer' => 'Kategorija osobe je obavezna.',
        'person_category.between' => 'Kategorija osobe nije važeća.',
        'person_birthday.date' => 'Datum rođenja osobe nije važećeg formata.'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * define relationships
     */
    public function images()
    {
        return $this->hasMany('PersonImage', 'person_id');
    }

    public function category()
    {
        return $this->belongsTo('PersonCategory', 'category_id');
    }

    /**
     * added functions
     */
    public function getDateBirthdayFormated()
    {
        return date('d.m.Y.', strtotime($this->person_birthday));
    }

    public function getDateBirthdayInput()
    {
        return date('d.m.Y', strtotime($this->person_birthday));
    }


}