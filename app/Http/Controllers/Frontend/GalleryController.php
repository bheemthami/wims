<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\GalleryRequest;

use App\Models\Frontend\Gallery;
use App\Models\Frontend\Image;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\Frontend\GalleryManager;
use App\Managers\AcademicYearManager;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    protected $galleryManager;
    protected $commonDataManager;
    protected $settingManager;
    protected $academicYearManager;

    function __construct(
        GalleryManager $galleryManager,
        CommonDataManager $commonDataManager,
        SettingManager $settingManager,
        AcademicYearManager $academicYearManager
    ) {
        $this->galleryManager = $galleryManager;
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
        $this->academicYearManager = $academicYearManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();
            $data['type_options'] = $this->commonDataManager->galleryTypeDropdown();
            $data['year_options'] = $this->academicYearManager->dropdown();

            if (request()->ajax()) {

                $search_params = request()->only('title', 'academic_year_id', 'type');
                $galleries = $this->galleryManager->all($search_params, $setting->per_page);

                return  view('site_modules.galleries.replace_index', compact('galleries', 'data', 'setting'));
            }


            if (Sentinel::hasAccess('galleries.index')) {


                $search_params['title'] = null;
                $search_params['academic_year_id'] = null;
                $search_params['type'] = null;
                $galleries = $this->galleryManager->all($search_params, $setting->per_page);
                return view('site_modules.galleries.index', compact('galleries', 'data', 'setting'));
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

            if (Sentinel::hasAccess('galleries.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['type_options'] = $this->commonDataManager->galleryTypeDropdown();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $data['yes_no_options'] = $this->commonDataManager->yesNoDropdown();
                return view('site_modules.galleries.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {

        try {

            if (Sentinel::hasAccess('galleries.store')) {
                DB::beginTransaction();
                $galleryDetails = $request->only('title', 'summary', 'status', 'date', 'academic_year_id', 'type', 'is_slider');
                $galleryDetails['slug'] = Str::slug($request->title);
                $galleryDetails['user_id'] = Sentinel::getUser()->id;

                if ($request->type == 'video') {
                    $galleryDetails['link'] = $request->link;
                }

                $gallery = Gallery::create($galleryDetails);

                if ($request->type == 'image') {
                    if ($request->hasFile('image')) {
                        foreach ($request->image as $key => $img) {
                            $imgDetails = [];
                            $imgDetails['title'] = $gallery->title;
                            $imgDetails['gallery_id'] = $gallery->id;
                            $file = $img;
                            $folder = 'uploads/galleries/';
                            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                            $file->move($folder, $fileName);
                            $imgDetails['image'] = $fileName;
                            $imgDetails['order'] = ++$key;
                            Image::create($imgDetails);
                        }
                    }
                }

                DB::commit();
                return redirect()->route('galleries.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('galleries.view')) {
                $gallery = Gallery::with(['images' => function ($query) {
                    $query->orderBy('order', 'ASC');
                }])->find($id);
                return view('site_modules.galleries.view', compact('gallery'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {

            if (Sentinel::hasAccess('galleries.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['type_options'] = $this->commonDataManager->galleryTypeDropdown();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $data['yes_no_options'] = $this->commonDataManager->yesNoDropdown();
                $gallery = Gallery::with(['images' => function ($query) {
                    $query->orderBy('order', 'ASC');
                }])->find($id);

                return view('site_modules.galleries.edit', compact('data', 'gallery'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('galleries.update')) {
                DB::beginTransaction();
                $galleryDetails = $request->only('title', 'summary', 'academic_year_id', 'status', 'link', 'date', 'is_slider');

                $galleryDetails['slug'] = Str::slug($request->title);
                $galleryDetails['user_id'] = Sentinel::getUser()->id;

                $gallery = Gallery::find($id);
                $gallery->update($galleryDetails);
                if ($request->has('old_images')) {
                    foreach ($request->old_images as $key => $updateImg) {
                        $image = Image::find($updateImg['id']);
                        $imageUpdateDetails = [];
                        $imageUpdateDetails['title'] = $updateImg['title'];
                        $imageUpdateDetails['order'] = $updateImg['order'];
                        $image->update($imageUpdateDetails);
                    }
                }

                if ($request->type == 'image') {
                    if ($request->hasFile('image')) {
                        foreach ($request->image as $key => $img) {
                            $imgDetails = [];
                            $imgDetails['title'] = $gallery->title;
                            $imgDetails['gallery_id'] = $gallery->id;
                            $file = $img;
                            $folder = 'uploads/galleries/';
                            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                            $file->move($folder, $fileName);
                            $imgDetails['image'] = $fileName;
                            $imgDetails['order'] = ++$key;
                            Image::create($imgDetails);
                        }
                    }
                }

                DB::commit();

                return redirect()->route('galleries.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('galleries.delete')) {
                DB::beginTransaction();
                $gallery = Gallery::find($id);

                if ($gallery->type == 'image') {
                    foreach ($gallery->images as $key => $img) {
                        // Remove  old file
                        $oldPath = public_path('uploads/galleries/' . $img->image);
                        if (File::exists($oldPath)) {
                            File::delete($oldPath);
                        }

                        $img->delete();
                    }
                }
                $gallery->delete();
                DB::commit();
                return redirect()->route('galleries.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    public function destroyImage($image_id)
    {

        try {

            if (Sentinel::hasAccess('galleries.delete')) {
                DB::beginTransaction();
                $img = Image::find($image_id);
                $gallery = Gallery::find($img->gallery_id);
                if (count($gallery->images) > 1) {
                    // Remove  old file
                    $oldPath = public_path('uploads/galleries/' . $img->image);
                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                    $img->delete();
                    DB::commit();
                    return redirect()->route('galleries.show', $img->gallery->id)->with('success', 'Operation Successfull');
                }

                DB::commit();
                return redirect()->route('galleries.show', $img->gallery->id)->with('warning', 'Delete not allowed !');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('galleries.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $folder = public_path('uploads/galleries/');
            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $fileName);

            $url = asset('uploads/galleries/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
