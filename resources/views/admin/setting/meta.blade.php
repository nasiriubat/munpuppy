@extends('admin.setting.index')

@section('admin.setting.breadcrumbs')
{{ Breadcrumbs::render('meta-setting') }}
@endsection

@section('admin.setting.layout')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.setting.meta-update') }}">
                @csrf
                <fieldset class="setting-fieldset">
                    <legend class="setting-legend">{{ __('Meta Setting') }}</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meta_site_name">{{ __('Meta Site Name') }}</label>
                                <input name="meta_site_name" id="meta_site_name" type="text" class="form-control {{ $errors->has('meta_site_name') ? ' is-invalid ' : '' }}" value="{{ old('meta_site_name', setting('meta_site_name')) }}">
                                @if ($errors->has('meta_site_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_site_name') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="meta_description">{{ __('Meta Description') }}</label>
                                <input name="meta_description" id="meta_description" type="text" class="form-control {{ $errors->has('meta_description') ? ' is-invalid ' : '' }}" value="{{ old('meta_description', setting('meta_description')) }}">
                                @if ($errors->has('meta_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_description') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meta_keyword">{{ __('Meta Keyword') }}</label>
                                <input name="meta_keyword" id="meta_keyword" type="text" class="form-control {{ $errors->has('meta_keyword') ? ' is-invalid ' : '' }}" value="{{ old('meta_keyword', setting('meta_keyword')) }}">
                                @if ($errors->has('meta_keyword'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_keyword') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="meta_image">{{ __('Meta Image ') }}</label>
                                <input name="meta_image" id="meta_image" type="text" class="form-control {{ $errors->has('meta_image') ? ' is-invalid ' : '' }}" value="{{ old('meta_image', setting('meta_image')) }}">
                                @if ($errors->has('meta_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_image') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meta_fb_app_id">{{ __('Meta Facebook App Id') }}</label>
                                <input name="meta_fb_app_id" id="meta_fb_app_id" type="text" class="form-control {{ $errors->has('meta_fb_app_id') ? ' is-invalid ' : '' }}" value="{{ old('meta_fb_app_id', setting('meta_fb_app_id')) }}">
                                @if ($errors->has('meta_fb_app_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_fb_app_id') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="meta_publisher">{{ __('Meta Facebook Publisher') }}</label>
                                <input name="meta_publisher" id="meta_publisher" type="text" class="form-control {{ $errors->has('meta_publisher') ? ' is-invalid ' : '' }}" value="{{ old('meta_publisher', setting('meta_publisher')) }}" placeholder="Facebook page link">
                                @if ($errors->has('meta_publisher'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_publisher') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="meta_twitter_site">{{ __('Meta Twitter Site Account ') }}</label>
                                <input name="meta_twitter_site" id="meta_twitter_site" type="text" class="form-control {{ $errors->has('meta_twitter_site') ? ' is-invalid ' : '' }}" value="{{ old('meta_twitter_site', setting('meta_twitter_site')) }}">
                                @if ($errors->has('meta_twitter_site'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_twitter_site') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="google_console">{{ __('Google Console ') }}</label>
                                <textarea name="google_console" id="google_console" rows="3" class="form-control {{ $errors->has('google_console') ? ' is-invalid ' : '' }}">{{ old('google_console', setting('google_console')) }}</textarea>
                                @if ($errors->has('google_console'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('google_console') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="meta_twitter_creator">{{ __('Meta Twitter Creator Account ') }}</label>
                                <input name="meta_twitter_creator" id="meta_twitter_creator" type="text" class="form-control {{ $errors->has('meta_twitter_creator') ? ' is-invalid ' : '' }}" value="{{ old('meta_twitter_creator', setting('meta_twitter_creator')) }}">
                                @if ($errors->has('meta_twitter_creator'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('meta_twitter_creator') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="google_analytics">{{ __('Google Analytics ') }}</label>
                                <textarea name="google_analytics" id="google_analytics" rows="3" class="form-control {{ $errors->has('google_analytics') ? ' is-invalid ' : '' }}">{{ old('google_analytics', setting('google_analytics')) }}</textarea>
                                @if ($errors->has('google_analytics'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('google_analytics') }}
                                </div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="google_tag_manager">{{ __('Google Tag Manager ') }}</label>
                                <textarea name="google_tag_manager" id="google_tag_manager" type="text" cols="10" rows="10" class="form-control {{ $errors->has('google_tag_manager') ? ' is-invalid ' : '' }}">{{ old('google_tag_manager', setting('google_tag_manager')) }}</textarea>
                                @if ($errors->has('google_tag_manager'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('google_tag_manager') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="form-group col-md-6">
                        <button class="btn btn-primary">
                            <span>{{ __('update Meta Setting') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection