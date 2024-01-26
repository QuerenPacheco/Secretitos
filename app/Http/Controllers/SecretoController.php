<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secreto;
use App\Providers\RouteServiceProvider;


class SecretoController extends Controller
{
    public function index()
    {
        $secrets = Secreto::all();
        return response()->json($secrets);
    }

    public function create(): Response
    {
        return Inertia::render('Secrets/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $secreto = Secreto::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);
        // $secreto = Secreto::create($request->all());
        // return response()->json($request->user()->id);
        return redirect(RouteServiceProvider::HOME)
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post actualizado exitosamente.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post eliminado exitosamente.');
    }
}
