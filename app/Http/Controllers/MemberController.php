<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Member ;
use App\Model\BookIssue ;

use App\Http\Requests;

class MemberController extends Controller
{

    /**
     * MemberController constructor.
     * For checking login status
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * To show add new member page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdd()
    {
        return view('member/add');
    }

    /**
     * Post form handler of new member page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if($request->has('name')
            && $request->has('address')
            && $request->has('email')
            && $request->has('phone')
            && $request->has('gender')
        )
        {
            $member = new Member();
            $member->name = $request->name ;
            $member->address = $request->address ;
            $member->email = $request->email ;
            $member->phone = $request->phone ;
            $member->gender = $request->gender ;

            $member->save() ;
            return view('/successEntry') ;
        }
    }

    /**
     * To show Edit/Update Member's info page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEdit(Request $request, $id)
    {
        $member = Member::find($id);
        return view('/member/update', ['member' => $member]) ;
    }

    /**
     * Post Form handler to Edit/update Member's info
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        if($request->has('action') && $request->action === 'delete')
        {
            $member = Member::find($request->id) ;
            $member->delete();
            return view('/successEntry' , ['data' => "Deleted Successfully"]) ;
        }
        else
        {
            $member = Member::find($request->id);

            if($request->has('name'))
                $member->name = $request->name ;

            if($request->has('email'))
                $member->email = $request->email ;

            if($request->has('address'))
                $member->address = $request->address ;

            if($request->has('gender'))
                $member->gender = $request->gender ;

            if($request->has('phone'))
                $member->phone = $request->phone ;

            $member->save() ;
            return view('/successEntry') ;
        }


    }

    /**
     * Show Member Search Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSearch()
    {
        /**
         * Call Member/search view
         */
        return view('member/search');
    }

    /**
     * Post Form handler of Member Search Page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if($request->has('search'))
        {
            /**
             * Initialize Member Model
             */
            $member = Member::on() ;
            if(!empty($request->search['name']))
            {
                $member->where('name', 'LIKE' , '%'.$request->search['name'].'%') ;
            }

            if(!empty($request->search['email']))
            {
                $member->where('email', 'LIKE' ,  '%'.$request->search['email'].'%') ;
            }

            if(!empty($request->search['author']))
            {
                $member->where('phone', 'LIKE' , '%'.$request->search['phone'].'%') ;
            }

            /**
             * Call Member/list view
             */
            return view('/member/list', ['members' => $member->get()->toArray() ]) ;
        }
    }

    /**
     * Show Member's issue books
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIssue(Request $request , $id )
    {
        $books = array() ;
        /**
         * Search in model of all issued book in name of member ID: $id
         */
        $issues = BookIssue::where('memberID', $id)->get();
        foreach($issues as $issue )
        {
            $books[] = array(
                "id" => $issue->bookID ,
                "Book Name" => $issue->book->name ,
                "Book Publisher" => $issue->book->publication ,
                "Book Issue Date" => $issue->issueDate ,
                "Member email" => $issue->member->email,
                "status" => $issue->status
            ) ;
        }

        return view('/member/issuelist', ['books' => $books, "member" => $id ] ) ;
    }

}
