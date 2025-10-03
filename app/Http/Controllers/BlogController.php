<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $blogs = $user->blogs;

        return view('dashboard', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        /* $validated = $request->validate([ */
        /*     'name' => 'required|string|max:100', */
        /*     'email' => 'required|email|unique:users', */
        /*     'username' => 'sometimes|nullable|string|max:50|unique:users', */
        /*     'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()], */
        /**/
        /* ]); */
        /* $user = new User; */
        /**/
        /* $user->name = $validated['name']; */
        /* $user->email = $validated['email']; */
        /* $user->username = $validated['username']; */
        /* $user->password = Hash::make($validated['password']); */
        /* $user->save(); */
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $slug = Str::slug($validated['title'], '-');

        $blog = new Blog(['title' => $validated['title'], 'content' => $validated['content'], 'slug' => $slug]);
        $id = Auth::id();
        $user = User::find($id);
        $user->blogs()->save($blog);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, string $slug)
    {
        $user = User::where('username', $username)->firstOrFail();

        $blog = $user->blogs()->where('slug', $slug)->firstOrFail();

        return view('blog.show', ['blog' => $blog, 'user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::find($id);
        if ($blog && $blog->user_id === Auth::id()) {
            return view('blog.edit', ['blog' => $blog]);
        } else {
            return redirect('dashboard')->withErrors(['error' => 'Blog not found or unauthorized']);
        }
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = Blog::find($id);
        if ($blog && $blog->user_id === Auth::id()) {
            $blog->title = $validated['title'];
            $blog->content = $validated['content'];
            $blog->save();

            return redirect('dashboard');
        } else {
            return redirect('dashboard')->withErrors(['error' => 'Blog not found or unauthorized']);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $blog = Blog::find($id);
        if ($blog && $blog->user_id === Auth::id()) {
            $blog->delete();

            return redirect('dashboard');
        } else {
            return redirect('dashboard')->withErrors(['error' => 'Blog not found or unauthorized']);
        }
        //
    }
}
