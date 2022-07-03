<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="row">
        <div class="col-md-6">
          <h6>Mes Informations</h6>
          @if(Cache::has('user-is-online-' . $user->id))
              <span class="text-success">Vous êtes connectés</span>
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
                <tr>
                    <th>
                        <button class="btn btn-link"

                        wire:click="setNewPassword">Modifier votre Mot de passe</button>
                    </th>
                    <td>
                        @if ($setPassword)
                            {{-- expr --}}
                            <form action="" wire:submit.prevent="updatePassword">
                                <input type="password" class="form-control form-control-sm mb-1" wire:model="last_password" placeholder="Votre Mot de pass">
                                <input type="password" class="form-control form-control-sm mb-1" wire:model="new_password" placeholder="Nouveau mot de passe">
                                <input type="password" class="form-control form-control-sm mb-1" wire:model="confirm_password"  placeholder="Confirmer votre mot de passe">
                                <button type="submit" class="btn btn-block btn-outline-primary btn-sm">Modifier</button>
                            </form>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if ($showMessage)
                            {{-- expr --}}
                            <p class="text-success text-center">{{ $showMessage }}</p>
                        @endif
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="col-md-6">


            <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        @php $users = DB::table('users')->get(); @endphp
                      
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Navigateur</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->first_name}}</td>
                                        <td>
                                            <small>{{$user->navigateur}}</small>
                                        </td>
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
