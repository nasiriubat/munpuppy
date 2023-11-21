<?php

namespace App\Http\Controllers\Admin;

use Setting;
use DatabaseSeeder;
use LanguageSeeder;
use App\Enums\Status;
use App\Models\Language;
use App\Libraries\MyString;
use BackendMenuTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BackendController;

class SettingController extends BackendController
{

    public function __construct()
    {
        parent::__construct();

        $this->data['sitetitle'] = 'Settings';

        $this->middleware(['permission:setting']);
    }

    // Site Setting
    public function index()
    {
        $this->data['language'] = Language::where('status',Status::ACTIVE)->get();
        return view('admin.setting.site', $this->data);
    }

    public function siteSettingUpdate(Request $request)
    {

   
        $niceNames    = [];
        $settingArray = $this->validate($request, $this->siteValidateArray(), [], $niceNames);
       
        if ($request->hasFile('site_logo')) {
            $site_logo                 = request('site_logo');
            $settingArray['site_logo'] = $site_logo->getClientOriginalName();
            $request->site_logo->move(public_path('images'), $settingArray['site_logo']);
        } else {
            unset($settingArray['site_logo']);
        }

        if (isset($settingArray['timezone'])) {
            MyString::setEnv('APP_TIMEZONE', $settingArray['timezone']);
            Artisan::call('optimize:clear');
        }
        
        Setting::set($settingArray);
        Setting::save();

        return redirect(route('admin.setting.index'))->withSuccess('The Site setting updated successfully');
    }


    public function socialSetting()
    {
        return view('admin.setting.social', $this->data);
    }

    public function socialSettingUpdate(Request $request)
    {
        $niceNames    = [];
        $settingArray = $this->validate($request, $this->socialValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();
        return redirect(route('admin.setting.meta'))->withSuccess('The Social setting updated successfully.');
    }

    public function editorSetting()
    {
        return view('admin.setting.editor', $this->data);
    }

    public function editorSettingUpdate(Request $request)
    {
        $niceNames    = [];
        $settingArray = $this->validate($request, $this->editorValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();
        return redirect(route('admin.setting.editor'))->withSuccess('The Social setting updated successfully.');
    }

    
    public function metaSetting()
    {
        return view('admin.setting.meta', $this->data);
    }

    public function metaSettingUpdate(Request $request)
    {
        $niceNames    = [];
        $settingArray = $this->validate($request, $this->metaValidateArray(), [], $niceNames);

        Setting::set($settingArray);
        Setting::save();
        return redirect(route('admin.setting.meta'))->withSuccess('The Meta setting updated successfully.');
    }
    // Site Setting validation
    private function siteValidateArray()
    {
        return [
            'site_name'         => 'required|string',
            'site_email'        => 'required|string|max:100',
            'site_phone_number' => 'required|max:60',
            'site_footer'       => 'required|string|max:200',
            'timezone'          => 'required|string',
            'site_logo'         => 'nullable|mimes:jpeg,jpg,png,gif|max:3096',
            'site_description'  => 'required|string|max:500',
            'site_address'      => 'required|string|max:500',
            'adsense_script'    => 'nullable',
            'list_ad'    => 'nullable',
            'locale'            => 'nullable|string',
        ];
    }


    // Social Setting validation
    private function socialValidateArray()
    {
        return [
            'facebook'  => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'youtube'   => 'nullable|string|max:100',
            'twitter'   => 'nullable|string|max:100',
        ];
    }

    private function editorValidateArray()
    {
        return [
            'managing_editor'  => 'nullable|string|max:100',
            'advisory_editor' => 'nullable|string|max:100',
            'editor'   => 'nullable|string|max:100',
        ];
    }

    private function metaValidateArray()
    {
        return [
            'meta_site_name'       => 'nullable|string',
            'meta_description'     => 'nullable|string',
            'meta_keyword'         => 'nullable|string',
            'meta_image'           => 'nullable|string',
            'meta_fb_app_id'       => 'nullable|string',
            'meta_publisher'       => 'nullable|string',
            'meta_twitter_site'    => 'nullable|string',
            'meta_twitter_creator' => 'nullable|string',
            'google_analytics'     => 'nullable|string',
            'google_tag_manager'     => 'nullable|string',
            'google_console'     => 'nullable|string',
        ];
    }
}
