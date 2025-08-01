<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if user_id is already nullable - if so, skip this migration
        $columns = DB::select('DESCRIBE reviews');
        $userIdColumn = collect($columns)->firstWhere('Field', 'user_id');
        
        if ($userIdColumn && $userIdColumn->Null === 'YES') {
            // user_id is already nullable, nothing to do
            return;
        }
        
        Schema::table('reviews', function (Blueprint $table) {
            // Check and drop foreign key constraint if it exists
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'reviews' 
                AND COLUMN_NAME = 'user_id' 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            
            if (!empty($foreignKeys)) {
                $table->dropForeign(['user_id']);
            }
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Check and drop unique constraint if it exists (though it likely doesn't exist)
            try {
                $table->dropUnique(['product_id', 'user_id']);
            } catch (\Illuminate\Database\QueryException $e) {
                // Ignore error if constraint doesn't exist
            }
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Modify user_id to be nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Add the foreign key constraint back
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            try {
                $table->dropForeign(['user_id']);
            } catch (\Illuminate\Database\QueryException $e) {
                // Ignore error if constraint doesn't exist
            }
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Make user_id non-nullable again
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
        
        Schema::table('reviews', function (Blueprint $table) {
            // Add back the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Only add unique constraint if it makes sense for your business logic
            // Uncomment the next line if you want to restore the unique constraint
            // $table->unique(['product_id', 'user_id']);
        });
    }
};
