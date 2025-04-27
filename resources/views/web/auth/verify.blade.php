@extends('layouts.app')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Vérifiez votre adresse email') }}</p>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
            </div>
        @endif

        {{ __('Avant de continuer, veuillez vérifier votre email pour le lien de vérification.') }}
        {{ __('Si vous n'avez pas reçu l'e-mail') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Cliquez ici pour en demander un autre') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
