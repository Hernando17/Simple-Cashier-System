<?php

/* Telling the PHP compiler that the class Transaction is in the App\Models namespace. */

namespace App\Models;

/* This is a shortcut to the `factory` method in the `HasFactory` trait. */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* The Transaction model is a model that represents a transaction */

class Transaction extends Model
{
    /* This is a shortcut to the `factory` method in the `HasFactory` trait. */
    use HasFactory;
    /* This is telling the database that the table name is `transactions` and the primary key is `id`.
   The `fillable` property is telling the database that the fields `id_inventory`, `quantity`,
   `discount`, and `total` are allowed to be filled in. */

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id_inventory', 'quantity', 'discount', 'total'];

    /**
     * This function returns the inventory model that the product belongs to
     * 
     * @return The belongsTo method returns an object of the class that it is called on. In this case,
     * it returns an object of the class Question.
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'id_inventory', 'id');
    }
}
