<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('create_form_fields', function (Blueprint $table) {
                $table->id();
                $table->integer('formid');
                $table->text('label');
                $table->text('sample_field');
                $table->integer('field_type');
                $table->text('comments');
                $table->tinyInteger('status')->default('1');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_form_fields');
    }
};
