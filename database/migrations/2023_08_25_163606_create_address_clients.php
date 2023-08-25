<?php

use App\Models\Client;
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
        Schema::create('address_clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cep');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->string('state');
            $table->enum('type', ['residence', 'work', 'charge'])->nullable();
            $table->foreignIdFor(Client::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
