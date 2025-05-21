<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->index('phoneUniqueIndex');
            $table->enum('status', ['new', 'in_progress', 'completed', 'cancelled'])->index('statusIndex');
            $table->text('note')->nullable();
            $table->foreignId('user_id')->nullable()->index('userIdIndex')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE leads ADD COLUMN brand_ids integer[] default NULL;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
