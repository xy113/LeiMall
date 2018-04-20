<?php

namespace App\Models;

/**
 * App\Models\Address
 *
 * @property int $address_id
 * @property int $uid
 * @property string $consignee
 * @property string $phone
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $street
 * @property string $postcode
 * @property int $isdefault
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereConsignee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereIsdefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereUid($value)
 * @mixin \Eloquent
 */
class Address extends BaseModel
{
    protected $table = 'address';
    protected $primaryKey = 'address_id';
}
