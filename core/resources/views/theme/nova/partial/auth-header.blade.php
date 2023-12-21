<li class="dropdown main-user-balance nav nav-item nav-link ps-lg-2">
  <a class="new nav-link profile-user d-flex" href="" id="userHeaderBalance" data-bs-toggle="dropdown" style="font-size: 1rem">
    {{ GENERAL_SETTING['cur_sym'] }} {{ showAmount(auth()->user()->balance,0) }} 
  </a>
  <div class="dropdown-menu">
    <div class="dropdown-item">
        <div class="form-check form-switch d-flex align-items-center justify-content-center">
            <input class="form-check-input" onclick="showUserBalanceInDollar()" type="checkbox" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">USD</label>
          </div>
    </div>
  </div>
</li>

<li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
  <a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"> <img src="{{ getUserImage() }}" alt="avatar">
  </a>
  <div class="dropdown-menu">
    <div class="menu-header-content border-bottom p-3">
      <div class="d-flex wd-100p">
        <div class="main-img-user"> <img src="{{ getUserImage() }}" alt="avatar">
        </div>
        <div class="my-auto ms-3">
          <h6 class="tx-15 font-weight-semibold mb-0">{{ auth()->user()->username }}</h6><span class="dropdown-title-text subtext op-6 tx-12"><span class='badge badge-pill bg-primary'>#{{ auth()->user()->token_id }}</span></span>
        </div>
      </div>
    </div>
    <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="far fa-user-circle"></i>Profile</a>
    <a class="dropdown-item" href="{{ route('user.withdraw') }}"><i class="fa fa-database"></i> Wallet</a>

    <a class="dropdown-item" href="{{ route('user.referral') }}"><i class="fa fa-database"></i> Referral</a>
    
    <a class="dropdown-item" href="{{ route('user.offer.reports') }}"><i class="fa fa-database"></i> History</a>

    @if (auth()->user()->role == 1)
      <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-database"></i> Admin Panel</a>
    @endif

    <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();"><i class="far fa-arrow-alt-circle-left"></i> Sign Out</a>
    <form id="logout-form" action="{{ route('user.logout') }}" style="display: none;">
    </form>
  </div>
</li>
