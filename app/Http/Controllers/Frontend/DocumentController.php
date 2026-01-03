<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Frontend\DocumentRequest;

use App\Models\Frontend\Document;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\AcademicYearManager;
use App\Managers\Frontend\DocumentTypeManager;
use App\Managers\Frontend\DocumentManager;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    protected $documentManager;
    protected $commonDataManager;
    protected $settingManager;
    protected $documentTypeManager;
    protected $academicYearManager;

    function __construct(
        DocumentManager $documentManager,
        CommonDataManager $commonDataManager,
        SettingManager $settingManager,
        DocumentTypeManager $documentTypeManager,
        AcademicYearManager $academicYearManager
    ) {
        $this->documentManager = $documentManager;
        $this->commonDataManager = $commonDataManager;
        $this->settingManager = $settingManager;
        $this->documentTypeManager = $documentTypeManager;
        $this->academicYearManager = $academicYearManager;
    }

    public function index()
    {
        try {
            if (request()->ajax()) {
                $setting = defaultSetting();

                $search_params = request()->only('title', 'academic_year_id', 'document_type_id', 'status');
                $documents = $this->documentManager->all($search_params, $setting->per_page);
                return  view('site_modules.documents.replace_index', compact('documents'));
            }

            if (Sentinel::hasAccess('documents.index')) {

                $setting = defaultSetting();
                $search_params['title'] = null;
                $search_params['academic_year_id'] = null;
                $search_params['document_type_id'] = null;
                $search_params['status'] = null;
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['document_type_options'] = $this->documentTypeManager->dropdown();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $documents = $this->documentManager->all($search_params, $setting->per_page);
                return view('site_modules.documents.index', compact('documents', 'data', 'setting'));
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

            if (Sentinel::hasAccess('documents.create')) {

                $setting = defaultSetting();
                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['document_type_options'] = $this->documentTypeManager->dropdown();
                $data['year_options'] = $this->academicYearManager->dropdown();

                return view('site_modules.documents.create', compact('data', 'setting'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {

        try {

            if (Sentinel::hasAccess('documents.store')) {
                DB::beginTransaction();
                $documentDetails = $request->only('title', 'order', 'status', 'description', 'academic_year_id', 'document_type_id', 'date');

                $documentDetails['slug'] = Str::slug($request->title);
                $documentDetails['user_id'] = Sentinel::getUser()->id;

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/documents/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $documentDetails['image'] = $fileName;
                }

                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/documents/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);
                    $documentDetails['attachment'] = $fileName;
                }

                Document::create($documentDetails);
                DB::commit();
                return redirect()->route('documents.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('documents.view')) {
                $document = Document::find($id);
                return view('site_modules.documents.view', compact('document'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('documents.edit')) {

                $data['setting'] = defaultSetting();

                $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
                $data['document_type_options'] = $this->documentTypeManager->dropdown();
                $data['year_options'] = $this->academicYearManager->dropdown();
                $document = Document::find($id);
                return view('site_modules.documents.edit', compact('data', 'document'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
    {

        try {

            if (Sentinel::hasAccess('documents.update')) {
                DB::beginTransaction();
                $documentDetails = $request->only('title', 'attachment', 'order', 'status', 'summary', 'academic_year_id', 'document_type_id', 'date');

                $documentDetails['slug'] = Str::slug($request->title);

                $document = Document::find($id);

                $document->update($documentDetails);

                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $folder = 'uploads/documents/';
                    $fileName = 'image-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_image = $document->image;

                    $document->update(['image' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/documents/' . $old_image);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }


                if ($request->hasFile('attachment')) {
                    $file = $request->attachment;
                    $folder = 'uploads/documents/';
                    $fileName = 'attachment-' . random_int(0, 9999999999) . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $fileName);

                    $old_attachment = $document->attachment;

                    $document->update(['attachment' => $fileName]);

                    // Remove  old file
                    $oldFilePath = public_path('uploads/documents/' . $old_attachment);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                DB::commit();

                return redirect()->route('documents.index')->with('success', 'Operation Successfull');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('documents.delete')) {
                $document = Document::find($id);

                // Remove  old file
                $oldPath = public_path('uploads/documents/' . $document->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                // Remove  old attachment
                $oldPath = public_path('uploads/documents/' . $document->attachment);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                $document->delete();
                return redirect()->route('documents.index')->with('success', 'Operation Successfull');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('documents.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}
