@extends('templates.public')

 
@section('content')


<div class="ESG">
    <div class="Banner1">
    
       <div class="text">
            <h5 class="m-0">ENVIRONMENTAL, SOCIAL AND GOVERNANCE INVESTING</h5>
            <h1>Our Approach</h1>
        </div>

    </div>
    <div class="container">
        <div class="section1">
            <center>
                <div class="text margin60">
                    <h4>OUR COMMITMENT TO ESG INTEGRATION</h4>
                    <div class="line margin20"></div>
                    <p>Individual research analysts and portfolio managers are responsible for implementing ESG integration in their portfolios and investment research. We believe this bottom-up approach encourages strategy-specific innovation while allowing each portfolio management team to learn from best practices across the investment platform. Our ESG Investing team accelerates this process with top-down expertise and support.</p>
                </div>
            </center>
        </div>
        <div class="section2 ">
            <center>
                <div class="col-md-7">
                    <div class="video1" >
                        <video width="320" controls>
                        <source src="mov_bbb.mp4" type="video/mp4">
                        <source src="mov_bbb.ogg" type="video/ogg">
                        Your browser does not support HTML video.
                        </video>
                    </div>

                    <a href="https://www.bigbuckbunny.org/" target="_blank"></a>
                </div>
            </center>
        </div>
    </div>
    <div class="section3 ">
        <div class="container ">
            <center>
                <h3>Neuberger Berman’s Environmental, Social and Governance Integration Framework</h3>
                <p>Our ESG-integrated strategies select an approach from our ESG Integration Framework of Avoid, Assess, Amplify or Aim for Impact, depending on various <br> factors such as the objectives of the strategy, asset class and investment time horizon.</p>
                <div class="img"></div>
            </center>
        </div>
    </div>
    <div class="container">
        <div class="section4  dash">
            <center class="margin60">
                <h3>PROPRIETARY ESG ANALYSIS AND RATINGS</h3>
                <div class="line margin20"></div>
                <p>At Neuberger Berman our research analysts have worked closely with our in-house ESG Investing team to rate corporations on <br> material ESG metrics at the industry level. Core to development of this proprietary ESG ratings system has been our ability to <br> marry the specialized sector expertise of our analysts with our dedicated internal ESG investing team’s perspective on complex <br> ESG data sets.</p>
            </center>
        </div>
        <div class="section5 margin60">
            <center class="margin60">
                <div class="top margin70">
                    <p class="">Assessment of Environmental and Social Factors</p>
                    <h3>A cohesive three-part method</h3>
                </div>
            </center>
            <div class="down ">
                <div class="row">
                    <div class="col-md-4">
                        <center>
                        <img src="{{ asset('assets/img/assess.svg') }}" alt="" style="width: 15%; height:15%;">
                        <div class="header">
                            <h3 class="number">1</h3>
                            <h3>Industry-Specific Assessment</h3>
                        </div>
                        <p>Conduct material factors analysis using Sustainability Accounting Standards Board (SASB) as a starting point, but adding expert analyst judgement</p>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                        <img src="{{ asset('assets/img/resource_icon.svg') }}" alt="" style="width: 15%; height:15%;">
                        <div class="header">
                            <h3 class="number">2</h3>
                            <h3>Broad Range of Sources</h3>
                        </div>
                        <p>Combines company-reported, specialized data and third-party research used to measure performance against these factors</p>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                        <img src="{{ asset('assets/img/Engagement.svg') }}" alt="" style="width: 15%; height:15%;">
                        <div class="header">
                            <h3 class="number">3</h3>
                            <h3>Active Engagement</h3>
                        </div>
                        <p>Engaging with company management provides additional qualitative insight for analysts to overlay quantitative assessment</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 
@endsection
