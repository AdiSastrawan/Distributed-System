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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->date("borrow_start");
            $table->date("borrow_end");
            $table->foreignId('book_id')->nullable()->constrained('books')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('librarian_id')->nullable()->constrained('librarians')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignUuid('student_id')->nullable()->constrained('students')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
