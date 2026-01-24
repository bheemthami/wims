<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\TestimonialRequest;

use App\Models\Frontend\Testimonial;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\TestimonialManager;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class TestimonialController extends Controller
{
    protected $testimonialManager;
    protected $commonDataManager;

    function __construct(
        TestimonialManager $testimonialManager,
        CommonDataManager $commonDataManager
    ) {
        $this->testimonialManager = $testimonialManager;
        $this->commonDataManager = $commonDataManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();
                $params = request()->only('title');
                $testimonials = $this->testimonialManager->all($params, $setting->per_page);
                return  view('site_modules.testimonials.replace_index', compact('testimonials'));
            }


            if (Sentinel::hasAccess('testimonials.index')) {
                $setting = defaultSetting();
                $params['title'] = null;
                $testimonials = $this->testimonialManager->all($params, $setting->per_page);
                return view('site_modules.testimonials.index', compact('testimonials'));
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

            if (Sentinel::hasAccess('testimonials.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.testimonials.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {

        try {

            if (Sentinel::hasAccess('testimonials.store')) {
                DB::beginTransaction();
                $details = $request->except('image');

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/testimonials/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $details['image'] = $fileName;
                }

                Testimonial::create($details);
                DB::commit();
                return redirect()->route('testimonials.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('testimonials.view')) {
                $testimonial = Testimonial::find($id);
                return view('site_modules.testimonials.view', compact('testimonial'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('testimonials.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $testimonial = Testimonial::find($id);
                return view('site_modules.testimonials.edit', compact('data', 'testimonial'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('testimonials.update')) {
                DB::beginTransaction();
                $details = $request->except('image');

                $testimonial = Testimonial::find($id);

                $testimonial->update($details);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/testimonials/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $testimonial->image;

                    $testimonial->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/testimonials/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('testimonials.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
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


            if (Sentinel::hasAccess('testimonials.delete')) {
                $testimonial = Testimonial::find($id);
                // Remove  old file
                $oldPath = public_path('uploads/testimonials/' . $testimonial->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $testimonial->delete();
                return redirect()->route('testimonials.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('testimonials.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
