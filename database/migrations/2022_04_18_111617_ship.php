<?php

use App\Models\File;
use App\Models\Port;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ship', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('imo');
            $table->string('residence')->nullable();
            $table->foreignIdFor(Port::class, 'residence_port')->nullable();
            $table->foreignIdFor(File::class)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ship');
    }
};
