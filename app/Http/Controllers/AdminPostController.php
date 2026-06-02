<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.works.index', [
            'works' => Work::all(),
        ]);
    }

    public function create()
    {
        return view('admin.works.create');
    }

    public function store()
    {
        Work::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'img_path' => request()->file('img_path')->store('img_paths'),
        ]));

        return redirect('/admin/works')->with('success', 'Work post Created!');
    }

    public function edit(Work $work)
    {
        return view('admin.works.edit', ['work' => $work]);
    }

    public function update(Work $work)
    {
        $attributes = $this->validatePost($work);

        if ($attributes['img_path'] ?? false) {
            Storage::delete($work->img_path);
            $attributes['img_path'] = request()->file('img_path')->store('img_paths');
        }

        $work->update($attributes);

        return back()->with('success', 'Work post Updated!');
    }

    public function destroy(Work $work)
    {
        Storage::delete($work->img_path);
        $work->delete();

        return back()->with('success', 'Work post Deleted!');
    }

    protected function validatePost(?Work $work = null): array
    {
        $work ??= new Work;

        return request()->validate([
            'title' => 'required',
            'img_path' => $work->exists
                ? ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048']
                : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'slug' => ['required', Rule::unique('works', 'slug')->ignore($work)],
            'description' => 'required',
            'features' => 'required',
        ]);
    }
}
