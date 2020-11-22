@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">

        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">Permissions</li>

    </ol>

    <div class="classification">

        <div class="row">

            <div class="col-md-9">

                <form action="{{ route('permissions.search') }}" method="get">

                    <div class="row">

                        <div class="col-md-4 col-sm-6">

                            <input type="text" name="name" class="form-control" placeholder="... Enter The Name Of Role ..." autocomplete="off" value="{{ request()->name }}" />

                        </div>

                        <div class="col-md-2 col-sm-4">

                            <button class="btn btn-behance d-none d-sm-block w-100">

                                <i class="fas fa-search mr-1"></i> Search

                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3">

                <a href="{{ route('permissions.create') }}" class="text-decoration-none">

                    <button class="btn btn-block btn-info text-light">

                        <i class="fa fa-plus mr-2"></i> Add New Permissions

                    </button>

                </a>

            </div>

        </div>

    </div>

    @foreach (['danger', 'success'] as $msg)

        @if(session()->has($msg))

            <p
                class="alert alert-{{ $msg }} m-0 mt-2 text-center font-xl pt-2 pr-0 pb-2 pl-0"
            > ..... {{ session()->get($msg) }} ..... </p>

        @endif

    @endforeach

    <div class="table-responsive">

        <div class="card-body pr-0 pl-0">

            <table class="table table-responsive-sm table-striped">

                <thead class="text-center">

                <tr>

                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>

                </tr>

                </thead>

                <tbody class="text-center">

                @if($roles->count() > 0)

                    @foreach($roles as $index => $role)

                        <tr>

                            <td> {{ $index }} </td>

                            <td>

                                {{ \Modules\Core\Http\Helper\AppHelper::upperWords($role->name) }}

                            </td>

                            <td>

                                <a href="{{ route('permissions.edit', $role->id) }}">

                                    <button type="button" class="btn btn-info" title="Edit">
                                        <i class="fa fa-edit text-light"></i>
                                    </button>

                                </a>

                                <form

                                    action="{{ route('permissions.delete', $role->id) }}"
                                    method="post"
                                    style="display: inline-block"
                                >

                                    @csrf
                                    @method("DELETE")

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('Are You Sure You Want To Delete This Record ?')"
                                        title="Delete"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                @else

                    <tr>

                        <td colspan="5">

                            <p class="font-weight-bold font-2xl m-0">Sorry, There's No Data.</p>

                        </td>

                    </tr>

                @endif



                </tbody>

            </table>

            <div class="pag-count">

                <div class="row m-0">

                    <div class="col-sm-6 p-0">

{{--                        {{ $roles->appends(request()->query())->links() }}--}}

                    </div>

                    <div class="col-sm-6 p-0 text-right">

                        Showing 1 To {{ $paginationNumber }} Of {{ $roles->count() }} Entries

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
