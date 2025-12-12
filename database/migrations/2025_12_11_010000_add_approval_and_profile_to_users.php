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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('email');
            $table->unsignedTinyInteger('age')->nullable()->after('mobile');
            $table->boolean('approved')->default(false)->after('password');
            $table->foreignId('requested_course_id')->nullable()->constrained('courses')->nullOnDelete()->after('approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['requested_course_id']);
            $table->dropColumn(['mobile', 'age', 'approved', 'requested_course_id']);
        });
    }
};
