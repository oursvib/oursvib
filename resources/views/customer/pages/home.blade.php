@extends('customer.layouts.default')

@section('content')
    <div id="wrapper">

        <div class="">
		<div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="homesearch-container search-container margin-top-100">
                            <h2>The World of Online Reservation &amp; Booking Marketplace <br></h2>
                            <div class="announce">Zero Subscription Fee | Free Listing </div>
                            @include('customer.includes.searchhome')
                            <!-- Row With Forms / End -->
                        </div>

                    </div>
                </div>
            </div>
			 <!-- Banner -->
		<div class="">
		<div class="homeslidercarousel owl-carousel">
                        <!-- Listing Item -->
                                <div class="owl-item">

                                                <img src="{{asset('customerfile/images/slider01.png')}}" alt="">
                                </div>
								<!-- Listing Item -->
                                <div class="owl-item">

                                                <img src="{{asset('customerfile/images/slider02.png')}}" alt="">
                                </div>
								<!-- Listing Item -->
                                <div class="owl-item">

                                                <img src="{{asset('customerfile/images/slider03.png')}}" alt="">
                                </div>
                                </div>
                                </div>


        </div>
		<!-- Category Listings-->
<div class="container-fluid margin-top-less200 homelistings">
            <div class="row margin-bottom-15">
			<div class="col-md-3">
			<div class="utf-listing-item">
            <div class="utf-listing-content">
              <div class="utf-listing-title">
                <h4><a href="{{URL('viewlistingbycategory',['venue'])}}">Venues</a></h4>
				<img src="{{asset('customerfile/images/popular-location-01.jpg')}}" alt="" style="height: auto;">
				<a href="{{URL('viewlistingbycategory',['venue'])}}">See more venues</a>
			  </div>
			  </div>
			  </div>
			  </div>
			<div class="col-md-3">
			<div class="utf-listing-item">
            <div class="utf-listing-content">
              <div class="utf-listing-title">
                <h4><a href="{{URL('viewlistingbycategory',['space'])}}">Space</a></h4>
				<img src="{{asset('customerfile/images/popular-location-03.jpg')}}" alt="" style="height: auto;">
				<a href="{{URL('viewlistingbycategory',['space'])}}">See more Space</a>
			  </div>
			  </div>
			  </div>
			  </div>
			<div class="col-md-3">
			<div class="utf-listing-item">
            <div class="utf-listing-content">
              <div class="utf-listing-title">
                <h4><a href="{{URL('viewlistingbycategory',['happenings'])}}">Happenings</a></h4>
				<img src="{{asset('customerfile/images/popular-location-02.jpg')}}" alt="" style="height: auto;">
				<a href="{{URL('viewlistingbycategory',['happenings'])}}">See more happenings</a>
			  </div>
			  </div>
			  </div>
			  </div>
			<div class="col-md-3">
			<div class="utf-listing-item">
            <div class="utf-listing-content">
              <div class="utf-listing-title">
                <h4><a href="{{URL('viewlistingbycategory',['services'])}}">Services</a></h4>
				<img src="{{asset('customerfile/images/popular-location-05.jpg')}}" alt="" style="height: auto;">
				<a href="{{URL('viewlistingbycategory',['services'])}}">See more Services</a>
			  </div>
			  </div>
			  </div>
			  </div>

          </div>

		  </div>
        <!-- Featured -->
        <div class="container-fluid margin-bottom-30">
            <div class="row discoveroursvibsec">
                <div class="col-md-12">
                <div class="white_bg">
                <div class="utf-listing-title  padding-bottom-5">
                        <h3 class="headline margin-top-0  margin-bottom-0 ">Discover Oursvib</h3>
                         </div>
                </div>
                </div>
                <div class="col-md-12">
                <div class="white_bg">
                    <div class="carousel owl-carousel">
                        <!-- Listing Item -->

                       @foreach($recentlisting as $recent)
                                <div class="owl-item">
                                    <div class="utf-carousel-item-area">
                                        <div class="utf-listing-item compact">
                                            <a href="{{URL('viewlisting', [$recent->id])}}" class="utf-smt-listing-img-container">

                                                <div class="utf-listing-img-content-item">
                                                    <span class="utf-listing-compact-title-item"> {{$recent->title}}<i>Starts from RM {{$recent->listingprice->where('listing_id',$recent->id)->min('normal_price')}}</i></span>
                                                </div>
                                                <img src="https://oursvib.s3.amazonaws.com/medium_image/medium_{{$recent->listingimages->where('listing_id',$recent->id)->pluck('listing_images')->first()}}" width="268" height="205">

                                            </a>
                                        </div>
                                    </div>
                                </div>
                        @endforeach

                    </div>
                        <div class="owl-controls clickable">
                            <div class="owl-pagination">
                                <div class="owl-page active"><span class=""></span>
                                </div>
                                <div class="owl-page"><span class=""></span>
                                </div>
                            </div>
                            <div class="owl-buttons">
                                <div class="owl-prev"></div>
                                <div class="owl-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Carousel / End -->
            </div>
        <!-- Featured / End -->

        <!-- Container -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="utf-section-headline-item centered margin-bottom-30 margin-top-0">
                        <h3 class="headline"><span>Most Popular </span> Most Popular Properties Places</h3>
                        <div class="utf-headline-display-inner-item">Most Popular</div>
                        <p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
                    </div>
                </div>
                @foreach($statewise as $s=>$state)
                <div class="col-md-4 col-sm-6">
                    <a href="{{URL('viewlistingbystate', [$state->state])}}" class="img-box">
                        <div class="utf-listing-badges-item"> <span class="featured">Featured</span>
                        </div>
                        <img src="{{asset('customerfile/images/popular-location-'.sprintf("%02d",$s+1).'.jpg')}}" alt="">
                        <div class="utf-cat-img-box-content visible">
                            <h4> {{ucwords($state->name)}}</h4>
                            <span>{{$state->total}} listings</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="utf-centered-button margin-top-10">
                <a href="{{URL('viewlistingcountry', [$country[0]->countryId])}}" class="button">View all listing in {{ucwords($country[0]->name)}}</a>
            </div>
        </div>
        <!-- Container / End -->
        <section class="fullwidth margin-top-65 margin-bottom-0 padding-bottom-80 padding-top-75" data-background-color="#f7f7f7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf-section-headline-item centered margin-bottom-0 margin-top-0">
                            <h3 class="headline"><span>Clients Say About Us</span> What Our Clients Say</h3>
                            <div class="utf-headline-display-inner-item">Clients Say About Us</div>
                            <p class="utf-slogan-text">Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="testimonial-carousel owl-carousel owl-theme" >
                                    <div class="owl-item">
                                        <div class="utf-carousel-item-area">
                                            <div class="utf-listing-item utf-testimonial-item-box-area">
                                                <div class="utf-testimonial-box">
                                                    <div class="testimonial">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown printer took a galley of type and scrambled
                                                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                                                        text of the printing and type setting industry galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged.</div>
                                                    <div class="testimonial-author">
                                                        <img src="{{asset('customerfile/images/happy-client-01.jpg')}}" alt="">
                                                        <h4>John Williams <span>Real Estate Agent</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" >
                                        <div class="utf-carousel-item-area">
                                            <div class="utf-listing-item utf-testimonial-item-box-area">
                                                <div class="utf-testimonial-box">
                                                    <div class="testimonial">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown printer took a galley of type and scrambled
                                                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                                                        text of the printing and type setting industry galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged.</div>
                                                    <div class="testimonial-author">
                                                        <img src="{{asset('customerfile/images/happy-client-02.jpg')}}" alt="">
                                                        <h4>John Williams <span>Real Estate Agent</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="utf-carousel-item-area">
                                            <div class="utf-listing-item utf-testimonial-item-box-area">
                                                <div class="utf-testimonial-box">
                                                    <div class="testimonial">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown printer took a galley of type and scrambled
                                                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                                                        text of the printing and type setting industry galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged.</div>
                                                    <div class="testimonial-author">
                                                        <img src="{{asset('customerfile/images/happy-client-03.jpg')}}" alt="">
                                                        <h4>John Williams <span>Real Estate Agent</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="utf-carousel-item-area">
                                            <div class="utf-listing-item utf-testimonial-item-box-area">
                                                <div class="utf-testimonial-box">
                                                    <div class="testimonial">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown printer took a galley of type and scrambled
                                                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                                                        text of the printing and type setting industry galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged.</div>
                                                    <div class="testimonial-author">
                                                        <img src="{{asset('customerfile/images/happy-client-03.jpg')}}" alt="">
                                                        <h4>John Williams <span>Real Estate Agent</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="utf-carousel-item-area">
                                            <div class="utf-listing-item utf-testimonial-item-box-area">
                                                <div class="utf-testimonial-box">
                                                    <div class="testimonial">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since, when an unknown printer took a galley of type and scrambled
                                                        it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the
                                                        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy
                                                        text of the printing and type setting industry galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                                                        remaining essentially unchanged.</div>
                                                    <div class="testimonial-author">
                                                        <img src="{{asset('customerfile/images/happy-client-02.jpg')}}" alt="">
                                                        <h4>John Williams <span>Real Estate Agent</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            <div class="owl-controls clickable">
                                <div class="owl-pagination">
                                    <div class="owl-page"><span class=""></span>
                                    </div>
                                    <div class="owl-page active"><span class=""></span>
                                    </div>
                                    <div class="owl-page"><span class=""></span>
                                    </div>
                                    <div class="owl-page"><span class=""></span>
                                    </div>
                                    <div class="owl-page"><span class=""></span>
                                    </div>
                                </div>
                                <div class="owl-buttons">
                                    <div class="owl-prev"></div>
                                    <div class="owl-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel / End -->
                </div>
            </div>
        </section>

 @stop
