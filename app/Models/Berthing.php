<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Berthing extends Model
{
    protected $table = 'berthing';

    public function port(): Relation
    {
        return $this->hasOne(Port::class);
    }

    public function setPort(?Port $port): void
    {
        if ($port === null) {
            throw new NotFoundHttpException('Port not found');
        }

        $this->port_id = $port->getAttribute('id');
    }

    public function ship(): Relation
    {
        return $this->belongsTo(Ship::class);
    }

    public function setShip(?Ship $ship): void
    {
        if ($ship === null) {
            throw new NotFoundHttpException('Ship not found');
        }

        $this->ship_id = $ship->getAttribute('id');
    }

    public function file(): Relation
    {
        return $this->belongsTo(File::class);
    }

    public function setFile(?File $file): void
    {
        $this->file_id = $file?->getAttribute('id') ?? null;
    }
}
