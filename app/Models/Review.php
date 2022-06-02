<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static wherePublished(bool $value)
 */
class Review extends Model
{
  use HasFactory;

  protected $fillable = [
    'customer_id',
    'message',
    'grade',
    'published',
  ];

  public function customer(): HasOne
  {
    return $this->hasOne(Customer::class, 'id', 'customer_id');
  }
}
