<?php


Resource::created(function(Resource $resource) {

    Action::unguard();

    // Index
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'index',
        'title' => 'Index',
        'uri' => '/',
        'method' => 'GET',
        'view' => 'grid',
        'view_config' => [],
    ]);

    // Create
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'create',
        'title' => 'Create',
        'uri' => '/create',
        'method' => 'GET',
        'view' => 'form',
        'view_config' => [],
    ]);

    // Store
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'store',
        'title' => 'Store',
        'uri' => '/create',
        'method' => 'POST',
        'view' => 'redirect',
        'view_config' => [
            'route' => $resource->slug . '.index',
            'message' => 'Item is created!',
        ],
    ]);

    // Show
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'store',
        'title' => 'Store',
        'uri' => '/{id}',
        'method' => 'GET',
        'view' => 'show',
        'view_config' => [],
    ]);

    // Edit
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'edit',
        'title' => 'Edit',
        'uri' => '/{id}/edit',
        'method' => 'GET',
        'view' => 'form',
        'view_config' => [],
    ]);

    // Update
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'update',
        'title' => 'Update',
        'uri' => '/{id}',
        'method' => 'PUT',
        'view' => 'redirect',
        'view_config' => [
            'route' => $resource->slug . '.index',
            'message' => 'Item is updated!',
        ],
    ]);

    // Destroy
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'destroy',
        'title' => 'Delete',
        'uri' => '/{id}',
        'method' => 'DELETE',
        'view' => 'redirect',
        'view_config' => [
            'route' => $resource->slug . '.index',
            'message' => 'Item is deleted!',
        ],
    ]);
});


Resource::created(function(Resource $resource) {

    $client = new Guzzle\Http\Client();
    $response = $client->get($resource->uri)->send();

    $data = $response->json();
    $item = current($data);

    foreach($item as $name => $value) {

        $element = Element::firstOrNew([
            'resource_id' => $resource->id,
            'name' => $name
        ]);

        $element->label = Str::title($name);
        $element->type = 'string';
        $element->save();
    }
});
