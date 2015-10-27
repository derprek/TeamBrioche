<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;
use Auth;
use Carbon\Carbon;
use App\Report;
use App\Question;
use App\Manager;
use App\Practitioner;
use App\User;
use App\Product;
use App\Tag;
use App\Category;
use App\Subcategory;
use App\Selection;
use App\Message;
use App\Conversation;
use Input; 

class MessengerController extends Controller
{   
    public function __construct()
    {
        $this->beforeFilter(function(){
           
               if ((Auth::guest()) && (!Session::has('prac_id')))
               {
                    return redirect('/unauthorizedaccess');
               }
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {       
        return view('messages.mailbox');
    }

    public function show($conv_id)
    {
        Session::put('conv_id',$conv_id);

        return view('messages.showthread');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getMail()
    {
        if(Session::has('prac_id'))
        {
            $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        if(isset($viewer))
        {
            $conversations = Message::latest('created_at')->GetConversationReceiver($viewer->email)
                                ->distinct()->lists('conv_id'); 

            $conversationlist = array();

            foreach($conversations as $conversation_id)
            {       
                $unreadcounter =0;
                $conversation = Conversation::find($conversation_id);

                if(($conversation->firstuser_email !== $viewer->email) && ($conversation->seconduser_email === $viewer->email))
                {
                    $recipient_email = $conversation->firstuser_email;
                    $practitioner = Practitioner::ValidateEmail($recipient_email)->first();

                    if($practitioner === null)
                    {
                        $user = User::ValidateEmail($recipient_email)->first();

                            if($user !== null)
                            {
                                $recipient = $user;
                            }
                            else
                            {
                                $recipient = null;
                            }
                    }
                    else
                    {
                        $recipient = $practitioner;
                    }

                }
                elseif(($conversation->seconduser_email !== $viewer->email) && ($conversation->firstuser_email === $viewer->email))
                {   
                    $recipient_email = $conversation->seconduser_email;
                    $practitioner = Practitioner::ValidateEmail($recipient_email)->first();

                    if($practitioner === null)
                    {
                        $user = User::ValidateEmail($recipient_email)->first();

                            if($user !== null)
                            {
                                $recipient = $user;
                            }
                            else
                            {
                                $recipient = null;
                            }
                    }
                    else
                    {
                        $recipient = $practitioner;
                    }

                }
                else
                {
                    $recipient_email = "Error retrieving recipient email :(";
                }
                
                $last_message = Message::latest('created_at')->GetMessageById($conversation_id)
                                    ->first();

                $last_msg_title = $last_message->title;
                $last_msg_content = $last_message->content;
                $last_msg_status = $last_message->status;
                $last_msg_time = $last_message->created_at->diffForHumans();
                $unreadcounter = count(Message::GetConversationReceiver($viewer->email)->GetMessageById($conversation_id)
                                    ->GetUnreadMessages()->lists('id'));

                
                $is_last_sender = true;
                if($last_message->receiver_email === $viewer->email)
                {
                    $is_last_sender = false;
                }

                $has_unread = false;
                if(($unreadcounter > 0) AND ($is_last_sender === false))
                {
                    $has_unread = true;
                }

                if($recipient !== null)
                {
                   $recipient_name = $recipient->fname . " " . $recipient->sname;
                   $recipient_email = $recipient->email;
                }
                else
                {
                    $recipient_name ='Recipient no longer exists';
                    $recipient_email = 'Recipient no longer exists';
                }

                $conversationlist[] = ['conv_id'=>$conversation_id,
                                    'recipient_name'=>$recipient_name,   
                                    'recipient_email'=>$recipient_email,
                                    'last_msg_title'=>$last_msg_title,
                                    'last_msg_content'=>$last_msg_content,
                                    'last_msg_time'=>$last_msg_time,
                                    'last_msg_status'=>$last_msg_status,
                                    'unreadcount'=>$unreadcounter,
                                    'has_unread' =>$has_unread,
                                    'is_last_sender' =>$is_last_sender];
                          
            }
        }
        else
        {
            return null;
        }   
   
        if(count($conversationlist) < 1)
        {
            return null;
        }
        else
        {   
            return $conversationlist;
        }
        
    }

     public function getUnread()
    {
        if(Session::has('prac_id'))
        {
            $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        $unreadcount = Message::latest('created_at')->GetConversationReceiver($viewer->email)
                            ->GetUnreadMessages()->distinct()->lists('conv_id');

        if(count($unreadcount) < 1)
        {
            return null;
        }
        else
        {   
            return $unreadcount;
        }

    }

    public function getAllMessages()
    {     
        if(Session::has('prac_id'))
        {
             $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        $messages = Message::latest('created_at')->GetMessageById(Session::get('conv_id'))
                            ->get();
        
        $messagelist = array();
        foreach($messages as $message)
        {       
           if($message->sender_email === $viewer->email)
                {
                   $sender_email='You';
                   $sender_name = 'You';

                   $receiver_email=$message->receiver_email; 
                    $practitioner = Practitioner::ValidateEmail($receiver_email)->first();

                    if($practitioner === null)
                    {
                        $user = User::ValidateEmail($receiver_email)->first();

                        if($user !== null)
                        {
                            $recipient = $user;                          
                        }
                        else
                        {
                            $recipient = null;
                        }
                    }
                    else
                    {
                        $recipient = $practitioner;                  
                    }

                    $recipient_email = $recipient->email;
                    $recipient_name = $recipient->fname . " " . $recipient->sname;    

                
                    
                }
                
           if($message->receiver_email === $viewer->email)
                {
                    $receiver_email='You';
                    
                    $sender_email= $message->sender_email;
                    $practitioner = Practitioner::ValidateEmail($sender_email)->first();

                    if($practitioner === null)
                    {
                        $user = User::ValidateEmail($sender_email)->first();

                        if($user !== null)
                        {
                            $recipient = $user;
                            $sender_name = $user->fname . " " . $user->sname;
                        }
                        else
                        {
                            $recipient = null;
                        }
                    }
                    else
                    {
                        $recipient = $practitioner;
                        $sender_name = $practitioner->fname . " " . $practitioner->sname;
                    }

                    $recipient_email = $recipient->email;
                    $recipient_name = $recipient->fname . " " . $recipient->sname;
                    
                }

            $is_receiver = false;
            if($message->receiver_email === $viewer->email)
            {
                $is_receiver = true;
            }

            $is_unread = false;
            if(($message->status === 'unread') AND ($is_receiver === true))
            {
                $is_unread = true;
            }

           $messagelist[] = ['id'=>$message->id,
                                'conv_id'=>$message->conv_id,
                                'sender_email'=>$sender_email,
                                'sender_name'=>$sender_name,
                                'receiver_email'=>$receiver_email,
                                'recipient_email'=>$recipient_email,
                                'recipient_name'=>$recipient_name,
                                'title'=>$message->title,
                                'status'=>$message->status,
                                'content'=>$message->content,
                                'is_unread'=>$is_unread,
                                'created_at'=>$message->created_at->diffForHumans()];

        }

        if(count($messagelist) < 1)
        {
            return null;
        }
        else
        {   
            return $messagelist;
        }
    }

    public function store()
    {   
        if(Session::has('prac_id'))
        {
             $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        $first = Conversation::GetFirstParty($viewer->email)->GetSecondParty(Input::get('receiver_email'))->first();
        $second = Conversation::GetFirstParty(Input::get('receiver_email'))->GetSecondParty($viewer->email)->first();

        if(($first !== null) OR ($second !== null))
        {   
            if($first !== null)
            {
                $conversation_id = $first->id;
            }
            elseif($second !== null)
            {
                $conversation_id = $second->id;
            }
        }
        elseif(($first === null) AND ($second === null))
        {
            $newConversation = new Conversation;
            $newConversation->firstuser_email = $viewer->email;
            $newConversation->seconduser_email = Input::get('receiver_email');
            $newConversation->save();
            $conversation_id = $newConversation->id;

        }

        if($conversation_id !== null)
        {
            $newMessage = new Message;
            $newMessage->conv_id = $conversation_id;
            $newMessage->receiver_email = Input::get('receiver_email');
            $newMessage->sender_email = $viewer->email;
            $newMessage->title = Input::get('title');
            $newMessage->content = Input::get('content');
            $newMessage->status =  Input::get('status');
            $newMessage->save();
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function markasread()
    {   
        if(Session::has('prac_id'))
        {
             $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        $messages = Message::GetMessageById(Input::get('conv_id'))->get();

        foreach($messages as $message)
        {
            if($message->receiver_email === $viewer->email)
            {
                if($message->status === 'unread')
                {
                    $message->status = 'read';
                    $message->save();
                }

            }  
        }

        return $messages;
    }


    public function getAllRecipients()
    {   
        $recipientlist = array();

        if(Session::has('prac_id'))
        {
             $practitionerlist = Practitioner::NotCurrent()->get();
             $clientlist = User::MyClient()->get();

             $allRecipients = $practitionerlist->merge($clientlist);

                foreach($allRecipients as $recipient)
                {
                    $recipientlist[] = ['id'=>$recipient->id,
                                        'name'=>$recipient->fname . " " . $recipient->sname,
                                        'email'=>$recipient->email
                                        ];
                }

        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
            $viewer_reports = Report::GetUserReports()->get();
            $owner_practitioner = Practitioner::GetThisPractitioner($viewer->prac_id)->get();

            foreach($viewer_reports as $report)
            {   
                $shared_reports[] = $report->practitioners()->get();
            }

            $shared_reports[] = $owner_practitioner;

            foreach($shared_reports as $shared_report)
            {
                foreach($shared_report as $report_participants)
                {
                    $recipientlist[] = ['id'=>$report_participants->id,
                                        'name'=>$report_participants->fname . " " . $report_participants->sname,
                                        'email'=>$report_participants->email
                                        ];
                }

            }
            
        }

        if(count($recipientlist) < 1)
        {
            return null;
        }
        else
        {   
            return $recipientlist;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getSentbox()
    {   
        if(Session::has('prac_id'))
        {
             $viewer = Practitioner::find(Session::get('prac_id'));
        }
        elseif(Auth::check())
        {
            $viewer = User::find(Auth::user()->id);
        }

        if(isset($viewer))
        {

        $messages = Message::latest('created_at')->GetConversationSender($viewer->email)
                            ->get();
        
        $messagelist = array();
        foreach($messages as $message)
        {       
            $practitioner = Practitioner::ValidateEmail($message->receiver_email)->first();

            if($practitioner === null)
            {
                $user = User::ValidateEmail($message->receiver_email)->first();

                if($user !== null)
                {
                    $recipient = $user;
                }
                else
                {
                    $recipient === null;
                }
            }
            else
            {
                $recipient = $practitioner;
            }

            if($recipient !== null)
            {
                $receiver_email = $recipient->email;
                $receiver_name = $recipient->fname . " " . $recipient->sname; 
            }
            else
            {
                $receiver_email = "Unrecognized User.";
                $receiver_name = "Unrecognized User."; 
            }
            
               $messagelist[] = ['id'=>$message->id,
                                    'conv_id'=>$message->conv_id,
                                    'receiver_email'=>$receiver_email,
                                    'receiver_name'=>$receiver_name,
                                    'title'=>$message->title,
                                    'content'=>$message->content,
                                    'created_at'=>$message->created_at->diffForHumans()];
        }
        }

        if(count($messagelist) < 1)
        {
            return null;
        }
        else
        {   
            return $messagelist;
        }
    }
}
