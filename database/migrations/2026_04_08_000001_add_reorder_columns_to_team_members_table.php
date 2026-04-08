<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->after('sort_order');
            $table->integer('lft')->default(0)->after('parent_id');
            $table->integer('rgt')->default(0)->after('lft');
            $table->integer('depth')->default(0)->after('rgt');
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['parent_id', 'lft', 'rgt', 'depth']);
        });
    }
};
