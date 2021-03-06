@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
<div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 align-self-center">
        <div class="card">
            <div class="card-header">
                <strong>
                    @lang('labels.frontend.auth.register_box_title')
                </strong>
            </div><!--card-header-->

            <div class="card-body">
                {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                            {{ html()->text('name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.name'))
                                        ->attribute('maxlength', 191) }}
                        </div><!--col-->
                    </div><!--row-->

<!--                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}

                            {{ html()->text('last_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.last_name'))
                                        ->attribute('maxlength', 191) }}
                        </div>form-group
                    </div>col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                            {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                            {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                            {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

                            {{ html()->text('phone')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.phone')) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                
                <!-- FOR EMPLOYER ONLY--->
                @if ($type === 'employer')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.company_name'))->for('company_name') }}

                            {{ html()->text('company_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.company_name')) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.company_url'))->for('company_url') }}

                            {{ html()->text('company_url')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.company_url')) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.company_desc'))->for('company_desc') }}

                            {{ html()->textarea('company_desc')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.company_desc')) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.company_logo'))->for('company_logo') }}

                            {{ html()->file('company_logo')
                                        ->class('form-control') }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="checkbox">
                                {{ html()->label(html()->checkbox('is_agency', false, 0) . ' ' . __('validation.attributes.frontend.is_agency'))->for('is_agency') }}
                            </div>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                @endif
                <!-- FOR EMPLOYER END--->           
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="checkbox">
                                {{ html()->label(html()->checkbox('mailing_subscription', true, 1) . ' ' . __('validation.attributes.frontend.mailing_subscription'))->for('mailing_subscription') }}
                            </div>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                {{ html()->hidden('type', $type) }}
                @if(config('access.captcha.registration'))
                <div class="row">
                    <div class="col">
                        {!! Captcha::display() !!}
                        {{ html()->hidden('captcha_status', 'true') }}
                    </div><!--col-->
                </div><!--row-->
                @endif

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0 clearfix">
                            {{ form_submit(__('labels.frontend.auth.register_button')) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                {{ html()->form()->close() }}

                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            {!! $socialiteLinks !!}
                        </div>
                    </div><!--/ .col -->
                </div><!-- / .row -->

            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- col-md-8 -->
</div><!-- row -->
@endsection

@push('after-scripts')
@if(config('access.captcha.registration'))
{!! Captcha::script() !!}
@endif
@endpush
