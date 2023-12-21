<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportMessage;
use App\Models\AdminNotification;
use App\Models\SupportAttachment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{

    // Support Ticket
    /**
     * @return Factory|View
     */
    public function supportTicket()
    {
        if (!Auth::user()) {
            abort(404);
        }
        $pageTitle = "Support Tickets";
        $supports = SupportTicket::where('user_id', Auth::id())->orderBy('priority', 'desc')->orderBy('id','desc')->paginate();
        return view(SETTING['site_theme'] . 'support.index', compact('supports', 'pageTitle'));
    }


    /**
     * @return Factory|View
     */
    public function openSupportTicket()
    {
        if (!Auth::user()) {
            abort(404);
        }
        $pageTitle = "Support Tickets";
        $user = Auth::user();
        return view(SETTING['site_theme'] . 'support.create', compact('pageTitle', 'user'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function storeSupportTicket(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $files = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf','doc','docx');

        $this->validate($request, [
            'attachments' => [
                'max:4096',
                function ($attribute, $value, $fail) use ($files, $allowedExts) {
                    foreach ($files as $file) {
                        $ext = strtolower($file->getClientOriginalExtension());
                        if (($file->getSize() / 1000000) > 2) {
                            return $fail("Maximum 2MB file size allowed!");
                        }
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf, doc, docx files are allowed");
                        }
                    }
                    if (count($files) > 5) {
                        return $fail("Maximum 5 files can be uploaded");
                    }
                },
            ],
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
            'priority' => 'required|in:1,2,3',
        ]);

        $user = auth()->user();
        $ticket->user_id = $user->id;
        $random = rand(100000, 999999);
        $ticket->ticket = $random;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->priority = $request->priority;
        $ticket->save();

        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New support ticket has opened';
        $adminNotification->click_url = urlPath('moder.ticket.view',$ticket->id);
        $adminNotification->save();


        $path = imagePath()['ticket']['path'];
        if ($request->hasFile('attachments')) {
            foreach ($files as  $file) {
                try {
                    $attachment = new SupportAttachment();
                    $attachment->support_message_id = $message->id;
                    $attachment->attachment = uploadFile($file, $path);
                    $attachment->save();
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your file'];
                    return back()->withNotify($notify);
                }
            }
        }
        $notify[] = ['success', 'ticket created successfully!'];
        return redirect()->route('user.ticket')->withNotify($notify);
    }


    /**
     * @param $ticket
     * @return Factory|View
     */
    public function viewTicket($ticket)
    {
        $pageTitle = "Support Tickets";
        $userId = 0;
        if (Auth::user()) {
            $userId = Auth::id();
        }
        $my_ticket = SupportTicket::where('ticket', $ticket)->where('user_id',$userId)->orderBy('id','desc')->firstOrFail();
        $messages = SupportMessage::where('supportticket_id', $my_ticket->id)->orderBy('id','desc')->get();
        $user = auth()->user();
        return view(SETTING['site_theme'] . 'support.view', compact('my_ticket', 'messages', 'pageTitle', 'user'));

    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws ValidationException
     */
    public function replyTicket(Request $request, $id)
    {
        $userId = 0;
        if (Auth::user()) {
            $userId = Auth::id();
        }
        $ticket = SupportTicket::where('user_id',$userId)->where('id',$id)->firstOrFail();
        $message = new SupportMessage();
        if ($request->replayTicket == 1) {
            $attachments = $request->file('attachments');
            $allowedExts = array('jpg', 'png', 'jpeg', 'pdf', 'doc','docx');

            $this->validate($request, [
                'attachments' => [
                    'max:4096',
                    function ($attribute, $value, $fail) use ($attachments, $allowedExts) {
                        foreach ($attachments as $file) {
                            $ext = strtolower($file->getClientOriginalExtension());
                            if (($file->getSize() / 1000000) > 2) {
                                return $fail("Miximum 2MB file size allowed!");
                            }
                            if (!in_array($ext, $allowedExts)) {
                                return $fail("Only png, jpg, jpeg, pdf doc docx files are allowed");
                            }
                        }
                        if (count($attachments) > 5) {
                            return $fail("Maximum 5 files can be uploaded");
                        }
                    },
                ],
                'message' => 'required',
            ]);

            $ticket->status = 2;
            $ticket->last_reply = Carbon::now();
            $ticket->save();

            $message->supportticket_id = $ticket->id;
            $message->message = $request->message;
            $message->save();

            $path = imagePath()['ticket']['path'];

            if ($request->hasFile('attachments')) {
                foreach ($attachments as $file) {
                    try {
                        $attachment = new SupportAttachment();
                        $attachment->support_message_id = $message->id;
                        $attachment->attachment = uploadFile($file, $path);
                        $attachment->save();

                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Could not upload your ' . $file];
                        return back()->withNotify($notify)->withInput();
                    }
                }
            }

            $notify[] = ['success', 'Support ticket replied successfully!'];
        } elseif ($request->replayTicket == 2) {
            $ticket->status = 3;
            $ticket->last_reply = Carbon::now();
            $ticket->save();
            $notify[] = ['success', 'Support ticket closed successfully!'];
        }else{
            $notify[] = ['error','Invalid request'];
        }
        return back()->withNotify($notify);

    }


    /**
     * @param $ticket_id
     * @return false|int
     */
    public function ticketDownload($ticket_id)
    {
        $attachment = SupportAttachment::findOrFail(decrypt($ticket_id));
        $file = $attachment->attachment;

        $path = imagePath()['ticket']['path'];
        $full_path = $path.'/'. $file;

        $title = Str::slug($attachment->supportMessage->ticket->subject);
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);


        header('Content-Disposition: attachment; filename="' . $title . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

}
