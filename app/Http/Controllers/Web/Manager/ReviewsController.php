<?php

namespace App\Http\Controllers\Web\Manager;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
  public function show()
  {
    return view('pages.manager.reviews.list', [
      'reviews' => Review::with([
        'customer'
      ])->get()
    ]);
  }

  public function publishToggle($id)
  {
    $review = Review::find($id);

    $review->update([
      'published' => !$review->published
    ]);

    return redirect()->back()->with('successMessage', __('Review successfully updated'));
  }

  public function delete($id)
  {
    Review::find($id)->delete();
    return redirect()->back()->with('successMessage', __('Review successfully deleted'));
  }
}
