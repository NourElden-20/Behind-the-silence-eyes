<H1>Doctor Dashboard</H1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>