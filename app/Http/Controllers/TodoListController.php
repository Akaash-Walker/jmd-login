<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
class TodoListController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new list item with the validated data
        $newListItem = new ListItem;
        $newListItem->name = $validatedData['name'];
        $newListItem->is_complete = 0;
        $newListItem->save();

        return view('dashboard');
    }
}
