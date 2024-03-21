<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    // Index method to handle the home page
    public function index()
    {
        // Retrieve active posts
        $data = post::where('status', '=', 'Active')->get();

        if (Auth::id()) {
            // Check if a user is authenticated
            $user = Auth()->user()->userType;

            // If the user is a regular user, return the home view with post data
            if ($user == 'user') {
                return view('home.home', compact('data'));
            }
            // If the user is an admin, return the admin dashboard
            else if ($user == 'admin') {
                return view('admin.adminDashboard');
            } else {
                return redirect()->back();
            }
        }
    }

    //load the homepage with active posts
    public function homepage()
    {
        $data = post::where('status', '=', 'Active')->get();
        return view('home.home', compact('data'));
    }

    //load the "read more" page for a specific post
    public function read_more($id)
    {
        $data = post::find($id);
        return view('home.read_more', compact('data'));
    }


    public function create_post()
    {
        return view('home.create_post');
    }

// handle the creation of a new post by a user
    public function user_post(Request $request)
    {
        // Validation rules for post creation
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1999',
        ]);

        // Retrieve user information
        $user = Auth()->user();
        $user_id = $user->id;
        $name = $user->name;
        $userType = $user->userType;

        $post = new post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = 'Pending';
        ///
        $post->user_id = $user_id;
        $post->name = $name;
        $post->user_type = $userType;


        $img = $request->image;
        // Handle image upload if provided
        if ($img) {
            //generates a unique filename for the uploaded image based on the current timestamp and the original extension of the file
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $request->image->move('postImage', $imgName); //keep image in public folder (postImage)
            $post->image = $imgName;
        }

        $post->save();
        alert()->success('Post Created Successfully!', "WAIT FOR ADMIN'S APPROVAL! :)");

        return redirect('/my_posts');
    }

    // public function my_posts(){
    //     $user = Auth::user();
    //     $userId = $user->id;
    //     $data = post::where('user_id', '=', $userId)->get();
    //     return view('home.my_posts', compact('data'));
    // }


    public function my_posts()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Retrieve posts created by the current user with status 'Active' or 'Pending'
        $data = post::where('user_id', $userId)
            ->whereIn('status', ['Active', 'Pending'])
            ->get();

        return view('home.my_posts', compact('data'));
    }


    //handle deletion of a post by the current user
    public function user_delete_post($id)
    {
        $post = post::find($id);
        $image = $post->image;
        if ($image) {
            $imagePath = public_path('postImage/' . $image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();
        alert()->success('Congrats!!', 'Post Deleted Successfully :)');
        return redirect()->back();
    }

    ///edit
    public function user_edit_post($id)
    {
        $post = post::find($id);
        return view('home.user_edit_post', compact('post'))->with('message', 'Post Updated Successfully :)');
    }

    public function user_updated_post(Request $request, $id)
    {
        $post = post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;

        $img = $request->image;
        if ($img) {
            //generates a unique filename for the uploaded image based on the current timestamp and the original extension of the file
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $request->image->move('postImage', $imgName); //keep image in public folder (postImage)
            $post->image = $imgName; //keep image in db
        }

        $post->save();
        alert()->success('Congrats!!', 'Post Updated Successfully :)');

        return redirect('/my_posts');
    }


    public function banner()
    {
        $data = post::where('user_type', '=', 'admin')->get();
        return view('home.banner', compact('data'));
    }

    public function about_read_more()
    {
        return view('home.about_read_more');
    }

    public function blogs()
    {
        $data = post::where('status', '=', 'Active')->get();
        return view('home.blogs', compact('data'));
    }
}
