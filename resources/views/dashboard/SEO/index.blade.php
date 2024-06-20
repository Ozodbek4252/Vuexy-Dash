@extends('layouts.dashboard')
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">SEO</h4>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                        data-bs-target=".edit-seo-modal">
                        <i data-feather="edit-3" class="me-50"></i>
                        {{ __('body.Edit') }}
                    </button>
                </div>
                <div class="card-body">
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('body.Name_n') }}</th>
                            <th>{{ __('body.Value') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __('body.Title') }}</td>
                            <td>{{ $seo->title }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('body.Description') }}</td>
                            <td>{{ $seo->description }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('body.Keywords') }}</td>
                            <td>{{ $seo->keywords }}</td>
                        </tr>

                        {{--  Edit Modal Beginning  --}}
                        <div class="modal fade edit-seo-modal" tabindex="-1" role="dialog"
                            aria-labelledby="editSEOModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSEOModalLabel">
                                            {{ __('body.Update SEO') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <form action="{{ Route('dash.seos.update', $seo->id) }}" enctype="multipart/form-data"
                                        method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">

                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach ($langs as $lang)
                                                    <li class="nav-item">
                                                        <a class="nav-link lang-nav-link" id="{{ $lang->code }}"
                                                            data-bs-toggle="tab" href="#lang-{{ $lang->code }}"
                                                            aria-controls="{{ $lang->code }}" role="tab"
                                                            aria-selected="true">
                                                            <img src="{{ $lang->icon }}" width="20" alt="">
                                                            &nbsp;
                                                            {{ $lang->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach ($langs as $lang)
                                                    <div class="tab-pane" id="lang-{{ $lang->code }}"
                                                        aria-labelledby="{{ $lang->code }}" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="seo-title">
                                                                        {{ __('body.Title') }}
                                                                    </label>
                                                                    <input name="title_{{ $lang->code }}"
                                                                        value="{{ $seo->translations[$lang->code]['title']['content'] }}"
                                                                        type="text" class="form-control"
                                                                        placeholder="{{ __('body.Enter title') }}..."
                                                                        id="seo-title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="seo-description">
                                                                        {{ __('body.Description') }}
                                                                    </label>
                                                                    <input name="description_{{ $lang->code }}"
                                                                        value="{{ $seo->translations[$lang->code]['description']['content'] }}"
                                                                        type="text"
                                                                        placeholder="{{ __('body.Enter description') }}..."
                                                                        class="form-control" id="seo-description">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="seo-keywords">
                                                            {{ __('body.Keywords') }}
                                                        </label>
                                                        <input name="keywords" value="{{ $seo->title }}" type="text"
                                                            value="{{ $seo->keywords }}"
                                                            placeholder="{{ __('body.Enter keywords') }}..."
                                                            class="form-control" id="seo-keywords">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // add active class to the first nav-link
            $('.lang-nav-link').first().addClass('active');
            $('.tab-pane').first().addClass('active');
        });
    </script>
@endsection
