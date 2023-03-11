<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_code',
        'category_id',
        'suppliers_id',
        'unit_id',
        'description',
        'status',
        'price',
        'image',
    ];
}
