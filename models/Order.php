<?php namespace Mage2\Cart\Models;

use Model;

/**
 * Order Model
 */
class Order extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mage2_cart_orders';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
                    'customer_id',
                    'address_shipping_id',
                    'address_billing_id',
                    'payment_method',
                    'shipping_method',
                    'status_id'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
    ];
    public $hasMany = [];
    public $belongsTo = [
        'customer' => \Mage2\Cart\Models\Customer::class,
        'status' => \Mage2\Cart\Models\Status::class
    ];
    public $belongsToMany = ['products' => ['Mage2\Cart\Models\Product', 'table' => 'mage2_cart_order_product']];
     
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}