<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function postPage()
    {
        return view('admin.postPage');
    }

    public function add_post(Request $request)
    {
        $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        // 'image' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);
        //////
        $user = Auth()->user();
        $user_id = $user->id;
        $name = $user->name;
        $userType = $user->userType;

        $post = new post;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = 'Active';
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
        alert()->success('Congrats!!','Post Created Successfully :)');

        return redirect('show_post')->with('message', 'Post Created Successfully :)');
    }

    public function show_post()
    {
        $data = post::where('status', 'Active')->get();
        return view('admin.show_post', compact('data'));
    }

    public function delete_post($id)
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

    public function edit_post($id)
    {
        $post = post::find($id);

        return view('admin.edit_post', compact('post'))->with('message', 'Post Updated Successfully :)');
    }

    public function updated_post(Request $request,$id)
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

        return redirect('/show_post');
    }

    public function accept_post($id)
    {
        $post = post::find($id);
        $post->status = 'Active';
        $post->save();
        alert()->success('Congrats!!','Post is Approved!! :)');
        return redirect()->back();
    }

    public function decline_post($id)
    {
        $post = post::find($id);
        $post->status = 'Declined';
        $post->save();
        return redirect()->back();
    }



    public function getNewPostCount()
    {
        // $data = post::all();
        $newPostCount = post::where('status', 'pending')->count();

        return response()->json(['count' => $newPostCount]);
    }

    public function getPendingTasks()
    {
        $tasks = post::where('status', 'pending')->get();

        return response()->json(['tasks' => $tasks]);
    }

    public function pending_post()
    {
        $data = post::where('status', '=', 'Pending' )->get();
        return view('admin.pending_post', compact('data'));
    }


//bar chart
    public function getChartData()
    {
        // Fetch data from the database
        $postData = post::selectRaw("DATE(created_at) as date, COUNT(*) as post_count")
            ->groupBy('date')
            ->get();

        return response()->json($postData);
    }
    // public function getUserData()
    // {
    //     // Fetch data from the database
    //     $userData = User::selectRaw("DATE(created_at) as date, COUNT(*) as u_count")
    //         ->groupBy('date')
    //         ->get();

    //     return response()->json($userData);
    // }

    //  public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Perform search in the database
    //     $results = post::where('title', 'LIKE', "%$query%")->get();

    //     // You can customize the response based on your needs
    //     return view('search_results', ['results' => $results, 'query' => $query]);
    // }








 }
