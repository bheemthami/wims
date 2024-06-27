<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Setting;
use App\Models\Frontend\Page;
use App\Models\Frontend\Post;
use App\Models\Frontend\QuickLink;
class SettingComposer{

	public $settings = [];

	public function __construct()
	{
		$data['setting'] = Setting::select('municipality','office','phone','email','office_address','province_name','province_no','logo','local_logo','favicon','system_name','system_short_name','tag_line','academic_year_id','per_page')->first();
        $data['about_us'] = Page::where(['slug'=>'about-us','status'=>1])->first();
        $data['recents'] = Post::where(['status'=>1])->orderBy('date','DESC')->limit(2)->get();
        $data['header_links'] = QuickLink::where(['status'=>1,'type'=>'header'])->orderBy('order','ASC')->get();
        $data['body_links'] = QuickLink::where(['status'=>1,'type'=>'body'])->orderBy('order','ASC')->get();
        $data['links'] = QuickLink::where(['status'=>1,'type'=>'footer'])->orderBy('order','ASC')->get();
        $this->settings = $data;
        return $this->settings;
    }
    /*
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {        
    	$view->with('settings',$this->settings);
    }

}