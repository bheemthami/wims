<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\BannerRequest;

use App\Models\Frontend\Banner;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\Frontend\BannerManager;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class BannerController extends Controller
{
    protected $bannerManager;
    protected $commonDataManager;
    protected $settingManager;

    function __construct(
        BannerManager $bannerManager,
        CommonDataManager $commonDataManager,
        SettingManager $settingManager
    ) {
        $this->bannerManager = $bannerManager;
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();
            $search_params['title'] = null;
            $search_params['status'] = null;
            $statusOptions = $this->commonDataManager->publishStatusDropdown();

            if (request()->ajax()) {

                if (request()->ajax()) {
                    $search_params = request()->only('title', 'status');
                }

                $banners = $this->bannerManager->all($search_params, $setting->per_page);
                return  view('site_modules.banners.replace_index', compact('banners', 'setting', 'statusOptions'));
            }


            if (Sentinel::hasAccess('banners.index')) {
                $banners = $this->bannerManager->all($search_params, $setting->per_page);
                return view('site_modules.banners.index', compact('banners', 'setting', 'statusOptions'));
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

            if (Sentinel::hasAccess('banners.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.banners.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {

        try {

            if (Sentinel::hasAccess('banners.store')) {
                DB::beginTransaction();
                $bannerDetails = $request->only('title', 'tagline', 'order', 'status');
                $bannerDetails['slug'] = Str::slug($request->title);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/banners/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $bannerDetails['image'] = $fileName;
                }

                $banner = Banner::create($bannerDetails);
                DB::commit();
                return redirect()->route('banners.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('banners.view')) {
                $banner = Banner::find($id);
                return view('site_modules.banners.view', compact('banner'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($banner_id)
    {

        try {

            if (Sentinel::hasAccess('banners.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $banner = Banner::find($banner_id);
                return view('site_modules.banners.edit', compact('data', 'banner'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('banners.update')) {
                DB::beginTransaction();
                $bannerDetails = $request->only('title', 'tagline', 'status', 'order');
                $bannerDetails['slug'] = Str::slug($request->title);

                $banner = Banner::find($id);

                $banner->update($bannerDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/banners/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $banner->image;

                    $banner->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/banners/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('banners.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('banners.delete')) {
                $banner = Banner::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/banners/' . $banner->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $banner->delete();
                return redirect()->route('banners.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('banners.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
