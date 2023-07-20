@extends('layouts.app', ['title' => 'Privacy Policy', 'bodyClass' => ''])
@section('content')
    <!-- HEADER SECTION BEGIN -->
    <header class="header" id="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="header-inner">
                        <nav class="navbar container">
                            <div class="burger" id="burger">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </div>
                            <div class="menu" id="menu">
                                <ul class="menu-inner">
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Holidays</a></li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Occasions</a></li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Family Events</a>
                                    </li>
                                    <li class="menu-item"><a href="javascript:void(0)" class="menu-link">Sports Teams</a>
                                    </li>
                                    <li>
                                        <div class="ftb-subscribe-btn hide-btn-desktop">

                                            @if (Auth::check())
                                                <a href="{{ route('user.dashboard') }}"
                                                    class="btn btn-primary">Dashboard</a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ URL::to('/') }}" class="brand"><img src="{{ asset('images/logo.png') }}"
                                    alt="image" class="img-fluid"></a>
                            <div class="ftb-subscribe-btn hide-btn-mobile">
                                @if (Auth::check())
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section class="aboutus-sec-bg">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="aboutus-content">
                        <h6>Privacy Policy</h6>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="aboutus-content">
                        <p>
                            At efanfare.com, we value your privacy and are committed to protecting your personal
                            information. This Privacy Policy outlines the types of information we collect from users of our
                            website and how we use, share, and protect that information. By accessing or using efanfare.com,
                            you consent to the terms of this Privacy Policy.
                        </p>

                        <h2>Information We Collect</h2>
                        <h3 style="font-size: 1.75rem">1. Personal Information</h3>
                        <p>
                            We may collect personal information that you provide to us voluntarily when you register an
                            account, make a purchase, subscribe to our newsletter, or interact with our website. This may
                            include your name, email address, billing and shipping address, telephone number, and payment
                            information.
                        </p>

                        <h3 style="font-size: 1.75rem">1.2 Automatically Collected Information</h3>
                        <p>
                            When you visit efanfare.com, certain information is collected automatically. This may include
                            your IP address, browser type, device information, operating system, and usage data. We may also
                            use cookies, web beacons, and similar technologies to collect information about your
                            interactions with our website.
                        </p>

                        <h2>Use of Information</h2>
                        <h3 style="font-size: 1.75rem">2.1 Provide Services</h3>
                        <p>
                            We use the information we collect to provide you with the products, services, and features
                            available on efanfare.com. This includes processing orders, delivering products, responding to
                            inquiries, and personalizing your experience on our website.
                        </p>

                        <h3 style="font-size: 1.75rem">2.2 Communication</h3>
                        <p>
                            We may use your personal information to communicate with you, such as sending order
                            confirmations, updates, and customer service messages. We may also send you promotional emails
                            or newsletters if you have subscribed to them. You have the option to opt-out of receiving such
                            communications at any time.
                        </p>

                        <h3 style="font-size: 1.75rem">2.3 Analytics and Improvements</h3>
                        <p>
                            We use the information collected to analyze user behavior, improve our website, and enhance the
                            overall user experience. This includes monitoring website usage, identifying trends, and
                            optimizing our services.
                        </p>

                        <h3 style="font-size: 1.75rem">2.4 Legal Compliance</h3>
                        <p>
                            We may use or disclose your personal information as required by applicable laws, regulations, or
                            legal processes.
                        </p>

                        <h2>Sharing of Information</h2>
                        <h3 style="font-size: 1.75rem">3.1 Third-Party Service Providers</h3>
                        <p>
                            We may share your personal information with trusted third-party service providers who assist us
                            in operating our website, processing payments, delivering products, or conducting business
                            operations. These service providers are obligated to protect your information and are only
                            authorized to use it for the specified purposes.
                        </p>

                        <h3 style="font-size: 1.75rem">3.2 Legal Requirements</h3>
                        <p>
                            We may disclose your personal information if we believe it is necessary to comply with a legal
                            obligation, protect our rights, investigate fraud or illegal activities, or enforce our terms
                            and conditions.
                        </p>

                        <h3 style="font-size: 1.75rem">3.3 Business Transfers</h3>
                        <p>
                            In the event of a merger, acquisition, or sale of all or a portion of our assets, your personal
                            information may be transferred as part of the transaction. We will notify you of any such change
                            in ownership or control of your personal information.
                        </p>

                        <h2>Data Security</h2>
                        <p>
                            We implement appropriate security measures to protect the confidentiality, integrity, and
                            availability of your personal information. However, please note that no method of transmission
                            or storage over the Internet is 100% secure, and we cannot guarantee the absolute security of
                            your information.
                        </p>

                        <h2>Your Choices</h2>
                        <h3 style="font-size: 1.75rem">5.1 Access and Correction</h3>
                        <p>
                            You have the right to access, update, or correct your personal information. You can do this by
                            logging into your account or by contacting us directly.
                        </p>

                        <h3 style="font-size: 1.75rem">5.2 Cookies</h3>
                        <p>
                            Most web browsers are set to accept cookies by default. You can modify your browser settings to
                            reject cookies or alert you when cookies are being used. However, please note that some features
                            of efanfare.com may not function properly if cookies are disabled.
                        </p>

                        <h3 style="font-size: 1.75rem">5.3 Marketing Communications</h3>
                        <p>
                            If you no longer wish to receive promotional emails or newsletters from us, you can unsubscribe
                            by following the instructions provided in the communication or by contacting us.
                        </p>

                        <h2>Children's Privacy</h2>
                        <p>
                            Efanfare.com is not intended for use by individuals under the age of 18. We do not knowingly
                            collect personal information from children. If you are a parent or guardian and believe that
                            your child has provided us with their personal information, please contact us, and we will take
                            steps to delete the information.
                        </p>

                        <h2>Changes to this Privacy Policy</h2>
                        <p>
                            We may update this Privacy Policy from time to time to reflect changes in our practices or legal
                            requirements. We will post the updated Privacy Policy on efanfare.com and indicate the effective
                            date of the revision.
                        </p>

                        <h2>Contact Us</h2>
                        <p>
                            If you have any questions, concerns, or requests regarding this Privacy Policy or the handling
                            of your personal information, please contact us at <a
                                href="mailto:efanfare.com@gmail.com">efanfare.com@gmail.com</a>.
                        </p>

                        <p>
                            Please note that this Privacy Policy applies solely to efanfare.com and does not cover any
                            third-party websites or services linked to or mentioned on our website. We encourage you to
                            review the privacy policies of those third parties before providing them with your personal
                            information.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
    @parent
@endsection
