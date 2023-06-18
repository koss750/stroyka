<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
	    /**
	     *      * The table associated with the model.
	     *           *
	     *                * @var string
	     *                     */
	    protected $table = 'designs';

	        /**
		 *      * The attributes that are mass assignable.
		 *           *
		 *                * @var array
		 *                     */
	        protected $fillable = [
			        'project_name',
				        'category',
					        'total_area',
						        'length',
							        'width',
								        'project_id',
									        'order_count',
										        'material_type',
											        'floors',
												        'roof_area',
													        'foundation',
														        'ocb200_work',
															        'ocb200_waste',
																        'log200_work',
																	        'log200_waste',
																		        'timber145x140_work',
																			        'timber145x140_waste',
																				        'basement_floor',
																					        'ground_floor',
																						        'second_floor',
																							        'third_floor',
																								        'attic_floor',
																									        'ocb_walls_m2',
																										        'pb_walls_m2',
																											        'pb_cuts_lm',
																												        'ocb_cuts_lm',
																													        'roofing_ruberoid_m2',
																														        'roof_slope',
																															        'roof_pie',
																																        'rafters',
																																	        'wide_ridge_piece',
																																		        'single_slope_ridge_piece',
																																			        'wind_plank',
																																				        'eaves_board',
																																					        'drip_edge',
																																						        'lower_endova',
																																							        'upper_endova',
																																								        'screw_35',
																																									        'screw_70',
																																										        'packaging',
																																											        'isospan_am_70m2',
																																												        'isospan_am_35m2',
																																													        'double_sided_tape',
																																														        'rockwool_scandik',
																																															        'isospan_b_70m2',
																																																        'isospan_b_35m2',
																																																	        'corner_joint',
																																																		        'surface_joint',
																																																			        'osb3_sheet',
																																																				        'ridge_aerator',
																																																					        'slope_aerator',
																																																						        'roof_insulation_150mm',
																																																							        'roof_insulation_200mm',
																																																								        'gutter_3m',
																																																									        'gutter_connector',
																																																										        'gutter_bracket',
																																																											        'end_cap',
																																																												        'funnel',
																																																													        'elbow',
																																																														        'downpipe_3m',
																																																															        'downpipe_1m',
																																																																        'pipe_clamp',
																																																																	        'pipe_coupling',
																																																																		        'gutter_angle_90',
																																																																			        'gutter_inner_angle_90',
																																																																				        'gutter_length',
																																																																					        'sway_count',
																																																																						        'lumber_volume',
																																																																							        'area',
																																																																								        'cvs_108x2500',
																																																																									        'cvs_108x3000',
																																																																										        'concrete_150x3000',
																																																																											        'concrete_200x3000',
																																																																												        'ribbon_300x600',
																																																																													        'ribbon_300x700',
																																																																														        'ribbon_300x800',
																																																																															        'ribbon_300x900',
																																																																																        'ribbon_300x1000',
																																																																																	        'ribbon_400x600',
																																																																																		        'ribbon_400x700',
																																																																																			        'ribbon_400x800',
																																																																																				        'ribbon_400x900',
																																																																																					        'ribbon_400x1000',
																																																																																						        'ribbon_500x600',
																																																																																							        'ribbon_500x700',
																																																																																								        'ribbon_500x800',
																																																																																									        'ribbon_500x900',
																																																																																										        'ribbon_500x1000',
																																																																																											        'meta_title',
																																																																																												        'meta_keywords',
																																																																																													        'meta_description',
																																																																																														        'element_title',
																																																																																															    ];
}
