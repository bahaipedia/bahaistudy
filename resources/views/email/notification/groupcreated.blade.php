<h1>new group was created</h1>

<p>name: {{$user->name}}</p>
<p>group: {{$group->name}}</p>
<a href='{{route('group.dashboard', [str_replace('/', ' ', str_replace('#', ' ', $group->book->name)), $group->route])}}'>id: {{$group->id}}</a>