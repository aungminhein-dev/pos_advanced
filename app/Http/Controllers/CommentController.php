<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        if($request->starCount){
            $existingRating = Rating::query()->uniqueRating(Auth::user()->id,$request->productId)->first();
            Rating::create([
                'star_count' => $request->starCount,
                'user_id' => Auth::user()->id,
                'product_id'=> $request->productId
            ]);
            if($existingRating){
                $existingRating->update([
                    'star_count' =>  $request->starCount
                ]);
            }
        }

        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->productId,
            'description' => $request->description
        ];
        $userName = User::where('id',Auth::user()->id)->first()->name;
        $comment = Comment::create($data);
        $comment->notifications()->create([
            'title' => $userName . ' has commented on your product!',
            'description' => 'Loremm'
        ]);
        toastr()->success('Commented!','Success');
        return back()->with(['comment'=>'comment']);
    }
}
