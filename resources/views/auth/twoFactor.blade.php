@extends('layouts.app', ['title' => 'Verification Code', 'bodyClass' => 'signup-scr'])
@section('styles')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
@endsection
@section('content')
    <!-- SIGNUP SECTION BEGIN -->
    <section class="signup-pg-sec forgot-password-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 left-column">
                    <div class="form-sec">

                        <p class="alert alert-info d-none">
                            The verification code has been sent again
                        </p>

                        @if ($errors->has('two_factor_code'))
                            <p class="alert alert-danger">
                                {{ $errors->first('two_factor_code') }}
                            </p>
                        @endif
                        <form method="POST" action="{{ route('twoFactor.check') }}">
                            @csrf
                            <h4>Verification Code</h4>
                            <p class="verified-text">We have sent the verification code to the email <a
                                    href="mailto:example@gmail.com"
                                    class="verified-email">{{ request()->user()->email }}</a>
                            </p>
                            <div class="verification-code-box">
                                <fieldset class='number-code'>
                                    <div>
                                        <input type="number" name="two_factor_code[1]" placeholder="0" class='code-input'
                                            required />
                                        <input type="number" name="two_factor_code[2]" placeholder="0" class='code-input'
                                            required />
                                        <input type="number" name="two_factor_code[3]" placeholder="0" class='code-input'
                                            required />
                                        <input type="number" name="two_factor_code[4]" placeholder="0" class='code-input'
                                            required />
                                    </div>
                                </fieldset>

                            </div>
                            <div class="journey-btn">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>

                            <div class="resend-text">
                                <p>didn't receive the code? <a id="resend-button" href="{{ route('twoFactor.resend') }}"
                                        style="pointer-events: pointer; cusor: pointer; color: black;">Resend code</a></p>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 right-column">
                    <div class="pg-logo">
                        <a href="{{ URL::to('/') }}"><img src="images/logo.png"></a>
                    </div>
                    <div class="signup-img">
                        <img src="images/signup-img.png" alt="image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SIGNUP SECTION END -->
@endsection

@section('scripts')
    <script>
        /*VERFICATION CODE SCRIPT BEGIN*/
        const inputElements = [...document.querySelectorAll('input.code-input')]
        inputElements.forEach((ele, index) => {
            ele.addEventListener('keydown', (e) => {
                if (e.keyCode === 8 && e.target.value === '') inputElements[Math.max(0, index - 1)].focus()
            })
            ele.addEventListener('input', (e) => {
                const [first, ...rest] = e.target.value
                e.target.value = first ?? ''
                const lastInputBox = index === inputElements.length - 1
                const didInsertContent = first !== undefined
                if (didInsertContent && !lastInputBox) {
                    inputElements[index + 1].focus()
                    inputElements[index + 1].value = rest.join('')
                    inputElements[index + 1].dispatchEvent(new Event('input'))
                }
            })
        })
        /*VERFICATION CODE SCRIPT END*/
    </script>



    <script>
        const resendBtn = document.getElementById('resend-button');
        const message = document.querySelector('.alert-info');
        let seconds = 60;
        // Add a click event listener to the resend button
        resendBtn.addEventListener('click', (event) => {
            // Prevent the default behavior of clicking on a link
            event.preventDefault();



            const interval = setInterval(() => {
                if (seconds) {
                    resendBtn.style['pointer-events'] = 'none';
                    resendBtn.style['cursor'] = 'default';
                    resendBtn.style['color'] = 'gray';
                    // Display the seconds next to the send button
                    resendBtn.innerText = `Resend after ${seconds}s`;
                    // Substract the second by 1
                    --seconds;
                } else {
                    resendBtn.innerText = `Resend`;

                    // Enable default styling for anchor tag
                    resendBtn.style['pointer-events'] = 'auto';
                    resendBtn.style['cursor'] = 'pointer';
                    resendBtn.style['color'] = 'black';
                    message.classList.add('d-none');
                    message.classList.remove('flex');
                    clearInterval(interval);
                }
            }, 1000);

            // Send an AJAX request to the resend code URL
            const xhr = new XMLHttpRequest();
            xhr.open('GET', resendBtn.href);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send();
            message.classList.remove('d-none');
            message.classList.add('flex');
        });
    </script>
@endsection
