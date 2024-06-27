<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Setting;

use DB;
use Session;
use Sentinel;

use App\Managers\HomeManager;
use App\Managers\SettingManager;
use App\Managers\RoleManager;
use App\Managers\DesignationManager;
use App\Managers\UserManager;
use App\Managers\AcademicYearManager;

use App\Managers\Frontend\BannerManager;
use App\Managers\Frontend\DepartmentManager;
use App\Managers\Frontend\DocumentManager;
use App\Managers\Frontend\DocumentTypeManager;
use App\Managers\Frontend\EmbedManager;
use App\Managers\Frontend\EventManager;
use App\Managers\Frontend\FacilityManager;
use App\Managers\Frontend\GalleryManager;
use App\Managers\Frontend\OfficialManager;
use App\Managers\Frontend\PageManager;
use App\Managers\Frontend\PostCategoryManager;
use App\Managers\Frontend\PostManager;
use App\Managers\Frontend\ProgramManager;
use App\Managers\Frontend\QuickLinkManager;
use App\Managers\Frontend\TestimonialManager;
use App\Managers\Frontend\TrainingCategoryManager;
use App\Managers\Frontend\TrainingManager;
use App\Managers\Frontend\TrainingTypeManager;

class HomeController extends Controller
{
  protected $homeManager;
  protected $userManager;
  protected $settingManager;
  protected $designationManager;
  protected $roleManager;
  protected $academicYearManager;
  protected $bannerManager;
  protected $departmentManager;
  protected $documentManager;
  protected $documentTypeManager;
  protected $embedManager;
  protected $eventManager;
  protected $facilityManager;
  protected $galleryManager;
  protected $officialManager;
  protected $pageManager;
  protected $postCategoryManager;
  protected $postManager;
  protected $programManager;
  protected $quickLinkManager;
  protected $testimonialManager;
  protected $trainingManager;
  protected $trainingCategoryManager;
  protected $trainingTypeManager;


  public function __construct(HomeManager $homeManager,
    AcademicYearManager $academicYearManager,
    SettingManager $settingManager,
    UserManager $userManager,
    DesignationManager $designationManager,
    RoleManager $roleManager,
    BannerManager $bannerManager,
    DepartmentManager $departmentManager,
    DocumentManager $documentManager,
    DocumentTypeManager $documentTypeManager,
    EmbedManager $embedManager,
    EventManager $eventManager,
    FacilityManager $facilityManager,
    GalleryManager $galleryManager,
    OfficialManager $officialManager,
    PageManager $pageManager,
    PostCategoryManager $postCategoryManager,
    PostManager $postManager,
    ProgramManager $programManager,
    QuickLinkManager $quickLinkManager,
    TestimonialManager $testimonialManager,
    TrainingManager $trainingManager,
    TrainingCategoryManager $trainingCategoryManager,
    TrainingTypeManager $trainingTypeManager,
  ){
    $this->homeManager = $homeManager;
    $this->settingManager = $settingManager;
    $this->userManager = $userManager;
    $this->designationManager = $designationManager;
    $this->roleManager = $roleManager;
    $this->academicYearManager = $academicYearManager;

    $this->bannerManager = $bannerManager;
    $this->departmentManager = $departmentManager;
    $this->documentManager = $documentManager;
    $this->documentTypeManager = $documentTypeManager;
    $this->embedManager = $embedManager;
    $this->eventManager = $eventManager;
    $this->facilityManager = $facilityManager;
    $this->pageManager = $pageManager; 
    $this->officialManager = $officialManager;
    $this->galleryManager = $galleryManager;

    $this->postCategoryManager = $postCategoryManager;
    $this->postManager = $postManager; 
    $this->programManager = $programManager;

    $this->quickLinkManager = $quickLinkManager; 
    $this->testimonialManager = $testimonialManager;
    $this->trainingManager = $trainingManager;
    $this->trainingCategoryManager = $trainingCategoryManager;
    $this->trainingTypeManager = $trainingTypeManager;

  }


  public function index(Request $request)
  {

    try {

      $setting = defaultSetting();

      if(!$setting){
        return redirect('admin/setting')->with('error','Plz configure default setting before continue.');
      }

      $count['settings'] = $this->settingManager->count();
      $count['users'] = $this->userManager->count();
      $count['designations'] = $this->designationManager->count();
      $count['roles'] = $this->roleManager->count();
      $count['years'] = $this->academicYearManager->count();
      $count['banners'] = $this->bannerManager->count();

      $count['departments'] = $this->departmentManager->count();
      $count['documents_types'] = $this->documentTypeManager->count();
      $count['documents'] = $this->documentManager->count();
      $count['embeds'] = $this->embedManager->count();
      $count['events'] = $this->eventManager->count();
      $count['facilities'] = $this->facilityManager->count();
      $count['galleries'] = $this->galleryManager->count();
      $count['officials'] = $this->officialManager->count(1,1);
      $count['pages'] = $this->pageManager->count();
      $count['post_categories'] = $this->postCategoryManager->count();
      $count['posts'] = $this->postManager->count();
      $count['programs'] = $this->programManager->count();
      $count['quick_links'] = $this->quickLinkManager->count();
      $count['testimonials'] = $this->testimonialManager->count();     
      $count['training_categories'] = $this->trainingCategoryManager->count();
      $count['trainings'] = $this->trainingManager->count();
      $count['training_types'] = $this->trainingTypeManager->count();

      return view('admin.home', compact('count'));
    } catch (Exception $e) {
      return redirect('/')->with('error','Oops! Something sent wrong.');
    }

  }

}
