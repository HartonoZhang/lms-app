<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    public function message($msg, $status)
    {
        Session::flash('status', $status);
        Session::flash('message', $msg);
    }

    public function update (Request $request)
    {
        $validation = $request->validate([
            'web_name' => ['required', 'min:3', 'max:20'],
            'name' => ['required', 'min:3', 'max:50'],
            'logo' => ['mimes:png,jpg,jpeg', 'max:2048'],
            'favicon' => ['mimes:png,jpg,jpeg', 'max:2048']
        ]);

        if ($validation) {
            $organization = Organization::first();

            $imageLogo = $request->hasFile('logo') ? $request->file('logo') : $organization->logo;
            $imageFavicon = $request->hasFile('favicon') ?  $request->file('favicon') : $organization->favicon;

            $logoName = $imageLogo;
            $faviconName = $imageFavicon;

            if(!is_string($imageLogo)){
                $logoExtension =  $imageLogo->getClientOriginalExtension();
                $logoName = $request->name . '-' . now()->timestamp . '-logo.' . $logoExtension;
                $imageLogo->move('assets/images/organization', $logoName);
            }

            if(!is_string($imageFavicon)){
                $faviconExtension = $imageFavicon->getClientOriginalExtension();
                $faviconName = $request->name . '-' . now()->timestamp . '-favicon.' . $faviconExtension;
                $imageFavicon->move('assets/images/organization', $faviconName);
            }
            
            $organization->update([
                'name' => $request->name,
                'web_name' => $request->web_name,
                'logo' => $logoName,
                'favicon' => $faviconName
            ]);
            
            $this->message('Website Information Successfully Updated!', 'success');
            return back();
        }
    }
}
