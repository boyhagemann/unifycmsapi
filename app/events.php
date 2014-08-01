<?php


Resource::created(function(Resource $resource) {

    Action::unguard();

    // Index
    $index = Action::create([
        'resource_id' => $resource->id,
        'name' => 'index',
        'title' => 'Index',
        'uri' => '/',
        'method' => 'GET',
        'view' => 'grid',
        'view_config' => [],
    ]);

    $indexNode = Node::create([
        'action_id' => $index->id,
        'label' => $index->title,
        'uri' => $resource->slug,
    ]);

    // Create
    $create = Action::create([
        'resource_id' => $resource->id,
        'name' => 'create',
        'title' => 'Create',
        'uri' => '/',
        'method' => 'POST',
        'view' => 'form',
        'view_config' => [],
    ]);

    $createNode = Node::create([
        'action_id' => $create->id,
        'label' => $create->title,
        'uri' => $resource->slug . '/create',
    ]);
    $createNode->makeChildOf($indexNode);

    // Show
    $show = Action::create([
        'resource_id' => $resource->id,
        'name' => 'show',
        'title' => 'Show',
        'uri' => '/{id}',
        'method' => 'GET',
        'view' => 'show',
        'view_config' => [],
    ]);

    $showNode = Node::create([
        'action_id' => $show->id,
        'label' => $show->title,
        'uri' => $resource->slug . '/{id}',
    ]);
    $showNode->makeChildOf($indexNode);

    // Edit
    $edit = Action::create([
        'resource_id' => $resource->id,
        'name' => 'edit',
        'title' => 'Edit',
        'uri' => '/{id}',
        'method' => 'PUT',
        'view' => 'form',
        'view_config' => [],
    ]);

    $editNode = Node::create([
        'action_id' => $edit->id,
        'label' => $edit->title,
        'uri' => $resource->slug . '/{id}/edit',
    ]);
    $editNode->makeChildOf($indexNode);

    // Delete
    $delete = Action::create([
        'resource_id' => $resource->id,
        'name' => 'delete',
        'title' => 'Delete',
        'uri' => '/{id}',
        'method' => 'DELETE',
        'view' => 'delete',
        'view_config' => [],
    ]);

    $deleteNode = Node::create([
        'action_id' => $delete->id,
        'label' => $delete->title,
        'uri' => $resource->slug . '/{id}/delete',
    ]);
    $deleteNode->makeChildOf($indexNode);
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

Element::created(function(Element $element) {

    $actions = $element->resource->actions;

    foreach($actions as $action) {

        if($action->name == 'delete') {
            continue;
        }

        $field = Event::until('element.created', [$action, $element]);
        $field->save();
    }

});

Action::deleting(function(Action $action) {
    $action->responses()->delete();
    $action->messages()->delete();
    $action->redirects()->delete();

    if($action->node) {
        $action->node->delete();
    }
});

Element::deleting(function(Element $element) {

    $element->fields()->delete();

});


Event::listen('element.created', function(Action $action, Element $element) {

    return Field::firstOrNew([
        'element_id' => $element->id,
        'action_id' => $action->id,
        'view' => 'form.text',
        'view_config' => [
            'placeholder' => 'haaaa...',
        ],
    ]);
});