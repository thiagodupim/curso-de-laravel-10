<h1>Nova dúvida</h1>

<x-alert/>

<form action="{{ route('supports.store') }}" method="POST">
    {{-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> --}}
    @include('admin.supports.partials.form')
</form>