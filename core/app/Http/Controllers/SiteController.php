<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
        return view($this->activeTemplate . 'contact', compact('pageTitle', 'sections'));
    }

    public function contactSubmit(Request $request)
    {
        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'bail|required|max:191',
            'subject' => 'bail|required|max:100',
            'message' => 'bail|required',
        ]);


        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogs()
    {
        $pageTitle = 'Blogs';
        $emptyMessage = 'No Blog Yet';
        $blogs = Frontend::where('data_keys', 'blog.element')->paginate(getPaginate());
        $popular = Frontend::latest()->where('data_keys', 'blog.element')->limit(10)->get();
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();

        return view($this->activeTemplate . 'blog', compact('blogs', 'popular', 'pageTitle', 'emptyMessage', 'sections'));
    }
    public function blogDetails($id, $slug)
    {
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $popular = Frontend::latest()->where('data_keys', 'blog.element')->where('id', '!=', $id)->limit(10)->get();
        $pageTitle = $blog->data_values->title;
        return view($this->activeTemplate . 'blog_details', compact('blog', 'popular', 'pageTitle'));
    }


    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        $notify[] = ['success', 'Cookie accepted successfully'];
        return back()->withNotify($notify);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function policyPage($slug, $id)
    {
        $policyPage    = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policyPage->data_values->title;
        return view($this->activeTemplate . 'policy_page', compact('policyPage', 'pageTitle'));
    }


    public function viewExpertMember($id, $slug)
    {
        $expertMember = Frontend::where('id', $id)->where('data_keys', 'expert_team.element')->firstOrFail();
        $pageTitle = $expertMember->data_values->name;
        return view($this->activeTemplate . 'view_expert_member', compact('expertMember', 'pageTitle'));
    }


    public function subscribeStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191|email|unique:subscribers,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first('email')]);
        }
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        return response()->json(['success' => 'Subscribed Successfully']);
    }

}
