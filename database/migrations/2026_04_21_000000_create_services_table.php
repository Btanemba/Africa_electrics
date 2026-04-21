<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon', 50)->default('switchboard');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'title' => 'Switchboard Construction',
                'description' => 'Custom-designed and built switchboards for industrial and commercial applications, ensuring safe and efficient power distribution.',
                'icon' => 'switchboard',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Development Electronics',
                'description' => 'Engineering and development of electronic systems tailored to your specific needs, from prototyping to full-scale production.',
                'icon' => 'development',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Research & Development',
                'description' => 'Innovating new energy solutions and electrical technologies through continuous research, testing, and development programs.',
                'icon' => 'research',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};