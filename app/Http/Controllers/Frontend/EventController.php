<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\EventRequest;
use App\Managers\AcademicYearManager;
use App\Models\Frontend\Event;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\Frontend\EventManager;

use Sentinel;
use DB;
use Str;
use File;

class EventController extends Controller
{
    protected $eventManager;
    protected $commonDataManager;
    protected $settingManager;
    protected $academicYearManager;

    function __construct(
        EventManager $eventManager,
        CommonDataManager $commonDataManager,
        SettingManager $settingManager,
        AcademicYearManager $academicYearManager,
    ) {
        $this->eventManager = $eventManager;
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
        $this->academicYearManager = $academicYearManager;
    }

    public function index()
    {
        try {

            $setting = defaultSetting();
            $yearOptions = $this->academicYearManager->dropdown();
            $statusOptions = $this->commonDataManager->publishStatusDropdown();

            if (!request()->ajax()) {
                $params['title'] = null;
                $params['academic_year_id'] = $setting->academic_year_id;
                $params['status'] = null;
            } else {
                $params = request()->only('title', 'academic_year_id', 'status');
            }

            if (request()->ajax()) {

                $events = $this->eventManager->all($params, $params['academic_year_id'], $setting->perp_page, $params['status']);

                return view('site_modules.events.replace_index', compact('events', 'yearOptions', 'setting', 'statusOptions'));
            }


            if (Sentinel::hasAccess('events.index')) {

                $events = $this->eventManager->all($params, $params['academic_year_id'], $setting->perp_page, $params['status']);

                return view('site_modules.events.index', compact('events', 'yearOptions', 'setting', 'statusOptions'));
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

            if (Sentinel::hasAccess('events.create')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                return view('site_modules.events.create', compact('data'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {

        try {

            if (Sentinel::hasAccess('events.store')) {
                DB::beginTransaction();
                $setting = defaultSetting();
                $user = Sentinel::getUser();
                $eventDetails = $request->only('title', 'description', 'start_date', 'end_date', 'start_time', 'end_time', 'status', 'remarks', 'speaker');

                $eventDetails['slug'] = Str::slug($request->title);
                $eventDetails['academic_year_id'] = $setting->academic_year_id;
                $eventDetails['user_id'] = $user->id;


                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/events/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $eventDetails['image'] = $fileName;
                }

                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/events/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $eventDetails['attachment'] = $fileName;
                }
                $event = Event::create($eventDetails);
                DB::commit();
                return redirect()->route('events.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('events.view')) {
                $event = Event::find($id);
                return view('site_modules.events.view', compact('event'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($event_id)
    {

        try {

            if (Sentinel::hasAccess('events.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $event = Event::find($event_id);
                return view('site_modules.events.edit', compact('data', 'event'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('events.update')) {
                DB::beginTransaction();
                $eventDetails = $request->only('title', 'description', 'start_date', 'end_date', 'start_time', 'end_time', 'status', 'remarks', 'speaker');


                $event = Event::find($id);

                $event->update($eventDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/events/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $event->image;

                    $event->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/events/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }


                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/events/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_attachment = $event->attachment;

                    $event->update(['attachment' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/events/' . $old_attachment);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('events.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('events.delete')) {
                $event = Event::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/events/' . $event->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Remove  old attachment
                $oldPath = public_path('uploads/events/' . $event->attachment);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $event->delete();
                return redirect()->route('events.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('events.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $folder = public_path('uploads/events/');
            $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
            $file->move($folder, $fileName);

            $url = asset('uploads/events/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
