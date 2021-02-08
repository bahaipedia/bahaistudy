<h1>please confirm email</h1>

<p>{{$user->name}}</p>
<p>{{$user->lastname}}</p>
<p>{{$user->role}}</p>
<a href='{{route('confirm.email.status', [Crypt::encryptString(auth()->user()->id)])}}'>follow this link to confirm the email</a>
