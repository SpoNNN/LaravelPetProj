<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::where("user_id", auth()->user()->id)->first();

        return view("pages.auth.profile", compact("profile"));
    }
    public function create(ProfileRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $imagePath = $image->storeAs('images', $imageName, 'public');

            Profile::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath
            ]);
        } else {
            Profile::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'description' => $request->description
            ]);
        }

        return redirect()->back()->with('success', 'Creted succesfully');
    }
    public function update(ProfileRequest $request)
    {
        $profile = Profile::where("user_id", auth()->user()->id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            $imagePath = $image->storeAs('images', $imageName, 'public');

            Storage::disk('public')->delete($profile->image);

            $profile->updateOrCreate(
                [
                    'user_id' => auth()->user()->id
                ],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $imagePath
                ]
            );

        } else {
            $profile->updateOrCreate(
                [
                    'user_id' => auth()->user()->id
                ],
                [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            );
        }

        return redirect()->back()->with('success', 'Update success');
    }
    public function destroy()
    {
        $profile = Profile::where("user_id", auth()->user()->id)->first();

        if (!is_null($profile->image)) {

            Storage::disk('public')->delete($profile->image);

        }
        $profile->delete();
        return redirect()->back()->with('success', 'Donate profile deleted');
    }
}
