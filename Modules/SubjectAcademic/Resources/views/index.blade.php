@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">

        <li class="breadcrumb-item">

            <a href="{{ route('dashboard.home') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('academic.index') }}">Academic</a>

        </li>

        <li class="breadcrumb-item">Subjects Academic</li>

    </ol>

    <div class="classification">

        <div class="row m-0">

            <div class="col-md-9 p-0">

                <form action="{{ route('subjectAcademic.index') }}" method="get">

                    <div class="row m-0">

                        <div class="col-md-4 p-0 pr-2">

                            <input
                                class="form-control"
                                name="name"
                                value="{{ request()->name }}"
                                type="text"
                                placeholder="... Subject Name ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-3 p-0 pr-2">

                            <input
                                class="form-control"
                                name="code"
                                value="{{ request()->code }}"
                                type="text"
                                placeholder="... code ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-4 p-0 pr-2">

                            <select name="class_id" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Select Class -- </option>

                                <option value=""> No Selected </option>

                                @foreach($classes as $class)

                                    <option

                                        value="{{ $class->id }}"

                                        @if(request()->class_id == $class->id) selected @endif

                                    > {{ $class->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-1 col-sm-12 p-0 pr-2">

                            <button class="btn btn-behance d-none d-sm-block">Search</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3 p-0 pl-2">

                <a href="{{ route('subjectAcademic.create') }}" class="text-decoration-none">

                    <button class="btn btn-block btn-info text-light">

                            <i class="fa fa-plus mr-2"></i> Add New Subject Academic

                    </button>

                </a>

            </div>

        </div>

    </div>

    @foreach (['danger', 'success'] as $msg)

        @if(Session::has($msg))

            <p
                class="alert alert-{{ $msg }} m-0 mt-2 text-center font-xl pt-2 pr-0 pb-2 pl-0"
            > ..... {{ Session::get($msg) }} ..... </p>

        @endif

    @endforeach

    <div class="table-responsive">

        <div class="card-body pr-0 pl-0">

            <table class="table table-responsive-sm table-striped">

                <thead class="text-center">

                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Class</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody class="text-center">

                    @if($subjects->count() > 0)

                        @foreach($subjects as $index => $subject)

                            <tr>

                                <td> {{ $index }} </td>

                                <td> {{ $subject->name }} </td>

                                <td> {{ $subject->code }} </td>

                                <td>

                                    {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceClass, "name", "id", $subject->class_id) }}

                                </td>

                                <td>

                                    <a href="{{ route('subjectAcademic.edit', $subject->id) }}">

                                        <button type="button" class="btn btn-info" title="Edit">
                                            <i class="fa fa-edit text-light"></i>
                                        </button>

                                    </a>

                                    <form
                                        action="{{ route('subjectAcademic.delete', $subject->id) }}"
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

                            <td colspan="6">

                                <p class="font-weight-bold font-2xl m-0">Sorry, There's No Data.</p>

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

            <div class="pag-count">

                <div class="row m-0">

                    <div class="col-sm-6 p-0">

                        {{ $subjects->appends(request()->query())->links() }}

                    </div>

                    <div class="col-sm-6 p-0 text-right">

                        Showing 1 To {{ $paginationNumber }} Of {{ $subjects->count() }} Entries

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
