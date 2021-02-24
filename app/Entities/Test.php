<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Test.
 *
 * @package namespace App\Entities;
 */
class Test extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'variable_parameter',
        'immutable_parameter',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'immutable_parameter' => 'CHANGED/ BUG!!!',
    ];

}
