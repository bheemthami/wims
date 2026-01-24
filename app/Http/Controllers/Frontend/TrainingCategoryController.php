<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\TrainingCategoryRequest;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\TrainingCategoryManager;
use App\Models\Frontend\TrainingCategory;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class TrainingCategoryController extends Controller
{
    protected $trainingCategoryManager;
    protected $commonDataManager;

    function __construct(
        TrainingCategoryManager $trainingCategoryManager,
        CommonDataManager $commonDataManager
    ) {
        $this->trainingCategoryManager = $trainingCategoryManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            $setting = defaultSetting();

            $params['title'] = null;

            if (request()->ajax()) {
                $params = request()->only('title');
                $training_categories = $this->trainingCategoryManager->all($params, $setting->per_page);
                return  view('site_modules.training_categories.replace_index', compact('training_categories'));
            }


            if (Sentinel::hasAccess('training-categories.index')) {
                $training_categories = $this->trainingCategoryManager->all($params, $setting->per_page);
                return view('site_modules.training_categories.index', compact('training_categories'));
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

            if (Sentinel::hasAccess('training-categories.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.training_categories.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingCategoryRequest $request)
    {

        try {

            if (Sentinel::hasAccess('training-categories.store')) {
                DB::beginTransaction();
                $details = $request->only('title', 'order', 'status');
                $details['slug'] = Str::slug($request->title);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/training_categories/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $details['image'] = $fileName;
                }

                TrainingCategory::create($details);
                DB::commit();
                return redirect()->route('training-categories.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('training-categories.view')) {
                $training_category = TrainingCategory::find($id);
                return view('site_modules.training_categories.view', compact('banner'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($training_category_id)
    {

        try {

            if (Sentinel::hasAccess('training-categories.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $training_category = TrainingCategory::find($training_category_id);
                return view('site_modules.training_categories.edit', compact('data', 'training_category'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingCategoryRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('training-categories.update')) {
                DB::beginTransaction();
                $details = $request->only('title', 'status', 'order');
                $details['slug'] = Str::slug($request->title);

                $training_category = TrainingCategory::find($id);

                $training_category->update($details);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/training_categories/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $training_category->image;

                    $training_category->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/training_categories/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('training-categories.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
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


            if (Sentinel::hasAccess('training-categories.delete')) {
                $training_category = TrainingCategory::find($id);
                if (count($training_category->trainings) > 0) {
                    return redirect()->route('training-categories.index')->with('warning', 'This data is used in another table.');
                }

                // Remove  old file
                $oldPath = public_path('uploads/training_categories/' . $training_category->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $training_category->delete();
                return redirect()->route('training-categories.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('training-categories.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
