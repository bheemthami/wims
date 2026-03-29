<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\PageRequest;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;

use App\Managers\Frontend\PageManager;

use App\Models\Frontend\Page;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class PageController extends Controller
{
    protected $pageManager;
    protected $commonDataManager;
    protected $settingManager;

    function __construct(
        PageManager $pageManager,
        CommonDataManager $commonDataManager,
        SettingManager $settingManager
    ) {
        $this->pageManager = $pageManager;
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();
            $statusOptions = $this->commonDataManager->publishStatusDropdown();

            $search_params['title'] = null;
            $search_params['status'] = null;

            if (request()->ajax()) {
                if (request()->ajax()) {
                    $search_params = request()->only('title', 'status');
                }
                $pages = $this->pageManager->all($search_params, $setting->per_page);
                return  view('site_modules.pages.replace_index', compact('pages', 'setting', 'statusOptions'));
            }


            if (Sentinel::hasAccess('pages.index')) {
                $pages = $this->pageManager->all($search_params, $setting->per_page);
                return view('site_modules.pages.index', compact('pages', 'setting', 'statusOptions'));
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

            if (Sentinel::hasAccess('pages.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.pages.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {

        try {

            if (Sentinel::hasAccess('pages.store')) {
                DB::beginTransaction();
                $pageDetails = $request->only('title', 'summary', 'description', 'order', 'status');
                $pageDetails['slug'] = Str::slug($request->title);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/pages/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $pageDetails['image'] = $fileName;
                }

                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/pages/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $pageDetails['attachment'] = $fileName;
                }

                $page = Page::create($pageDetails);
                DB::commit();
                return redirect()->route('pages.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('pages.view')) {
                $page = Page::find($id);
                return view('site_modules.pages.view', compact('page'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($page_id)
    {

        try {

            if (Sentinel::hasAccess('pages.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $page = Page::find($page_id);
                return view('site_modules.pages.edit', compact('data', 'page'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('pages.update')) {
                DB::beginTransaction();
                $pageDetails = $request->only('title', 'summary', 'description', 'status', 'order');


                $page = Page::find($id);

                $page->update($pageDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/pages/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $page->image;

                    $page->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/pages/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }


                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/pages/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_attachment = $page->attachment;

                    $page->update(['attachment' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/pages/' . $old_attachment);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('pages.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('pages.delete')) {
                $page = Page::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/pages/' . $page->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Remove  old attachment
                $oldPath = public_path('uploads/pages/' . $page->attachment);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $page->delete();
                return redirect()->route('pages.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $folder = public_path('uploads/pages/');
            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $fileName);

            $url = asset('uploads/pages/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
