<?php

namespace Mage2\Cart\Models;

use October\Rain\Auth\Models\User;

/**
 * Customer Model
 */
class Customer extends User {

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mage2_cart_customers';


    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'persist_code'
    ];
     /**
     * @var array The attributes that should be hidden for arrays.
     */
    protected $hidden = ['password', 'persist_code'];

    /**
     * @var array The attributes that aren't mass assignable.
     */
    protected $guarded = [ 'persist_code'];

     /**
     * @var array List of attribute names which should be hashed using the Bcrypt hashing algorithm.
     */
    protected $hashable = ['password', 'persist_code'];

    /**
     * @var array List of attribute names which should not be saved to the database.
     */
    protected $purgeable = ['password_confirmation'];

    /**
     * Validation rules
     */
    public $rules = [
        'email' => 'required|between:6,255|email|unique:mage2_cart_customers',
        'password' => 'required|between:4,255',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'orders' => ['Mage2\Cart\Models\Order']
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
    
    
    /**
     * Gets a code for when the user is persisted to a cookie or session which identifies the user.
     * @return string
     */
    public function beforeCreate()
    {
        $this->persist_code = str_random();
    }
       /**
     * Looks up a user by their email address.
     * @return self
     */
    public static function findByEmail($email)
    {
        if (!$email) {
            return;
        }

        return self::where('email', $email)->first();
    }

}
