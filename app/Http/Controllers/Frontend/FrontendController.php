<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\PostConstants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Managers\CommonDataManager;
use App\Managers\SettingManager;
use App\Managers\DesignationManager;
use App\Managers\Frontend\PageManager;
use App\Managers\Frontend\PostCategoryManager;
use App\Managers\Frontend\PostManager;
use App\Managers\Frontend\EventManager;
use App\Managers\Frontend\ProgramManager;
use App\Managers\Frontend\BannerManager;
use App\Managers\Frontend\TrainingManager;
use App\Managers\Frontend\FacilityManager;
use App\Managers\Frontend\TestimonialManager;
use App\Managers\Frontend\QuickLinkManager;
use App\Managers\Frontend\GalleryManager;
use App\Managers\Frontend\DocumentTypeManager;
use App\Managers\Frontend\DocumentManager;
use App\Managers\Frontend\DepartmentManager;
use App\Managers\Frontend\OfficialManager;
use App\Managers\Frontend\TrainingCategoryManager;
use App\Managers\Frontend\EmbedManager;

use Exception;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    protected $commonManager;
    protected $settingManager;
    protected $designationManager;
    protected $pageManager;
    protected $postManager;
    protected $eventManager;
    protected $postCategoryManager;
    protected $programManager;
    protected $bannerManager;
    protected $trainingManager;
    protected $facilityManager;
    protected $testimonialManager;
    protected $quickLinkManager;
    protected $galleryManager;
    protected $documentTypeManager;
    protected $documentManager;
    protected $departmentManager;
    protected $officialManager;
    protected $trainingCategoryManager;
    protected $embedManager;

    public function __construct(
        CommonDataManager $commonManager,
        DesignationManager $designationManager,
        SettingManager $settingManager,
        PageManager $pageManager,
        PostCategoryManager $postCategoryManager,
        PostManager $postManager,
        EventManager $eventManager,
        ProgramManager $programManager,
        BannerManager $bannerManager,
        TrainingManager $trainingManager,
        FacilityManager $facilityManager,
        TestimonialManager $testimonialManager,
        QuickLinkManager $quickLinkManager,
        GalleryManager $galleryManager,
        DocumentTypeManager $documentTypeManager,
        DocumentManager $documentManager,
        DepartmentManager $departmentManager,
        OfficialManager $officialManager,
        TrainingCategoryManager $trainingCategoryManager,
        EmbedManager $embedManager,
    ) {

        $this->commonManager = $commonManager;
        $this->settingManager = $settingManager;
        $this->designationManager = $designationManager;
        $this->pageManager = $pageManager;
        $this->postCategoryManager = $postCategoryManager;
        $this->postManager = $postManager;
        $this->eventManager = $eventManager;
        $this->programManager = $programManager;
        $this->bannerManager = $bannerManager;
        $this->trainingManager = $trainingManager;
        $this->facilityManager = $facilityManager;
        $this->testimonialManager = $testimonialManager;
        $this->quickLinkManager = $quickLinkManager;
        $this->galleryManager = $galleryManager;
        $this->documentManager = $documentManager;
        $this->documentTypeManager = $documentTypeManager;
        $this->departmentManager = $departmentManager;
        $this->officialManager = $officialManager;
        $this->trainingCategoryManager = $trainingCategoryManager;
        $this->embedManager = $embedManager;
    }

    public function index()
    {
        try {
            $settings = defaultSetting();
            $page['about_us']  = $this->pageManager->getPageBySlug(Str::slug('about us'));
            $page['welcome']  = $this->pageManager->getPageBySlug(Str::slug('Welcome'));
            $page['message']  = $this->pageManager->getPageBySlug(Str::slug('Message From Head Teacher'));
            $page['smc']  = $this->pageManager->getPageBySlug(Str::slug('School Management Committee'));


            $post_categories = $this->postCategoryManager->filter(1);

            $categories = [];
            foreach ($post_categories as $key => $category) {
                $categories[$key]['title'] = $category->title;
                $categories[$key]['slug'] = $category->slug;
                $categories[$key]['posts'] = $this->postManager->topPublishedPosts(null, $category->id, 6);
            }

            $data['marquee_recents']  = $this->postManager->publishedPosts(null, null, 10);
            $data['events'] = $this->eventManager->publishedEvents(3);
            $data['programs'] = $this->programManager->publishedPrograms(3);
            $data['banners'] = $this->bannerManager->publishedBanners();
            $data['facilities'] = $this->facilityManager->publishedFacilities();
            $data['testimonials'] = $this->testimonialManager->publishedTestimonials();

            $data['principal'] = $this->designationManager->findBySlug('principal');

            $embeddings['facebook'] = $this->embedManager->getEmbeddingByType('facebook-page');
            $embeddings['twitter'] = $this->embedManager->getEmbeddingByType('twitter-handle');
            $embeddings['google_map'] = $this->embedManager->getEmbeddingByType('google-map');

            $data['video'] = $this->galleryManager->topOneVideo();

            $data['modal_img'] = $this->postManager->modalImages($settings->academic_year_id, PostConstants::SHOW_ON_MODAL_DEFAULT_NO);
            $data['officials'] = $this->officialManager->publishedOfficialsOnFrontPage();

            $data['gallery_images'] = $this->listPublishedImages();
            return view('frontend.new-index', compact('settings', 'categories', 'data', 'page', 'embeddings'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }


    public function contact_us()
    {

        try {

            $settings = $this->settingManager->defaultSetting();
            $embedding = $this->embedManager->getEmbeddingByType('google-map');
            return view('frontend.contact_us', compact('settings', 'embedding'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function about_us()
    {

        try {
            $about =  $this->pageManager->getPageBySlug(Str::slug('about us'));
            if ($about) {

                $settings = $this->settingManager->defaultSetting();
                return view('frontend.about_us', compact('settings', 'about'));
            }

            return redirect()->route('index');
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function pageBySlug(Request $request)
    {

        try {
            $page =  $this->pageManager->getPageBySlug(Str::slug($request->slug));
            if (!$page) {
                return redirect()->route('index');
            }
            return view('frontend.page', compact('page'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }


    /*
    Notices front end
*/
    public function publishedPostBySlug($slug = null)
    {
        try {

            $post =  $this->postManager->getPostBySlug($slug);
            $posts = $this->postManager->publishedPosts();
            return view('frontend.posts.post_details', compact('post', 'posts'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function allPublishedPosts(Request $request)
    {
        try {
            $catSlug = $request->get('slug');
            $category_id = null;
            if ($catSlug) {
                $category = $this->postCategoryManager->getPostCategorysBySlug($catSlug);
                $category_id = $category->id;
            }
            $setting = defaultSetting();
            $posts = $this->postManager->publishedPosts(null, $category_id);
            $topPosts = $this->postManager->topPublishedPosts(null, $category_id, 1);
            $links = $this->quickLinkManager->publishedQuickLinks(['body' => 'body', 'footer' => 'footer']);
            return view('frontend.posts.all_posts', compact('posts', 'topPosts', 'links'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }


    /*
    Notices front end
*/
    public function publishedEventBySlug($slug = null)
    {
        try {
            $slug  = explode('?', $slug);
            $nid =  base64_decode(request()->nid);

            $event =  $this->eventManager->publishedEventBySlug($slug, $nid);
            $events = $this->eventManager->publishedEvents();
            return view('frontend.events.event_details', compact('event', 'events'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function allPublishedEvents()
    {
        try {
            $events = $this->eventManager->publishedEvents();
            $topEvents = $this->eventManager->topPublishedEvents(3);

            return view('frontend.events.all_events', compact('events', 'topEvents'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedProgramBySlug($slug = null)
    {
        try {
            $program =  $this->programManager->getProgramBySlug($slug);
            if (!$program) {
                return redirect()->route('index')->with('error', 'Oops! Something went wrong.');
            }
            $programs = $this->programManager->publishedPrograms();
            $trainings = $this->trainingManager->publishedTrainings();
            return view('frontend.programs.details', compact('program', 'programs', 'trainings'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedTrainingBySlug($slug = null)
    {
        try {
            $training =  $this->trainingManager->getTrainingBySlug($slug);
            if (!$training) {
                return redirect()->route('index')->with('error', 'Oops! Something went wrong.');
            }
            $trainings = $this->trainingManager->publishedTrainings();
            $programs = $this->programManager->publishedPrograms();
            return view('frontend.trainings.details', compact('training', 'programs', 'trainings'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedPhotos()
    {
        try {
            $setting = defaultSetting();
            $published = 1;
            $params['title'] = null;
            $params['academic_year_id'] = null;
            $params['type'] = 'image';
            $photos = $this->galleryManager->publishedGallery($params, $setting->per_page, $published);
            return view('frontend.gallery.images', compact('photos'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedGalleryBySlug(Request $request)
    {
        try {
            $photo = $this->galleryManager->publishedGalleryBySlug($request->slug);
            if (!$photo) {
                return redirect()->route('index')->with('error', 'Oops! Something went wrong.');
            }
            return view('frontend.gallery.image-details', compact('photo'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }



    public function publishedVideos()
    {
        try {
            $setting = defaultSetting();
            $published = 1;
            $params['title'] = null;
            $params['academic_year_id'] = null;
            $params['type'] = 'video';
            $videos = $this->galleryManager->publishedGallery($params, $setting->per_page, $published);
            return view('frontend.gallery.videos', compact('videos'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedPublications()
    {
        try {
            $setting = defaultSetting();
            $document_categories = $this->documentTypeManager->publishedDocumentTypes();
            $categories = [];
            foreach ($document_categories as $key => $category) {
                $categories[$key]['title'] = $category->title;
                $categories[$key]['slug'] = $category->slug;
                $categories[$key]['downloads'] = $this->documentManager->publishedDocuments($category->id, $setting->perp_page);
            }

            // dd($categories[0]['downloads'][0]->image, $categories[0]['downloads'][0]->attachment);

            return view('frontend.publications', compact('categories'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }


    public function publishedFaculties()
    {
        try {
            $setting = defaultSetting();
            $departments = $this->departmentManager->all(null, $setting->per_page, 1);
            $faculties = [];
            foreach ($departments as $key => $department) {
                $officials = $this->officialManager->publishedOfficials($department->id);
                if (count($officials) > 0 && $department->slug  !== Str::slug('board of directors')) {
                    $faculties[$key]['title'] = $department->title;
                    $faculties[$key]['officials'] = $officials;
                }
            }
            return view('frontend.faculties', compact('faculties'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedPrograms()
    {
        try {
            $programs = $this->programManager->publishedPrograms();
            return view('frontend.programs', compact('programs'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedTrainings()
    {
        try {

            $setting = defaultSetting();
            $training_cats = $this->trainingCategoryManager->publishedTrainingCategories();

            $categories = [];
            foreach ($training_cats as $key => $category) {
                $trainings = $this->trainingManager->publishedTrainings(null, $category->id);
                if (count($trainings) > 0) {
                    $categories[$key]['title'] = $category->title;
                    $categories[$key]['trainings'] = $trainings;
                }
            }

            return view('frontend.trainings', compact('categories'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function publishedFacilities()
    {
        try {
            $facilities = $this->facilityManager->publishedFacilities();

            return view('frontend.facilities', compact('facilities'));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function download($file)
    {
        try {
            return response()->download(public_path('/uploads/documents/' . $file));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function downloadPosts($file)
    {
        try {
            return response()->download(public_path('/uploads/posts/' . $file));
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }

    public function listPublishedImages()
    {
        try {
            $galleries = $this->galleryManager->publishedGalleryImages();
            $images = [];
            foreach ($galleries as $gallery) {
                $images = array_merge($images, array_map(function ($image) use ($gallery) {
                    return array_merge($image, ['gallery_slug' => $gallery->slug]);
                }, $gallery->images->toArray()));
            }

            return array_slice($images, 0, 16);
        } catch (Exception $e) {
            return "Oops, something went wrong!";
        }
    }
}
