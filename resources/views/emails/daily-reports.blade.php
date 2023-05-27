<h1>Email with Attachments</h1>

<p>This email contains attachments. Please find them below:</p>

@foreach ($files as $file)
    <a href="{{ $message->embed($file) }}">DaileFile</a><br>
@endforeach
