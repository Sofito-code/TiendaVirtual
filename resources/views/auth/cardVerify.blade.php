<h1 class="text-center" style="padding-bottom: 10px">{{ __('Verifica tú correo') }}</h1>
<div class="card">
    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
            </div>
        @endif

        {{ __('Antes de continuar, revise su correo electrónico para obtener un enlace de verificación.') }}
        {{ __('Si no recibiste el correo electrónico') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haga clic aquí para solicitar otro') }}</button>.
        </form>
    </div>
</div>
