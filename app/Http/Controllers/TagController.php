<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function delete(Tag $tag)
    {
       $tag->delete();
       return back();
    }
}
