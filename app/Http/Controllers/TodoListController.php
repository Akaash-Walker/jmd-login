<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class TodoListController extends Controller
{
    // Conventionally index should come first, followed by create, store, show, edit, update, destroy
    public function index()
    {
        // authenticate user
        $user = Auth::user();

        // Fetch list items
        // $listItems = ListItem::all() ?? collect();
        // Note: listItem::all() will return an empty collection if it finds nothing, no need for the conditional check
        $listItems = ListItem::all(); // also, this is fine for short lists but may want to use pagination

        // Pass the list items and user to the view
        return view('dashboard', [
            'listItems' => $listItems,
            'user' => $user
        ]);
    }

    // This is where a create action would go if it were necessary...

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

        // All could be done with one line however the is_complete column is messing it up because we are not technically using it
        // ListItem::create($validatedData);

        // Flash user data to the session
        // $request->session()->flash('user', Auth::user());

        return redirect()->route('dashboard'); // Redirect to the dashboard page
    }

    // This is were a show action would go if it were necessary...

    public function edit($id)
    {
        $user = Auth::user();
        // $listItems = ListItem::all() ?? collect();
        // Note: listItem::all() will return an empty collection if it finds nothing, no need for the conditional check
        $listItems = ListItem::all();

        // foreach ($listItems as $listItem) {
        //     if ($listItem->id == $id) {
        //         // return view item if id matches
        //         return view('edit', ['listItem' => $listItem, 'user' => $user, 'listItems' => $listItems, 'id' => $id]);
        //     }
        // }
        // throw new Exception();

        // this replaces above, you don't need to loop over items, you just need to find
        $listItemToUpdate = ListItem::find($id);

        // Tip: compact() is a shorthand for saying that the key and value names are the same i.e 'listItem' => $listItem
        return view('edit', compact(['user', 'listItems', 'listItemToUpdate']));
    }

    public function update(Request $request, $id)
    {
    /*    $request->validate([
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
        }*/

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the list item
        $listItem = ListItem::find($id);
        $listItem->name = $validatedData['name'];
        $listItem->is_complete = 0; // only necessary because of the way the migration was set up
        $listItem->save();

        return redirect('dashboard');
    }

    // delete action is conventionally called destroy and comes last
    public function destroy($id)
    {
        // All of the below can be replaced with these two lines
        $listItem = ListItem::findOrFail($id);
        $listItem->delete();

        // // get all list items
        // $listItems = ListItem::all() ?? collect();

        // // loop over all list items and find the one that matches with id
        // foreach ($listItems as $item) {
        //     if ($item->id == $id) {
        //         // delete item if id matches
        //         $item->delete();
        //         // stop search
        //         break;
        //     }
        // }

        // go back to dashboard route
        return redirect()->route('dashboard')->with('success', 'Item deleted successfully.');
    }
}
