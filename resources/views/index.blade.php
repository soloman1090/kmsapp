@extends('templates.public')

 
@section('content')


<div class= margin_60_35">
   <div class="Home">
        <div class="Banner1">
            <div class="text">
                <p><b>A PREMIER GLOBAL ALTERNATIVE ASSET MANAGER</b></p>
                <h1>Pioneers of long-term impact</h1>
                <p>Our disciplined investment approach creates value and delivers strong risk-adjusted <br> returns for our investors across market cycles.</p>
                <a href="about"><button><p>Brookfield Overview </p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg></button>
                </a>
            </div>
        </div>
        <div class="section1 ">
            <div class="container">
                <center>
                    <p class="big">We are invested in long-life, high-quality assets and businesses <br> around the world that form the backbone of the global economy.</p>
                </center>
                <div class="margin40">
                    <div class="row">
                        <div class="col-md-3  ">
                            <div class="margin20 rightline padding10">
                            <center>
                                <h2>$19+ billion</h2>
                                <p>AUM</p>
                            </center>
                            </div>
                        </div>
                        <div class="col-md-3  ">
                            <div class="margin20 rightline padding10">
                            <center>
                                <h2>~4,000</h2>
                                <p>operating employees</p>
                            </center>
                            </div>
                        </div>
                        <div class="col-md-3  ">
                            <div class="margin20 rightline padding10">
                            <center>
                                <h2>30+ countries</h2>
                                <p>across five continents</p>
                            </center>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="margin20 padding10">
                            <center>
                                <h2>13+ years</h2>
                                <p>as owner-operators</p>
                            </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section2 ">
            <div class="">
                <center>
                    <div class="col-md-12">
                        <video   autoplay="true" muted width="100%" height="500" controls>
                        <source src="{{ asset('assets/img/WeAre.mp4') }}" type=video/ogg>
                        <source src="{{ asset('assets/img/WeAre.mp4') }}" type=video/mp4>
                        </video>
                    </div>
                </center>
            </div>
        </div>
        <div class="section3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 pl10">
                        <div class="line1">
                            <div class="row margin50">
                                <div class="col-md-5">
                                    <img src="{{ asset('assets/img/screen1.png') }}" alt="" width="80%">
                                </div>
                                <div class="col-md-7">
                                    <h2>Fundamental <br> research focused <br> on value</h2>
                                </div>
                            </div>
                            <p class="ml100 bal">Our fundamental portfolio managers and analysts belong to research clusters organized by global sectors. This format brings a cross-trained group of sector specialists together to critique and debate each investment idea for Causeway’s developed markets strategies, looking to buy or sell at the right price and the right time. Their expertise is complemented by quantitative risk modeling.</p>
                        </div>
                    </div>
                    <div class="col-md-6 pr10">
                        <div class="line2">
                        <div class="row margin40">
                                <div class="col-md-7">
                                    <h2>Quantitative research focused on multi-factor alpha and risk management</h2>
                                </div>
                                <div class="col-md-5">
                                    <img src="{{ asset('assets/img/screen1.png') }}" alt="" width="80%">
                                </div>
                            </div>
                            <p class="ml100">Our quantitative portfolio managers and analysts manage Causeway’s emerging markets and international small cap strategies, and a portion of our international and global opportunities strategies, and provide screening and risk management tools to the fundamental investment process for our other strategies. In-depth knowledge from fundamental research enriches the empirical quantitative analysis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section4 margin60">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 margin20">
                        <div class="all1">
                            <div class="text">
                                <h1>Real Estate</h1>
                                <p>We partner with governments and businesses to meet their decarbonization goals.</p>
                                <a href="real-estate"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 margin20">
                        <div class="all2">
                            <div class="text">
                                <h1>Infrastructure</h1>
                                <p>We invest in critical infrastructure that delivers essential goods and services.</p>
                                <a href="infrastructure"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 margin20">
                        <div class="all3">
                            <div class="text">
                                <h1>Insurance Solutions</h1>
                                <p>We acquire high-quality businesses and make them even better.</p>
                                <a href="insurance-solutions"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 margin20">
                        <div class="all4">
                            <div class="text">
                                <h1>Credit</h1>
                                <p>We own, operate and develop iconic properties in the world's most dynamic markets.</p>
                                <a href="credit"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 margin20">
                        <div class="all5">
                            <div class="text">
                                <h1>Multi Asset Solution</h1>
                                <p>Together, Brookfield and Oaktree offer one of the most comprehensive credit platforms globally. </p>
                                <a href="multi-asset-solution"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 margin20">
                        <div class="all6">
                            <div class="text">
                                <h1>Insurance Solutions</h1>
                                <p>We provide creative capital and investment solutions to insurance companies and their stakeholders.</p>
                                <div class="margin30"></div>
                                {{-- <a href="#"><button><p>Learn More</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section5 margin50">
            <div class="container">
                <p><b>ABOUT US</b></p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Everything we do, and every investment we make, is grounded in our heritage as an owner and operator of high-quality assets and businesses around the world. As stewards of the capital that our shareholders and clients entrust to us, we invest alongside them for the long-term.</p>
                        <p>We are value-oriented investors focused on cash-flow businesses with high barriers to entry. Our decades of experience have taught us that the best opportunities are often found in regions or sectors undergoing periods of financial or operational challenge. And our access to large-scale, flexible capital—along with a truly global footprint—means we are able to transact where many others cannot. </p>
                    </div>
                    <div class="col-md-6">
                        <div class="set">
                            <a href="unique-process"><button class="lline"><p>Our Approach</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                            </a>
                        </div>
                        <div class="set">
                            <a href="esg"><button  class="lline"><p>Global Presence</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                            </a>
                        </div>
                        <div class="set">
                            <a href="about"><button><p>Responsibility</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section6">
           <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class=" margin30 ttext mr50 padding20">
                        <div class="linegreen "></div>
                        <h1>Our Impact</h1>
                        <p class="">We are committed to acting in the long-term interests of all our stakeholders. This mission drives us to invest responsibly, operate our business with integrity, and build a diverse and inclusive workplace where our employees can thrive.</p>
                        <p>Our <span> 2022 Impact Report</span> outlines how we are dedicated to serving as an example of investing with client objectives front of mind while creating positive impact for all stakeholders.</p>
                        <a href="responsible-investing"><button>LEARN MORE</button></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="line4"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="line3"></div>
                </div>
                <div class="col-md-6">
                    <div class="ml100 margin30 ttext padding20">
                        <div class="linegreen "></div>
                        <h1>Commitment to <br> Diversity, Equity, & <br> Inclusion</h1>
                        <p class="margin40">Our culture is a driving factor of our success and is critical to our  ability to create and deliver value to our clients.</p>
                        <a href="diversity-and-inclusion"><button>LEARN MORE</button></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <div class="padding20">
                    <div class="margin30"></div>
                        <div class="linegreen ml50"></div>
                        <h1 class="ml50">Latest News</h1>
                    <!-- Flickity HTML init -->
                    <div class="carousel" data-flickity='{ "freeScroll": true, "wrapAround": true,"autoPlay": true }'>
                        <div class="carousel-cell">
                        <div class="text ml100">
                                <p>GCM Grosvenor to Present at William <br> Blair’s 43rd Annual Growth Stock <br> Conference on June 7, 2023	</p>
                                <span>May 25, 2023</span> <br>
                                <a href="#"><button><p>READ MORE</p><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-cell">
                        <div class="text ml100">
                                <p>GCM Grosvenor to Present at William <br> Blair’s 43rd Annual Growth Stock <br> Conference on June 7, 2023	</p>
                                <span>May 25, 2023</span> <br>
                                <a href="#"><button><p>READ MORE</p><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                        <div class="carousel-cell">
                        <div class="text ml100">
                                <p>GCM Grosvenor to Present at the Morgan <br> Stanley US Financials, Payments and CRE <br> Conference on June 14, 2023	</p>
                                <span>May 31, 2023</span>  <br>
                                <a href="#"><button><p>READ MORE</p><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!--  -->
                </div>
                <div class="col-md-6">
                    <div class="line2"></div>
                </div>
            </div>
           </div>
        </div>
   </div>
</div>

 
@endsection
