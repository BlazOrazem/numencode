<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="content-box p-20 base-bg white f-s-16 text-center">
            <div>
                <p>Logged in as<br /><strong>{{ $admin->name }}</strong></p>
                <span class="current-date"></span>
            </div>
            <span class="time" style="font-size: 50px; font-weight: 400; letter-spacing: 0; margin-top: 27px; line-height: 50px;"></span>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="content-box">
            <div class="head clearfix">
                <h5 class="content-title text-color text-center" style="width: 100%;">Website visitors</h5>
            </div>
            <div class="content">
                <div class="visitors-chart text-right" data-percent="0"></div>
                <div class="p-absolute t-50 l-20">
                    <p class="zero-m">New visitors</p>
                    <p class="zero-m success-color f-20 visitorsNew">0%</p>
                </div>
                <div class="p-absolute b-20 l-20">
                    <p class="zero-m">Returning<br />visitors</p>
                    <p class="zero-m base-color f-20 visitorsReturn">0%</p>
                </div>
            </div>
            <div class="visible-lg visible-md" style="height: 6px;"></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="content-box success-bg white text-center">
            <div class="head clearfix">
                <h5 class="content-title" style="width: 100%;">Website statistics</h5>
            </div>
            <div class="content" style="padding-top: 12px;">
                <p class="text-uppercase zero-m">Visitors</p>
                <p class="f-30 visitorCounter">0</p>
                <p class="text-uppercase zero-m">Pageviews</p>
                <p class="zero-m f-30 pageviewCounter">0</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="content-box info-bg white text-center">
            <div class="head clearfix">
                <h5 class="content-title" style="width: 100%;">Website traffic</h5>
            </div>
            <div class="content" style="padding-top: 12px;">
                <p class="text-uppercase zero-m">Average session duration</p>
                <p class="f-30 avgSessionDuration">0</p>
                <p class="text-uppercase zero-m">Currently active visitors</p>
                <p class="zero-m f-30 activeVisitors"></p>
            </div>
        </div>
    </div>
</div>