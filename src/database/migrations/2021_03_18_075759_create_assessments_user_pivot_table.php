<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assessment_id');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('start_date')->nullable();
            $table->unique(['user_id', 'assessment_id'], 'uassessment_uq');
            $table->foreign('user_id', 'ua_user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('assessment_id', 'ua_assessment_id')->on('assessments')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('assessments_user_pivot');
    }
}
