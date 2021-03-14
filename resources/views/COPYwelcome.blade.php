<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
        
        <title>Bahai</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 45px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            a{
                font-size: 20px;
                margin: 5px;
                color:black !important;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @if(auth()->user() !== NULL)
                <div class="title m-b-md">
                    Welcome to '{{auth()->user()->name}} {{auth()->user()->lastname}}' {{$title}}
                </div>
                @else
                <div class="title m-b-md">
                    Welcome to {{$title}}
                </div>
                @endif
                <div>
                    @if(auth()->user() !== NULL)
                    <a href={{route('store.book')}}>store book</a>
                    <a href={{route('store.author')}}>store author</a> 
                    <a href={{route('store.container')}}>store contanier</a> 
                    <br>
                    <br>
                    <a href={{route('list.books')}}>view books</a>
                    <a href={{route('list.authors')}}>view authors</a> 
                    <a href={{route('list.containers')}}>view contaniers</a>
                    <a href={{route('list.users')}}>view users</a>  
                    <br>
                    <br>
                    <a href={{route('logout')}}>logout</a>
                    @else
                    <a href={{route('login')}}>login</a>
                    <a href={{route('register')}}>register</a>      
                    @endif
                    <a href={{route('auth.reset.password.input')}}>reset password</a>
                </div>
                <br>
                <div>
                    @if(auth()->user() !== NULL && auth()->user()->email_validated == 1)
                    <a href={{route('deconfirm.email.status', [Crypt::encryptString(auth()->user()->id)])}}>the user email is confirmated change status</a>
                    @elseif(auth()->user() !== NULL)
                    <a href={{route('confirm.email')}}>send email confirmation</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
