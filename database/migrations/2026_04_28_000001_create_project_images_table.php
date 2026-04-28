<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $projects = DB::table('projects')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->select('id', 'image')
            ->orderBy('id')
            ->get();

        if ($projects->isEmpty()) {
            return;
        }

        $timestamp = now();

        DB::table('project_images')->insert(
            $projects->map(static fn (object $project) => [
                'project_id' => $project->id,
                'image_path' => $project->image,
                'sort_order' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ])->all()
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};