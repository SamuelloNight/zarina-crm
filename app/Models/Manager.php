<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static whereEmail(mixed $email)
 * @method static create(array $array)
 * @method static find($id)
 */
class Manager extends Authenticatable
{
  use HasFactory, Notifiable;

  protected $fillable = [
    'avatar',
    'first_name',
    'last_name',
    'email',
    'phone_number',
    'password',
    'is_root',
  ];

  protected $appends = [
    'full_name'
  ];

  public function getFullNameAttribute(): string
  {
    return "$this->first_name $this->last_name";
  }

  public function getOrdersCount(string $status = null): int
  {
    return $status ? $this->orders()->where('status', '=', $status)->count() : $this->orders()->count();
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class, 'manager_id', 'id');
  }
}
