<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function cancel(Rental $rental)
    {
        // Check authorization
        if ($rental->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Check if rental can be cancelled
        if (!in_array($rental->status, ['pending', 'approved'])) {
            return redirect()->route('user.rentals.show', $rental->id)
                ->with('error', 'This rental cannot be cancelled.');
        }

        $rental->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('user.rentals.index')
            ->with('success', 'Rental cancelled successfully!');
    }
}
