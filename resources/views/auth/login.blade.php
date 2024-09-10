<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="textbox">
                <label for="email" :value="__('Email')">Email</label>
                <input placeholder="Your Email" type="text" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="textbox">
                <label for="password" :value="__('Password')">Password</label>
                <input placeholder="Your Password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary" ;">Login</button>
            </div>
        </form>
        <div class="optional">
            <span class="spanreg">No Account yet?</span>
            <a type="button" class="changebutton" href="{{ route('register') }}">Register</a>
        </div>

    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>
