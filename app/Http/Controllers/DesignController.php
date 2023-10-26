<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use App\Models\Image;


class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.*/
    
    public function create(Request $request)
    {
        $title = $request->input('title');
        $pvParts = [
            $request->input('pvPart1'),
            $request->input('pvPart2'),
            $request->input('pvPart3'),
            $request->input('pvPart4'),
            $request->input('pvPart5'),
            $request->input('pvPart6'),
            $request->input('pvPart7'),
            $request->input('pvPart8'),
            $request->input('pvPart9'),
            $request->input('pvPart10'),
            $request->input('pvPart11'),
            $request->input('pvPart12')
            ];
        $serializePv = json_encode($pvParts);
        $mvParts = [
            $request->input('mvPart1'),
            $request->input('mvPart2'),
            $request->input('mvPart3'),
            $request->input('mvPart4'),
            $request->input('mvPart5'),
            $request->input('mvPart6'),
            $request->input('mvPart7'),
            $request->input('mvPart8'),
            $request->input('mvPart9'),
            $request->input('mvPart10'),
            $request->input('mvPart11'),
            $request->input('mvPart12')
            ];
        $meta = [
            $request->input('MetaTitle'),
            $request->input('MetaKeywords'),
            $request->input('MetaDesc'),
            $request->input('MetaHeader')
        ];
        $serializeMv = json_encode($mvParts);
        $serializeMeta = json_encode($meta);
        
        // Create a new Design instance
        $design = new Design();
        $design->title = $title;
        $design->pvPart1 = $serializePv;
        $design->mvPart1 = $serializeMv;
        $design->Meta = $serializeMeta;
        

        // Save the design to the database
        $design->save();
        
        // Upload and save the associated imagesy
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
    
                $imageModel = new Image();
                $imageModel->filename = $path;
                // Set any additional image properties...
                
                $design->images()->save($imageModel);
            }
        }
    }
         
 public function store(Request $request)
    {
        /*Validate and process the request data*/
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'size' => 'required|string',
            'length' => 'required|string',
            'width' => 'required|string',
            'code' => 'required|string',
            'numOrders' => 'required|integer',
            // ... Add validation rules for other properties ...
        ]);

        // Create a new design instance
        $design = Design::create($validatedData);

        // Process and save rooms data
        if ($request->has('rooms')) {
            $roomsData = $request->input('rooms');
            $rooms = [];

            foreach ($roomsData as $roomData) {
                $room = new Room($roomData);
                $rooms[] = $room;
            }

            $design->rooms()->saveMany($rooms);
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Design saved successfully!');
    }

    public function updateOrder(Request $request, $id)
    {
        
        $design = Design::findOrFail($id);
        $design->order = $request->input('order');
        $design->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design)
    {
        //
    }
}
