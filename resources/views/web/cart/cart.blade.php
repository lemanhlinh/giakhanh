@extends('web.layouts.web')

@section('content')
    <div class="content-register">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <style>
        .content-register{
            padding: 176px 0 80px;
            text-align: center;
        }
        .content-register img{
            display: block;
            margin: 0 auto;
        }
        .content-register .title-register{
            color: #E91A22;
            font-size: 32px;
            margin-bottom: 40px;
            text-transform: uppercase;
        }
        .button-go-to-page a{
            border-radius: 8px;
            text-align: center;
            padding: 14px 20px;
            display: block;
            text-decoration: none;
            font-family: GoogleSans-Bold;
        }
        .button-go-to-page .go-to-course-page{
            background: #E91A22;
            color: #fff;
        }
        .button-go-to-page .go-to-home-page{
            color: #620B0E;
            background: #E4A812;
        }
    </style>
@endsection

@section('script')
    @parent
@endsection
