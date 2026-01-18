<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('title');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company');
            $table->string('designation');
            $table->string('category');
            $table->string('token');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('redeem')->default(0);
            $table->timestamp('redeem_on')->nullable();
            $table->integer('type');

            // Indexes
            $table->index('name', 'idx_name');
            $table->index('email', 'idx_email');
            $table->index('phone', 'idx_phone');
            $table->index('token', 'idx_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendee');
    }
};
