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
//    Action::create([
//        'resource_id' => $resource->id,
//        'name' => 'create',
//        'title' => 'Create',
//        'uri' => '/create',
//        'method' => 'GET',
//        'view' => 'form',
//        'view_config' => [],
//    ]);

    // Store
    Action::create([
        'resource_id' => $resource->id,
        'name' => 'store',
        'title' => 'Create',
        'uri' => '/',
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
        'name' => 'show',
        'title' => 'Show',
        'uri' => '/{id}',
        'method' => 'GET',
        'view' => 'show',
        'view_config' => [],
    ]);

    // Edit
//    Action::create([
//        'resource_id' => $resource->id,
//        'name' => 'edit',
//        'title' => 'Edit',
//        'uri' => '/{id}/edit',
//        'method' => 'GET',
//        'view' => 'form',
//        'view_config' => [],
//    ]);

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

Resource::deleting(function(Resource $resource) {

    foreach($resource->actions as $action) {
        $action->delete();
    }

    foreach($resource->elements as $element) {
        $element->delete();
    }
});

Action::created(function(Action $action) {

    if($action->uri == '/' && $action->method == 'POST') {

        ActionResponse::create([
            'action_id' => $action->id,
            'status' => 'success',
            'name' => 'success',
            'value' => 'true',
        ]);

        ActionMessage::create([
            'action_id' => $action->id,
            'status' => 'success',
            'body' => 'Item is succesfully created',
        ]);

    }

    if($action->uri == '/{id}' && $action->method == 'PUT') {

        ActionResponse::create([
            'action_id' => $action->id,
            'status' => 'success',
            'name' => 'success',
            'value' => 'true',
        ]);

        ActionMessage::create([
            'action_id' => $action->id,
            'status' => 'success',
            'body' => 'Item is succesfully updated',
        ]);

    }
});

Action::created(function(Action $action) {

    Node::create([
        'action_id' => $action->id,
        'label' => $action->title,
        'uri' => $action->name,
    ]);
});

Action::deleting(function(Action $action) {
    $action->responses()->delete();
    $action->messages()->delete();
    $action->redirects()->delete();
    $action->node->delete();
});
