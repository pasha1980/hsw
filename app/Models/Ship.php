<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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
}
