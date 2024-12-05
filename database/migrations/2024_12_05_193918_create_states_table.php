<?php

use App\Models\State;
use App\Services\StateService;
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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->timestamps();
        });

        (new StateService())->addMigrateState(State::CREATED_ID, 'Создан');
        (new StateService())->addMigrateState(State::PUBLISHED_ID, 'Опубликован');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
