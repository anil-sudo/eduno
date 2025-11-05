<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Enums
use App\Enums\VisibilityType;
use App\Enums\MediaFormat; 
use App\Enums\MediaType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->string('caption')->nullable();

            $table->string('type')->default(MediaType::Image->value); 
            $table->string('visibility')->default(VisibilityType::Private->value);
            $table->string('format')->default(MediaFormat::Portrait->value);

            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->string('poster')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
