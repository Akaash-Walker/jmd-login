<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

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

        // Flash user data to the session
        $request->session()->flash('user', Auth::user());

        return redirect()->route('dashboard'); // Redirect to the dashboard page
    }

    public function index()
    {
        // Fetch list items
        $listItems = ListItem::all() ?? collect();

        // authenticate user
        $user = Auth::user();

        // Pass the list items and user to the view
        return view('dashboard', [
            'listItems' => $listItems,
            'user' => $user
        ]);
    }

    public function delete($id)
    {

        // get all list items
        $listItems = ListItem::all() ?? collect();

        // loop over all list items and find the one that matches with id
        foreach ($listItems as $item) {
            if ($item->id == $id) {
                // delete item if id matches
                $item->delete();
                // stop search
                break;
            }
        }

        // go back to dashboard route
        return redirect()->route('dashboard')->with('success', 'Item deleted successfully.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $listItems = ListItem::all() ?? collect();
        foreach ($listItems as $listItem) {
            if ($listItem->id == $id) {
                // return view item if id matches
                return view('edit', ['listItem' => $listItem, 'user' => $user, 'listItems' => $listItems, 'id' => $id]);
            }
        }
        throw new Exception();
    }

    public function save(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $listItems = ListItem::all();
        foreach ($listItems as $listItem) {
            if ($listItem->id == $id) {
                $listItem->name = $request->input('name');
                $listItem->save();
                $itemId = $listItem->id;

                // Redirect back to the dashboard route with success message and item ID
                return redirect()->route('dashboard')->with('success', 'Item saved successfully.');
            }
        }
        throw new Exception();
    }
}
