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
        Schema::table('menu', function (Blueprint $table) {
            // Supprime les colonnes uniquement si elles existent
            if (Schema::hasColumn('menu', 'starter')) {
                $table->dropColumn('starter');
            }
            if (Schema::hasColumn('menu', 'main_course')) {
                $table->dropColumn('main_course');
            }
            if (Schema::hasColumn('menu', 'dairy')) {
                $table->dropColumn('dairy');
            }
            if (Schema::hasColumn('menu', 'dessert')) {
                $table->dropColumn('dessert');
            }
            if (Schema::hasColumn('menu', 'menu_date')) {
                $table->dropColumn('menu_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->string('starter')->nullable();
            $table->string('main_course')->nullable();
            $table->string('dairy')->nullable();
            $table->string('dessert')->nullable();
            $table->date('menu_date')->nullable();
        });
    }
};
