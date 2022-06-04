<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $validated)
 * @method static wherePhoneNumber(mixed $phone_number)
 * @method static find(int|string|null $id)
 * @method static whereId(int|string|null $id)
 */
class Customer extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone_number',
    'password',
    'business_area',
  ];

  protected $hidden = [
    'password',
  ];

  protected $appends = [
    'full_name'
  ];

  public function getFullNameAttribute(): string
  {
    return "$this->first_name $this->last_name";
  }

  public function review(): HasOne
  {
    return $this->hasOne(Review::class, 'customer_id', 'id');
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class, 'customer_id', 'id');
  }

  public function getOrdersCount(string $status = null): int
  {
    return $status ? $this->orders()->where('status', '=', $status)->count() : $this->orders()->count();
  }
}
