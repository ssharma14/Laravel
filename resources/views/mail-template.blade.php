<ul>
    @if($name)
        <li>
            <strong>{{ $name }}</strong>
        </li>
    @endif
    @if($email)
        <li>
            <strong>{{ $email }}</strong>
        </li>
    @endif
    @if($subject)
        <li>
            <strong>{{ $subject }}</strong>
        </li>
    @endif
    <hr>
    @if($messageLines)
        <h4>Message:</h4>
        <p>
            @foreach ($messageLines as $messageLine)
                {{ $messageLine }}<br>
            @endforeach
        </p>
        <hr>
    @endif
</ul>
