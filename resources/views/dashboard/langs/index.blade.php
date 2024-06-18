@extends('layouts.dashboard')
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('body.Langs') }}</h4>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target=".create-lang-modal">
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
                            <th>{{ __('body.Code') }}</th>
                            <th>{{ __('body.Name_n') }}</th>
                            <th>{{ __('body.Published') }}</th>
                            <th>{{ __('body.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = ($langs->currentPage() - 1) * $langs->perPage();
                        @endphp
                        @foreach ($langs as $lang)
                            <tr>
                                <td>{{ ++$count }}</td>
                                <td>
                                    <img src="{{ asset('/' . $lang->icon) }}" class="me-75" height="auto" width="20"
                                        alt="{{ $lang->name }}" />
                                </td>
                                <td>{{ $lang->code }}</td>
                                <td>{{ $lang->name }}</td>
                                <td>
                                    @if ($lang->is_published)
                                        <span class="badge rounded-pill badge-light-primary me-1">
                                            {{ __('body.Published') }}
                                        </span>
                                    @else
                                        <span class="badge rounded-pill badge-light-warning me-1">
                                            {{ __('body.Not Published') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target=".edit-lang-modal-{{ $lang->id }}">
                                                <i data-feather="edit-3" class="me-50"></i>
                                                <span>{{ __('body.Edit') }}</span>
                                            </a>
                                            @if (!in_array($lang->code, ['en', 'uz', 'ru']))
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target=".delete-lang-modal-{{ $lang->id }}">
                                                    <i data-feather="trash" class="me-50"></i>
                                                    <span>{{ __('body.Delete') }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{--  Edit Modal Beginning  --}}
                            <div class="modal fade edit-lang-modal-{{ $lang->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editLangModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editLangModalLabel">
                                                {{ __('body.Update Lang') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <form action="{{ Route('dash.langs.update', $lang->id) }}"
                                            enctype="multipart/form-data" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <img src="{{ asset('/' . $lang->icon) }}"
                                                                style="width: 50px; height: auto;"
                                                                alt="{{ $lang->name }}">
                                                            {{ __('body.Icon Preview') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="lang-code">
                                                                {{ __('body.Code') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <input name="code" value="{{ $lang->code }}"
                                                                type="text" placeholder="{{ __('body.Enter code') }}..."
                                                                class="form-control" id="lang-code">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="lang-name">
                                                                {{ __('body.Name_n') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <input name="name" value="{{ $lang->name }}"
                                                                type="text"
                                                                placeholder="{{ __('body.Enter name_n') }}..."
                                                                class="form-control" id="lang-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="lang-icon">
                                                                {{ __('body.Icon') }}
                                                            </label>
                                                            <input name="icon" type="file" class="form-control"
                                                                id="lang-icon">
                                                        </div>
                                                    </div>
                                                    @if (!in_array($lang->code, ['en', 'uz', 'ru']))
                                                        <div class="col-md-6 d-flex align-items-end">
                                                            <div class="form-check form-switch mb-3" dir="ltr">
                                                                <label class="form-check-label"
                                                                    for="isPublishedSwitch">{{ __('body.Published') }}</label>
                                                                <input name="is_published" type="checkbox"
                                                                    class="form-check-input" id="isPublishedSwitch"
                                                                    @checked($lang->is_published)>
                                                            </div>
                                                        </div>
                                                    @endif
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
                            <div class="modal fade delete-lang-modal-{{ $lang->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteLangModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLangModalLabel">
                                                {{ __('body.Delete Lang') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <form action="{{ Route('dash.langs.destroy', $lang->id) }}" method="POST">
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
                        {{ $langs->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  Create Modal Beginning  --}}
    <div class="modal fade create-lang-modal" tabindex="-1" role="dialog" aria-labelledby="createLangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLangModalLabel">{{ __('body.Create Lang') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ Route('dash.langs.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-code">
                                        {{ __('body.Code') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="code" type="text" placeholder="{{ __('body.Enter code') }}..."
                                        class="form-control" id="lang-code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-name">
                                        {{ __('body.Name_n') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="name" type="text" placeholder="{{ __('body.Enter name_n') }}..."
                                        class="form-control" id="lang-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lang-icon">
                                        {{ __('body.Icon') }} <span class="text-danger">*</span>
                                    </label>
                                    <input name="icon" type="file" class="form-control" id="lang-icon">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-switch mb-3" dir="ltr">
                                    <label class="form-check-label"
                                        for="isPublishedSwitch">{{ __('body.Published') }}</label>
                                    <input name="is_published" type="checkbox" class="form-check-input"
                                        id="isPublishedSwitch" checked>
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
