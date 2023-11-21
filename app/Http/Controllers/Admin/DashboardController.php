<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\PreRegister;
use App\Models\VisitingDetails;
use App\Http\Controllers\BackendController;


class DashboardController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['sitetitle'] = 'Dashboard';
        $this->middleware(['permission:dashboard'])->only('index');
    }
    public function index()
    {
        return view('admin.dashboard.index', $this->data);
    }

    public function deleteOldPost()
    {
        $posts = Post::with('media')->get();
        $i = 0;
        foreach ($posts as $post) {

            if (dateExpired($post->deadline)) {
                $i+=1;
                $post->tags()->detach();
                $post->categories()->detach();
                if (isset($post->image)) {
                    $post->clearMediaCollection('posts');
                }
                $post->delete();
            }
        }
        return redirect()->back()->with('success', $i.' Old Post Deleted Successfully !');
    }
}
