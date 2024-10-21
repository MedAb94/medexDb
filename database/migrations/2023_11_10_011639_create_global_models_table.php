<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('global_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('url_prefix');
            $table->string('icon')->nullable();
            $table->string('add_title')->nullable();
            $table->string('edit_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_models');
    }
};
