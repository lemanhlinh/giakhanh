<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.contact.detail');
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContact $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            Contact::create(
                [
                    'name' => $data['name'],
                    'content' => $data['content'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'address' =>  $data['address'],
                ]
            );
            DB::commit();
            Session::flash('success', trans('message.create_contact_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_contact_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }
}
