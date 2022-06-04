<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ReflectionClass;

/**
 * @method static create(array $array)
 * @method static whereId($id)
 * @method static whereManagerId(mixed $id)
 * @method static find($id)
 */
class Order extends Model
{
  use HasFactory;

  public const REQUEST_FROM_CLIENT = 'Request from client';
  public const ACCEPTED_BY_MANAGER = 'Accepted by manager';
  public const AWAITING_PAYMENT = 'Awaiting payment';
  public const STATUS_DELETED_BY_CUSTOMER = 'Deleted by customer';
  public const STATUS_DELETED_BY_MANAGER = 'Deleted by manager';
  public const STATUS_SUCCESSFULLY_IMPLEMENTED = 'Successfully implemented';

  protected $fillable = [
    'customer_id',
    'manager_id',
    'name',
    'phone_number',
    'email',
    'company',
    'description',
    'services',
    'status',
  ];

  protected $appends = [
    'cleared_phone_number'
  ];

  public function getClearedPhoneNumberAttribute()
  {
    return str_replace([' ', '(', ')', '+'], '', $this->phone_number);
  }

  public function customer(): HasOne
  {
    return $this->hasOne(Customer::class, 'id', 'customer_id');
  }

  public function manager(): HasOne
  {
     return $this->hasOne(Manager::class, 'id', 'manager_id');
  }

  public static function statuses(): array
  {
    return [
      self::REQUEST_FROM_CLIENT,
      self::ACCEPTED_BY_MANAGER,
      self::AWAITING_PAYMENT,
      self::STATUS_DELETED_BY_CUSTOMER,
      self::STATUS_DELETED_BY_MANAGER,
      self::STATUS_SUCCESSFULLY_IMPLEMENTED,
    ];
  }
}
