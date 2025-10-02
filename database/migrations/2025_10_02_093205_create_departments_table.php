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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
              $table->string('tenant_id')->constrained()->onDelete('cascade'); // Added for multi-tenancy
               $table->string('name');
                 $table->string('seo');
               $table->text('added_by')->nullable();
            $table->unsignedBigInteger('head_of_department')->nullable(); // references users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
