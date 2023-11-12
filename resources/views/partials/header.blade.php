
<header class="masthead">
    <div class="container">
       @auth
      @if (auth()->user()->is_admin === 1)
      <div class="masthead-subheading">Welcome To Naive Dashboard! {{ auth()->user()->name }}</div>
    @else
    <div class="masthead-subheading">Welcome To Naive Home! {{ auth()->user()->name }}</div>
      @endif
       @else
       <div class="masthead-subheading">Welcome To Naive!</div>
       @endauth
        <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
        @auth
        <a class="btn btn-primary btn-xl text-uppercase" href="{{ route('prediction.create') }}">Go Predict!</a>
        @else
        <a class="btn btn-primary btn-xl text-uppercase" href="{{ route('register') }}">Create New Acount!</a>
        @endauth
    </div>        
</header>