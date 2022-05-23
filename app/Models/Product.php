<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProductFactory;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    public $scoutSyncAttributes = [
        'updateFilterableAttributes' => [
            'price',
            'in_stock',
            'name'
        ]
    ];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function toSearchableArray()
    {
        return $this->toResponseArray();
    }

    public function toResponseArray()
    {
        $array = $this->toArray();
        $array['price'] = (float) $array['price'];
        $array['types'] = $this->lookups->where('key', 'TYPE')->pluck('value');
        $array['vendors'] = $this->lookups->where('key', 'VENDOR')->pluck('value');
        $array['colors'] = $this->lookups->where('key', 'COLOR')->pluck('value');
        $array['settings'] = $this->lookups->where('key', 'SETTINGS')->pluck('value');
        $array['designers'] = $this->lookups->where('key', 'DESIGNER')->pluck('value');
        $array['materials'] = $this->lookups->where('key', 'MATERIAL')->pluck('value');
        $array['retailer'] = $this->retailer->name;

        return $array;
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function lookups()
    {
        return $this->belongsToMany(Lookup::class);
    }
}
