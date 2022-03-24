<?php

/* Telling the PHP compiler that the class Inventory is in the App\Models namespace. */

namespace App\Models;

/* This is a shortcut for the following code: */

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* This class is a model that represents the inventory table in the database */

class Inventory extends Model
{
    /* This is a shortcut for the following code: */
    use HasFactory;

    /* This is the model's database table name, primary key, and the fields that can be filled. */
    protected $table = 'inventorys';
    protected $primaryKey = 'id';
    protected $fillable = ['item', 'price'];

    /**
     * The `transaction()` method returns a `Transaction` object that is associated with the
     * `Transaction` model
     * 
     * @return A Transaction object.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
