<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Person extends Eloquent implements SluggableInterface{

    /**
     * Persons Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	person_full_name VARCHAR(255) / UNIQUE
     *  - 	person_description TEXT
     *  -   person_birthday DATE
     *  -   category_id INT UNSIGNED / FOREIGN KEY@person_category
     *  -   is_athlete ENUM / DEFAULT 'yes'
     *  -   slug VARCHAR(255)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'person_full_name',
        'save_to'    => 'slug',
    );

    /**
     * validation rules for news entities
     *
     */
    public static $rules = array(
        'person_full_name' => 'required|between:1,255|unique:persons',
        'person_description' => 'required',
        'person_category' => 'integer|between:1,7',
        'person_birthday' => 'date'
    );

    public static $rulesLessStrict = array(
        'person_full_name' => 'required|between:1,255',
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

    public function getDateBirthdayFormatedHTML()
    {
        return date('Y-m-d', strtotime($this->person_birthday));
    }

    public function getDateBirthdayInput()
    {
        return date('d.m.Y', strtotime($this->person_birthday));
    }

    public function nextPerson()
    {
        return Person::where('id', '>', $this->id)->orderBy('id', 'asc')->take(1)->get()->first();
    }

    public function previousPerson()
    {
        return Person::where('id', '<', $this->id)->orderBy('id', 'desc')->take(1)->get()->first();
    }


}