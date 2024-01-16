<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['item_name', 'category', 'price', 'description', 'condition', 'type', 'status', 'photo', 'owner_name', 'contact', 'address'];
}
