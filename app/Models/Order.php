<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static whereId($id)
 */
class Order extends Model
{
  use HasFactory;

  public const REQUEST_FROM_CLIENT = 'Request from clinet';
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

  public function customer(): HasOne
  {
    return $this->hasOne(Customer::class, 'id', 'customer_id');
  }

  public function manager()
  {
    // return $this->hasOne(Manager::class, 'id', 'manager_id')
  }
}
