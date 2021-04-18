<h1>new host was stepped down</h1>

<p>name: {{$user->name}}</p>
<p>group: {{$group->name}}</p>
<a href='{{route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route])}}'>id: {{$group->id}}</a>

