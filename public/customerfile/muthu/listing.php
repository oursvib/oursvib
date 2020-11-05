<html lang="en">
   <?php
      $title="Oursvib Listings";
      $description="";
      $keywords="";
      include"sitehead.php";
      ?> 
   <body>
      <!-- Wrapper -->
      <div id="wrapper">
      <?php include"siteheader.php";
         ?> 
      <div class="clearfix"></div>
      <!-- Header Container / End --> 
      <!-- Titlebar -->
      <div class="parallax titlebar" data-background="https://www.oursvib.com/public/site/img/revsliderimgs/3A.jpg" >
        
         <div id="titlebar">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h2>Listings</h2>
                     <!-- Breadcrumbs -->
                     <nav id="breadcrumbs">
                        <ul>
                           <li><a href="index.html">Home</a></li>
                           <li>Listings</li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Main Search Container -->
      <div class="utf-main-search-container-area inner-map-search-block inner-search-item">
         <div class="container search-container" style="padding-top:25px;padding-bottom:0">
            <div class="row ">
               <!-- Property Type -->
               <div class="col-md-2 ">
                  <select data-placeholder="Property Type" class="utf-chosen-select-single-item" style="display: none;">
                     <option value="" disabled="" selected="">Type of Booking</option>
                     <option value="Instant Booking">Instant Booking</option>
                     <option value="Instant Booking Package">Instant Booking Package</option>
                     <option value="Rental">Rental</option>
                     <option value="Lease">Lease</option>
                  </select>
               </div>
               <div class="col-md-3">
                  <div class="utf-main-search-input-item">
                     <input type="text" name="selectdates" class="form-control " value="01/01/2018 - 01/15/2018" />
                  </div>
               </div>
               <!-- Status -->
               <div class="col-md-3">
                  <select data-placeholder="Any Status" class="utf-chosen-select-single-item" style="display: none;">
                     <option value="" disabled="" selected="">Filter by city/Town</option>
                     <option value="" disabled="">Malaysia 
                     </option>
                     <option value="Kuala Lumpur">Kuala Lumpur</option>
                     <option value="George Town">George Town</option>
                     <option value="Butterworth">Butterworth</option>
                     <option value="Shah Alam">Shal Alam</option>
                     <option value="Petaling Jaya">Petaling Jaya</option>
                     <option value="Ipoh">Ipoh</option>
                     <option value="Johar Bahru">Johor Bahru</option>
                     <option value="Iskandar Puteri">Iskandar Puteri</option>
                     <option value="Melaka">Melaka</option>
                     <option value="Alor Setar">Alor Setar</option>
                     <option value="Kuala Terrengganu">Kuala Terrengganu</option>
                     <option value="Kota kinabalu">Kota kinabalu</option>
                     <option value="Kuching">Kuching</option>
                     <option value="Miri">Miri</option>
                     <option value="" disabled="">Singapore 
                     </option>
                     <option value="Clementi">Clementi</option>
                     <option value="yishun">yishun</option>
                     <option value="Bukit Batok">Bukit Batok</option>
                     <option value="Jurong East">Jurong East</option>
                     <option value="Jurong West">Jurong West</option>
                     <option value="Kallang">Kallang</option>
                     <option value="Pasir Ris">Pasir Ris</option>
                     <option value="Queenstown">Queenstown</option>
                     <option value="Punggol">Punggol</option>
                     <option value="Sembawang">Sembawang</option>
                     <option value="Sengkang">Sengkang</option>
                     <option value="Serangoon">Serangoon</option>
                     <option value="Tampines">Tampines</option>
                     <option value="Toa Payoh">Toa Payoh</option>
                     <option value="Hougang">Hougang</option>
                     <option value="Ang Mo Kio">Ang Mo Kio</option>
                     <option value="Bedok">Bedok</option>
                     <option value="Bedok">Bishan</option>
                     <option value="Bukit Merah">Bukit Merah</option>
                     <option value="Bukit Panjang">Bukit Panjang</option>
                     <option value="Choa Chu Kang">Choa Chu Kang</option>
                     <option value="Geylang">Geylang</option>
                     <option value="Woodlands">Woodlands</option>
                     <option value="Ang Mo Kio"> Ang Mo Kio</option>
                     <option value="Bedok">Bedok</option>
                     <option value="Bishan">Bishan</option>
                  </select>
               </div>
               <div class="col-md-4">
                  <div class="utf-main-search-input-item">
                     <input class="form-control-lg" type="number" value="1" data-decimals="0" min="0" max="2000000" step="1"/>
                     <button class="button"><i class="fa fa-search"></i> Search</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Main Search Container / End -->
      <!-- Content -->
      <div class="container margin-bottom-25">
         <div class="row sticky-wrapper">
            <div class="col-md-8">
               <!-- Sorting -->
               <div class="utf-sort-box-aera">
                  <div class="sort-by">
                     <label>Sort By:</label>
                     <div class="sort-by-select">
                        <select data-placeholder="Default Properties" class="utf-chosen-select-single-item" style="display: none;">
                           <option>Default Properties</option>
                           <option>Low to High Price</option>
                           <option>High to Low Price</option>
                           <option>Newest Properties</option>
                           <option>Oldest Properties</option>
                        </select> 
                     </div>
                  </div>
                  <div class="utf-layout-switcher padding-bottom-15"> 
				  <a href="#" class="grid active"><i class="sl sl-icon-grid"></i></a> 
                     <a href="#" class="list "><i class="sl sl-icon-list"></i></a> 
                     
                  </div>
               </div>
               <!-- Listings -->
               <div class="utf-listings-container-area grid-layout">
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item"><span class="featured">Featured</span> </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <div class="utf-listing-carousel-item owl-carousel owl-theme" style="opacity: 1; display: block;">
                            <div class="owl-item" style="width: 271px;">
                                    <div><img src="images/listing-01.jpg" alt="" style="height: 302px;"></div>
                                 </div>
                                 <div class="owl-item" style="width: 271px;">
                                    <div><img src="images/listing-01.jpg" alt="" style="height: 302px;"></div>
                                 </div>
                                 <div class="owl-item" style="width: 271px;">
                                    <div><img src="images/listing-01.jpg" alt="" style="height: 302px;"></div>
                                 </div> 
                        </div>
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$22,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                     </div>
                  </div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item"> <span class="for-rent">For Rent</span> </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-02.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$20,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item"> <span class="featured">Featured</span> <span class="for-rent">For Rent</span> </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-03.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$18,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item">  </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <div class="utf-listing-carousel-item owl-carousel owl-theme" style="opacity: 1; display: block;">
                           <div class="owl-item" style="width: 271px;">
                                    <div><img src="images/listing-04.jpg" alt="" style="height: 302px;"></div>
                                 </div>
                                 <div class="owl-item" style="width: 271px;">
                                    <div><img src="images/listing-04.jpg" alt="" style="height: 302px;"></div>
                                 </div> 
                        </div>
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$16,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item">  </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-05.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$18,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item"> <span class="for-rent">For Rent</span> </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-06.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$15,000/mo</span>
                           <h4><a href="detailpage.php">Old Town Manchester</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item">  </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-05.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$18,000/mo</span>
                           <h4><a href="detailpage.php">Luxury Apartment</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <!-- Listing Item / End --> 
                  <!-- Listing Item -->
                  <div class="utf-listing-item">
                     <a href="detailpage.php" class="utf-smt-listing-img-container" style="height: 302px;">
                        <div class="utf-listing-badges-item"> <span class="for-rent">For Rent</span> </div>
                        <div class="utf-listing-img-content-item">
                           <span class="video-button with-tip" data-tip-content="Video">
                              <div class="tip-content">Video</div>
                           </span>
                        </div>
                        <img src="images/listing-06.jpg" alt="" style="height: 302px;"> 
                     </a>
                     <div class="utf-listing-content">
                        <div class="utf-listing-title">
                           <span class="utf-listing-price">$15,000/mo</span>
                           <h4><a href="detailpage.php">Old Town Manchester</a></h4>
                           <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> 2021 San Pedro, Los Angeles 90015</span>
                        </div>
                        <ul class="utf-listing-features">
                           <li><i class="fa fa-bed"></i> Beds<span>3</span></li>
                           <li><i class="icon-feather-codepen"></i> Baths<span>2</span></li>
                           <li><i class="fa fa-car"></i> Garages<span>2</span></li>
                           <li><i class="icon-line-awesome-arrows"></i> Sq Ft<span>1530</span></li>
                        </ul>
                        
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <!-- Listings Container / End --> 
               <!-- Pagination -->
               <div class="utf-pagination-container margin-top-20">
                  <nav class="pagination">
                     <ul>
                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#" class="current-page">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li class="blank">...</li>
                        <li><a href="#">10</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                     </ul>
                  </nav>
               </div>
               <!-- Pagination / End -->         
            </div>
            <!-- Sidebar -->
            <div class="col-md-4">
               <div class="sidebar"> 
                  <!-- Widget -->
                  <div class="widget utf-sidebar-widget-item">
                     <div class="utf-boxed-list-headline-item">
                        <h3>Find New Space</h3>
                     </div>
                     <div class="row with-forms">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <select data-placeholder="Any Status" class="utf-chosen-select-single-item" style="display: none;">
                              <option>Any Status</option>
                              <option>For Sale</option>
                              <option>For Rent</option>
                           </select>
                           <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>Any Status</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <select data-placeholder="Any Type" class="utf-chosen-select-single-item" style="display: none;">
                              <option>Any Type</option>
                              <option>Apartments</option>
                              <option>Houses</option>
                              <option>Commercial</option>
                              <option>Garages</option>
                              <option>Lots</option>
                           </select>
                           <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>Any Type</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Row / End --> 
                     <!-- Row -->
                     <div class="row with-forms">
                        <div class="col-md-6">
                           <select data-placeholder="Beds" class="utf-chosen-select-single-item" style="display: none;">
                              <option label="blank"></option>
                              <option>Beds (Any)</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                           </select>
                           <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>Beds</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <select data-placeholder="Baths" class="utf-chosen-select-single-item" style="display: none;">
                              <option label="blank"></option>
                              <option>Baths (Any)</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                           </select>
                           <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>Baths</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Row / End -->
                     <!-- Row -->
                     <div class="row with-forms">
                        <div class="col-md-12">
                           <select data-placeholder="All States" class="chosen-select" style="display: none;">
                              <option>All States</option>
                              <option>Alabama</option>
                              <option>Alaska</option>
                              <option>Arizona</option>
                              <option>Arkansas</option>
                              <option>California</option>
                              <option>Colorado</option>
                              <option>Connecticut</option>
                              <option>Delaware</option>
                              <option>Florida</option>
                              <option>Georgia</option>
                           </select>
                           <div class="chosen-container chosen-container-single" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>All States</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off"></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Row / End --> 
                     <!-- Row -->
                     <div class="row with-forms">
                        <div class="col-md-12">
                           <select data-placeholder="All Cities" class="chosen-select" style="display: none;">
                              <option>All Cities</option>
                              <option>New York</option>
                              <option>Los Angeles</option>
                              <option>Chicago</option>
                              <option>Brooklyn</option>
                              <option>Queens</option>
                              <option>Houston</option>
                              <option>Manhattan</option>
                           </select>
                           <div class="chosen-container chosen-container-single chosen-container-single-nosearch" style="width: 100%;" title="">
                              <a class="chosen-single chosen-default">
                                 <span>All Cities</span>
                                 <div><b></b></div>
                              </a>
                              <div class="chosen-drop">
                                 <div class="chosen-search"><input type="text" autocomplete="off" readonly=""></div>
                                 <ul class="chosen-results"></ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Row / End --> 
                     <!-- Area Range -->
                     <div class="utf-range-slider-item margin-top-10 margin-bottom-25">
                        <label>Area Range</label>
                        <div id="utf-area-range-item" data-min="0" data-max="1500" data-unit="sq ft" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                           <input type="text" class="first-slider-value" disabled=""><input type="text" class="second-slider-value" disabled="">
                           <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                           <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <!-- Price Range -->
                     <div class="utf-range-slider-item margin-bottom-10">
                        <label>Price Range</label>
                        <div id="utf-price-range-item" data-min="0" data-max="400000" data-unit="$" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                           <input type="text" class="first-slider-value" disabled=""><input type="text" class="second-slider-value" disabled="">
                           <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                           <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                     <!-- More Search Options --> 
                     <a href="#" class="utf-utf-more-search-options-area-button margin-bottom-10 margin-top-20" data-open-title="More Search Option" data-close-title="Less Search Option"></a>
                     <div class="utf-more-search-options-area relative">
                        <div class="checkboxes one-in-row margin-bottom-10">
                           <input id="check-2" type="checkbox" name="check">
                           <label for="check-2">Air Conditioning</label>
                           <input id="check-3" type="checkbox" name="check">
                           <label for="check-3">Swimming Pool</label>
                           <input id="check-4" type="checkbox" name="check">
                           <label for="check-4">Central Heating</label>
                           <input id="check-5" type="checkbox" name="check">
                           <label for="check-5">Laundry Room</label>
                           <input id="check-6" type="checkbox" name="check">
                           <label for="check-6">Gym</label>
                           <input id="check-7" type="checkbox" name="check">
                           <label for="check-7">Alarm</label>
                           <input id="check-8" type="checkbox" name="check">
                           <label for="check-8">Window Covering</label>
                        </div>
                        <!-- Checkboxes / End -->               
                     </div>
                     <!-- More Search Options / End -->
                     <button class="button fullwidth margin-top-10">Search</button>
                  </div>
                  <!-- Widget / End -->
                  <!-- Widget -->
                  <div class="widget utf-sidebar-widget-item">
                     <div class="utf-boxed-list-headline-item">
                        <h3>Recently Viewed</h3>
                     </div>
                     <ul class="widget-tabs">
                        <!-- Post #1 -->
                        <li>
                           <div class="widget-content">
                              <div class="widget-thumb"> <a href="blog-full-width-single-post.html"><img src="images/blog-widget-03.jpg" alt=""></a> </div>
                              <div class="widget-text">
                                 <h5><a href="blog-full-width-single-post.html">How to Woo a Recruiter and Land Your Dream.</a></h5>
                                 <span>$22,000/mo</span> 
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </li>
                        <!-- Post #2 -->
                        <li>
                           <div class="widget-content">
                              <div class="widget-thumb"> <a href="blog-full-width-single-post.html"><img src="images/blog-widget-02.jpg" alt=""></a> </div>
                              <div class="widget-text">
                                 <h5><a href="blog-full-width-single-post.html">Hey Its Time To Get Up And Get Hired.</a></h5>
                                 <span>$22,000/mo</span> 
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </li>
                        <!-- Post #3 -->
                        <li>
                           <div class="widget-content">
                              <div class="widget-thumb"> <a href="blog-full-width-single-post.html"><img src="images/blog-widget-01.jpg" alt=""></a> </div>
                              <div class="widget-text">
                                 <h5><a href="blog-full-width-single-post.html">The Best Canadian Merchant Account Providers.</a></h5>
                                 <span>$22,000/mo</span> 
                              </div>
                              <div class="clearfix"></div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <!-- Widget / End--> 
                    
                  <!-- Widget -->
                  <div class="widget utf-sidebar-widget-item">
                     <div class="utf-boxed-list-headline-item">
                        <h3>Social Sharing</h3>
                     </div>
                     <ul class="utf-social-icons rounded">
                        <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a class="instagram" href="#"><i class="icon-instagram"></i></a></li>
                        <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                     </ul>
                     <div class="clearfix"></div>
                  </div>
                  <!-- Widget / End-->            			
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- Sidebar / End --> 
         </div>
      </div>
      <?php include"sitefooter.php"; ?>