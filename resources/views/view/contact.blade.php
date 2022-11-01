@component('mail::message')
<h2>Hello {{$data->name}},</h2>
<p>{{ $data->message }}
</p>


Happy coding!<br>

Thanks,<br>
<a href="http://" target="_blank" rel="noopener noreferrer">David from {{ config('app.name') }} </a> <br>
@endcomponent
