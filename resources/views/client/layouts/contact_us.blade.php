@extends('client.shared.master')
@section('content')

<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{trans('message.Contact')}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{trans('message.home')}}</a></li>
                        <li class="breadcrumb-item active"> {{trans('message.Contact Us')}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>{{trans('message.CONTACT INFO')}}</h2>
                        <p>{{trans('message.Content')}} </p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>{{trans('message.Address')}}: 33 Xô Viết Nghệ Tĩnh <br>Hải Nam District<br> Hòa Cường Nam Ward</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>{{trans('message.Phone')}}: <a href="">+(84) 0384443456</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>{{trans('message.Email')}}: <a href="mailto:contactinfo@gmail.com">winwin260299@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>{{trans('message.GET IN TOUCH')}}</h2>
                        <p>{{trans('message.content us')}}</p>
                        @if(Session::has('flash_message'))
                            <strong>{{ Session::get('flash_message') }}</strong>
                        @endif  
                        <form id="contactForm" method="post" action="{{ route('sendcontact')}}">
                             @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('regis.name')}}" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" placeholder="{{trans('regis.email')}}" id="email" class="form-control" name="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="{{trans('regis.subject')}}" required data-error="Please enter your Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" name="mess" placeholder="{{trans('regis.Your Message')}}" rows="4" data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">{{trans('regis.Send Message')}}</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

@endsection