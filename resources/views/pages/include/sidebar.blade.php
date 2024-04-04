
{{-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
       <div class="section-bar clearfix">
          <div class="section-title">
             <span>Phim Hot</span>
          </div>
       </div>
       <section class="tab-content">
          <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
             <div class="halim-ajax-popular-post hidden"></div>
             <div class="popular-post">
               @foreach($phimhot_sidebar as $key => $hot)
                <div class="item post-37176">
                   <a href="{{route('movie',$hot->slug)}}" title="{{$hot->title}}">
                      <div class="item-link">
                         <img src="{{asset('uploads/movie/'.$hot->image)}}" class="lazy post-thumb" alt="{{$hot->title}}" title="{{$hot->title}}" />
                         <span class="is_trailer">Hot</span>
                      </div>
                      <p class="title">{{$hot->title}}</p>
                   </a>
                   <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                   <div style="float: left;">
                      <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                      <span style="width: 0%"></span>
                      </span>
                   </div>
                </div>
                @endforeach
             </div>
          </div>
       </section>
    </div>
 </aside> --}}
     <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Top Views</span>
                    <ul class="halim-popular-tab " role="tablist" id="pills-tad">
                        <li role="presentation" class="active">
                            <a class="ajax-tab filter-sidebar" id="pills-home-tad" role="tab" data-toggle="pill" data-showpost="10" href="#ngay" data-type="today">Day</a>
                        </li>
                        <li role="presentation">
                            <a class="ajax-tab filter-sidebar" id="pills-home-tad" role="tab" data-toggle="pill" data-showpost="10" href="#tuan" data-type="week">Week</a>
                        </li>
                        <li role="presentation">
                            <a class="ajax-tab filter-sidebar" id="pills-home-tad" role="tab" data-toggle="pill" data-showpost="10" href="#thang" data-type="month">Month</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
               {{-- <div id="halim-ajax-popular-post-default" class="popular-post">
                     <span id="show_data_default"></span>
               </div> --}}
               <div class="tab-pane fade-post" id="tuan" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div id="halim-ajax-popular" class="popular-post">
                     <span id="show_data"></span>
                  </div>
               </div>
             </div>
            <div class="clearfix"></div>
        </div>
    </aside>