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
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a>
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
                        <h6>Terms and Conditions</h6>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="aboutus-content">
                        <p>
                            Please read these Terms and Conditions carefully before using efanfare.com. These Terms and
                            Conditions govern your access to and use of the website. By accessing or using efanfare.com, you
                            agree to be bound by these Terms and Conditions. If you do not agree with any part of these
                            Terms and Conditions, you should not access or use the website.
                        </p>

                        <h2>Use of the Website</h2>
                        <h3 style="font-size: 1.75rem">1.1 Eligibility</h3>
                        <p>
                            You must be at least 18 years old to use efanfare.com. By accessing or using the website, you
                            represent and warrant that you are of legal age to form a binding contract.
                        </p>

                        <h3 style="font-size: 1.75rem">1.2 Compliance</h3>
                        <p>
                            You agree to comply with all applicable laws, regulations, and these Terms and Conditions when
                            using efanfare.com. You are solely responsible for your use of the website and any content you
                            submit or access through it.
                        </p>

                        <h3 style="font-size: 1.75rem">1.3 Account Information</h3>
                        <p>
                            If you create an account on efanfare.com, you are responsible for maintaining the
                            confidentiality of your account information, including your username and password. You agree to
                            provide accurate and complete information when creating your account and to update it promptly
                            if there are any changes.
                        </p>

                        <h3 style="font-size: 1.75rem">1.4 Prohibited Activities</h3>
                        <p>
                            You agree not to engage in any of the following activities when using efanfare.com:
                        <ul>
                            <li>Violating any applicable laws or regulations.</li>
                            <li>Infringing upon the intellectual property rights of others.</li>
                            <li>Posting, transmitting, or distributing any content that is unlawful, harmful, defamatory,
                                obscene, or otherwise objectionable.</li>
                            <li>Interfering with or disrupting the functionality of efanfare.com or its servers.</li>
                            <li>Attempting to gain unauthorized access to any portion or feature of the website or any other
                                systems or networks connected to efanfare.com.</li>
                            <li>Engaging in any fraudulent, deceptive, or misleading activities.</li>
                        </ul>
                        </p>

                        <h2>Intellectual Property</h2>
                        <h3 style="font-size: 1.75rem">2.1 Ownership</h3>
                        <p>
                            All content, trademarks, logos, and other intellectual property rights displayed on efanfare.com
                            are the property of efanfare.com or their respective owners. You acknowledge and agree that you
                            do not acquire any ownership rights by using the website.
                        </p>

                        <h3 style="font-size: 1.75rem">2.2 Use of Content</h3>
                        <p>
                            You may access and use the content on efanfare.com for personal, non-commercial purposes only.
                            You may not modify, reproduce, distribute, transmit, display, perform, publish, license, create
                            derivative works from, or sell any content from efanfare.com without prior written consent from
                            efanfare.com or the respective intellectual property owner.
                        </p>

                        <h2>Product Information and Orders</h2>
                        <h3 style="font-size: 1.75rem">3.1 Product Availability</h3>
                        <p>
                            The availability and descriptions of products displayed on efanfare.com are subject to change
                            without notice. We make reasonable efforts to ensure that the information provided on the
                            website is accurate, but we do not guarantee the accuracy, completeness, or reliability of any
                            product information.
                        </p>

                        <h3 style="font-size: 1.75rem">3.2 Order Acceptance</h3>
                        <p>
                            Placing an order on efanfare.com does not constitute acceptance of your order. We reserve the
                            right to accept or reject any order for any reason at our sole discretion. If we reject your
                            order, we will notify you and provide a refund if applicable.
                        </p>

                        <h3 style="font-size: 1.75rem">3.3 Pricing</h3>
                        <p>
                            The prices of products on efanfare.com are subject to change without notice. We make efforts to
                            ensure that the prices are accurate, but errors may occur. If we discover an error in the price
                            of a product you have ordered, we will notify you and give you the option to proceed with the
                            order at the corrected price or cancel the order.
                        </p>

                        <h2>Limitation of Liability</h2>
                        <h3 style="font-size: 1.75rem">4.1 Disclaimer</h3>
                        <p>
                            EFANFARE.COM IS PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS. TO THE FULLEST EXTENT PERMITTED
                            BY APPLICABLE LAW, EFANFARE.COM DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT
                            LIMITED TO MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. EFANFARE.COM
                            DOES NOT WARRANT THAT THE WEBSITE WILL BE UNINTERRUPTED, ERROR-FREE, OR FREE FROM VIRUSES OR
                            OTHER HARMFUL COMPONENTS.
                        </p>

                        <h3 style="font-size: 1.75rem">4.2 Limitation of Liability</h3>
                        <p>
                            TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, EFANFARE.COM SHALL NOT BE LIABLE FOR ANY
                            INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR EXEMPLARY DAMAGES ARISING OUT OF OR IN
                            CONNECTION WITH YOUR USE OF EFANFARE.COM. THIS INCLUDES, BUT IS NOT LIMITED TO, DAMAGES FOR LOSS
                            OF PROFITS, GOODWILL, USE, DATA, OR OTHER INTANGIBLE LOSSES, EVEN IF EFANFARE.COM HAS BEEN
                            ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
                        </p>

                        <h2>Indemnification</h2>
                        <p>
                            You agree to indemnify, defend, and hold harmless efanfare.com and its affiliates, officers,
                            directors, employees, and agents from any claims, liabilities, damages, losses, costs, or
                            expenses arising out of or in connection with your use of efanfare.com, your violation of these
                            Terms and Conditions, or your violation of any rights of another party.
                        </p>

                        <h2>Amendments</h2>
                        <p>
                            Efanfare.com reserves the right to modify, update, or revise these Terms and Conditions at any
                            time, with or without notice. By continuing to access or use efanfare.com after any changes to
                            these Terms and Conditions, you agree to be bound by the updated terms.
                        </p>

                        <h2>Governing Law and Jurisdiction</h2>
                        <p>
                            These Terms and Conditions shall be governed by and construed in accordance with the laws of
                            [insert applicable jurisdiction]. Any dispute arising out of or in connection with these Terms
                            and Conditions shall be subject to the exclusive jurisdiction of the courts of [insert
                            applicable jurisdiction].
                        </p>

                        <h2>Contact Us</h2>
                        <p>
                            If you have any questions, concerns, or requests regarding these Terms and Conditions, please
                            contact us at <a href="mailto:efanfare.com@gmail.com">efanfare.com@gmail.com</a>
                        </p>

                        <p>
                            Please note that these Terms and Conditions apply solely to efanfare.com and do not cover any
                            third-party websites or services linked to or mentioned on our website. We encourage you to
                            review the terms and conditions of those third parties before using their services.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
