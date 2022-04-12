<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StockLot extends Model
{

    use HasFactory;

    protected $connection = 'sqlsrv';

    protected $table = 'stock_lots';

    protected $fillable = [
        'lot_id',
        'dispatch_guide_id',
        'quantity_type_id',
        'items',
        'kg_amount',
        'loaded_by',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->loaded_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
            $model->loaded_by = is_object(Auth::guard(config('app.guards.web'))->user()) ? Auth::guard(config('app.guards.web'))->user()->id : 1;
        });

    }
}
