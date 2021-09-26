<div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-row">
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('/')}}frontEnd/images/phone.png" alt=""></div>0165027505079</div>
                <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('/')}}frontEnd/images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">{{$websetting->main_email}}</a></div>
                <div class="top_bar_content ml-auto">
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#">Language<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Bangla</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Currency<i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <li><a href="#">TAKA ৳</a></li>
                                    <li><a href="#">USD $</a></li>
                                    <li><a href="#">RUPEE ₹</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>



                    @if(Auth::check())
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                            <li>
                                <a href="#"><i class="fas fa-user"></i> {{ Auth::user()->name }}</a>
                                <ul>
                                    <li><a href="{{route('customerLoGout')}}">Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    @endif

                    @guest
                    <div class="top_bar_menu">
                        <ul class="standard_dropdown top_bar_dropdown">
                             <li>
                                <a href="{{route('login')}}">Login<i class="fas fa-chevron-down"></i></a>
{{--                                 <ul style="width: 250px; padding: 10px;">--}}
{{--                                    <form action="{{route('login')}}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Email Address:</label>--}}
{{--                                            <input type="email" class="form-control" name="email" autocomplete="off" autofocus required/>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label for="">Password:</label>--}}
{{--                                            <input type="password" name="password" class="form-control" autocomplete="off" autofocus required/>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group">--}}
{{--                                           <button type="submit" class="btn btn-success btn-block">Login</button>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </ul>--}}
                            </li>

                            <li>
                                <a href="{{route('register')}}">Register<i class="fas fa-chevron-down"></i></a>

                             </li>
                         </ul>
                    </div>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</div>
