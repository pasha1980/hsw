<?php

namespace App\Models;

use App\Filters\PortFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Port extends Model
{
    use HasFactory;
    protected $table = 'port';

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new PortFilter($request))->filter($builder);
    }
}
