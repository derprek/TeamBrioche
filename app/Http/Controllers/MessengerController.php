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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {       
        return view('messages.inbox');
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
    public function getInbox()
    {
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $conversations = Message::latest('created_at')->GetConversationReceiver($prac_email)
                            ->distinct()->lists('conv_id');

        $conversationlist = array();
        foreach($conversations as $conversation_id)
        {       
            $unreadcounter =0;
            if(Conversation::find($conversation_id)->firstuser_email !== $prac_email)
            {
                $sender_email = Conversation::find($conversation_id)->firstuser_email;
                $getprac = Practitioner::ValidateEmail($sender_email)->first();

                if($getprac === null)
                {
                    $sender_name = "";
                }
                else
                {
                    $sender_name = $getprac->fname . " " . $getprac->sname;
                }


                if($sender_name === null)
                {
                    $getuser = User::ValidateEmail($sender_email)->first();
                    $sender_name = $getuser->fname . " " . $getuser->sname;
                    
                    if($sender_name === null)
                    {
                        $sender_name = "";
                    }
                }
            }
            elseif(Conversation::find($conversation_id)->seconduser_email !== $prac_email)
            {
                $sender_email = Conversation::find($conversation_id)->seconduser_email;
                $getprac = Practitioner::ValidateEmail($sender_email)->first();
                $sender_name = $getprac->fname . " " . $getprac->sname;

                if($sender_name === null)
                {
                    $getuser = User::ValidateEmail($sender_email)->first();
                    $sender_name = $getuser->fname . " " . $getuser->sname;
                    
                    if($sender_name === null)
                    {
                        $sender_name = "";
                    }
                }
            }
            else
            {
                $sender_email = "Error retrieving recipient email :(";
            }
            
            $last_message = Message::latest('created_at')->GetMessageById($conversation_id)
                                ->GetConversationReceiver($prac_email)->first();

            $last_msg_title = $last_message->title;
            $last_msg_content = $last_message->content;
            $last_msg_status = $last_message->status;
            $last_msg_time = $last_message->created_at->diffForHumans();
            $unreadcounter = count(Message::GetConversationReceiver($prac_email)->GetMessageById($conversation_id)
                                ->GetUnreadMessages()->lists('id'));

            
            $is_last_sender = true;
            if($last_message->receiver_email === $prac_email)
            {
                $is_last_sender = false;
            }

            $has_unread = false;
            if(($unreadcounter > 0) AND ($is_last_sender === false))
            {
                $has_unread = true;
            }



            $conversationlist[] = ['conv_id'=>$conversation_id,
                                'sender_name'=>$sender_name,
                                'sender_email'=>$sender_email,
                                'last_msg_title'=>$last_msg_title,
                                'last_msg_content'=>$last_msg_content,
                                'last_msg_time'=>$last_msg_time,
                                'last_msg_status'=>$last_msg_status,
                                'unreadcount'=>$unreadcounter,
                                'has_unread' =>$has_unread,
                                'is_last_sender' =>$is_last_sender];
                      
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
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $unreadcount = Message::latest('created_at')->GetConversationReceiver($prac_email)
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
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $messages = Message::latest('created_at')->GetMessageById(Session::get('conv_id'))
                            ->get();
        
        $messagelist = array();
        foreach($messages as $message)
        {       
           if($message->sender_email === $prac_email)
                {
                   $sender_email='You';
                }
                else
                {
                    $sender_email=$message->sender_email;
                    $recipient = Practitioner::ValidateEmail($sender_email)->first();
                    $recipient_email = $recipient->email;
                    $recipient_name = $recipient->fname . " " . $recipient->sname;
                }
                
           if($message->receiver_email === $prac_email)
                {
                    $receiver_email='You';
                }
                else
                {
                    $receiver_email=$message->receiver_email; 
                    $recipient = Practitioner::ValidateEmail($receiver_email)->first();
                    $recipient_email = $recipient->email;
                    $recipient_name = $recipient->fname . " " . $recipient->sname;    
                }

            $is_sender = false;
            if($message->receiver_email === $prac_email)
            {
                $is_sender = true;
            }

            $is_unread = false;
            if(($message->status === 'unread') AND ($is_sender === true))
            {
                $is_unread = true;
            }


           $messagelist[] = ['id'=>$message->id,
                                'conv_id'=>$message->conv_id,
                                'sender_email'=>$sender_email,
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
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $first = Conversation::where('firstuser_email','=', $prac_email )->where('seconduser_email','=', Input::get('receiver_email'))->first();
        $second = Conversation::where('firstuser_email','=', Input::get('receiver_email') )->where('seconduser_email','=', $prac_email)->first();

        if(($first !== null) OR ($second !== null))
        {   
            if($first !== null)
            {
                $conv_id = $first->id;
            }
            elseif($second !== null)
            {
                $conv_id = $second->id;
            }
        }
        elseif(($first === null) AND ($second === null))
        {
            $newConversation = new Conversation;
            $newConversation->firstuser_email = $prac_email;
            $newConversation->seconduser_email = Input::get('receiver_email');
            $newConversation->created_at = Carbon::now();
            $newConversation->save();
            $conv_id = $newConversation->id;

        }

        $newMessage = new Message;
        $newMessage->conv_id = $conv_id;
        $newMessage->receiver_email = Input::get('receiver_email');
        $newMessage->sender_email = $prac_email;
        $newMessage->title = Input::get('title');
        $newMessage->content = Input::get('content');
        $newMessage->status =  Input::get('status');
        $newMessage->created_at = Carbon::now();
        $newMessage->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function markasread()
    {
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $messages = Message::GetMessageById(Input::get('conv_id'))->get();

        foreach($messages as $message)
        {
            if($message->receiver_email === $prac_email)
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
        $pracslist = Practitioner::NotCurrent()->get();

        foreach($pracslist as $prac)
        {
            $recipientlist[] = ['id'=>$prac->id,
                                'name'=>$prac->fname . " " . $prac->sname,
                                'email'=>$prac->email
                                ];
        }

        if(count($recipientlist) < 1)
        {
            return null;
        }
        else
        {   
            return $recipientlist;
        }

        return $recipientlist;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function getSentbox()
    {
        $prac_email = Practitioner::find(Session::get('prac_id'))->email;
        $messages = Message::latest('created_at')->GetConversationSender($prac_email)
                            ->get();
        
        $messagelist = array();
        foreach($messages as $message)
        {       

        $recipient = Practitioner::ValidateEmail($message->receiver_email)->first();

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
