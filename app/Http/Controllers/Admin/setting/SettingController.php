<?php

namespace App\Http\Controllers\admin\setting;

use App\Models\Setting;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(SettingRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $setting_current = Setting::findOrFail($request->setting_id);
            $setting = $setting_current->update($request->except(['_token','setting_id', 'logo', 'favicon']));


            if ($request->hasFile('logo')) {
                $this->updateLogo($request, $setting_current);
            }
            if ($request->hasFile('favicon')) {
                $this->updateFavicon($request, $setting_current);
            }

            DB::commit();

            if (!$setting) {

                return redirect()->back()->with('error', 'Try Again Latter!');
            }
            return redirect()->back()->with('success', 'Setting Updated Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['erorrs', $e->getMessage()]);
        }
    }

    private function updateLogo($request, $setting_current)
    {
        ImageManger::deleteImageFormLocal($setting_current->logo);
        $file = ImageManger::generateImageName($request->logo);
        $logo_path = ImageManger::storeImageInlocal($request->logo, 'setting', $file);
        $setting_current->update([
            'logo' => $logo_path
        ]);
    }
    private function updateFavicon($request, $setting_current)
    {
        ImageManger::deleteImageFormLocal($setting_current->favicon);
        $file = ImageManger::generateImageName($request->favicon);
        $favicon_path = ImageManger::storeImageInlocal($request->favicon, 'setting', $file);
        $setting_current->update([
            'favicon' => $favicon_path
        ]);
    }
}
