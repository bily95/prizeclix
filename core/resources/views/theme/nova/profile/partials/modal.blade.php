<div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog" role="document">
      <div class="modal-content p-4">
          <h5 class="text-center" >@lang('Delete Account')</h5>
          <form action="{{ route('user.account.delete') }}" method="post">
              @csrf
              <div class="modal-body">
                  <p class="text-center">Your account and all data will be deleted
                      permanently and this action cannot be undo.</p>
              </div>
              <div class="modal-footer  justify-content-center border-0">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                      >@lang('Cancel')</button>
                  <button type="submit" class="btn btn-primary"
                      >@lang('Delete')</button>
              </div>
          </form>
      </div>
  </div>
</div>