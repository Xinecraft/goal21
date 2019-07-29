<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1"/>
    <meta name="author" content="SmartTemplates"/>
    <meta name="description" content="landing page template for saas companies"/>
    <meta name="propeller" content="14d892fceaa8932109c1df2b6d912b30">
    <meta name="keywords"
          content="landing page template, saas landing page template, saas website template, one page saas template"/>
    <title>Goal-21|Multi Level Marketing Platform</title>
    <link rel="stylesheet" href="css/swiper.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900" rel="stylesheet">

    <script class="/js/Propellarnotificationads.js"></script>
</head>
<body>
<header class="header">
    <div class="header__content header__content--fluid-width">
        <div class="header__logo-title"><img src="/images/logo.png" alt="logo"></div>
        <nav class="header__menu">
            <ul>
                <li><a class="selected header-link" href="{{ url('/') }}">HOME</a></li>
                <li><a class="header-link" href="{{ route('aboutus') }}">ABOUT</a></li>
                <li><a class="header-link" href="{{ route('terms') }}">TERMS</a></li>
                <li><a class="header-link" href="{{ route('faq') }}">FAQ</a></li>
                <li><a href="#features" class="header-link">FEATURES</a>
                <li>
                <li class="header__btn header__btn--login"><a href="{{ route('login') }}">LOGIN</a></li>
                <li class="header__btn header__btn--signup"><a href="{{ route('register') }}">REGISTER</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- Section -- intro -->
<section class="section section--intro" id="intro">
    <div class="section__content section__content--fluid-width section__content--intro">
        <div class="intro">
            <div class="intro__content">
                <div class="intro__title">Start <span>Earning</span> high profit with Goal 21</div>
                <div class="intro__subtitle">We believe we have created a world class platform for earning.</div>
                <div class="intro__description">More Than 100000 people network with huge profits which will help you to
                    fulfill your dreams.
                </div>
                <div class="intro__buttons intro__buttons--left">
                    <a href="https://goal-21.com/register" class="btn btn--blue-bg btn--play modal-toggle">Join US</a>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-animation">
        @include('partials._globesvg')
    </div>
    <svg class="svg-intro-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M95,0 Q90,90 0,100 L100,100 100,0 Z" fill="#ffffff"/>
    </svg>
</section>

<!-- Section -- features -->
<section class="section section--features" id="features">

    <div class="section__content section__content--fluid-width section__content--features">
        <h2 class="section__title section__title--centered">A Business Made for You </h2>
        <div class="section__description section__description--centered">
            <b>We believe everyone should get chance to be rich and fulfill their dreams,Here is your chance.</b>
        </div>
        <div class="grid grid--3col grid--features">

            <div class="grid__item">
                <div class="grid__icon"><img src="images/icons/icons-64-green/responsive-64.png" alt="" title=""/></div>
                <h3 class="grid__title"><span>Easy</span> Work </h3>
                <p class="grid__text"><b>We have made the website look good on all devices (desktops, tablets, and
                        phones), so that you can work with an ease.</b></p>
            </div>

            <div class="grid__item">
                <div class="grid__icon"><img src="images/icons/icons-64-green/desktop-chart-64.png" alt="" title=""/>
                </div>
                <h3 class="grid__title">Fast <span>Growth</span></h3>
                <p class="grid__text"><b>We have learnt how to provide the best service for our customers so that they
                        can grow in huge quantity with lower struggle.</b></p>
            </div>

            <div class="grid__item">
                <div class="grid__icon"><img src="images/icons/icons-64-green/browser-64.png" alt="" title=""/></div>
                <h3 class="grid__title">Smart <span>Multi</span> Task</h3>
                <p class="grid__text"><b>We have seperated the tasks so it will be easier for you to complete it.</b>
                </p>
            </div>

        </div>
    </div>


</section>

<!-- Section -- about -->
<section class="section" id="about">

    <div class="section__content section__content--fluid-width section__content--about">
        <div class="grid grid--5col grid--about">

            <div class="grid__item grid__item--x2">
                <h3 class="grid__title">Getting Started <span>with us is super easy. Just follow this steps.</span></h3>
                <p class="grid__text"><b>Simplicity and higher returns is what we are known for, A simple design
                        dashboard with all features.</b></p>
                <ul class="grid__list">
                    <li><b>Sign up with us.</li>
                    <li>Submit your Details</li>
                    <li>Add users under you</li>
                    <li>Start Earning and Start fulfilling your Dreams.</b></li>
                </ul>

            </div>
            <div class="grid__item grid__item--x3">
                <div class="grid__image grid__image--right" data-paroller-factor="0.2" data-paroller-type="foreground"
                     data-paroller-direction="vertical"><img src="images/desktop-frame-about.png" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Section -- about -->
