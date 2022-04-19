<?php

namespace App\Models;

use App\Filters\ShipFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Ship extends Model
{
    use HasFactory;
    protected $table = 'ship';

    public function file(): Relation
    {
        return $this->belongsTo(File::class);
    }

    public function setFile(?File $file): void
    {
        if ($file === null) {
            return;
        }

        $this->file_id = $file->getAttribute('id');
    }

    public function berthing(): Relation
    {
        return $this->hasMany(Berthing::class);
    }

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new ShipFilter($request))->filter($builder);
    }
}
