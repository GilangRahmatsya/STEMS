<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    use AuthorizesRequests;

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        // Delete image if exists
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()->route('user.items.index')
            ->with('success', 'Item deleted successfully!');
    }
}
