<?php

/** Start The NameSpace Of This Controller **/

    namespace Modules\Home\Http\Controllers;

/** End The NameSpace Of This Controller **/


/** Start Basic Declaration **/

    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Routing\Controller;
    use Illuminate\Http\Request;
    use Exception;

/** End Basic Declaration **/


                            /******************************************************************************/


/** Start The HomeController **/

    class HomeController extends Controller
    {

        /** Start Index Method **/

            /**
             * Display a listing of the resource.
             * @return Renderable
             */
            public function index()
            {
                return view('home::index');
            }

        /** End Index Method **/


                            /******************************************************************************/

        /**
         * Show the form for creating a new resource.
         * @return Renderable
         */
        public function create()
        {
            return view('home::create');
        }

        /**
         * Store a newly created resource in storage.
         * @param Request $request
         * @return Renderable
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Show the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function show($id)
        {
            return view('home::show');
        }

        /**
         * Show the form for editing the specified resource.
         * @param int $id
         * @return Renderable
         */
        public function edit($id)
        {
            return view('home::edit');
        }

        /**
         * Update the specified resource in storage.
         * @param Request $request
         * @param int $id
         * @return Renderable
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         * @param int $id
         * @return Renderable
         */
        public function destroy($id)
        {
            //
        }
    }

/** End The HomeController **/
