@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('permissions.index') }}">Permissions</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('permissions.update', $role[0]->id) }}" method="post">

        @csrf

        <input type="hidden" name="guard" value="{{ $role[0]->guard_name }}" />

        @foreach($permissionsArray as $permission)
        <input type="hidden" name="permissions[]" value="{{ $permission }}" />
        @endforeach

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="role" class="font-2xl"> {{ \Modules\Core\Http\Helper\AppHelper::upperWords($role[0]->name) }} Role :- </label>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">

                <table class="table table-striped">

                    <thead>

                    <tr>

                        <th scope="col">

                            <input type="checkbox" style="width: 18px;height: 18px" id="selectAll" />

                        </th>
                        <th scope="col">Module Name</th>
                        <th scope="col">Create</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>

                    </tr>

                    </thead>

                    <tbody>

                        @foreach(\Modules\Core\Http\Helper\AppHelper::allModules() as $module)

                            <tr>

                                <th scope="row">

                                    <input type="checkbox" style="width: 18px;height: 18px" class="selectRow" />

                                </th>

                                <td> {{ \Modules\Core\Http\Helper\AppHelper::upperWords($module) }} </td>

                                <td>

                                    <input
                                        type="checkbox"
                                        name="create_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        value="create_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        style="width: 18px;height: 18px"
                                        @if(in_array("create_" . \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module), $permissionsArray))
                                            checked
                                        @endif
                                    />

                                </td>

                                <td>

                                    <input
                                        type="checkbox"
                                        name="view_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        value="view_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        style="width: 18px;height: 18px"
                                        @if(in_array("view_" . \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module), $permissionsArray))
                                            checked
                                        @endif
                                    />

                                </td>

                                <td>

                                    <input
                                        type="checkbox"
                                        name="edit_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        value="edit_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        style="width: 18px;height: 18px"
                                        @if(in_array("edit_" . \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module), $permissionsArray))
                                            checked
                                        @endif
                                    />

                                </td>

                                <td>

                                    <input
                                        type="checkbox"
                                        name="delete_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        value="delete_{{ \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module) }}"
                                        style="width: 18px;height: 18px"
                                        @if(in_array("delete_" . \Modules\Core\Http\Helper\AppHelper::ReplaceSpaceWithUnderScore($module), $permissionsArray))
                                            checked
                                        @endif
                                    />

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl mt-3">
            <i class="fa fa-edit mr-1"></i> Update Permissions
        </button>

    </form>

@endsection
