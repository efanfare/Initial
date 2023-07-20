@extends('layouts.main_dashboard', ['title' => 'Subscription', 'dbClass' => 'db photo-bank-sec'])

@section('content')
    <div class="welcome-box-flex">

        <div class="welcome-box-text">
            <h6>Subscription & Billings</h6>
        </div>
        @if ($user->package_id !== 1)
            <div class="welcome-box-btn">
                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Cancel
                    Subscription</a>
            </div>
        @endif
    </div>
    @if (session()->has('message'))
        <div class="toast-container top-0 end-0 p-3">
            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center aligns-center"
                style="z-index: 5; right: 0; bottom: 0;">
                <div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true"
                    data-delay="4000">
                    <div class="toast-header">
                        <strong class="mr-auto">Success!</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="toast-body">
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal logout-modal fade" id="exampleModal1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="images/cancel-subscription.png" alt="image" class="img-fluid">
                    <h6>are you sure you want to <span>cancel your subscription?</span></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <a href="{{ route('subscription.cancel') }}" class="btn btn-primary">Yes
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="scenes-tabs gallery-boxes-row">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#flamingo" role="tab" aria-controls="pills-flamingo"
                    aria-selected="true">Subscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#cuckoo" role="tab" aria-controls="pills-cuckoo"
                    aria-selected="false">Billing history</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="flamingo" role="tabpanel" aria-labelledby="flamingo-tab">
                <div class="subscription-bg-color">
                    <div class="subscription-toggle-btn">
                        <div class="plan-tab-boxes">
                            <div class="tab-heading-flex">
                                <div class="tab-btn-heading">
                                    <h4>Select efanfare plans</h4>
                                    <p>Choose a plan tailored to your needs</p>
                                </div>
                                <div class="subscription-tab-flex">
                                    <span class="tab-left-text">Monthly</span>
                                    <div class="tabs one">
                                        <div class="active_box" style="width: 183px; left: 6px;"></div>
                                        <div class="tab tab-one active" data-attr="tab_one"></div>
                                        <div class="tab tab-two" data-attr="tab_two"></div>
                                    </div>
                                    <span class="tab-right-text">Yearly</span>
                                </div>
                            </div>
                            <div class="tabs_content one">
                                <div attr="tab_one" class="active">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_monthly }} <small>
                                                                        ${{ $package->price_monthly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                google ads</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                {{ $package->scene_limit_monthly }} limited scenes</li>
                                                            <li><span><i class="fa fa-check" aria-hidden="true"></i></span>
                                                                Upload {{ $package->item_limit_monthly }} custom item</li>
                                                            <li><span><i class="fa fa-check"
                                                                        aria-hidden="true"></i></span>
                                                                Free
                                                                hand use</li>
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">
                                                        @if ($package->id !== 1)
                                                            @if ($user->package_id === $package->id && $user->package_interval === 'monthly')
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @else
                                                                <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'monthly']) }}"
                                                                    class="btn btn-primary">
                                                                    Get started
                                                                    <i class="fa fa-long-arrow-right"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if ($user->package_id === $package->id)
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div attr="tab_two">
                                    <div class="row">
                                        @foreach ($packages as $package)
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="plan-price-box">
                                                    <div class="price-amount-flex">
                                                        <div class="price-amount-img">
                                                            <span><img src="images/plan-price-img.png" alt="image"
                                                                    class="img-fluid"></span>
                                                        </div>
                                                        <div class="plan-price-content">
                                                            @if ($package->id !== 1)
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span> ${{ $package->price_yearly }} <small>
                                                                        ${{ $package->price_yearly }}</small></span>
                                                            @else
                                                                <h6>{{ $package->package_name }}</h6>
                                                                <span>Free <small>$0.00</small></span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="plan-box-listing">
                                                        <ul>
                                                            @if ($package->id !== 1)
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_yearly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_yearly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @else
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->google_ads_free ? 'No' : 'Yes' }}
                                                                    google ads</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    {{ $package->scene_limit_monthly }} limited scenes</li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Upload {{ $package->item_limit_monthly }} custom item
                                                                </li>
                                                                <li><span><i class="fa fa-check"
                                                                            aria-hidden="true"></i></span>
                                                                    Free
                                                                    hand use</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="get-started-btn">
                                                        @if ($package->id !== 1)
                                                            @if ($user->package_id === $package->id && $user->package_interval === 'yearly')
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @else
                                                                <a href="{{ route('plans.show', ['package' => $package->id, 'interval' => 'yearly']) }}"
                                                                    class="btn btn-primary">
                                                                    Get started
                                                                    <i class="fa fa-long-arrow-right"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if ($user->package_id === $package->id)
                                                                <a href="javascript:void(0)" class="btn btn-primary">
                                                                    Your Current Plan
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Billing History Section --}}
            <div class="tab-pane fade" id="cuckoo" role="tabpanel" aria-labelledby="profile-tab">
                <div class="subscription-bg-color">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Billing details</th>
                                    <th scope="col" class="text-right text-edit">

                                        {{ $user->package_id === 1 ? 'Inactive' : 'Active' }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->package_id !== 1)
                                <tr>
                                    <td>Payment method</td>
                                    <td class="text-right"><strong>{{ strtoupper($user->pm_type) }}</strong></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="subscription-plan-table">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Subscription Plan</th>
                                        @if ($user->package_id !== 1)
                                            <th scope="col" class="text-right text-edit">
                                                {{-- <a
                                                    href="{{ route('subscription.cancel') }}">Cancel Subscription
                                                </a> --}}
                                                <a href="javascript:void(0)" data-toggle="modal"
                                                    data-target="#exampleModal1">Cancel
                                                    Subscription</a>
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                            $userPlaned = \App\Models\Package::userCurrentPackage($user->package_id);
                                        @endphp
                                        <td>Choose plan</td>
                                        <td class="text-right">

                                            <strong>{{ $userPlaned->package_name }} </strong>
                                            @if ($user->package_id === 1)
                                                <sub>plan doesn't generate billing invoice </sub>
                                            @endif
                                        </td>
                                    </tr>

                                    @if ($user->package_id !== 1)
                                        <tr>
                                            <td>Subscription plan</td>
                                            <td class="text-right">
                                                <strong>{{ ucfirst($user->package_interval) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Start date</td>
                                            <td class="text-right">
                                                <strong>{{ \Carbon\Carbon::createFromTimeStamp($user->subscription($user->subscriptions()->active()->latest()->first()->name)->asStripeSubscription()->current_period_start)->format('M d, Y') }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Renewal date</td>
                                            <td class="text-right">
                                                <strong>
                                                    {{ \Carbon\Carbon::createFromTimeStamp($user->subscription($user->subscriptions()->active()->latest()->first()->name)->asStripeSubscription()->current_period_end)->format('M d, Y') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="month-amount-table">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Plan</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-none">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                        
                                            <td>{{ isset($invoice->lines->data[1]->plan->id) ? \App\Models\Package::getPackageNameByPriceId($invoice->lines->data[1]->plan->id) : \App\Models\Package::getPackageNameByPriceId($invoice->lines->data[0]->plan->id) }}
                                            </td>
                                            <td>USD {{ $invoice->total() }}</td>
                                            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                            <td><span class="status-text">{{ $invoice->isPaid() ? 'Paid' : '--' }}</span>
                                            </td>
                                            <td><a href="/user/invoice/{{ $invoice->id }}" class="btn btn-primary"><i
                                                        class="fa fa-cloud-download" aria-hidden="true"></i></a></td>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            /*PLANS TAB SCRIPT BEGIN*/
            let allTabs = document.querySelectorAll(".tabs");
            allTabs.forEach((tabs) => {
                tabs.addEventListener("click", function(e) {
                    currTabParent = this.className.split(" ").join(".");
                    currTabParentData = e.target.dataset.attr;
                    let currTabWidth = e.target.offsetWidth;
                    let currTabLeftVal = e.target.offsetLeft;
                    document.querySelector("." + currTabParent + " .active_box").style.width =
                        currTabWidth + "px";
                    document.querySelector("." + currTabParent + " .active_box").style.left =
                        currTabLeftVal + "px";
                    var tabs = document.querySelectorAll("." + currTabParent + " .tab");
                    tabs.forEach((tab) => {
                        tab.classList.remove("active");
                    });
                    e.target.classList.add("active");
                    let currTabContent = this.className.split(" ").slice(1).join(".");
                    let dSet = e.target.dataset.attr;
                    var tabsContentHide = document.querySelectorAll(
                        ".tabs_content" + "." + currTabContent + "> div"
                    );
                    tabsContentHide.forEach((tabContentHide) => {
                        tabContentHide.classList.remove("active");
                    });
                    var tabsContent = document.querySelectorAll(
                        ".tabs_content" + "." + currTabContent + " [attr=" + dSet + "]"
                    );
                    tabsContent.forEach((tabContent) => {
                        tabContent.classList.add("active");
                    });
                });
            });
            document.querySelectorAll(".tabs .tab:nth-child(2)").forEach((element) => {
                element.click();
            });
            /*PLANS TAB SCRIPT END*/
        });
    </script>
    @if (session()->has('message') || session()->has('error'))
        <script>
            $('.toast').toast('show');
        </script>
    @endif
@endsection
