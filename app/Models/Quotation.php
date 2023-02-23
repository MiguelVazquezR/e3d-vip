<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    // constants
    const STATUS_IN_CHECKING = 0,
        STATUS_GENERATED = 1,
        STATUS_APPROVED = 2;

    protected $fillable = [
        'user_id',
        'seller_id',
        'released_at',
        'status',
        'freight_cost',
        'tooling_cost',
        'currency',
        'first_production_days',
    ];

    protected $dates = ['released_at'];

    protected $relationships_white_list = ['user', 'products', 'seller'];
    protected $filter_white_list = ['id', 'currency', 'status'];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(ProductQuotation::class);
    }

    // query scopes
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->relationships_white_list) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $relationships_white_list = collect($this->relationships_white_list);

        foreach ($relations as $key => $relationship) {
            if (!$relationships_white_list->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    public function scopeFilter(Builder $query)
    {
        if (empty($this->filter_white_list) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $filter_white_list = collect($this->filter_white_list);

        foreach ($filters as $key => $value) {
            if ($filter_white_list->contains($key)) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }
    }
}
