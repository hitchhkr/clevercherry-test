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
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable(true);
            $table->integer('blocks')->default(1);
            $table->boolean('enabled')->default(1);
            $table->timestamps();
        });

        $data = [
            [
                'title' => 'Consultation',
                'blocks' => 4
            ],
            [
                'title' => 'Follow-up',
                'blocks' => 2
            ],
            [
                'title' => 'Evaluation',
                'blocks' => 1
            ]
            ];

        DB::table('appointment_types')->insert($data);
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_types');
    }
};
