@extends('layouts.web')

@section('title', 'Registration')
@section('description', '')
@section('canonical', config('app.url') . Request::path())


@section('hero-section')
    <div class="container mx-auto lg:px-4 py-6">
        <div class="flex flex-col space-y-4 my-2 md:my-0 lg:flex-row lg:mx-4">
            @include('partials.frontend.auth-form-view')
            <div class="panel w-full sm:w-[70%] lg:w-[35%] xl:w-[30%] mx-auto ">
                <form id="registration-form" action="{{ route('register') }}" method="POST"
                    class="border-4 border-primary-one shadow-md rounded-lg px-4 pt-2 pb-6 flex flex-col md:ml-auto w-full space-y-2 text-white ">

                    <div class="bg-primary py-2 px-5 rounded-t-lg">
                        <p class="text-3xl text-center text-white font-semibold">
                            {{ trans('global.register') }}
                        </p>
                    </div>

                    @if (session()->has('status'))
                        <p class="alert alert-info">
                            {{ session()->get('status') }}
                        </p>
                    @endif

                    {{-- @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif --}}
                    @csrf

                    <div class="mb-2">
                        <input id="name" type="name"
                            class="input-control {{ $errors->has('name') ? ' is-invalid' : '' }}" required
                            autocomplete="name" autofocus placeholder="Name" name="name"
                            value="{{ old('name', null) }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-2">
                        <input id="email" type="email"
                            class="input-control {{ $errors->has('email') ? ' is-invalid' : '' }}" required
                            autocomplete="email" placeholder="{{ trans('global.login_email') }}" name="email"
                            value="{{ old('email', null) }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-2">
                        <input type="text" id="phone" class="input-control @error('phone') error-field @enderror" placeholder="" value="{{ old('phone','') }}"/>
                        <p id="valid-msg" class="hidden font-bold">
                            <i class="fa fa-check-circle text-primary-two text-xl pt-2" aria-hidden="true"></i> Valid Number
                        </p>
                        <p id="error-msg" class="hidden text-primary-one"></p>
                        @error('phone')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <input type="hidden" name="phone" id="phone2" />
                    </div>

                    <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const phone     = document.querySelector("#phone");
        var errorMsg    = document.querySelector("#error-msg"),
        validMsg        = document.querySelector("#valid-msg");

        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        const phoneInput = window.intlTelInput(phone, {
            preferredCountries: ["ae"],
            separateDialCode : true,
            dropdownContainer : document.body,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                return "e.g. " + selectedCountryPlaceholder;
            },
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io/103.244.175.33?token=1fb4fdd88d0fa0", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "ae";
                    // success(countryCode);
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        var submit = $('#registration-form').find(':submit');

        var reset = function() {
            phone.classList.remove("error");
            phone.classList.remove("error-field");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hidden");
            validMsg.classList.add("hidden");
            submit.attr("disabled", true);
            submit.addClass("btn-disabled");
        };

        // on blur: validate
        phone.addEventListener('blur', function() {
            reset();
            if (phone.value.trim()) {
                if (phoneInput.isValidNumber()) {
                    validMsg.classList.remove("hidden");
                    submit.attr("disabled", false);
                    submit.removeClass("btn-disabled");
                } else {
                    phone.classList.add("error");
                    phone.classList.add("error-field");
                    var errorCode = phoneInput.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hidden");
                }
            }
        });

        // on keyup / change flag: reset
        phone.addEventListener('change', reset);
        phone.addEventListener('keyup', reset);

        $("#registration-form").submit(function() {
            $('#registration-form').find(':submit').attr("disabled", true);
            $('#submit').html("Submiting...");
            const phoneNumber = phoneInput.getNumber();
            $('#phone2').val(phoneNumber);
            return true;
        });

    </script>
@endsection
