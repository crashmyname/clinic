<meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="">
@if (!auth()->check() == "")
berhasil login
<form action="{{route('logout')}}" method="post">
    @csrf
<button type="submit">logout</button>
</form>
@else
redirect back('/')
@endif