<?php

namespace App\Http\Controllers;

use App\Models\Commentaar;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CommentaarController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'message' => 'required',
        ]);
        $comment = new Commentaar();
        $comment->user_id = auth()->id();
        $comment->news_id = $request->news_id;
        $comment->message = $request->message;

        $comment->save();

        return redirect()->back()->with('success', 'Commentaar toegevoegd');
        
    }

    public function edit($id)
    {
        $comment = Commentaar::findOrFail($id);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Commentaar::findOrFail($id);
        $comment->message = $request->title;

        $comment->save();

        return redirect()->route('nieuws.show', $comment->news_id);
    }

    public function destroy($id)
    {
        $comment = Commentaar::findOrFail($id);
        $comment->delete();

        return redirect()->back();
    }
}

