<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_issues', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bookID');
            $table->integer('memberID') ;
            $table->enum('status' , array(
                "issue", "return"
            )) ;
            $table->dateTime("issueDate") ;
            $table->dateTime('returnDate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('book_issues');
    }
}
