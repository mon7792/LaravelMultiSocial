{{-- @if($user->count() != 0 ) --}}
@foreach ($user as $us)
    <tr>
      <td>{{ $us->name }}</td>
      <td>{{ $us->email }}</td>
      <td></td>
    </tr>
@endforeach
{{-- @else
  <tr>
    no such user
  </tr>
@endif --}}
