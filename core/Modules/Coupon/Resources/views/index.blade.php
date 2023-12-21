<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#couponModal">
    Enter Coupon Code
</button>


<div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card m-0">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <form action="{{ route('coupon.click') }}" method="POST">
                                @csrf
                                <x-bs::input type="text" name="coupon" label="Enter Coupon Code" />
                                <br>
                                <div class="d-flex justify-content-between align-items-center mb-3 ">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <button type="button"  data-bs-dismiss="modal" class="btn btn-secondary">cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
