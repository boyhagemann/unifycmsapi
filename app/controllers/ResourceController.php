<?php

class ResourceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Resource::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $v = Validator::make(Input::all(), [
            'uri' => 'required|url',
            'title' => 'required',
        ]);

        if($v->fails()) {
            return ['success' => false, 'errors' => $v->messages()];
        }

        $resource = Resource::firstOrNew(Input::only(['uri']));
        $resource->fill(Input::only('title'));
        $resource->save();

        return [
            'success' => true,
            'errors' => [],
            'data' => $resource->toArray(),
        ];
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  Resource $resource
	 * @return Response
	 */
	public function show(Resource $resource)
	{
		return $resource;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Resource $resource)
	{
		$resource->delete();

        return ['success' => true, 'message' => 'Resource deleted'];
	}


}
