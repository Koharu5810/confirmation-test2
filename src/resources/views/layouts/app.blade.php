<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    {{-- ヘッダーフォント --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="header">
            <h2 class="header__logo">
                <a href="{{ route('products.index') }}">mogitate</a>
            </h2>
        </div>
    </header>

    <main>
        <div class="main-container">

            @yield('content')

        </div>
    </main>
</body>

</html>
