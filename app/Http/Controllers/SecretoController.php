<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secreto;
use App\Providers\RouteServiceProvider;


class SecretoController extends Controller
{
    public function index(Request $request)
    {
        $secretTitles= Secreto::where('user_id', $request->user()->id)->select('id', 'title')->get();
        return response()->json($secretTitles);
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
        return redirect(RouteServiceProvider::HOME)
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Request $request, $id)
    {
        $secretContent= Secreto::where('id', $id)
                                ->where('user_id', $request->user()->id)
                                ->pluck('content')[0];
        return response()->json($secretContent);
    }

   
    public function destroy(Request $request, $id)
    {
        $secretDelete= Secreto::where('id', $request->id)
                                ->where('user_id', $request->user()->id);
        $secretDelete->delete();

        return response()->json('💥 El secreto se ha autodestruido 💥');
    }
}
