<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="row">
        <div class="col-md-6">
            @dump(auth()->user())


          <h6>Mes Informations</h6>
          @if(Cache::has('user-is-online-' . $user->id))
              <span class="text-success">Online</span>
          @else
              <span class="text-secondary">Offline</span>
          @endif

            <table class="table table-bordered table-sm table-hover table-striped">
                <tr>
                    <th>Nom et prénom</th>
                    <td>
                        {{$user->first_name}} {{$user->last_name}}

                    </td>
                </tr> 
                <tr>
                    <th>Email</th>
                    <td>
                        {{ $user->email }}

                    </td>
                </tr>
                
            </table>
        </div>
        <div class="col-md-6">


            <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        @php $users = DB::table('users')->get(); @endphp
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-success">Online</span>
                                            @else
                                                <span class="text-secondary">Offline</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            


        </div>
    </div>
</div>
