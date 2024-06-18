@extends('dashboard')
@section('content')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('body.Company Info') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dash.company-setting.update') }}" method="post" class="form"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name-column">{{ __('body.Name_n') }}</label>
                                        <input name="name" value="{{ $company->name }}" type="text" id="name-column"
                                            class="form-control" placeholder="{{ __('body.Enter name_n') }}..." />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="city-column">{{ __('body.Logo') }}</label>
                                        <input name="logo" type="file" id="city-column" class="form-control"
                                            placeholder="City" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label"
                                            for="country-floating">{{ __('body.Secondary Logo') }}</label>
                                        <input name="logo_secondary" type="file" id="country-floating"
                                            class="form-control" placeholder="Country" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="user-avatar-section">
                                        <div class="d-flex flex-column">
                                            <div class="user-info">
                                                <label class="form-label"
                                                    for="city-column">{{ __('body.Logo Preview') }}</label>
                                            </div>
                                            <img class="img-fluid rounded mt-1 mb-2" src="{{ $company->logo_path }}"
                                                height="110" width="110" alt="User avatar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="user-avatar-section">
                                        <div class="d-flex flex-column">
                                            <div class="user-info">
                                                <label class="form-label"
                                                    for="city-column">{{ __('body.Secondary Logo Preview') }}</label>
                                            </div>
                                            <img class="img-fluid rounded mt-1 mb-2"
                                                src="{{ $company->logo_secondary_path }}" height="110" width="110"
                                                alt="User avatar" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('body.Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