<section class="section">

    <div class="section__content section__content--fluid-width section__content--about">
        <div class="grid grid--5col grid--about">


            <div class="grid__item grid__item--x2 grid__item--floated-right">
                <h3 class="grid__title">Unlimited Earning <span> With Zero investment.</span></h3>
                <p class="grid__text"><b>No need to Investment any money to start work with this plan. just need to open
                        account and start work to earn money. Goal-21 is the one where no any investment needed to start
                        work.</b></p>
                <ul class="grid__list">
                    <li><b>Zero Investment</b></li>
                    <li><b>Faster Payouts</b></li>
                    <li><b>Higher Profit.</b></li>
                    <li><b>Work friendly dashboard</b></li>
                </ul>

            </div>
            <div class="grid__item grid__item--x3">
                <div class="grid__image grid__image--left" data-paroller-factor="0.2" data-paroller-type="foreground"
                     data-paroller-direction="vertical"><img src="images/desktop-frame-about-2.png" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Section -- about -->
<section class="section" id="about2">

    <div class="section__content section__content--fluid-width section__content--about">
        <div class="grid grid--5col grid--about">

            <div class="grid__item grid__item--x2">
                <h3 class="grid__title">Something is<span> Bothering You?</span>.</h3>
                <p class="grid__text"><b>Our Matrix and Autofill Plans are just way ahead then any provider in market,
                        Simple, High returns, Instant payouts just make your work more easier.</b></p>
                <ul class="grid__list">
                    <li><b>Higher Returns.</li>
                    <li>Not like other providers, Slow dashboard.We have made it in such a way that it responses in 1
                        click.
                    </li>
                    <li>Sign of Trust by 100000 peoples working from home and earning huge.</li>
                </ul>

            </div>
            <div class="grid__item grid__item--x3">
                <div class="grid__image grid__image--right" data-paroller-factor="0.2" data-paroller-type="foreground"
                     data-paroller-direction="vertical"><img src="images/desktop-frame-about-3.png" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>

</section>


<!-- Section -- pricing -->
<section class="section" id="pricing">

    <div class="section__content section__content--fluid-width section__content--padding">
        <h2 class="section__title section__title--centered">Our Plans</h2>
        <div class="section__description section__description--centered">
            We believe we have created the most efficient Work from home business that will give the highest benefits
            with a seal of trust.
        </div>


        <div class="pricing">
            <div class="pricing__switcher switcher">
                <div class="switcher__buttons">
                    <div class="switcher__button switcher__button--enabled">MATRIX</div>
                    <div class="switcher__button">AUTOFILL</div>
                    <div class="switcher__border"></div>
                </div>

            </div>


            <div class="pricing__plan">
                <h3 class="pricing__title">Number of Ads Completed.</h3>
                <div class="pricing__values">
                    <div class="pricing__value pricing__value--show"><span></span>12006 <b></b></div>
                    <div class="pricing__value pricing__value--hide pricing__value--hidden"><span></span>12006 <b></b>
                    </div>
                </div>

                <a class="pricing__signup" href="https://goal-21.com/register">Start Working</a>
            </div>
            <div class="pricing__plan pricing__plan--popular">
                <div class="pricing__badge-bg"></div>
                <div class="pricing__badge-text">Still Growing</div>
                <h3 class="pricing__title">Number of Users.</h3>
                <div class="pricing__values">
                    <div class="pricing__value pricing__value--show"><span></span>7522 <b></b></div>
                    <div class="pricing__value pricing__value--hide pricing__value--hidden"><span></span>7922 <b></b>
                    </div>
                </div>
                <a class="pricing__signup" href="https://goal-21.com/register">Join the team.</a>
            </div>
            <div class="pricing__plan">
                <h3 class="pricing__title">Total Withdraw Amount</h3>
                <div class="pricing__values">
                    <div class="pricing__value pricing__value--show"><span></span>56500 <b></b></div>
                    <div class="pricing__value pricing__value--hide pricing__value--hidden"><span></span>56500 <b></b>
                    </div>
                </div>
                <a class="pricing__signup" href="https://goal-21.com/register">Get your earning today.</a>
            </div>
        </div>

        <div class="clear"></div>
    </div>

</section>

