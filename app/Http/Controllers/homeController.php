<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index(){
        $data = post::where('status', '=', 'Active' )->get();
        if(Auth::id()){
            $user = Auth()->user()->userType;

            if($user == 'user'){
                return view('home.home', compact('data'));
            }
            else if ($user == 'admin') {
                return view('admin.adminDashboard');
            }
            else{
                return redirect()->back();
            }

        }
    }

    public function homepage(){
        $data = post::where('status', '=', 'Active' )->get();
        return view('home.home', compact('data'));
    }

    public function read_more($id){
        $data = post::find($id);
        return view('home.read_more', compact('data'));
    }

    public function create_post(){
        return view('home.create_post');
    }


    public function user_post(Request $request)
    {
        $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        //'image' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);
        //////
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


        $img = $request->image; //retrieves the uploaded image
        if ($img) {
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            //generates a unique filename for the uploaded image based on the current timestamp and the original extension of the file
            $request->image->move('postImage', $imgName); //keep image in public folder (postImage)
            $post->image = $imgName; //keep image in db
        }

        $post->save();
        alert()->success('Post Created Successfully!',"WAIT FOR ADMIN'S APPROVAL! :)");

        return redirect('/my_posts');
    }

    // public function my_posts(){
    //     $user = Auth::user();
    //     $userId = $user->id;
    //     $data = post::where('user_id', '=', $userId)->get();
    //     return view('home.my_posts', compact('data'));
    // }


    public function my_posts(){
    $user = Auth::user();
    $userId = $user->id;

    $data = post::where('user_id', $userId)
                ->whereIn('status', ['Active', 'Pending'])
                ->get();

    return view('home.my_posts', compact('data'));
}


    public function user_delete_post($id)
    {
        $post = post::find($id);
        $image = $post->image;
        if ($image) {
            $imagePath = public_path('postImage/'.$image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();
        alert()->success('Congrats!!','Post Deleted Successfully :)');
        return redirect()->back();
    }

    ///edit

    public function user_edit_post($id)
    {
        $post = post::find($id);
        return view('home.user_edit_post', compact('post'))->with('message', 'Post Updated Successfully :)');
    }

    public function user_updated_post(Request $request,$id)
    {
        $post = post::find($id);
        $post->title = $request->title;
        $post->description=$request->description;

        $img = $request->image;
         if ($img) {
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            //generates a unique filename for the uploaded image based on the current timestamp and the original extension of the file
            $request->image->move('postImage', $imgName); //keep image in public folder (postImage)
            $post->image = $imgName; //keep image in db
        }

        $post->save();
        alert()->success('Congrats!!','Post Updated Successfully :)');

        return redirect('/my_posts');
    }


    public function banner(){
        $data = post::where('user_type', '=', 'admin')->get();
        return view('home.banner', compact('data'));
    }

    public function about_read_more(){
        return view('home.about_read_more');
    }

    public function blogs(){
        $data = post::where('status', '=', 'Active' )->get();
        return view('home.blogs', compact('data'));
    }
}
