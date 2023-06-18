<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Design extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Design>
     */
    public static $model = \App\Models\Design::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
		ID::make()->sortable(),
		Text::make('Project Name', 'project_name'),
		            Text::make('Category'),
			                Text::make('Total Area'),
					            Text::make('Length'),
						                Text::make('Width'),
								            Text::make('Project ID'),
									                Number::make('Order Count'),
											            Text::make('Material Type'),
												                Text::make('Floors'),
														            Text::make('Roof Area'),
															                Text::make('Foundation'),
																	            Text::make('OCB200 Work'),
																		                Text::make('OCB200 Waste'),
																				            Text::make('Log200 Work'),
																					                Text::make('Log200 Waste'),
																							            Text::make('Timber145x140 Work'),
																								                Text::make('Timber145x140 Waste'),
																										            Text::make('Basement Floor'),
																											                Text::make('Ground Floor'),
																													            Text::make('Second Floor'),
																														                Text::make('Third Floor'),
																																            Text::make('Attic Floor'),
																																	                Text::make('OCB Walls (m2)'),
																																			            Text::make('PB Walls (m2)'),
																																				                Text::make('PB Cuts (lm)'),
																																						            Text::make('OCB Cuts (lm)'),
																																							                Text::make('Roofing Ruberoid (m2)'),
																																									            Text::make('Roof Slope'),
																																										                Text::make('Roof Pie'),
																																												            Text::make('Rafters'),
																																													                Text::make('Wide Ridge Piece'),
																																															            Text::make('Single Slope Ridge Piece'),
																																																                Text::make('Wind Plank'),
																																																		            Text::make('Eaves Board'),
																																																			                Text::make('Drip Edge'),
																																																					            Text::make('Lower Endova'),
																																																						                Text::make('Upper Endova'),
																																																								            Text::make('Screw 35'),
																																																									                Text::make('Screw 70'),
																																																											            Text::make('Packaging'),
																																																												                Text::make('Isospan AM 70m2'),
																																																														            Text::make('Isospan AM 35m2'),
																																																															                Text::make('Double Sided Tape'),
																																																																	            Text::make('Rockwool Scandik'),
																																																																		                Text::make('Isospan B 70m2'),
																																																																				            Text::make('Isospan B 35m2'),
																																																																					                Text::make('Corner Joint'),
																																																																							            Text::make('Surface Joint'),
																																																																								                Text::make('OSB3 Sheet'),
																																																																										            Text::make('Ridge Aerator'),
																																																																											                Text::make('Slope Aerator'),
																																																																													            Text::make('Roof Insulation 150mm'),
																																																																														                Text::make('Roof Insulation 200mm'),
																																																																																            Text::make('Gutter 3m'),
																																																																																	                Text::make('Gutter Connector'),
																																																																																			            Text::make('Gutter Bracket'),
																																																																																				                Text::make('End Cap'),
																																																																																						            Text::make('Funnel'),
																																																																																							                Text::make('Elbow'),
																																																																																									            Text::make('Downpipe 3m'),
																																																																																										                Text::make('Downpipe 1m'),
																																																																																												            Text::make('Pipe Clamp'),
																																																																																													                Text::make('Pipe Coupling'),
																																																																																															            Text::make('Gutter Angle 90'),
																																																																																																                Text::make('Gutter Inner Angle 90'),
																																																																																																		            Text::make('Gutter Length'),
																																																																																																			                Text::make('Sway Count'),
																																																																																																					            Text::make('Lumber Volume'),
																																																																																																						                Text::make('Area'),
																																																																																																								            Text::make('Cvs 108x2500'),
																																																																																																									                Text::make('Cvs 108x3000'),
																																																																																																											            Text::make('Concrete 150x3000'),
																																																																																																												                Text::make('Concrete 200x3000'),
																																																																																																														            Text::make('Ribbon 300x600'),
																																																																																																															                Text::make('Ribbon 300x700'),
																																																																																																																	            Text::make('Ribbon 300x800'),
																																																																																																																		                Text::make('Ribbon 300x900'),
																																																																																																																				            Text::make('Ribbon 300x1000'),
																																																																																																																					                Text::make('Ribbon 400x600'),
																																																																																																																							            Text::make('Ribbon 400x700'),
																																																																																																																								                Text::make('Ribbon 400x800'),
																																																																																																																										            Text::make('Ribbon 400x900'),
																																																																																																																											                Text::make('Ribbon 400x1000'),
																																																																																																																													            Text::make('Ribbon 500x600'),
																																																																																																																														                Text::make('Ribbon 500x700'),
																																																																																																																																            Text::make('Ribbon 500x800'),
																																																																																																																																	                Text::make('Ribbon 500x900'),
																																																																																																																																			            Text::make('Ribbon 500x1000'),
																																																																																																																																				                Text::make('Meta Title'),
																																																																																																																																						            Text::make('Meta Keywords'),
																																																																																																																																							                Text::make('Meta Description'),
																																																																																																																																									            Text::make('Element Title')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