<!-- Section -- testimonials -->
<section class="section section--testimonials" id="testimonials">

    <div class="section__content section__content--fluid-width section__content--padding">
        <h2 class="section__title section__title--centered">Success stories</h2>
        <div class="testimonials">
            <div class="testimonials__content swiper-wrapper">
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-1.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Lason Duvan <a href="#">New York Business Center</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>"Business is all about the customer:
                            what the customer wants and what they get. "</p></div>

                </div>
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-2.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Jada Sacks <a href="#">Paris Tehnics</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>" I've internalized it to the point
                            of understanding that the success of my actions and/or endeavors"</p></div>

                </div>
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-3.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Lason Duvan <a href="#">Music Software</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>"The American Dream is that any man
                            or woman, despite of his or her background, can change their circumstances"</p></div>

                </div>
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-4.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Duran Jackson <a href="#">New York Business Center</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>"Generally, every customer wants a
                            product or service that solves their problem, worth their money"</p></div>

                </div>
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-5.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Maria Allesi <a href="#">Italy Solutions</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>"No one can make you successful; the
                            will to success comes from within.' I've made this my motto."</p></div>

                </div>
                <div class="testimonials__slide swiper-slide">
                    <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-6.jpg" alt=""
                                                                                      title=""/></div>
                    <div class="testimonials__source">Jenifer Patrison<a href="#">App Dating</a></div>
                    <div class="testimonials__text" data-swiper-parallax="-100%"><p>"Can change their circumstances and
                            rise as high as they are willing to work"</p></div>

                </div>
            </div>

            <div class="testimonials__pagination swiper-pagination"></div>
            <div class="testimonials__button--next swiper-button-next"></div>
            <div class="testimonials__button--prev swiper-button-prev"></div>
        </div>
        <div class="clear"></div>
    </div>

</section>


<!-- Section -->
<section class="section" id="support">
    <div class="section__content section__content--fluid-width section__content--padding">
        <div class="grid grid--2col grid--support">
            <div class="grid__item grid__item--padding">

                <h3 class="grid__title">Help &amp; Support</h3>
                <p class="grid__text">Your issue is our main priority. Our 24/7 support team is here to help you. Just
                    Give us a call or Whatsapp and we will get back to you as soon as possible.</p>
            </div>
            <div class="grid__item grid__item--padding grid__item--centering">
                <a class="grid__more">91XXXXXXXX</a>
            </div>
            <svg class="svg-support-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                 preserveAspectRatio="none">
                <path d="M0,90 Q0,100 3,100 L95,96 Q100,96 99,80 L95,25 Q94,15 90,15 L6,0 Q2,0 2,10 Z" fill="#ffba00"/>
            </svg>
        </div>
        <div class="clear"></div>
    </div>

</section>


<!-- Section -->
<!----<section class="section section--clients" id="clients">
        <div class="section__content section__content--fluid-width">
            <div class="grid grid--5col">

                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo1.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo2.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo3.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo4.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo5.png" alt="" title=""/></a></div>
                </div>
            </div>

        </div>
        <svg class="svg-cta-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#27ada6"/>
        </svg>
</section>
--->

<!-- Section -->
<section class="section section--cta" id="cta">
    <div class="section__content section__content--fluid-width section__content--padding section__content--cta">
        <h2 class="section__title section__title--centered section__title--cta">Get Started Now!</h2>
        <div class="section__description section__description--centered section__description--cta">
            Just Join us without having a second thought, And Start earning.
        </div>
        <div class="intro__buttons intro__buttons--centered">
            <a href="https://goal-21.com/register" class="btn btn--orange-bg">CREATE AN ACCOUNT</a>
        </div>
    </div>
    <svg class="svg-cta-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0,70 C30,130 70,50 100,70 L100,100 0,100 Z" fill="#ffffff"/>
    </svg>
</section>


<footer class="footer" id="footer">
    <div class="footer__content footer__content--fluid-width footer__content--svg">

        <div class="grid grid--5col">

            <div class="grid__item grid__item--x2">
                <h3 class="grid__title grid__title--footer-logo">Goal-21</h3>
                <p class="grid__text grid__text--copyright">Copyright &copy; 2019 Goal-21 <br/>All Rights Reserved.
                    Proudly made in India by Aystor </p>
                <ul class="grid__list grid__list--sicons">
                    <li><a href="#"><img src="images/social/black/twitter.png" alt="" title=""/></a></li>
                    <li><a href="#"><img src="images/social/black/facebook.png" alt="" title=""/></a></li>
                    <li><a href="#"><img src="images/social/black/linkedin.png" alt="" title=""/></a></li>
                </ul>
            </div>
            <div class="grid__item">
                <h3 class="grid__title grid__title--footer">Company</h3>
                <ul class="grid__list grid__list--fmenu">
                    <li><a href="#">About</a></li>
                    <li><a href="{{ route('terms') }}">Terms & Condition</a></li>
                    <li><a href="{{ route('faq') }}">FaQ</a></li>
                </ul>
            </div>
            <div class="grid__item">
                <h3 class="grid__title grid__title--footer">Products</h3>
                <ul class="grid__list grid__list--fmenu">

                    <li><a href="#">AUTOFILL</a></li>
                    <li><a href="#">MATRIX</a></li>
                </ul>
            </div>
            <div class="grid__item">
                <h3 class="grid__title grid__title--footer">Support</h3>
                <ul class="grid__list grid__list--fmenu">
                    <li><a href="mailto:support@goal-21.com">Contact</a></li>

                </ul>
            </div>

        </div>


    </div>


</footer>

@include('partials._adsinclude')
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.paroller.min.js"></script>
<script src="js/jquery.custom.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/swiper.custom.js"></script>
<script src="js/menu.js"></script>
</body>
</html>