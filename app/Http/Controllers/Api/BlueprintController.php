<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlueprintRequest;
use App\Http\Requests\UpdateBlueprintRequest;
use App\Models\Bleuprint;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlueprintController extends Controller
{
 use AuthorizesRequests;
    public function index()
    {
     return  auth()->user()->bleuprint()->latest()->get();  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlueprintRequest $request)
    {
        return auth()->user()->bleuprint()->create(
            $request->validated()
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(Bleuprint $bleuprint)
    {
        $this->authorize('view',$bleuprint);
        return $bleuprint;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlueprintRequest $request, Bleuprint $bleuprint)
    {
       $this->authorize('update',$bleuprint); 
       $bleuprint->update($request->validated());
        return $bleuprint;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bleuprint $bleuprint)
    {
 $this->authorize('delete', $bleuprint);

        $blueprint->delete();

        return response()->json([
            'message' => 'Blueprint supprimé avec succès.'
        ]);    }
}
