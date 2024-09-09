<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100"
          method="post"
          action="{{ route('submit_login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">
                CONNEXION
            </h1>

        </div>
        <!--begin::Heading-->

        <!--end::Separator-->

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input
                value="{{ old('email') }}"
                type="text" placeholder="Email" name="email" autocomplete="off"
                class="form-control bg-transparent @error('email') is-invalid @enderror"/>
            <!--end::Email-->
            @error('email')
            <strong class="invalid-feedback">{{ $message }}</strong>
            @enderror
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input
                type="password" placeholder="Password" name="password" autocomplete="off"
                class="form-control bg-transparent @error('password') is-invalid @enderror"/>
            <!--end::Password-->
        </div>
        <!--end::Input group--->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>

            <!--begin::Link-->
{{--            <a href="/forgot-password" class="link-primary">--}}
{{--                Mot de passe oublié ?--}}
{{--            </a>--}}
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Se connecter'])
            </button>
        </div>
    </form>
    <!--end::Form-->

</x-auth-layout>
