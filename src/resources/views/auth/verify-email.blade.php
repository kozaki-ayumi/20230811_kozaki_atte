<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>

<body>

<header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
          Atte
        </a>
    </div>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレス認証</div>

                <div class="card-body">
                    <p>認証メールを送信しました。届いたメールをご確認の上、記載のリンクから登録を完了させてください。</p>
                    <p>※メールが届かない場合は、入力したアドレスに間違いがあるか、あるいは迷惑メールフォルダに入っている可能性がありますのでご確認ください。</p>

                    <p>認証メールを再送する場合はこちらをクリックしてください。</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">メールを再送</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

