<?php

use App\Models\Ship;
use App\Models\Port;
use App\Models\File;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berthing', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ship::class);
            $table->foreignIdFor(Port::class);
            $table->dateTime('dateStart')->nullable();
            $table->dateTime('dateEnd')->nullable();
            $table->foreignIdFor(File::class)->nullable();
            $table->string('cargo')->nullable();
            $table->integer('const')->nullable();
            $table->boolean('isLoad')->nullable();
            $table->boolean('isShortage')->nullable();
            $table->text('problems')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berthing');
    }
};
