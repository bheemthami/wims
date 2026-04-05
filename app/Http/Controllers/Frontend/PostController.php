<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\PostRequest;

use App\Managers\SettingManager;
use App\Managers\CommonDataManager;
use App\Managers\AcademicYearManager;

use App\Managers\Frontend\PostCategoryManager;
use App\Managers\Frontend\PostManager;

use App\Models\Frontend\Post;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $commonDataManager;
    protected $settingManager;
    protected $academicYearManager;
    protected $postManager;
    protected $postCategoryManager;

    function __construct(
        CommonDataManager $commonDataManager,
        SettingManager $settingManager,
        AcademicYearManager $academicYearManager,
        PostCategoryManager $postCategoryManager,
        PostManager $postManager,
    ) {
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
        $this->academicYearManager = $academicYearManager;
        $this->postCategoryManager = $postCategoryManager;
        $this->postManager = $postManager;
    }

    public function index()
    {
        try {

            $setting = defaultSetting();
            $yearOptions = $this->academicYearManager->dropdown();
            $postCategoryOptions = $this->postCategoryManager->dropdown();
            $statusOptions = $this->commonDataManager->publishStatusDropdown();

            if (request()->ajax()) {

                $params = request()->only('title', 'academic_year_id', 'post_category_id', 'status', 'show_on_modal');
                $posts = $this->postManager->all($params, $setting->per_page);

                return  view('site_modules.posts.replace_index', compact('posts', 'yearOptions', 'postCategoryOptions', 'setting', 'statusOptions'));
            }

            if (Sentinel::hasAccess('posts.index')) {
                $filters['title'] = null;
                $filters['academic_year_id'] = $setting->academic_year_id;
                $filters['post_category_id'] = null;
                $filters['status'] = null;
                $filters['show_on_modal'] = null;
                $posts = $this->postManager->all($filters, $setting->perp_page);

                return view('site_modules.posts.index', compact('posts', 'yearOptions', 'postCategoryOptions', 'setting', 'statusOptions'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops, Something went wrong!!!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        try {

            if (Sentinel::hasAccess('posts.create')) {

                $data['setting'] = defaultSetting();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['post_category_options'] = $this->postCategoryManager->dropdown();
                return view('site_modules.posts.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        try {

            if (Sentinel::hasAccess('posts.store')) {
                DB::beginTransaction();

                $postDetails = $request->except('image', 'attachment');

                $postDetails['slug'] = Str::slug($request->title);

                $postDetails['user_id'] = Sentinel::getUser()->id;

                $postDetails['show_on_modal'] = $request->input('show_on_modal');

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/posts/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $postDetails['image'] = $fileName;
                }

                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/posts/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $postDetails['attachment'] = $fileName;
                }
                $post = Post::create($postDetails);
                DB::commit();
                return redirect()->route('posts.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            if (Sentinel::hasAccess('posts.view')) {
                $post = Post::find($id);
                return view('site_modules.posts.view', compact('post'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {

        try {

            if (Sentinel::hasAccess('posts.edit')) {

                $data['setting'] = defaultSetting();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['post_category_options'] = $this->postCategoryManager->dropdown();
                $post = Post::find($post_id);
                return view('site_modules.posts.edit', compact('data', 'post'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('posts.update')) {
                DB::beginTransaction();
                $postDetails = $postDetails = $request->except('image', 'attachment');

                $postDetails['slug'] = Str::slug($request->title);

                $postDetails['user_id'] = Sentinel::getUser()->id;

                $post = Post::find($id);

                $post->update($postDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/posts/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $post->image;

                    $post->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/posts/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }


                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/posts/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_attachment = $post->attachment;

                    $post->update(['attachment' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/posts/' . $old_attachment);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('posts.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            if (Sentinel::hasAccess('posts.delete')) {
                $post = Post::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/posts/' . $post->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Remove  old attachment
                $oldPath = public_path('uploads/posts/' . $post->attachment);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $post->delete();
                return redirect()->route('posts.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    public  function teacherAssign($id)
    {
        dd($id);
    }



    public function createLoginAccount($id)
    {

        try {

            if (Sentinel::hasAccess('posts.create-login-account')) {

                DB::beginTransaction();
                $post = Post::find($id);

                $userDetails['first_name'] = $post->first_name;
                $userDetails['last_name'] = $post->last_name;

                $user = Sentinel::findByCredentials(['login' => $post->email]);

                if ($user) {
                    return redirect()->route('posts.index')->with('warning', 'User account has been already created.');
                }

                $userDetails['email'] = $post->email;
                $userDetails['password'] = $post->mobile ? $post->mobile : '12345678';
                $user = Sentinel::registerAndActivate($userDetails);
                $role = Sentinel::findRoleBySlug('teacher');
                $role->users()->attach($user);
                DB::commit();
                return redirect()->route('users.index')->with('success', 'Successfully created.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }

    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $folder = public_path('uploads/posts/');
            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $fileName);

            $url = asset('uploads/posts/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
