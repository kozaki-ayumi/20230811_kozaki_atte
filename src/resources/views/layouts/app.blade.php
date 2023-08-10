<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
     
     @yield('css')
</head>
<body>

<header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
          Atte
        </a>
        <nav>
          <ul class="header-nav">
          @if (Auth::check())
          <?php $user = Auth::user(); ?>
              <li class="header-nav__item">
                 <form class="form" action="/" method="get">
                  @csrf    
                    <button class="header-nav__button">ホーム</button>
                 </form>
              </li>

              <li class="header-nav__item">
                 <form class="form" action="/attendance" method="get">
                  @csrf
                   <button class="header-nav__button">日付一覧</button>
                 </form>   
              </li> 

              <li class="header-nav__item">
                 <form class="form" action="/user/attendance" method="get">
                  @csrf
                  <input type="hidden" name="user_id" value="{{$user->id}}">
                   <button class="header-nav__button">個人一覧</button>
                 </form>   
              </li> 

              <li class="header-nav__item">
                 <form class="form" action="/logout" method="post">
                  @csrf
                   <button class="header-nav__button">ログアウト</button>
                 </form>
             </li>
          @endif
          </ul>
        </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

</body>
</html>