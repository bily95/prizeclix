<div class="card">
    <div class="card-body">
        <form action="{{ route('user.profile.account.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 my-1">
                    <x-bs::input type="text" name="token_id" value="{{ $user->token_id }}" label="ID"
                        class="disabled" readonly />
                </div>
                <div class="col-md-6 my-1">
                    <x-bs::input type="email" name="email" value="{{ $user->email }}" label="Email"
                        class="disabled" readonly />
                </div>
                <div class="col-md-6 my-1">
                    <x-bs::input type="text" name="username" value="{{ $user->username }}" label="Username" />
                </div>
                <div class="col-md-6 mt-5">
                    <div class="d-flex align-items-center justify-content-between">
                      <label>Make profile public</label>
                      <input type="checkbox" name="isPublic" @if($user->profile->isPublic) checked="checked" @endif data-toggle="toggle" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-2">Update</button>
          </form>
    </div>
    <div class="card-footer">
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger float-end">
            <i class="fas fa-trash"></i> Delete
            Account</a>
    </div>
</div>
