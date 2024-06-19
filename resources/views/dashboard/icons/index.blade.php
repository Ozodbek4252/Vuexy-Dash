@extends('layouts.dashboard')
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('body.Icons') }}</h4>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target=".create-icon-modal">
                        <i data-feather='plus'></i>
                        {{ __('body.Create') }}
                    </button>
                </div>
                <div class="card-body">
                    {{--  <p class="card-text">
                        Use <code class="highlighter-rouge">.table-striped</code> to add zebra-striping to any table row
                        within the
                        <code class="highlighter-rouge">&lt;tbody&gt;</code>. This styling doesn't work in IE8 and below as
                        <code>:nth-child</code> CSS selector isn't supported.
                    </p>  --}}
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('body.Icon') }}</th>
                            <th>{{ __('body.Name_n') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = ($icons->currentPage() - 1) * $icons->perPage();
                        @endphp
                        @foreach ($icons as $icon)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>
                                    <img src="{{ $icon->icon_path }}" class="me-75" height="auto" width="30"
                                        alt="{{ $icon->name }}" />
                                </td>
                                <td>{{ $icon->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target=".edit-icon-modal-{{ $icon->id }}">
                                                <i data-feather="edit-3" class="me-50"></i>
                                                <span>{{ __('body.Edit') }}</span>
                                            </a>
                                            @if (!in_array($icon->code, ['en', 'uz', 'ru']))
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target=".delete-icon-modal-{{ $icon->id }}">
                                                    <i data-feather="trash" class="me-50"></i>
                                                    <span>{{ __('body.Delete') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{--  Edit Modal Beginning  --}}
                            <div class="modal fade edit-icon-modal-{{ $icon->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editIconModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editIconModalLabel">
                                                {{ __('body.Update Icon') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <form action="{{ Route('dash.icons.update', $icon->id) }}"
                                            enctype="multipart/form-data" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <img src="{{ $icon->icon_path }}"
                                                                style="width: 50px; height: auto;"
                                                                alt="{{ $icon->name }}">
                                                            {{ __('body.Icon Preview') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="icon-icon">
                                                                {{ __('body.Icon') }}
                                                            </label>
                                                            <input name="icon" type="file" class="form-control"
                                                                id="icon-icon">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="icon-name">
                                                                {{ __('body.Name_n') }}
                                                            </label>
                                                            <input name="name" value="{{ $icon->name }}"
                                                                type="text"
                                                                placeholder="{{ __('body.Enter name_n') }}..."
                                                                class="form-control" id="icon-name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-outline-primary">{{ __('body.Update') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--  Edit Modal End  --}}

                            {{--  Delete Modal Beginning  --}}
                            <div class="modal fade delete-icon-modal-{{ $icon->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteIconModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteIconModalLabel">
                                                {{ __('body.Delete Icon') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <form action="{{ Route('dash.icons.destroy', $icon->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                {{ __('body.Do you really want to delete this?') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                                                <button type="submit"
                                                    class="btn btn-outline-danger">{{ __('body.Delete') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--  Delete Modal End  --}}
                        @endforeach
                        {{ $icons->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  Create Modal Beginning  --}}
    <div class="modal fade create-icon-modal" tabindex="-1" role="dialog" aria-labelledby="createIconModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createIconModalLabel">{{ __('body.Create Icon') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('dash.icons.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="icon-icon">
                                        {{ __('body.Icon') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="icon" type="file" class="form-control" id="icon-icon">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="icon-name">
                                        {{ __('body.Name_n') }}
                                    </label>
                                    <input name="name" type="text" placeholder="{{ __('body.Enter name_n') }}..."
                                        class="form-control" id="icon-name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger"
                            data-bs-dismiss="modal">{{ __('body.Close') }}</button>
                        <button type="submit" class="btn btn-outline-primary">{{ __('body.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--  Create Modal End  --}}
@endsection
