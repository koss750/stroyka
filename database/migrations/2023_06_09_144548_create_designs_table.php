<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsTable extends Migration
{
	    /**
	     *      * Run the migrations.
	     *           *
	     *                * @return void
	     *                     */
	    public function up()
		        {
				        Schema::create('designs', function (Blueprint $table) {
						$table->id();
						$table->string('project_name');
						            $table->string('category');
						            $table->string('total_area');
							                $table->string('length');
							                $table->string('width');
									            $table->string('project_id');
									            $table->string('order_count');
										                $table->string('material_type');
										                $table->string('floors');
												            $table->string('roof_area');
												            $table->string('foundation');
													                $table->string('ocb200_work');
													                $table->string('ocb200_waste');
															            $table->string('log200_work');
															            $table->string('log200_waste');
																                $table->string('timber145x140_work');
																                $table->string('timber145x140_waste');
																		            $table->string('basement_floor');
																		            $table->string('ground_floor');
																			                $table->string('second_floor');
																			                $table->string('third_floor');
																					            $table->string('attic_floor');
																					            $table->string('ocb_walls_m2');
																						                $table->string('pb_walls_m2');
																						                $table->string('pb_cuts_lm');
																								            $table->string('ocb_cuts_lm');
																								            $table->string('roofing_ruberoid_m2');
																									                $table->string('roof_slope');
																									                $table->string('roof_pie');
																											            $table->string('rafters');
																											            $table->string('wide_ridge_piece');
																												                $table->string('single_slope_ridge_piece');
																												                $table->string('wind_plank');
																														            $table->string('eaves_board');
																														            $table->string('drip_edge');
																															                $table->string('lower_endova');
																															                $table->string('upper_endova');
																																	            $table->string('screw_35');
																																	            $table->string('screw_70');
																																		                $table->string('packaging');
																																		                $table->string('isospan_am_70m2');
																																				            $table->string('isospan_am_35m2');
																																				            $table->string('double_sided_tape');
																																													            $table->string('gutter_connector');
																																														                $table->string('gutter_bracket');
																																														                $table->string('end_cap');
																																																            $table->string('funnel');
																																																            $table->string('elbow');
																																																	                $table->string('downpipe_3m');
																																																	                $table->string('downpipe_1m');
																																																			            $table->string('pipe_clamp');
																																																			            $table->string('pipe_coupling');
																																																				                $table->string('gutter_angle_90');
																																																				                $table->string('gutter_inner_angle_90');
																																																						            $table->string('gutter_length');
																																																						            $table->string('sway_count');
																																																							                $table->string('lumber_volume');
																																																							                $table->string('area');
																																																									            $table->string('cvs_108x2500');
																																																									            $table->string('cvs_108x3000');
																																																										                $table->string('concrete_150x3000');
																																																										                $table->string('concrete_200x3000');
																																																												            $table->string('ribbon_300x600');
																																																												            $table->string('ribbon_300x700');
																																																													                $table->string('ribbon_300x800');
																																																													                $table->string('ribbon_300x900');
																																																															            $table->string('ribbon_300x1000');
																																																															            $table->string('ribbon_400x600');
																																																																                $table->string('ribbon_400x700');
																																																																                $table->string('ribbon_400x800');
																																																																		            $table->string('ribbon_400x900');
																																																																		            $table->string('ribbon_400x1000');
																																																																			                $table->string('ribbon_500x600');
																																																																			                $table->string('ribbon_500x700');
																																																																					            $table->string('ribbon_500x800');
																																																																					            $table->string('ribbon_500x900');
																																																																						                $table->string('ribbon_500x1000');
																																																																						                $table->string('meta_title');
																																																																								            $table->string('meta_keywords');
																																																																								            $table->string('meta_description');
																																																																									                $table->string('element_title');
																																																																									                $table->timestamps();
																																																																											        });
					    }

	        /**
		 *      * Reverse the migrations.
		 *           *
		 *                * @return void
		 *                     */
	        public function down()
			    {
				            Schema::dropIfExists('projects');
					        }
}
