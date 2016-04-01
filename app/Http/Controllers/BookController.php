<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Model\Book ;
use App\Model\BookIssue ;

class BookController extends Controller
{
    /**
     * BookController constructor.
     * For checking login
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * For Showing Book issue at /book/issue
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIssue(Request $request)
    {
        $data = array() ;
        if($request->has('bookID'))
            $data['bookID'] = $request->bookID ;

        if($request->has('memberID'))
            $data['memberID'] = $request->memberID ;

        return view('book/issue', $data);
    }

    /**
     * Post method for issuing books
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function issue(Request $request)
    {
        /**
         * Only of memberID and bookID are exits
         */
        if($request->has('memberID') && $request->has('bookID'))
        {
            /**
             * Checking existence of book whose if already issued
             */
            $issue = BookIssue::where('bookID', $request->bookID)
                ->where('status', 'issue')
                ->get() ;

            /**
             * For updating status of book on books table
             */
            $book = Book::find($request->bookID) ;

            /**
             * For updating existing issued book
             */
            if( (count($issue) == 1) && (count($book) == 1) )
            {
                if($request->has('status'))
                {
                    if( ($issue[0]->status == 'issue') && ($request->status === 'return'))
                    {
                        $issue = BookIssue::where('bookID', $request->bookID)
                            ->where('status', 'issue')
                            ->first() ;

                        $issue->status = 'return';
                        $issue->returnDate = Carbon::now();

                        $book->status = 'no-issue' ;
                        $issue->save() ;
                        $book->save();
                    }
                }
                else
                {
                    return view('/successEntry', ['data' => "No/Wrong Book Issue change. Book is already allotted to someone"]) ;
                }
            }
            /**
             * For creating new issue which is not issued to anyone
             */
            else if( (count($issue) == 0) && (count($book) == 1))
            {

                $issue = new BookIssue() ;
                $issue->issueDate = Carbon::now() ;
                $issue->bookID = $request->bookID ;
                $issue->memberID = $request->memberID ;
                $issue->status = 'issue' ;

                $book->status = 'issue' ;
                $issue->save() ;
                $book->save();
            }
            elseif( count($issue) > 1 )
            {
                return view('/successEntry', ['data' => "Internal server error. More than one entry"]) ;
            }
            else
            {
                return view('/successEntry', ['data' => "Error, Book ID not found/Or Inter in database"]) ;
            }


            return view('/successEntry') ;
        }
    }

    /**
     * For Show book add screen at /book/add
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdd()
    {
        return view('book/add');
    }

    /**
     * Post form handler of Add book
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if($request->has('name')
            && $request->has('publication')
            && $request->has('author')
            && $request->has('price')
        )
        {
            $book = new Book();
            $book->name = $request->name ;
            $book->publication = $request->publication ;
            $book->author = $request->author ;
            $book->price = $request->price ;

            $book->save() ;
            return view('/successEntry') ;
        }
    }

    /**
     * Show book edit page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEdit(Request $request, $id)
    {
        $book = Book::find($id);
        return view('/book/update', ['book' => $book]) ;
    }

    /**
     * Post form request handler
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        /**
         * If request to delete then delete book
         */
        if($request->has('action') && $request->action === 'delete')
        {
            $book = Book::find($request->id) ;
            $book->delete();
            return view('/successEntry' , ['data' => "Deleted Successfully"]) ;
        }
        else
        {
            $book = Book::find($request->id);

            if($request->has('name'))
                $book->name = $request->name ;

            if($request->has('publication'))
                $book->publication = $request->publication ;

            if($request->has('author'))
                $book->author = $request->author ;

            if($request->has('price'))
                $book->price = $request->price ;

            $book->save() ;
            return view('/successEntry') ;
        }


    }

    /**
     * For search book page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSearch()
    {
        return view('book/search');
    }

    /**
     * Post form handler for book search page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if($request->has('search'))
        {
            $book = Book::on() ;
            if(!empty($request->search['name']))
            {
                $book->where('name', 'LIKE' , '%'.$request->search['name'].'%') ;
            }

            if(!empty($request->search['publication']))
            {
                $book->where('publication', 'LIKE' ,  '%'.$request->search['publication'].'%') ;
            }

            if(!empty($request->search['author']))
            {
                $book->where('author', 'LIKE' , '%'.$request->search['author'].'%') ;
            }

            return view('/book/list', ['books' => $book->get()->toArray() ]) ;
        }
    }
}
