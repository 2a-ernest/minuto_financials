@extends('templates.login')

@section('content')

<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><h2 style="color:white">{{ config('app.name', 'Laravel') }}</h2></div>
        <form id="login" role="form" method="POST" action="{{ url('/login') }}" />
            {{ csrf_field() }}

            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="email" id="email" placeholder="Enter any username or email"  value="{{ old('email') }}" required/>
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Enter any password" required/>
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Sign In</button>
            </div>
            <div class="inputwrapper animate4 bounceIn">
                <label><input type="checkbox" class="remember" name="signin" /> Keep me sign in</label>
            </div>

        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2013. Shamcey Admin Template. All Rights Reserved.</p>
</div>
@endsection
