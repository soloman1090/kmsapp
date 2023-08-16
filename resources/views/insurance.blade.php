@extends('templates.public')

 
@section('content')


<div class="margin_60_35">
<section class="banner">
    <div class="sec1">
        <h1>Insurance Solutions</h1>
        <p>We are a provider of bespoke alternative investment solutions to insurance company balance sheets globally</p>
    </div>
    </section>

    <div class="container">
        <div class="margin50"></div>
            <div class="secs2">
                <p>We utilize a consultative approach to offer both structured and customized alternative asset management solutions that meet the unique needs of the insurance industry. Our broad skill set results from our open architecture framework and allows us to pursue strong risk adjusted returns in a thoughtful and capital efficient format, aiming to increase ROE and book value growth while mitigating balance sheet volatility. We work as an extension of the internal asset management capabilities for insurance companies globally.</p>
            </div>
    </div>

    <div class="secs3 ">
        
        <div class="container">
            <div class="padding10"></div>
        <div class="">
            <h1>Representative Solutions</h1>
        </div>
        <div class="margin20"></div>
            <center>
                <div class="sec3s">
                    <div class="sec3--">
                       <div class="icon">
                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 250.83 249.58" style="enable-background:new 0 0 250.83 249.58;" xml:space="preserve"><style type="text/css">	.st4{fill:#D1D3D4;}	.st5{fill:none;}	.st6{fill:#FFFFFF;}	.st7{fill:#088470;}</style><image style="overflow:visible;" width="174" height="162" xlink:href="data:image/jpeg;base64,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" transform="matrix(1 0 0 1 -652.625 79.4167)"></image><path class="st4" d="M125.62,248.17c68.21,0,123.5-55.29,123.5-123.5S193.83,1.17,125.62,1.17S2.12,56.46,2.12,124.67 S57.42,248.17,125.62,248.17"></path><rect x="-6.88" y="-5.83" class="st5" width="265" height="255"></rect><path class="st6" d="M125.89,235.67c61.45,0,111.26-49.82,111.26-111.27S187.34,13.14,125.89,13.14S14.62,62.95,14.62,124.4 S64.44,235.67,125.89,235.67"></path><rect x="2.12" y="1.17" class="st5" width="247" height="247"></rect><rect x="2.12" y="1.17" class="st5" width="247" height="247"></rect><path class="st7" d="M71.15,110.22c0-2-0.01-5.36-0.71-8.61c4.29,0.17,5.17,5.73,5.17,13.07v4.65c-1.59,0.13-3.09,0.54-4.46,1.22 V110.22z M120.21,186.33H89.44c0-8.92-1.12-11.29-6.12-13.77c-6.73-3.35-11.07-7.66-14-10.97c-9.41-10.66-16.01-22.44-16.01-30.72 c0-6.98,0-11.44,0-20.36s1.9-13.38,8.03-13.38c4.46,0,5.35,5.65,5.35,13.1v14.2c-3.75,5.51-2.31,13.45,2.05,18.36 c0.04,0.05,4.67,4.89,10.99,12.44l5.69,6.28c0.17,0.24,0.35,0.47,0.57,0.63c1.46-3.41-1.25-8.57-2.5-10.06 c-0.63-0.75-1.23-1.45-1.82-2.15l0,0c-5.55-6.52-9.4-10.54-9.4-10.54c-3.1-3.51-4.25-9.92-0.55-13.39 c3.71-3.46,9.82-1.66,12.92,1.85l12.41,14.16c4.03,0.32,10.53,1.32,14.97,5.12C118.57,152.74,120.21,159.57,120.21,186.33z  M178.2,120.55c-1.37-0.68-2.87-1.09-4.46-1.22v-4.65c0-7.34,0.89-12.91,5.18-13.07c-0.71,3.25-0.71,6.62-0.71,8.61V120.55z  M137.33,147.13c4.44-3.8,10.95-4.8,14.97-5.12l12.41-14.16c3.1-3.51,9.21-5.31,12.92-1.85c3.71,3.47,2.55,9.88-0.55,13.39 c0,0-3.85,4.02-9.4,10.54l0,0c-0.59,0.7-1.18,1.4-1.82,2.15c-1.25,1.49-3.96,6.64-2.5,10.06c0.23-0.17,0.4-0.39,0.57-0.63l5.69-6.28 c6.32-7.56,10.95-12.4,11-12.44c4.35-4.92,5.78-12.85,2.04-18.36v-14.2c0-7.46,0.9-13.1,5.36-13.1c6.13,0,8.02,4.46,8.02,13.38 s0,13.38,0,20.36c0,8.28-6.6,20.06-16.01,30.72c-2.93,3.31-7.26,7.62-14,10.97c-5.01,2.49-6.12,4.85-6.12,13.77h-30.78 C129.13,159.57,130.78,152.74,137.33,147.13z M124.67,56.97c-22.17,0-40.14,17.97-40.14,40.14s17.97,40.14,40.14,40.14 c22.17,0,40.14-17.97,40.14-40.14S146.84,56.97,124.67,56.97z M124.67,128.12c-17.12,0-31-13.88-31-31s13.88-31,31-31 c17.13,0,31.01,13.88,31.01,31S141.8,128.12,124.67,128.12z M138.05,105.14c0-5.68-3.25-8.97-10.53-11.64 c-4.84-1.89-6.83-3.42-6.83-5.53c0-2.26,2.57-3.55,5.51-3.55c3.22,0,7.05,2.61,8.23,3.36c0.21,0.13,0.45,0.2,0.69,0.2 c0.15,0,0.3-0.03,0.44-0.07c0.37-0.13,0.65-0.43,0.78-0.79l1.65-5.57c0.18-0.54-0.03-1.14-0.52-1.44c-1.9-1.23-5.44-2.39-8.34-2.68 v-5.44c0-0.89-0.71-1.62-1.57-1.62h-5.78c-0.87,0-1.58,0.73-1.58,1.62v5.83c-5.42,1.71-8.92,5.75-8.92,10.99 c0,5.09,3.71,8.51,10.82,11.06c5.05,1.86,6.72,3.74,6.72,5.89c0,2.64-2.41,3.51-5.69,3.51c-3.1,0-6.41-1.52-8.31-2.62 c-0.2-0.12-0.43-0.18-0.65-0.18c-0.15,0-0.31,0.04-0.45,0.09c-0.37,0.14-0.64,0.42-0.76,0.79l-1.61,5.75 c-0.18,0.56,0.06,1.17,0.57,1.47c2.44,1.41,5.04,2.43,8.28,2.28v4.98c0,1.34,0.71,2.06,1.58,2.06h5.78c0.86,0,1.57-0.73,1.57-1.62 v-5.69C135,114.99,138.05,110.92,138.05,105.14z"></path></svg>
                       </div>
                        <div>
                            <p>CAPITAL EFFICIENT STRUCTURED PRODUCTS
                            </p>
                        </div>
                    </div>
        
                    <div class="sec3--">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 250.83 249.58" style="enable-background:new 0 0 250.83 249.58;" xml:space="preserve"><style type="text/css">	.st50{fill:#D1D3D4;}	.st51{fill:none;}	.st52{fill:#FFFFFF;}	.st53{fill:#068571;}</style><path class="st50" d="M125.62,248.17c68.21,0,123.5-55.29,123.5-123.5S193.83,1.17,125.62,1.17S2.12,56.46,2.12,124.67 S57.42,248.17,125.62,248.17"></path><rect x="-6.88" y="-5.83" class="st51" width="174" height="162"></rect><path class="st52" d="M125.89,235.67c61.45,0,111.26-49.82,111.26-111.27S187.34,13.14,125.89,13.14S14.62,62.95,14.62,124.4 S64.44,235.67,125.89,235.67"></path><rect x="2.12" y="1.17" class="st51" width="174" height="163"></rect><rect x="2.12" y="1.17" class="st51" width="247" height="247"></rect><g>	<g>		<path class="st53" d="M148.18,172.42l-10.02-10.02c-4.36,1.47-9.01,2.29-13.87,2.29c-24.04,0-43.52-19.48-43.52-43.52   c0-24.04,19.48-43.52,43.52-43.52s43.52,19.48,43.52,43.52c0,4.87-0.84,9.54-2.31,13.92l9.99,9.99c0.53-0.48,1.21-0.77,1.96-0.75   l8.67,0.15c1.28,0,2.44-0.78,2.84-2c0.26-0.75,0.49-1.51,0.73-2.29c0.49-1.68,0.93-3.39,1.28-5.14c0.26-1.25-0.35-2.52-1.48-3.13   l-7.54-4.21c-1.02-0.55-1.6-1.65-1.51-2.81c0.17-2.47,0.17-4.93,0-7.43c-0.09-1.16,0.49-2.26,1.48-2.81l7.57-4.21   c1.1-0.61,1.74-1.89,1.48-3.16c-0.26-1.25-0.55-2.5-0.9-3.71c-0.32-1.25-0.7-2.5-1.1-3.68c-0.38-1.22-1.57-2.03-2.84-2l-8.65,0.15   c-1.16,0.03-2.21-0.67-2.7-1.68c-1.1-2.26-2.35-4.41-3.71-6.44c-0.67-0.96-0.73-2.21-0.12-3.19l4.44-7.43   c0.67-1.07,0.55-2.5-0.29-3.45c-1.19-1.33-2.41-2.61-3.68-3.83c-0.58-0.55-1.16-1.07-1.77-1.6c-0.93-0.87-2.35-0.96-3.45-0.32   l-7.43,4.47c-0.99,0.61-2.23,0.52-3.19-0.12c-2.06-1.39-4.21-2.64-6.41-3.71c-1.07-0.49-1.74-1.54-1.71-2.7l0.15-8.67   c0-1.28-0.78-2.44-2-2.84c-0.75-0.26-1.51-0.49-2.29-0.73c-1.68-0.49-3.39-0.93-5.14-1.28c-1.25-0.26-2.52,0.35-3.13,1.48   l-4.21,7.54c-0.55,1.02-1.65,1.6-2.81,1.51c-2.47-0.17-4.93-0.17-7.43,0c-1.16,0.09-2.26-0.49-2.81-1.48l-4.21-7.57   c-0.61-1.1-1.89-1.74-3.16-1.48c-1.25,0.26-2.5,0.55-3.71,0.9c-1.25,0.32-2.5,0.7-3.68,1.1c-1.22,0.38-2.03,1.57-2,2.84l0.15,8.65   c0.03,1.16-0.67,2.2-1.68,2.7c-2.26,1.1-4.41,2.35-6.44,3.71c-0.96,0.67-2.2,0.73-3.19,0.12l-7.43-4.44   c-1.07-0.67-2.5-0.55-3.45,0.29c-1.33,1.19-2.61,2.41-3.83,3.68c-0.55,0.58-1.07,1.16-1.6,1.77c-0.87,0.93-0.96,2.35-0.32,3.45   l4.47,7.43c0.61,0.99,0.52,2.23-0.12,3.19c-1.39,2.06-2.64,4.21-3.71,6.41c-0.49,1.07-1.54,1.74-2.7,1.71l-8.67-0.15   c-1.28,0-2.44,0.78-2.84,2c-0.26,0.75-0.49,1.51-0.73,2.29c-0.49,1.68-0.93,3.39-1.28,5.14c-0.26,1.25,0.35,2.52,1.48,3.13   l7.54,4.21c1.02,0.55,1.6,1.65,1.51,2.81c-0.17,2.47-0.17,4.93,0,7.43c0.09,1.16-0.49,2.26-1.48,2.81l-7.57,4.21   c-1.1,0.61-1.74,1.89-1.48,3.16c0.26,1.25,0.55,2.5,0.9,3.71c0.32,1.25,0.7,2.5,1.1,3.68c0.38,1.22,1.57,2.03,2.84,2l8.65-0.15   c1.16-0.03,2.2,0.67,2.7,1.68c1.1,2.26,2.35,4.41,3.71,6.44c0.67,0.96,0.73,2.21,0.12,3.19l-4.44,7.43   c-0.67,1.07-0.55,2.5,0.29,3.45c1.19,1.33,2.41,2.61,3.68,3.83c0.58,0.55,1.16,1.07,1.77,1.6c0.93,0.87,2.35,0.96,3.45,0.32   l7.43-4.47c0.99-0.61,2.23-0.52,3.19,0.12c2.06,1.39,4.21,2.64,6.41,3.71c1.07,0.49,1.74,1.54,1.71,2.7l-0.15,8.67   c0,1.28,0.78,2.44,2,2.84c0.75,0.26,1.51,0.49,2.29,0.73c1.68,0.49,3.39,0.93,5.14,1.28c1.25,0.26,2.52-0.35,3.13-1.48l4.21-7.54   c0.55-1.02,1.65-1.6,2.81-1.51c2.47,0.17,4.93,0.17,7.43,0c1.16-0.09,2.26,0.49,2.81,1.48l4.21,7.57c0.61,1.1,1.89,1.74,3.16,1.48   c1.25-0.26,2.5-0.55,3.71-0.9c1.25-0.32,2.5-0.7,3.68-1.1c1.22-0.38,2.03-1.57,2-2.84l-0.15-8.65   C147.43,173.63,147.72,172.96,148.18,172.42z"></path>	</g>	<g>		<path class="st53" d="M157.45,135.26c-2.13-2.13-2.99-5.17-2.43-8.13c1.84-9.77-1-20.25-8.56-27.81   c-7.8-7.8-18.69-10.57-28.72-8.37c-0.59,0.13-0.81,0.88-0.39,1.31c3.08,3.08,12.61,12.61,16.65,16.65   c1.12,1.12,1.48,2.83,0.81,4.27c-3.84,8.23-10.35,14.74-18.57,18.57c-1.44,0.67-3.16,0.3-4.28-0.82   c-4.5-4.5-15.64-15.64-15.64-15.64c-1.43-1.43-2.18-1.2-2.31-0.6c-2.51,11.51,1.52,24.16,12.19,31.95c7,5.11,15.8,6.84,24.05,5.28   c2.94-0.55,5.96,0.33,8.07,2.44l27.86,27.86c5.25,5.25,13.76,5.25,19.02,0l0.1-0.1c5.25-5.25,5.25-13.76,0-19.02L157.45,135.26z"></path>	</g></g></svg>
                        </div>
                        <div>
                            <p>CUSTOMIZED SEPARATE ACCOUNTS ACROSS ASSET CLASSES
        
                            </p>
                        </div>
                    </div>
        
                    <div class="sec3--">
                        <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 250.83 249.58" style="enable-background:new 0 0 250.83 249.58;" xml:space="preserve"><style type="text/css">	.st12{fill:#D1D3D4;}	.st13{fill:none;}	.st14{fill:#FFFFFF;}	.st15{fill:#068571;}</style><image style="overflow:visible;" width="174" height="162" xlink:href="data:image/jpeg;base64,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" transform="matrix(1 0 0 1 -652.625 79.4167)"></image><path class="st12" d="M125.62,248.17c68.21,0,123.5-55.29,123.5-123.5S193.83,1.17,125.62,1.17S2.12,56.46,2.12,124.67 S57.42,248.17,125.62,248.17"></path><rect x="-6.88" y="-5.83" class="st13" width="265" height="255"></rect><path class="st14" d="M125.89,235.67c61.45,0,111.26-49.82,111.26-111.27S187.34,13.14,125.89,13.14S14.62,62.95,14.62,124.4 S64.44,235.67,125.89,235.67"></path><rect x="2.12" y="1.17" class="st13" width="247" height="247"></rect><rect x="2.12" y="1.17" class="st13" width="247" height="247"></rect><path class="st15" d="M190.49,172.89v11.56c0,1.91-1.55,3.47-3.47,3.47H64.51c-1.91,0-3.47-1.55-3.47-3.47v-11.56 c0-1.91,1.55-3.47,3.47-3.47h122.51C188.94,169.42,190.49,170.97,190.49,172.89z M188.73,97.02l-60.39-37.91 c-1.61-0.87-3.52-0.87-5.13,0L62.81,97.02c-1.09,0.59-1.77,1.77-1.77,3.05v5.82c0,1.9,1.46,3.43,3.26,3.43h122.92 c1.81,0,3.26-1.53,3.26-3.43v-5.82C190.49,98.79,189.81,97.61,188.73,97.02z M105.62,90.82l20.14-13.33l20.14,13.33H105.62z  M96.78,113.94H71.54c-0.69,0-1.25,0.56-1.25,1.25v3.37c0,2.56,2.07,4.62,4.62,4.62v32.36c-2.56,0-4.62,2.07-4.62,4.62v3.37 c0,0.69,0.56,1.25,1.25,1.25h25.24c0.69,0,1.25-0.56,1.25-1.25v-3.37c0-2.56-2.07-4.62-4.62-4.62v-32.36c2.56,0,4.62-2.07,4.62-4.62 v-3.37C98.03,114.5,97.47,113.94,96.78,113.94z M138.39,113.94h-25.24c-0.69,0-1.25,0.56-1.25,1.25v3.37c0,2.56,2.07,4.62,4.62,4.62 v32.36c-2.56,0-4.62,2.07-4.62,4.62v3.37c0,0.69,0.56,1.25,1.25,1.25h25.24c0.69,0,1.25-0.56,1.25-1.25v-3.37 c0-2.56-2.07-4.62-4.62-4.62v-32.36c2.56,0,4.62-2.07,4.62-4.62v-3.37C139.64,114.5,139.08,113.94,138.39,113.94z M180,113.94 h-25.24c-0.69,0-1.25,0.56-1.25,1.25v3.37c0,2.56,2.07,4.62,4.62,4.62v32.36c-2.56,0-4.62,2.07-4.62,4.62v3.37 c0,0.69,0.56,1.25,1.25,1.25H180c0.69,0,1.25-0.56,1.25-1.25v-3.37c0-2.56-2.07-4.62-4.62-4.62v-32.36c2.56,0,4.62-2.07,4.62-4.62 v-3.37C181.25,114.5,180.69,113.94,180,113.94z"></path></svg>
                        </div>
                        <div>
                            <p>CREDIT & EQUITY CO-INVESTMENT MANDATES
                            </p>
                        </div>
                    </div>
        
                    <div class="sec3--">
                       <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 250.83 249.58" style="enable-background:new 0 0 250.83 249.58;" xml:space="preserve"><style type="text/css">	.st70{fill:#D1D3D4;}	.st71{fill:none;}	.st72{fill:#FFFFFF;}	.st73{fill:#068571;}	.st74{fill:none;stroke:#068571;stroke-width:7;stroke-miterlimit:10;}</style><path class="st70" d="M125.62,248.17c68.21,0,123.5-55.29,123.5-123.5S193.83,1.17,125.62,1.17S2.12,56.46,2.12,124.67 S57.42,248.17,125.62,248.17"></path><rect x="-6.88" y="-5.83" class="st71" width="265" height="255"></rect><path class="st72" d="M125.89,235.67c61.45,0,111.26-49.82,111.26-111.27S187.34,13.14,125.89,13.14S14.62,62.95,14.62,124.4 S64.44,235.67,125.89,235.67"></path><rect x="2.12" y="1.17" class="st71" width="247" height="247"></rect><rect x="2.12" y="1.17" class="st71" width="247" height="247"></rect><g>	<rect id="XMLID_28_" x="66.45" y="157.78" class="st73" width="15.05" height="29.82"></rect>	<rect id="XMLID_30_" x="87.23" y="151.72" class="st73" width="15.05" height="35.89"></rect>	<rect id="XMLID_31_" x="108" y="142.19" class="st73" width="15.05" height="45.42"></rect>	<rect id="XMLID_32_" x="128.77" y="129.87" class="st73" width="15.05" height="57.74"></rect>	<rect id="XMLID_33_" x="149.55" y="111.2" class="st73" width="15.05" height="76.41"></rect>	<rect id="XMLID_34_" x="170.32" y="88.76" class="st73" width="15.05" height="98.85"></rect>	<path class="st74" d="M63.85,139.73c0,0,96.9-31,111.99-81.8"></path></g></svg>
                       </div>
                        <div>
                            <p>J-CURVE MITIGATION STRATEGIES IN SECONDARIES & CO-INVESTMENTS
        
                            </p>
                        </div>
                    </div>
        
                    <div class="sec3--">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 250.83 249.58" style="enable-background:new 0 0 250.83 249.58;" xml:space="preserve"><style type="text/css">	.st0{fill:#D1D3D4;}	.st1{fill:none;}	.st2{fill:#FFFFFF;}	.st3{fill:#068571;}</style><image style="overflow:visible;" width="174" height="162" xlink:href="data:image/jpeg;base64,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" transform="matrix(1 0 0 1 -652.625 79.4167)"></image><path class="st0" d="M125.62,248.17c68.21,0,123.5-55.29,123.5-123.5S193.83,1.17,125.62,1.17S2.12,56.46,2.12,124.67 S57.42,248.17,125.62,248.17"></path><rect x="-6.88" y="-5.83" class="st1" width="265" height="255"></rect><path class="st2" d="M125.89,235.67c61.45,0,111.26-49.82,111.26-111.27S187.34,13.14,125.89,13.14S14.62,62.95,14.62,124.4 S64.44,235.67,125.89,235.67"></path><rect x="2.12" y="1.17" class="st1" width="247" height="247"></rect><rect x="2.12" y="1.17" class="st1" width="247" height="247"></rect><g id="XMLID_486_">	<g id="XMLID_492_">		<path id="XMLID_496_" class="st3" d="M196.52,64.25c-0.02-0.08-0.05-0.17-0.08-0.25c-0.27-0.65-0.9-1.07-1.6-1.07l-10.87,0.26   l0.45-10.68c0-0.7-0.42-1.34-1.07-1.6c-0.65-0.27-1.4-0.12-1.89,0.38L169.3,63.44c-0.33,0.32-0.51,0.77-0.51,1.23l-0.45,12.41   c0,0.48,0.19,0.91,0.51,1.23l0,0c0.31,0.31,0.75,0.51,1.23,0.51l12.61-0.26c0.46,0,0.9-0.18,1.23-0.51l12.16-12.15   c0.31-0.31,0.49-0.72,0.51-1.14C196.58,64.59,196.57,64.42,196.52,64.25z"></path>		<path id="XMLID_493_" class="st3" d="M125.94,123.74c-0.59,0-1.18-0.22-1.63-0.67c-0.9-0.9-0.9-2.35,0-3.25l62.91-62.81   c0.9-0.9,2.35-0.9,3.25,0c0.9,0.9,0.9,2.35,0,3.25l-62.91,62.81C127.11,123.52,126.53,123.74,125.94,123.74L125.94,123.74z    M125.94,123.74"></path>	</g>	<g id="XMLID_487_">		<path id="XMLID_491_" class="st3" d="M177.51,123.74c0,29.76-24.12,53.88-53.88,53.88c-29.76,0-53.88-24.12-53.88-53.88   c0-29.76,24.12-53.88,53.88-53.88c13.15,0,25.2,4.72,34.56,12.54l6.31-6.31c-10.98-9.43-25.26-15.13-40.87-15.13   c-34.67,0-62.77,28.1-62.77,62.77c0,34.67,28.11,62.77,62.77,62.77c34.67,0,62.77-28.1,62.77-62.77   c0-15.58-5.68-29.84-15.08-40.82l-6.31,6.31C172.81,98.58,177.51,110.61,177.51,123.74z"></path>		<path id="XMLID_490_" class="st3" d="M159.55,123.74c0,19.84-16.08,35.92-35.92,35.92c-19.84,0-35.92-16.08-35.92-35.92   c0-19.84,16.08-35.92,35.92-35.92c8.19,0,15.74,2.74,21.78,7.36l6.33-6.33c-7.69-6.2-17.47-9.92-28.11-9.92   c-24.75,0-44.81,20.06-44.81,44.81c0,24.75,20.06,44.81,44.81,44.81c24.75,0,44.81-20.06,44.81-44.81   c0-10.62-3.7-20.38-9.88-28.06l-6.33,6.33C156.82,108.04,159.55,115.57,159.55,123.74z"></path>		<path id="XMLID_489_" class="st3" d="M141.59,123.74c0,9.92-8.04,17.96-17.96,17.96c-9.92,0-17.96-8.04-17.96-17.96   c0-9.92,8.04-17.96,17.96-17.96c3.22,0,6.24,0.85,8.85,2.33l6.51-6.51c-4.36-3.03-9.65-4.81-15.35-4.81   c-14.88,0-26.94,12.06-26.94,26.94c0,14.88,12.06,26.94,26.94,26.94c14.88,0,26.94-12.06,26.94-26.94c0-5.68-1.76-10.95-4.77-15.3   l-6.51,6.51C140.75,117.55,141.59,120.55,141.59,123.74z"></path>		<path id="XMLID_488_" class="st3" d="M126.08,126.16c-1.24,0-2.47-0.47-3.41-1.41c-1.89-1.89-1.89-4.94,0-6.83l2.94-2.94   c-0.64-0.14-1.3-0.22-1.98-0.22c-4.96,0-8.98,4.02-8.98,8.98c0,4.96,4.02,8.98,8.98,8.98c4.96,0,8.98-4.02,8.98-8.98   c0-0.65-0.07-1.29-0.2-1.9l-2.91,2.91C128.55,125.69,127.32,126.16,126.08,126.16z"></path>	</g></g></svg>
                        </div>
                        <div>
                            <p>ABSOLUTE RETURN MANDATE  
                            </p>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>

    <div class="container ">
        <div class="margin50"></div>
        <div class="greenLine"></div>
        <div class="margin30"></div>
        <h1>How We Invest</h1>
        <div class="margin30"></div>
        <div class="Drop1">
            <div class="drop_btn margin20" id="btn_vise">
                <button id="btn_direct" class="botBtn1" type="button" onclick="showhide(this)"> DIRECT INVESTMENTS</button>
                <button id="btn_co" class="botBtn2" type="button" onclick="showhide(this)">CO-INVESTMENTS</button>
                <button id="btn_fund" class="botBtn3" type="button" onclick="showhide(this)"> FUND INVESTMENTS</button>
                <button id="btn_secondary" class="botBtn4" type="button" onclick="showhide(this)">SECONDARY TRANSACTIONS</button>
                <button id="btn_joint" class="botBtn5" type="button" onclick="showhide(this)">JOINT VENTURE</button>
            </div>
            <div class="heighttable">
                <div id="direct" class="down" style="display: none;">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="">
                                <img src="{{ asset('assets/img/pexels-pixabay-414122.jpg') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2>Direct Investments </h2>
                                    <div class="margin25"></div>
                                    <p> Investments made directly into businesses or securities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="co" class="down"  style="display: none;">
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="">
                                <img src="{{ asset('assets/img/pexels-pixabay-414837.jpg') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class=" ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2> Co-Investments</h2>
                                    <div class="margin25"></div>
                                    <p> Investments made directly into businesses or securities in partnership with a sponsor. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fund" class="down"  style="display: none;">
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="">
                                <img src="{{ asset('assets/img/pexels-stephan-seeber-1261728.jpg') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class=" ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2>Fund Investments</h2>
                                    <div class="margin25"></div>
                                    <p> Investments in managers’ multi-client funds; such investments are also known as primary investments. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="secondary" class="down"  style="display: none;">
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="">
                                <img src="{{ asset('assets/img/Responsibility-success2.webp') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class=" ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2>Secondary Transactions</h2>
                                    <div class="margin25"></div>
                                    <p> Acquired interests in a primary fund after the fund has been at least partially deployed in underlying investments. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="joint" class="down"  style="display: none;">
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="">
                                <img src="{{ asset('assets/img/about_page/bridge.webp') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class=" ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2>Seed | Joint Venture | Acceleration Investments</h2>
                                    <div class="margin25"></div>
                                    <p>Investments in early stage managers or first funds in return for preferential terms and a share of manager economics. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="datta" class="down" style="display: block;">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="">
                                <img src="{{ asset('assets/img/pexels-pixabay-414122.jpg') }}" alt="" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="ml20">
                                <div class="padding20"></div>
                                <div class="greenLine"></div>
                                <div class="">
                                    <h2>Direct Investments </h2>
                                    <div class="margin25"></div>
                                    <p> Investments made directly into businesses or securities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    {{-- <div class="sec4">
        <div class="sec4-">
            <h1>How We Invest</h1>
            <div class="sec4-btn">
                <button>DIRECT INVESTMENTS</button>
                <button>CO-INVESTMENTS</button>
                <button>FUND-INVESTMENTS</button>
                <button>SECONDARY TRANSACTIONS</button>
                <button>JOINED VENTURE</button>
            </div>
            <div class="sec4-details">
                <div class="details-left"><img src="assets/img/insurance/chart_up.jpeg" alt=""></div>
                <div class="details-right">
                    <h1>Seed | Joint Venture | Acceleration Investments</h1>
                    <p>Investments in early stage managers or first funds in return for preferential terms and a share of manager economics. </p>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="margin50"></div>
    <div class="sec5 believe">
        <div class="sec5- ">
            <div class="col-md-8">
                <h1>"</h1>
               <h2>We believe we can provide significant value by tailoring our expertise across the alternatives spectrum to meet the unique needs of insurance capital."</h2>
               <div class="margin20"></div>
               <p>- Michael Sacks, Chairman and Chief Executive Officer of GCM Grosvenor</p>
            </div>
        </div>
    </div>

    <div class="margin50"></div>
    <div class="container">
        <div class="">
            <div class="">
                <h1>Why GCM Grosvenor for Insurance Solutions?</h1>
                <div class="margin30"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="sec6-details">
                            <h3>A global leader in alternative investments</h3>
                            <p>We are one of the largest independent alternative asset managers globally, with over 50 years of experience and $75 billion in assets under management.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sec6-details">
                            <h3>A leader in customized solutions​.</h3>
                            <p>Our open-architecture platform extends across alternative asset classes and allows us to tailor solutions to the unique needs of our clients.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sec6-details">
                            <h3>Experienced, dedicated team​</h3>
                            <p>With an average of ~15 years of insurance experience, our growing team specializes in delivering attractive solutions that meet the unique needs of each individual client.</p>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="margin60"></div>
        <div class="container">
            <div class="">
                <div class="greenLine"></div>
                <div class="margin30"></div>
                <div class="">
                    <h1>Related News and Insights</h1>
                    <div class="margin30"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sec7s-details">
                                <h3>How Insurers Can Navigate Alternatives in 2023</h3>
                                <span>March 2, 2023</span>
                                <div class="margin15"></div>
                                <p>We explore the attractive alternatives opportunity set for insurers and discuss how we believe they can best capitalize on that landscape in 2023. </p>
                                <button>LEARN MORE</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sec7s-details">
                                <h3>Incorporating Alternatives Into Insurance Portfolios Through Structured Solutions ​			</h3>
                                <span>			September 19, 2022		</span>
                                <div class="margin15"></div>
                                <p>We look at the applicability of alternative investments for insurers, discuss considerations insurers must keep in mind when making investment decisions, and explore several structured solutions in depth.   </p>
                                <button>LEARN MORE</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sec7s-details">
                                <h3>				GCM Grosvenor Raises $500 Million to Invest in Alternative Strategies as Part of GCM Grosvenor Insurance Solutions			</h3>
                                <span>November 8, 2021</span>
                                <div class="margin15"></div>
                                <p>CHICAGO, Nov. 08, 2021 — GCM Grosvenor (Nasdaq: GCMG), a global alternative asset management solutions provider, announced today that it has closed on a $500 million structured alternatives investment solution that will invest in alternative strategies including private equity, infrastructure, absolute return strategies, and alternative credit. <br> … </p>
                                <button>LEARN MORE</button>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
    </div>
<div class="martgin50"></div>
        </div>

 
@endsection
