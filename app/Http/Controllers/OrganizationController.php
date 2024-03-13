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
            'name' => ['required', 'min:3'],
            'logo' => ['required'],
            'favicon' => ['required']
        ]);

        if ($validation) {
            $organization = Organization::first();

            $logoExtension = $request->file('logo')->getClientOriginalExtension();
            $logoName = $request->name . '-' . now()->timestamp . '-logo.' . $logoExtension;
            $request->file('logo')->move('assets/images/organization', $logoName);

            $faviconExtension = $request->file('favicon')->getClientOriginalExtension();
            $faviconName = $request->name . '-' . now()->timestamp . '-favicon.' . $faviconExtension;
            $request->file('favicon')->move('assets/images/organization', $faviconName);

            $organization->update([
                'name' => $request->name,
                'logo' => $logoName,
                'favicon' => $faviconName
            ]);
            
            $this->message('Website Information Successfully Updated!', 'success');
            return back();
        }
    }
}
