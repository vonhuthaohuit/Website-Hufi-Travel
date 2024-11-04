<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SubscriberDatatables;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubscriberDatatables $dataTable)
    {
        return $dataTable->render('backend.subscriber.index');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $emails = Subscriber::where('is_verified', 1)->pluck('email')->toArray();

        Mail::to($emails)->send(new Newsletter($request->subject, $request->message));

        toastr('Mail has been send', 'success', 'success');

        return redirect()->back();
    }

    public function destory(string $id)
    {
        $subscriber = Subscriber::findOrFail($id)->delete();
        return response(['status' => 'success', 'message' => 'deleted successfully']);
    }
}
