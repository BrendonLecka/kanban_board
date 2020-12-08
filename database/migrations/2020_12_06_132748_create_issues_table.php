<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('assigned_to')->nullable();
            $table->dateTime('due_date');
            $table->smallInteger('order')->default(0);
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->foreignId('state_id');
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users');

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users');

            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
