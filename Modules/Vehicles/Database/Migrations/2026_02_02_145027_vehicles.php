<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'company_1';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('company_1')->create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license', 15);
            $table->enum('status', ['available', 'using', 'stopped'])->default('available');
            $table->foreignId('vehicle_type_id')->constrained('vehicle_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('company_1')->dropIfExists('vehicles');
    }
};
