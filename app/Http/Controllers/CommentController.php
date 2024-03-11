<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
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

        return back()->with(['comment'=>'comment']);
    }
}
