<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Setting;
use App\Models\Frontend\Page;
use App\Models\Frontend\Post;
use App\Models\Frontend\QuickLink;
use App\Models\Frontend\Menu;

class SettingComposer
{

    public $settings = [];

    public $menu = [];

    public $admin_menu = [];

    public function __construct()
    {
        $data['setting'] = Setting::select('municipality', 'office', 'phone', 'email', 'office_address', 'province_name', 'province_no', 'logo', 'local_logo', 'favicon', 'system_name', 'system_short_name', 'tag_line', 'academic_year_id', 'per_page')->first();
        $data['about_us'] = Page::where(['slug' => 'about-us', 'status' => 1])->first();
        $data['recents'] = Post::where(['status' => 1])->orderBy('date', 'DESC')->limit(2)->get();
        $data['header_links'] = QuickLink::where(['status' => 1, 'type' => 'header'])->orderBy('order', 'ASC')->get();
        $data['body_links'] = QuickLink::where(['status' => 1, 'type' => 'body'])->orderBy('order', 'ASC')->get();
        $data['links'] = QuickLink::where(['status' => 1, 'type' => 'footer'])->orderBy('order', 'ASC')->get();
        $this->settings = $data;

        $this->menu = Menu::with(['children' => function ($query) {
            return $query->where('is_active', 1)->orderBy('position', 'ASC');
        }])->where(['is_active' => 1, 'parent_id' => null])->orderBy('position', 'ASC')->get();

        $this->admin_menu = config('admin_menu');
    }
    /*
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('settings', $this->settings);
        $view->with('menu', $this->menu);
        $view->with('admin_menu', $this->admin_menu);
    }
}
